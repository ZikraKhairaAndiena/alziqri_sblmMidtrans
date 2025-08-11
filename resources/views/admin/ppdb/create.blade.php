@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h4>Formulir Pendaftaran PPDB</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('orang_tua.ppdb.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- <div class="mb-3">
                    <label>NISN</label>
                    <input type="text" name="nisn" class="form-control" required>
                </div> --}}

                <div class="mb-3">
                    <label>Nama Siswa</label>
                    <input type="text" name="nama_siswa" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tmp_lahir" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Agama</label>
                    <select name="agama" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="islam">Islam</option>
                        <option value="kristen">Kristen</option>
                        <option value="hindu">Hindu</option>
                        <option value="budha">Buddha</option>
                        <option value="kong_hu_cu">Konghucu</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Suku Bangsa</label>
                    <input type="text" name="suku_bangsa" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Anak Ke</label>
                    <input type="number" name="anak_ke" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Jumlah Saudara Kandung</label>
                    <input type="number" name="jmlh_saudara_kandung" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Bertempat Tinggal Pada</label>
                    <select name="tmp_tinggal" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="orang_tua">Orang Tua</option>
                        <option value="wali">Wali</option>
                        <option value="nenek">Nenek</option>
                        <option value="saudara">Saudara</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label> No NIK</label>
                    <input type="text" name="no_nik" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>No KK</label>
                    <input type="text" name="no_kk" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>No Akte Kelahiran</label>
                    <input type="text" name="no_akte" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Nama Wali</label>
                    <input type="text" name="nama_wali" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>No Telepon</label>
                    <input type="text" name="no_telp" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Upload KK</label>
                    <input type="file" name="foto_kk" class="form-control">
                </div>

                {{-- <div class="mb-3">
                    <label>foto</label>
                    <input type="file" name="foto" class="form-control">
                </div> --}}

                <div class="mb-3">
                    <label>Upload Akte Kelahiran</label>
                    <input type="file" name="foto_akte" class="form-control">
                </div>

                <input type="hidden" name="thn_ajaran_id" value="{{ $tahunAktif->id }}">

                <button type="submit" class="btn btn-success">Kirim Pendaftaran</button>
            </form>
        </div>
    </div>
</div>
@endsection
