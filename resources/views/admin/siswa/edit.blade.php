@extends('admin.layouts.main')

@section('title', 'Edit Siswa')

@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h4 class="fw-bold text-dark mb-0">Edit Data Siswa</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>NISN</label>
                    <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn', $siswa->nisn) }}" required>
                    @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label>Nama Siswa</label>
                    <input type="text" name="nama_siswa" class="form-control" value="{{ $siswa->nama_siswa }}" required>
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="L" {{ $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tmp_lahir" class="form-control" value="{{ $siswa->tmp_lahir }}" required>
                </div>

                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" value="{{ $siswa->tgl_lahir }}" required>
                </div>

                <div class="mb-3">
                    <label>Agama</label>
                    <select name="agama" class="form-select @error('agama') is-invalid @enderror" required>
                        <option value="islam" {{ old('agama', $siswa->agama) == 'islam' ? 'selected' : '' }}>Islam</option>
                        <option value="kristen" {{ old('agama', $siswa->agama) == 'kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="budha" {{ old('agama', $siswa->agama) == 'budha' ? 'selected' : '' }}>Budha</option>
                        <option value="hindu" {{ old('agama', $siswa->agama) == 'hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="kong_hu_cu" {{ old('agama', $siswa->agama) == 'kong_hu_cu' ? 'selected' : '' }}>Kong Hu Cu</option>
                    </select>
                    @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label>Suku Bangsa</label>
                    <input type="text" name="suku_bangsa" class="form-control @error('suku_bangsa') is-invalid @enderror" value="{{ old('suku_bangsa', $siswa->suku_bangsa) }}">
                    @error('suku_bangsa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Anak ke</label>
                        <input type="number" name="anak_ke" min="0" class="form-control @error('anak_ke') is-invalid @enderror" value="{{ old('anak_ke', $siswa->anak_ke) }}" required>
                        @error('anak_ke') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Jumlah Saudara Kandung</label>
                        <input type="number" name="jmlh_saudara_kandung" min="0" class="form-control @error('jmlh_saudara_kandung') is-invalid @enderror" value="{{ old('jmlh_saudara_kandung', $siswa->jmlh_saudara_kandung) }}" required>
                        @error('jmlh_saudara_kandung') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label>Tempat Tinggal</label>
                    <select name="tmp_tinggal" class="form-select @error('tmp_tinggal') is-invalid @enderror" required>
                        <option value="orang_tua" {{ old('tmp_tinggal', $siswa->tmp_tinggal) == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                        <option value="wali" {{ old('tmp_tinggal', $siswa->tmp_tinggal) == 'wali' ? 'selected' : '' }}>Wali</option>
                        <option value="nenek" {{ old('tmp_tinggal', $siswa->tmp_tinggal) == 'nenek' ? 'selected' : '' }}>Nenek</option>
                        <option value="saudara" {{ old('tmp_tinggal', $siswa->tmp_tinggal) == 'saudara' ? 'selected' : '' }}>Saudara</option>
                    </select>
                    @error('tmp_tinggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required>{{ $siswa->alamat }}</textarea>
                </div>

                <div class="mb-3">
                    <label>No NIK</label>
                    <input type="text" name="no_nik" class="form-control" value="{{ $siswa->no_nik }}" required>
                </div>

                <div class="mb-3">
                    <label>No KK</label>
                    <input type="text" name="no_kk" class="form-control" value="{{ $siswa->no_kk }}" required>
                </div>

                <div class="mb-3">
                    <label>No Akte</label>
                    <input type="text" name="no_akte" class="form-control" value="{{ $siswa->no_akte }}" required>
                </div>

                <div class="mb-3">
                    <label>Nama Wali</label>
                    <input type="text" name="nama_wali" class="form-control" value="{{ $siswa->nama_wali }}" required>
                </div>

                <div class="mb-3">
                    <label>No Telp</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ $siswa->no_telp }}" required>
                </div>

                <div class="mb-3">
                    <label>Foto Siswa</label><br>
                    @if($siswa->foto)
                        <img src="{{ asset('img/' . $siswa->foto) }}" alt="Foto Siswa" width="100" class="mb-2"><br>
                    @endif
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Gambar Kartu Keluarga (KK)</label><br>
                    @if($siswa->foto_kk)
                        <img src="{{ asset('img/' . $siswa->foto_kk) }}" alt="Gambar KK" width="100" class="mb-2"><br>
                    @endif
                    <input type="file" name="foto_kk" class="form-control @error('foto_kk') is-invalid @enderror">
                    @error('foto_kk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Gambar Akta Kelahiran</label><br>
                    @if($siswa->foto_akte)
                        <img src="{{ asset('img/' . $siswa->foto_akte) }}" alt="Gambar Akte" width="100" class="mb-2"><br>
                    @endif
                    <input type="file" name="foto_akte" class="form-control @error('foto_akte') is-invalid @enderror">
                    @error('foto_akte')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="aktif" {{ old('status', $siswa->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak_aktif" {{ old('status', $siswa->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save me-1"></i> Simpan Perubahan
                    </button>
                </div>

                {{-- <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div> --}}

            </form>
        </div>
    </div>
</div>
@endsection
