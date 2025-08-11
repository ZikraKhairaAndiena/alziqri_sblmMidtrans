@extends('admin.layouts.main')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center fw-bold mb-4">Daftar Pendaftaran Siswa</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ppdbs as $index => $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->thn_ajaran->nama }}</td>
                                    <td>{{ $item->siswa->nama_siswa }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tgl_daftar)->format('d-m-Y') }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('admin.ppdb.show', $item->id) }}" class="btn btn-success btn-sm me-1"><i class='bx bx-eye'></i>Detail</a>
                                    </td>
                                    {{-- <td>
                                        <a href="{{ route('admin.ppdb.show', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
                                    </td> --}}
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
