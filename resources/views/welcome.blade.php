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
                <div class="hero-content ms-5 col-12 col-md-6">
                    <h1>Transformasi Digital Sektor Pelayaran Indonesia</h1>
                    <p>Menghubungkan semua stakeholder sektor pelayaran dalam pemanfaatan teknologi crewing pelaut yang terintegrasi</p>
                </div>
            </div>
        </section>
    </div>

    ---

    {{-- tentang kami  --}}
    <section class="container my-5" id="tentang">
        <div class="d-flex justify-content-center mb-5">
            <h2 class="text-center mb-4 title-underline">Tentang Kami</h2>
        </div>
        <div class="row mx-0">
            <div class="col-12 col-md-5">
                <img src="{{ asset('image/pelayaran.jpg') }}" width="100%" height="100%" alt="" class="d-block object-fit-cover rounded-3">
                {{-- <img src="{{ asset('image/ship2.jpg') }}" width="60%" height="300px" class="object-fit-cover rounded-3 d-block mx-auto" style="top: -150px; right: 0; position: relative" alt=""> --}}
            </div>
            <div class="col-12 col-md-7 p-5 text-white text-justify bg-primary rounded-3">
                <strong>PT. WHS Global Mandiri</strong> adalah perusahaan pelayaran yang berdiri sejak tahun 2006 dan berkantor pusat di Jakarta, Jl. Pangeran Jayakarta Komp. 85 No. AB-AC Kota Jakarta Pusat, DKI Jakarta 10730 Indonesia, serta memiliki kantor cabang di Banjarmasin, Kalimantan Selatan. Perusahaan ini merupakan bagian dari Perusahaan Tanoto Maritime Group yang didirikan oleh bapak Tanoto Iskandar pada tahun 1973 yang mencakup layanan mulai dari pembangunan kapal baru, perbaikan kapal, penyewaan kapal, jasa pengiriman barang, agen pelayaran, manajemen armada, hingga layanan perantara (brokerage) dan berkantor pusat di Singapura. PT. WHS Global Mandiri berfokus pada penyewaan kapal atau chartering dan saat ini telah memiliki 54 armada kapal dengan jenis kapal Tugboat, Tongkang, SPB (Self-Propeller Barge), SPOB (Self-Propeller Oil Barge), dan Kapal Cargo dengan awak kapal yang bertugas saat ini sebanyak 510 orang.
            </div>
        </div>
    </section>

    <section id="karir" class="mb-5">
        <div class="container">
            <div class="d-flex justify-content-center">
                <h2 class="text-center mb-5 title-underline">Karir</h2>
            </div>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                @foreach ($karir as $item)
                    <div class="card" style="width: 24rem">
                        <img src="{{ asset('/images/lowongan_kerja/' . $item->image) }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                                <small class="text-muted">{{ $item->employment_type->name }}</small>
                            </div>
                            <p class="fw-bold mb-2">{{ $item->title }}</p>
                            <p>Sallary : Rp. {{ number_format($item->sallary ?? 0, 0, ',', '.') }}</p>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 100) }}</p>
                            <div class="d-flex justify-content-between gap-1 d-block mt-auto">
                                <div class="col-10">
                                    <a href="{{ route('lowongan_kerja.slug', $item->slug) }}" class="btn btn-primary w-100">Lamar Pekerjaan</a>
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
@endsection