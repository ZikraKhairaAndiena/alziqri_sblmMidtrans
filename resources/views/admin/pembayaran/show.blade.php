@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Detail Pendaftaran Siswa</h4>

                    <div class="table-responsive">
                        <h5 class="mb-3">Data Siswa</h5>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat Lahir</th>
                                    <td>{{ $siswa->tmp_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>{{ $siswa->tgl_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $siswa->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Orang Tua</th>
                                    <td>{{ $siswa->nama_wali }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>{{ $siswa->telepon }}</td>
                                </tr>
                                <tr>
                                    <th>No NIK</th>
                                    <td>{{ $siswa->no_nik }}</td>
                                </tr>
                                <tr>
                                    <th>No KK</th>
                                    <td>{{ $siswa->no_kk }}</td>
                                </tr>
                                <tr>
                                    <th>No Akte</th>
                                    <td>{{ $siswa->no_akte }}</td>
                                </tr>
                                <tr>
                                    <th>Gambar KK</th>
                                    <td>
                                        @if($siswa->gambar_kk)
                                            <img src="{{ asset('storage/' . $siswa->gambar_kk) }}" alt="Gambar KK" width="200">
                                        @else
                                            <em>Belum diunggah</em>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Gambar Akte</th>
                                    <td>
                                        @if($siswa->gambar_akte)
                                            <img src="{{ asset('storage/' . $siswa->gambar_akte) }}" alt="Gambar Akte" width="200">
                                        @else
                                            <em>Belum diunggah</em>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h5 class="mt-4">Status Pendaftaran: <strong>{{ $ppdb->status }}</strong></h5>

                        @if($ppdb->status == 'Diproses')
                        <form action="{{ route('admin.ppdb.verifikasi', $ppdb->id) }}" method="POST" class="mt-3">
                            @csrf
                            <div class="form-group">
                                <label for="status">Verifikasi:</label>
                                <select name="status" class="form-control">
                                    <option value="Diterima">Diterima</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success mt-2">Simpan</button>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
