<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FonnteLog;
use App\Helpers\FonnteHelper;

class FonnteController extends Controller
{
    public function index()
    {
        // Ambil log terbaru, pakai pagination
        $logs = FonnteLog::latest()->paginate(10);

        return view('admin.fonnte.index', compact('logs'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'nomor' => 'required',
            'pesan' => 'required'
        ]);

        // Kirim WA via FonnteHelper
        $result = FonnteHelper::kirimPesan($request->nomor, $request->pesan);

        // Simpan ke tabel fonnte_logs
        FonnteLog::create([
            'nomor' => $request->nomor,
            'pesan' => $request->pesan,
            'response' => json_encode($result, JSON_UNESCAPED_UNICODE)
        ]);

        return redirect()->route('admin.fonnte.index')->with('success', 'Pesan berhasil dikirim!');
    }
}
