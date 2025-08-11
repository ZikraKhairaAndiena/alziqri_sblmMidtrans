@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center fw-bold mb-4">Data Pembayaran</h4>
                    {{-- @if(auth()->user()->role === 'orang_tua')
                        <p><strong>Nama Siswa:</strong> {{ $pembayarans->first()?->siswa->nama_siswa ?? '-' }}</p>
                    @endif --}}
                    <div class="table-responsive">
                        @php
                            $user = Auth::user();
                        @endphp

                        @if($user->role === 'orang_tua' && isset($siswa))
                            <a href="{{ route('admin.pembayaran.create', ['siswa_id' => $siswa->id]) }}" class="btn btn-success btn-sm mb-3">Tambah Pembayaran</a>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pembayarans as $pembayaran)
                                <tr>
                                    <td>{{ $pembayaran->siswa->nama_siswa }}</td>
                                    <td>{{ $pembayaran->tgl_bayar }}</td>
                                    <td>Rp{{ number_format($pembayaran->nominal_bayar) }}</td>
                                    <td>{{ ucfirst($pembayaran->status_bayar) }}</td>
                                    <td>
                                        @if($pembayaran->status_bayar == 'pending')
                                            <a href="{{ $pembayaran->link_pembayaran }}" class="btn btn-sm btn-primary">Bayar</a>
                                        @else
                                            <span class="text-success">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
