@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4>Kehadiran Anak: {{ $siswa->nama_siswa }}</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kehadirans as $kehadiran)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($kehadiran->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ ucfirst($kehadiran->status) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada kehadiran.</td>
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
