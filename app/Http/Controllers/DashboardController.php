<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        // default values
        $jumlahSiswa = $jumlahGuru = 0;
        $totalTagihan = $totalTerbayar = $sisaTagihan = $persentaseBayar = 0;
        $namaSiswa = [];
        $kehadiran = [];

        if ($role === 'admin') {
            $jumlahSiswa = Siswa::count();
            $jumlahGuru  = Guru::count();

            $biayaTahunanPerSiswa = 720000 + 1080000 + 200000;

            $siswaList = Siswa::with(['pembayaran' => function($q) {
                $q->where('status_bayar', 'paid');
            }])->get();

            $dataPembayaran = $siswaList->map(function($siswa) use ($biayaTahunanPerSiswa) {
                $totalBayar = $siswa->pembayaran->sum('nominal_bayar');
                $sisaTagihan = max($biayaTahunanPerSiswa - $totalBayar, 0);
                $persentase = $biayaTahunanPerSiswa > 0
                    ? round(($totalBayar / $biayaTahunanPerSiswa) * 100, 2)
                    : 0;

                return [
                    'nama_siswa' => $siswa->nama_siswa,
                    'sisa_tagihan' => $sisaTagihan,
                    'persentase' => $persentase
                ];
            });

            return view('admin.dashboard', compact(
                'jumlahSiswa','jumlahGuru',
                'dataPembayaran'
            ));
        }

        if ($role === 'guru') {
            $jumlahSiswa = Siswa::count();

            // Diagram kehadiran (current month, top 10). Jika tabel kehadiran belum ada, fallback 0.
            if (Schema::hasTable('kehadirans')) {
                $start = now()->startOfMonth();
                $end   = now()->endOfMonth();

                $rows = DB::table('kehadirans')
                    ->select('siswa_id', DB::raw("SUM(CASE WHEN status='hadir' THEN 1 ELSE 0 END) as jml_hadir"))
                    ->whereBetween('tanggal', [$start, $end])
                    ->groupBy('siswa_id')
                    ->orderByDesc('jml_hadir')
                    ->limit(10)
                    ->get();

                $namaMap = Siswa::whereIn('id', $rows->pluck('siswa_id'))->pluck('nama_siswa','id');
                foreach ($rows as $r) {
                    $namaSiswa[] = $namaMap[$r->siswa_id] ?? ('Siswa '.$r->siswa_id);
                    $kehadiran[] = (int) $r->jml_hadir;
                }
            }

            if (empty($namaSiswa)) {
                $namaSiswa = Siswa::orderBy('nama_siswa')->limit(10)->pluck('nama_siswa')->toArray();
                $kehadiran = array_fill(0, count($namaSiswa), 0);
            }
        }

        return view('admin.dashboard', compact(
            'jumlahSiswa','jumlahGuru',
            'totalTagihan','totalTerbayar','sisaTagihan','persentaseBayar',
            'namaSiswa','kehadiran'
        ));
    }
}
