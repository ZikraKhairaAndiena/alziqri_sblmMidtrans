@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center fw-bold mb-4">Data Informasi</h2>
                    <div class="table-responsive">
                        <a href="{{ route('admin.informasi.create') }}" class="btn btn-success btn-sm mb-3">Tambah Informasi</a>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Jenis</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($informasi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($item->gambar)
                                            <img src="{{ asset('img/' . $item->gambar) }}"  width="50" height="50" class="rounded">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        @if($item->type == 'pengumuman')
                                            <span class="badge bg-primary">Pengumuman</span>
                                        @elseif($item->type == 'info')
                                            <span class="badge bg-info">Info</span>
                                        @elseif($item->type == 'galeri')
                                            <span class="badge bg-success">Galeri</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->tanggal)
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.informasi.show', $item->id) }}" class="btn btn-success btn-sm me-1" title="Lihat Detail">
                                                <i class='mdi mdi-eye'></i>
                                            </a>
                                            <a href="{{ route('admin.informasi.edit', $item->id) }}" class="btn btn-warning btn-sm me-1" title="Edit Data">
                                                <i class='mdi mdi-pencil'></i>
                                            </a>
                                            <form action="{{ route('admin.informasi.destroy', $item->id) }}" method="POST" class="d-inline form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Yakin akan menghapus data ini?')" title="Hapus Data">
                                                    <i class='mdi mdi-delete'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Tidak ada data informasi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{ $informasi->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
