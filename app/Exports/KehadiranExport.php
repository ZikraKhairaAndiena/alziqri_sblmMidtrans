<?php

namespace App\Exports;

use App\Models\Kehadiran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Carbon\Carbon;

class KehadiranExport implements FromView
{
    protected $kelasId, $bulan, $tahun;

    public function __construct($kelasId, $bulan, $tahun)
    {
        $this->kelasId = $kelasId;
        $this->bulan   = (int) $bulan;
        $this->tahun   = (int) $tahun;
    }

    public function view(): View
    {
        // Data kehadiran per siswa dalam kelas & bulan terpilih
        $kehadirans = Kehadiran::with('siswa.kelas')
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->whereHas('siswa', fn ($q) => $q->where('kelas_id', $this->kelasId))
            ->orderBy('siswa_id')
            ->get()
            ->groupBy('siswa_id');

        $hariDalamBulan = Carbon::createFromDate($this->tahun, $this->bulan, 1)->daysInMonth;
        $tanggal = collect(range(1, $hariDalamBulan));

        return view('admin.kehadiran.export', [
            'kehadirans' => $kehadirans,
            'tanggal'    => $tanggal,
            'bulan'      => $this->bulan,
            'tahun'      => $this->tahun,
        ]);
    }

    // public function drawings()
    // {
    //     // Pastikan file ada di: public/img/kop.png
    //     $kop = new Drawing();
    //     $kop->setName('Kop Surat');
    //     $kop->setDescription('Kop Surat Sekolah');
    //     $kop->setPath(public_path('img/kop.png'));
    //     $kop->setHeight(90);
    //     $kop->setCoordinates('A1'); // pojok kiri atas

    //     return [$kop];
    // }
}
