@extends('admin.layouts.main')

@section('title', 'Data Rapor')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center fw-bold mb-4">Data rapor</h4>
                    <div class="table-responsive">
                        <a href="{{ route('admin.rapor.create') }}" class="btn btn-success btn-sm mb-3">Tambah Rapor</a>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Siswa</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rapors as $rapor)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $rapor->siswa->nama_siswa ?? '-' }}</td>
                                        <td>{{ $rapor->thnAjaran->nama ?? '-' }}</td>
                                        <td class="text-center">{{ $rapor->semester }}</td>
                                        {{-- Tombol Aksi --}}
                                        <td class="text-nowrap text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.rapor.show', $rapor->id) }}" class="btn btn-info btn-sm me-1" title="Lihat Detail">
                                                    <i class='mdi mdi-eye'></i>
                                                </a>
                                                <a href="{{ route('admin.rapor.edit', $rapor->id) }}" class="btn btn-warning btn-sm me-1" title="Edit Data"><i class='mdi mdi-pencil'></i></a>
                                                <form action="{{ route('admin.rapor.destroy', $rapor->id) }}" method="POST" class="d-inline form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Yakin akan menghapus data ini?')">
                                                        <i class='mdi mdi-delete'></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin.rapor.cetak', $rapor->id) }}" class="btn btn-sm btn-danger ms-1" target="_blank" title="Cetak PDF"><i class="mdi mdi-file-pdf-box"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">Belum ada data rapor</td>
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
