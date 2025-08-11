@extends('admin.layouts.main')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center fw-bold mb-4">Data Pengguna</h2>
                    <div class="table-responsive">
                        <a href="{{ route('admin.pengguna.create') }}" class="btn btn-success btn-sm mb-3">Tambah Pengguna</a>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td class="text-nowrap text-center">
                                        <div class="btn-group" role="group">
                                            {{-- <a href="{{ route('admin.pengguna.show', $user->id) }}" class="btn btn-success btn-sm me-1" title="Lihat Detail">
                                                <i class='bx bx-show'></i>
                                            </a> --}}
                                            <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="btn btn-warning btn-sm me-1" title="Edit Data">
                                                <i class='bx bx-edit'></i>Edit
                                            </a>
                                            <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST" class="d-inline form-delete">
                                                @method('DELETE')
                                                @csrf
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
