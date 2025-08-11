@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center fw-bold mb-4">Data Siswa</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Foto</th>
                                    <th>NISN</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                    <td>
                                        @if($siswa->foto)
                                            <img src="{{ asset('img/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama_siswa }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $siswa->nisn ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d-m-Y') }}</td>
                                    <td>
                                        @if($siswa->status == 'aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.siswa.show', $siswa->id) }}" class="btn btn-success btn-sm me-1"><i class='bx bx-eye'></i>Lihat</a>
                                            <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm me-1"><i class='bx bx-edit'></i>Edit</a>
                                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="d-inline form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Yakin akan menghapus data ini?')"><i class='bx bx-trash'></i>Hapus</button>
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
