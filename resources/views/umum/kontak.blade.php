@extends('umum.layouts.main')

@section('content')

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h1 class="mb-2 bread">Lokasi Kami</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Kontak <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section">
    <div class="container">
        <div class="row">
            {{-- Maps di kiri --}}
            <div class="col-md-8 mb-4 mb-md-0">
                <div class="map-container" style="position:relative;overflow:hidden;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d994.7649043907342!2d100.35404126954756!3d-0.947083799879061!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b93c0b7fd4fb%3A0xXXXXXXXXXXXX!2sKantor%20Contoh!5e0!3m2!1sid!2sid!4v1692000000000!5m2!1sid!2sid"
                        width="100%"
                        height="500"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            {{-- Info kontak di kanan --}}
            <div class="col-md-4">
                <div class="p-4 mb-4 bg-light rounded d-flex">
                    <div class="me-3">
                        <i class="fa fa-map-marker fa-2x text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Address</h5>
                        <p class="mb-0">Jl. Teuku Umar No.15, Alai Parak Kopi, Kec. Padang Utara, Kota Padang, Sumatera Barat 25515</p>
                    </div>
                </div>

                <div class="p-4 mb-4 bg-light rounded d-flex">
                    <div class="me-3">
                        <i class="fa fa-envelope fa-2x text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Mail Us</h5>
                        <p class="mb-0">fruitStation@gmail.com</p>
                    </div>
                </div>

                <div class="p-4 bg-light rounded d-flex">
                    <div class="me-3">
                        <i class="fa fa-phone fa-2x text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Telephone</h5>
                        <p class="mb-0">+6281283333616</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
