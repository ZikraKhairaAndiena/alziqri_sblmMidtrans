<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class PembayaranController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // Ganti true jika sudah live
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'orang_tua') {
            $siswa = Siswa::where('user_id', $user->id)->first();
            if (!$siswa) {
                return back()->with('error', 'Data siswa tidak ditemukan');
            }
            $pembayarans = Pembayaran::where('siswa_id', $siswa->id)->get();
            return view('admin.pembayaran.index', compact('pembayarans', 'siswa'));
        }

        $pembayarans = Pembayaran::with('siswa')->get();
        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    public function create()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        $totalTerbayar = Pembayaran::where('siswa_id', $siswa->id)
            ->where('status_bayar', 'paid')
            ->sum('nominal_bayar');

        $totalTagihan = 2000000; // Rp 2.000.000
        $sisaTagihan = $totalTagihan - $totalTerbayar;

        if ($sisaTagihan <= 0) {
            return back()->with('error', 'Tagihan sudah lunas.');
        }

        return view('admin.pembayaran.create', compact('siswa', 'sisaTagihan', 'totalTagihan', 'totalTerbayar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nominal_bayar' => 'required|numeric|min:10000',
        ]);

        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        $totalTagihan = 2000000;
        $totalTerbayar = Pembayaran::where('siswa_id', $siswa->id)
            ->where('status_bayar', 'paid')
            ->sum('nominal_bayar');

        $sisaTagihan = $totalTagihan - $totalTerbayar;

        if ($sisaTagihan <= 0) {
            return back()->with('error', 'Tagihan sudah lunas.');
        }

        if ($request->nominal_bayar > $sisaTagihan) {
            return back()->with('error', 'Nominal bayar melebihi sisa tagihan.');
        }

        $orderId = uniqid('PAY-');

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $request->nominal_bayar,
            ],
            'customer_details' => [
                'first_name' => $siswa->nama,
                'email' => $siswa->user->email,
                'phone' => $siswa->no_telp,
            ],
            'callbacks' => [
                'finish' => route('admin.pembayaran.success')
            ]
        ];

        $snapToken = Snap::getSnapToken($params);
        $paymentUrl = "https://app.sandbox.midtrans.com/snap/v2/vtweb/" . $snapToken;

        Pembayaran::create([
            'order_id' => $orderId,
            'siswa_id' => $siswa->id,
            'tgl_bayar' => null,
            'nominal_bayar' => $request->nominal_bayar,
            'status_bayar' => 'pending',
            'link_pembayaran' => $paymentUrl,
        ]);

        return redirect($paymentUrl);
    }

    /**
     * Callback / Webhook dari Midtrans
     */
    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $data = $request->all();

        $signatureKey = $data['signature_key'] ?? '';

        // Validasi signature
        $hashed = hash('sha512',
            $data['order_id'] .
            $data['status_code'] .
            $data['gross_amount'] .
            $serverKey
        );

        if ($signatureKey !== $hashed) {
            Log::warning('❌ Signature Midtrans tidak valid', ['data' => $data]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $orderId = $data['order_id'];

        $pembayaran = Pembayaran::where('order_id', $orderId)->first();

        if (!$pembayaran) {
            Log::warning('❌ Pembayaran tidak ditemukan', ['order_id' => $orderId]);
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }

        $transactionStatus = $data['transaction_status'];

        // Update status
        if ($transactionStatus === 'settlement') {
            $pembayaran->status_bayar = 'paid';
            $pembayaran->tgl_bayar = now();
        } elseif ($transactionStatus === 'pending') {
            $pembayaran->status_bayar = 'pending';
        } elseif (in_array($transactionStatus, ['expire', 'cancel', 'deny'])) {
            $pembayaran->status_bayar = match ($transactionStatus) {
                'expire' => 'expired',
                'cancel' => 'cancelled',
                'deny'   => 'denied',
            };
        } elseif ($transactionStatus === 'capture') {
            if (($data['payment_type'] ?? '') === 'credit_card') {
                if (($data['fraud_status'] ?? '') === 'challenge') {
                    $pembayaran->status_bayar = 'pending';
                } else {
                    $pembayaran->status_bayar = 'paid';
                    $pembayaran->tgl_bayar = now();
                }
            }
        }

        $pembayaran->save();

        Log::info('✅ Midtrans webhook diproses', [
            'order_id' => $orderId,
            'status' => $pembayaran->status_bayar,
            'transaction_status' => $transactionStatus,
        ]);

        return response()->json(['message' => 'Success']);
    }

    public function success()
    {
        return view('admin.pembayaran.success');
    }
}
