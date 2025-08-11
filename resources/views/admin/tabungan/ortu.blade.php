@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4>Tabungan Anak: {{ $siswa->nama_siswa }}</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Saldo</th>
                                    <th>Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tabungans as $tabungan)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($tabungan->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ ucfirst($tabungan->jenis_transaksi) }}</td>
                                    <td>Rp{{ number_format($tabungan->jumlah, 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($tabungan->saldo, 0, ',', '.') }}</td>
                                    <td>
                                        @if($tabungan->bukti)
                                            <img src="{{ asset('storage/' . $tabungan->bukti) }}" width="50" height="50" class="rounded">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada transaksi tabungan.</td>
                                </tr>
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
