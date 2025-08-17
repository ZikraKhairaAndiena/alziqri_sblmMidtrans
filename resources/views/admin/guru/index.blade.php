@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center fw-bold mb-4">Data Guru</h4>
                    <div class="table-responsive">
                        <a href="{{ route('admin.guru.create') }}" class="btn btn-success btn-sm mb-3">Tambah Guru</a>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gurus as $guru)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($guru->foto)
                                            <img src="{{ asset('img/' . $guru->foto) }}" alt="Foto {{ $guru->nama_guru }}" width="50" height="50" class="rounded">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $guru->nama_guru }}</td>
                                    <td>{{ $guru->nip }}</td>
                                    <td>{{ $guru->jabatan }}</td>
                                    <td class="text-nowrap text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.guru.show', $guru->id) }}" class="btn btn-info btn-sm me-1" title="Lihat Detail">
                                                <i class='mdi mdi-eye'></i>
                                            </a>
                                            <a href="{{ route('admin.guru.edit', $guru->id) }}" class="btn btn-warning btn-sm me-1" title="Edit Data"><i class='mdi mdi-pencil'></i></a>
                                            <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" class="d-inline form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Yakin akan menghapus data ini?')" title="Hapus Data">
                                                    <i class='mdi mdi-delete'></i>
                                                </button>
                                            </form>
                                        </div>
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
