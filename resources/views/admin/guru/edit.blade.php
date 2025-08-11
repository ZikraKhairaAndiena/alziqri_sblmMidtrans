@extends('admin.layouts.main')

@section('title', 'Edit Guru')

@section('content')
<div class="content-wrapper">
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark mb-0">Edit Data Guru</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="user_id" class="form-label fw-semibold">Akun User</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">-- Pilih Akun --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $guru->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">NIP</label>
                <input type="text" name="nip" class="form-control" maxlength="30" value="{{ $guru->nip }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_guru" class="form-control" maxlength="100" value="{{ $guru->nama_guru }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="L" {{ $guru->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $guru->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="{{ $guru->tgl_lahir }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ $guru->alamat }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" class="form-control" maxlength="15" value="{{ $guru->no_telp }}" required>
            </div>

            {{-- <div class="mb-3">
                <label class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
                @if ($guru->foto)
                    <small class="d-block mt-2">Foto saat ini:</small>
                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" class="img-thumbnail mt-1" width="120">
                @endif
            </div> --}}

            <div class="mb-3">
                    <label>Foto guru</label><br>
                    @if($guru->foto)
                        <img src="{{ asset('img/' . $guru->foto) }}" alt="Foto guru" width="100" class="mb-2"><br>
                    @endif
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Mulai Mengajar</label>
                <input type="date" name="tgl_mulai_ngajar" class="form-control" value="{{ $guru->tgl_mulai_ngajar }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Pendidikan Terakhir</label>
                <input type="text" name="pend_terakhir" class="form-control" maxlength="30" value="{{ $guru->pend_terakhir }}" required>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
