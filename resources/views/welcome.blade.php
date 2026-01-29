@extends('layout.app')

<style>
    .hero {
        position: relative;
        width: 100%;
        height: 500px;
        background-image: url("{{ asset('image/pelayaran.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        border-radius: 20px;
        overflow: hidden;
        color: white;
    }
    .hero::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(
            circle at top right,
            transparent 0%,
            rgba(0, 70, 150, 0.6) 40%,
            rgba(0, 70, 150, 0.9) 100%
        );
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }
    .hero-container {
        position: relative;
    }

    .hero-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        z-index: 0;
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px); 
    }
</style>

@section('content')
    {{-- hero --}}
    <div class="hero-container" style="padding-top: 100px; background-image: url('{{ asset('image/bg-water-splash.jpg') }}'); background-size: cover; background-position: center; width: 100%; height: 100vh;">
        <section class="container py-5">
            <div class="hero d-flex align-items-center row">
                <div class="hero-content p-4 col-12 col-md-6">
                    <h1>Digital Transformation of The Indonesian Shipping Sector</h1>
                    <p>Connecting all shipping sector stakeholders in the use of integrated seafarer crewing technology</p>
                </div>
            </div>
        </section>
    </div>

    {{-- tentang kami  --}}
    <section class="container my-3" id="tentang">
        <div class="d-flex justify-content-center mb-3">
            <h2 class="text-center mb-4 title-underline">About Us</h2>
        </div>
        <div class="row mx-0">
            <div class="col-12 col-md-5 mb-3 mb-md-0">
                <img src="{{ asset('image/pelayaran.jpg') }}" width="100%" height="100%" alt="" class="d-block object-fit-cover rounded-3">
                {{-- <img src="{{ asset('image/ship2.jpg') }}" width="60%" height="300px" class="object-fit-cover rounded-3 d-block mx-auto" style="top: -150px; right: 0; position: relative" alt=""> --}}
            </div>
            <div class="col-12 col-md-7 p-5 text-white bg-primary rounded-3" style="text-align: justify;">
                <strong>PT. WHS Global Mandiri</strong> is a shipping company established in 2006 and headquartered at Jl. Pangeran Jayakarta Komp. 85 No. AB-AC, Central Jakarta City, DKI Jakarta 10730, Indonesia, and also has a branch office in Banjarmasin, South Kalimantan. 
                The company is part of the Tanoto Maritime Group, founded by Mr. Tanoto Iskandar in 1973, which provides services ranging from new shipbuilding, ship repair, ship chartering, cargo delivery services, shipping agency, fleet management, to brokerage services.
                PT. WHS Global Mandiri focuses on vessel chartering with types of vessels including tugboats, barges, SPB (Self-Propeller Barge), SPOB (Self-Propeller Oil Barge), and cargo vessels.
            </div>
        </div>
    </section>

    <section id="karir" class="mb-3">
        <div class="container">
            <div class="d-flex justify-content-center">
                <h2 class="text-center mb-5 title-underline">Career</h2>
            </div>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                @foreach ($karir as $item)
                    <div class="card" style="width: 24rem">
                        <img src="{{ asset('/images/lowongan_kerja/' . $item->image) }}" class="card-img-top" alt="" style="height: 300px; width: 100%; object-fit: cover">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="fw-bold mb-2">{{ $item->title }}</p>
                            <p>Sallary : Rp. {{ number_format((int) $item->sallary ?? 0, 0, ',', '.') }}</p>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 100) }}</p>
                            <div class="d-flex justify-content-between gap-1 d-block mt-auto">
                                <div class="col-10">
                                    <a href="{{ route('lowongan_kerja.slug', $item->slug) }}" class="btn btn-primary w-100">Apply Job</a>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route('lowongan_kerja.slug', $item->slug) }}" class="btn btn-light w-100 h-100 d-flex justify-content-center align-items-center"><i class="bi bi-bookmark text-primary"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    
    {{-- gallery  --}}
    <section class="container mb-5" id="gallery">
        <div class="d-flex justify-content-center mb-3">
            <h2 class="text-center mb-4 title-underline">Gallery</h2>
        </div>
        <div class="row mb-3">
            {{-- <video controls preload="metadata" poster="cover.jpg" width="100px" height="360">
            <source src="{{ asset('image/gallery/video1.mp4') }}" type="video/mp4">
            <track kind="subtitles" srclang="id" label="Indonesia" src="subs-id.vtt" default>
            </video> --}}
        </div>
        <div class="row">
            <div class="d-flex gap-3 flex-wrap justify-content-center mx-0">
                @for ($i = 1; $i < 7; $i++)
                    <img src="{{ asset('image/gallery/' . $i . '.jpg') }}" style="width: 250px; height: 250px; object-fit: cover; border-radius: 5px" alt="">
                @endfor
            </div>
        </div>
    </section>
@endsection