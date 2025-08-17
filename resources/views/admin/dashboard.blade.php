{{-- dashboard.blade.php --}}
@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Dashboard
        </h3>
    </div>

    {{-- Role Admin --}}
    @if(Auth::user()->role == 'admin')
        <div class="row">
            {{-- Card Jumlah Siswa --}}
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        {{-- <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" /> --}}
                        <h4 class="font-weight-normal mb-3">Jumlah Siswa <i class="mdi mdi-account-group mdi-24px float-end"></i></h4>
                        <h2 class="mb-5">{{ $jumlahSiswa }}</h2>
                    </div>
                </div>
            </div>

            {{-- Card Jumlah Guru --}}
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        {{-- <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" /> --}}
                        <h4 class="font-weight-normal mb-3">Jumlah Guru <i class="mdi mdi-account-group mdi-24px float-end"></i></h4>
                        <h2 class="mb-5">{{ $jumlahGuru }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Progress Pembayaran --}}
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="card-title text-center">RINCIAN PEMBAYARAN UANG SEKOLAH</h4>
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Sisa Tagihan</th>
                            <th>Progress Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataPembayaran as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item['nama_siswa'] }}</td>
                            <td>Rp {{ number_format($item['sisa_tagihan'], 0, ',', '.') }}</td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $item['persentase'] }}%"
                                        aria-valuenow="{{ $item['persentase'] }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ $item['persentase'] }}%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endif


    {{-- Role Guru --}}
    @if(Auth::user()->role == 'guru')
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    {{-- <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" /> --}}
                    <h4 class="font-weight-normal mb-3">Jumlah Siswa <i class="mdi mdi-account-group mdi-24px float-end"></i></h4>
                    <h2 class="mb-5">{{ $jumlahSiswa }}</h2>
                </div>
            </div>
        </div>

        {{-- Diagram Kehadiran --}}
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="card-title">Kehadiran Siswa</h4>
                <canvas id="chartKehadiran"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('chartKehadiran').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($namaSiswa) !!},
                    datasets: [{
                        label: 'Jumlah Kehadiran',
                        data: {!! json_encode($kehadiran) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    }]
                }
            });
        </script>
    @endif


    {{-- Role Orang Tua --}}
    @if(Auth::user()->role == 'orang_tua')
        <div class="text-center mt-4">
            <h4>Selamat Datang di Dashboard Orang Tua</h4>
            <p>Di sini Anda dapat melihat informasi perkembangan anak, tagihan, dan laporan sekolah.</p>
            {{-- <img src="{{ asset('assets/images/dashboard/orangtua.png') }}" class="img-fluid" alt="Dashboard Orang Tua"> --}}
        </div>
    @endif

</div>

@endsection
