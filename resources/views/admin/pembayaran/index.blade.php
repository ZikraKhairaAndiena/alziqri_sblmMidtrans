@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">

                    {{-- Untuk Orang Tua --}}
                    @if(auth()->user()->role === 'orang_tua')
                    <h4 class="fw-bold text-dark mb-3">Riwayat Pembayaran - {{ $siswa->nama_siswa }}</h4>
                        @php
                            $totalTagihan = 2000000;
                            $totalTerbayar = $pembayarans->where('status_bayar', 'paid')->sum('nominal_bayar');
                            $sisaTagihan = max($totalTagihan - $totalTerbayar, 0);
                            $persentaseBayar = $totalTagihan > 0 ? round(($totalTerbayar / $totalTagihan) * 100, 2) : 0;
                        @endphp

                        <div class="alert alert-info">
                            <h5 class="fw-bold mb-2">📋 Rincian Pembayaran Uang Sekolah (1 Tahun)</h5>
                            <ul class="mb-1">
                                <li>Uang pakaian (4 stel baju dan tas) <strong>Rp 720.000</strong></li>
                                <li>Uang partisipasi dan kegiatan <strong>Rp 1.080.000</strong></li>
                                <li>Uang bangunan <strong>Rp 200.000</strong></li>
                            </ul>
                            <p class="fw-bold mt-2">Total Tagihan: Rp {{ number_format($totalTagihan, 0, ',', '.') }}</p>
                            <p class="mb-1 text-success">Sudah Dibayar: Rp {{ number_format($totalTerbayar, 0, ',', '.') }}</p>
                            <p class="mb-1 text-danger">Sisa Tagihan: Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</p>

                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $persentaseBayar }}%"
                                    aria-valuenow="{{ $persentaseBayar }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ $persentaseBayar }}%
                                </div>
                            </div>
                        </div>

                        {{-- Tombol tambah pembayaran kalau masih ada sisa tagihan --}}
                        @if(isset($siswa) && $sisaTagihan > 0)
                            <a href="{{ route('admin.pembayaran.create', ['siswa_id' => $siswa->id]) }}"
                               class="btn btn-success btn-sm mb-3">Tambah Pembayaran</a>
                        @endif

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal Bayar</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pembayarans as $pembayaran)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d-m-Y') }}</td>
                                        <td>Rp{{ number_format($pembayaran->nominal_bayar) }}</td>
                                        <td>{{ ucfirst($pembayaran->status_bayar) }}</td>
                                        <td>
                                            @if($pembayaran->status_bayar == 'pending')
                                                <a href="{{ $pembayaran->link_pembayaran }}" class="btn btn-sm btn-primary">Bayar</a>
                                            @else
                                                <a href="{{ route('admin.pembayaran.invoice', $pembayaran->id) }}"
                                                   class="btn btn-sm btn-warning" target="_blank">Cetak Invoice</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    {{-- Untuk Admin --}}
                    @elseif(auth()->user()->role === 'admin')
                        <h4 class="card-title text-center fw-bold mb-4">Rincian Pembayaran Uang Sekolah</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Total Bayar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($pembayarans->groupBy('siswa_id') as $siswaId => $riwayat)
                                        @php
                                            $totalBayar = $riwayat->where('status_bayar', 'paid')->sum('nominal_bayar');
                                        @endphp
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $riwayat->first()->siswa->nama_siswa }}</td>
                                            <td>Rp {{ number_format($totalBayar, 0, ',', '.') }}</td>
                                            <td>
                                                <a href="{{ route('admin.pembayaran.detail', $siswaId) }}"
                                                   class="btn btn-info btn-sm me-1" title="Lihat Detail"><i class='mdi mdi-eye'></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
