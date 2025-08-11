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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Tanggal Mulai Ngajar</th>
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
                                    <td>{{ \Carbon\Carbon::parse($guru->tgl_mulai_ngajar)->format('d-m-Y') }}</td>
                                    <td class="text-nowrap text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.guru.show', $guru->id) }}" class="btn btn-success btn-sm me-1" title="Lihat Detail">
                                                <i class='bx bx-show'></i>Lihat
                                            </a>
                                            <a href="{{ route('admin.guru.edit', $guru->id) }}" class="btn btn-warning btn-sm me-1"><i class='bx bx-edit'></i>Edit</a>
                                            <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" class="d-inline form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Yakin akan menghapus data ini?')">
                                                    <i class='bx bx-trash'></i>Hapus
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
