<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // ADMIN: tampilkan semua tabungan
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'orang_tua') {
            // Hanya tampilkan tabungan anaknya
            $siswa = Siswa::where('user_id', $user->id)->first();
            if (!$siswa) {
                return back()->with('error', 'Data siswa tidak ditemukan');
            }
            $tabungans = Tabungan::where('siswa_id', $siswa->id)->orderByDesc('tanggal')->get();
            return view('admin.tabungan.ortu', compact('tabungans', 'siswa'));
        } else {
            // Guru bisa lihat semua tabungan
            $tabungans = Tabungan::with('siswa')->orderByDesc('tanggal')->get();
            return view('admin.tabungan.index', compact('tabungans'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role !== 'guru') { // ✅
            abort(403);
        }

        $siswas = Siswa::all();
        return view('admin.tabungan.create', compact('siswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'guru') { // ✅
            abort(403);
        }

        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'jenis_transaksi' => 'required|in:setor,tarik',
            'jumlah' => 'required|numeric|min:0',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $lastSaldo = Tabungan::where('siswa_id', $request->siswa_id)->latest()->first();
        $saldoSebelumnya = $lastSaldo ? $lastSaldo->saldo : 0;

        // Validasi khusus untuk tarik
        if ($request->jenis_transaksi === 'tarik' && $request->jumlah > $saldoSebelumnya) {
            return back()->withInput()->withErrors([
                'jumlah' => 'Jumlah penarikan tidak boleh melebihi saldo yang tersedia (' . number_format($saldoSebelumnya, 2) . ').'
            ]);
        }
        // Hitung saldo baru
        $saldoBaru = $request->jenis_transaksi === 'setor'
            ? $saldoSebelumnya + $request->jumlah
            : $saldoSebelumnya - $request->jumlah;

        $buktiFileName = null;
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $buktiFileName = time() . '_bukti_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $buktiFileName);
        }

        Tabungan::create([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal,
            'jenis_transaksi' => $request->jenis_transaksi,
            'jumlah' => $request->jumlah,
            'saldo' => $saldoBaru,
            'bukti' => $buktiFileName,
        ]);

        return redirect()->route('admin.tabungan.index')->with('success', 'Data tabungan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tabungan $tabungan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tabungan $tabungan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tabungan $tabungan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tabungan $tabungan)
    {
        //
    }
}
