@extends('admin.layouts.main')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center fw-bold mb-4">Data Kelas</h4>
                    <div class="table-responsive">
                        <a href="{{ route('admin.kelas.create') }}" class="btn btn-success btn-sm mb-3">Tambah Kelas</a>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Ajaran</th>
                                <th>Nama Kelas</th>
                                <th>Guru Kelas</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelass as $kelas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kelas->tahunAjaran->nama ?? 'N/A' }}</td>
                                    <td>{{ $kelas->nama_kelas }}</td>
                                    <td>{{ $kelas->guru->nama_guru ?? 'N/A' }}</td>
                                    <td class="text-nowrap text-center">
                                        <div class="btn-group" role="group">
                                            {{-- <a href="{{ route('admin.thn_ajaran.show', $thn_ajaran->id) }}" class="btn btn-info btn-sm me-1" title="Lihat Detail">
                                                <i class='mdi mdi-eye'></i>
                                            </a> --}}
                                            <a href="{{ route('admin.kelas.edit', $kelas->id) }}" class="btn btn-warning btn-sm me-1" title="Edit Data">
                                                <i class='mdi mdi-pencil'></i>
                                            </a>
                                            <form action="{{ route('admin.kelas.destroy', $kelas->id) }}" method="POST" class="d-inline form-delete">
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
