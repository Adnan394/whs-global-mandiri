@extends('layout.app')

@section('content')
    <main id="main" style="margin-top: 150px" class="mb-5">
        <div class="container">
            <div class="d-flex justify-content-center">
                <h2 class="text-center mb-5 title-underline">Pertanyaan</h2>
            </div>
            <div class="d-flex row align-items-stretch">
                <div class="col-12 col-md-5 d-flex">
                    <img src="{{ asset('images/lowongan_kerja/' . $lowongan->image) }}" 
                        class="rounded-5 w-100 h-100 object-fit-cover" 
                        alt="">
                </div>
                <div class="col-12 col-md-7 d-flex flex-column justify-content-between">
                    <div>
                        <p class="mb-2">
                            PT. WHS Global Mandiri 
                            <i class="bi bi-check text-primary p-1 rounded-circle fs-5"></i>
                        </p>
                        <h4 class="fw-500">
                            {{ $lowongan->status == 1 ? '[Dibuka] ' : '[Ditutup] ' }}{{ $lowongan->title }}
                        </h4>
                        <small class="text-muted">
                            Diupload pada : {{ Carbon\Carbon::parse($lowongan->created_at)->locale('id_ID')->isoFormat('d MMMM Y') }}
                        </small><br>
                        <small class="text-muted">
                            Gaji Berkisar : Rp. {{ $lowongan->sallary ? number_format($lowongan->sallary, 0, ',', '.') :  'Confinental' }}
                        </small>
                        <div class="d-flex gap-3 mt-3 align-items-center">
                            <button class="btn border border-2 text-muted px-4 py-1 rounded-5 disable">
                                <i class="bi bi-briefcase me-2"></i>{{ $lowongan->employment_type->name }}
                            </button>
                            <button class="btn border border-2 text-muted px-4 py-1 rounded-5 disable">
                                <i class="bi bi-person me-2"></i>{{ $lowongan->experience_level->name }}
                            </button>
                        </div>
                    </div>
                    <small class="text-muted mt-3">
                        PT. WHS Global Mandiri adalah perusahaan pelayaran yang berdiri sejak tahun 2006 dan berkantor pusat di Jakarta, Jl. Pangeran Jayakarta Komp. 85 No. AB-AC Kota Jakarta Pusat, DKI Jakarta 10730 Indonesia, serta memiliki kantor cabang di Banjarmasin, Kalimantan Selatan. Perusahaan ini merupakan bagian dari Perusahaan Tanoto Maritime Group yang didirikan oleh bapak Tanoto Iskandar pada tahun 1973 yang mencakup layanan mulai dari pembangunan kapal baru, perbaikan kapal, penyewaan kapal, jasa pengiriman barang, agen pelayaran, manajemen armada, hingga layanan perantara (brokerage) dan berkantor pusat di Singapura.
                    </small>
                </div>
            </div>

            <form action="{{ route('lowongan_kerja.lamar', $lowongan->id) }}" method="POST">
                @csrf
                <div class="row mt-5">
                    <h4>Jawab Pertanyaan Berikut</h4>
                    @foreach ($data as $item)
                        <div class="row mb-3">
                            <label for="{{ $item->id }}">{{ $loop->iteration }} . {{ $item->pertanyaan }}</label>
                            <textarea name="answer[{{ $item->id }}]" class="form-control ms-4 mt-3" id="" cols="30" rows="5"></textarea>
                        </div>    
                    @endforeach
                </div>
    
                <div class="row my-5 px-4">
                    <button class="btn btn-primary px-5 py-2"><i class="bi bi-lightning-charge me-2"></i>Kirim Jawaban</button>
                </div>
            </form>
        </div>
    </main>
@endsection