@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center fw-bold mb-4">Data Tabungan</h4>
                    @if(auth()->user()->role === 'orang_tua')
                        <p><strong>Nama Siswa:</strong> {{ $tabungans->first()?->siswa->nama_siswa ?? '-' }}</p>
                    @endif
                    <div class="table-responsive">

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if(auth()->user()->role === 'guru')
                            <a href="{{ route('admin.tabungan.create') }}" class="btn btn-success btn-sm mb-3">Tambah Tabungan</a>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    @if(auth()->user()->role !== 'orang_tua')
                                        <th>Nama Siswa</th>
                                    @endif
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Saldo</th>
                                    <th>Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tabungans as $tabungan)
                                    <tr>
                                        @if(auth()->user()->role !== 'orang_tua')
                                            <td>{{ $tabungan->siswa->nama_siswa }}</td>
                                        @endif
                                        <td>{{ \Carbon\Carbon::parse($tabungan->tanggal)->format('d-m-Y') }}</td>
                                        <td>{{ ucfirst($tabungan->jenis_transaksi) }}</td>
                                        <td>Rp{{ number_format($tabungan->jumlah, 0, ',', '.') }}</td>
                                        <td>Rp{{ number_format($tabungan->saldo, 0, ',', '.') }}</td>
                                        <td>
                                            @if($tabungan->bukti)
                                                <img src="{{ asset('img/' . $tabungan->bukti) }}" width="50" height="50" class="rounded">
                                            @else
                                                <span class="text-muted">Tidak ada</span>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
