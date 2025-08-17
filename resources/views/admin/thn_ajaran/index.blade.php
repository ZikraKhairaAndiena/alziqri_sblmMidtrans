@extends('admin.layouts.main')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center fw-bold mb-4">Data Tahun Ajaran</h4>
                    <div class="table-responsive">
                        <a href="{{ route('admin.thn_ajaran.create') }}" class="btn btn-success btn-sm mb-3">Tambah Tahun Ajaran</a>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Tahun Ajaran</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($thn_ajarans as $thn_ajaran)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $thn_ajaran->nama }}</td>
                                    <td>{{ ucfirst($thn_ajaran->status) }}</td>
                                    <td class="text-nowrap text-center">
                                        <div class="btn-group" role="group">
                                            {{-- <a href="{{ route('admin.thn_ajaran.show', $thn_ajaran->id) }}" class="btn btn-info btn-sm me-1" title="Lihat Detail">
                                                <i class='mdi mdi-eye'></i>
                                            </a> --}}
                                            <a href="{{ route('admin.thn_ajaran.edit', $thn_ajaran->id) }}" class="btn btn-warning btn-sm me-1" title="Edit Data">
                                                <i class='mdi mdi-pencil'></i>
                                            </a>
                                            <form action="{{ route('admin.thn_ajaran.destroy', $thn_ajaran->id) }}" method="POST" class="d-inline form-delete">
                                                @method('DELETE')
                                                @csrf
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
