@extends('layout.app')

@section('content')
    <main id="main" style="margin-top: 150px" class="mb-5">
        <div class="container">
            <div class="d-flex justify-content-center">
                <h2 class="text-center mb-5 title-underline">Detail Job Vacancy</h2>
            </div>
            <div class="d-flex row align-items-start">
                <div class="col-12 col-md-5 d-flex mb-3">
                    <img src="{{ asset('images/lowongan_kerja/' . $lowongan->image) }}" 
                        class="rounded-5 w-100 object-fit-cover" style="height: 400px; width: 100%; object-fit: cover"
                        alt="">
                </div>
                <div class="col-12 col-md-7 d-flex flex-column justify-content-between">
                    <div>
                        <p class="mb-2">
                            PT. WHS Global Mandiri 
                            <i class="bi bi-check text-primary p-1 rounded-circle fs-5"></i>
                        </p>
                        <h4 class="fw-500">
                            {{ $lowongan->status == 1 ? '[Open] ' : '[Close] ' }}{{ $lowongan->title }}
                        </h4>
                        <small class="text-muted">
                            Diupload pada : {{ Carbon\Carbon::parse($lowongan->created_at)->locale('id_ID')->isoFormat('d MMMM Y') }}
                        </small><br>
                        <small class="text-muted">
                            Gaji Berkisar : Rp. {{ $lowongan->sallary ? number_format($lowongan->sallary, 0, ',', '.') :  'Confinental' }}
                        </small>
                    </div>
                    <h4 class="mt-3">Description</h4>
                    <p class="text-muted">
                        {!! $lowongan->description !!}
                    </p>
                    <div class="row my-3 px-4">
                        @if (!empty(\App\Models\Pertanyaan::where('lowongan_kerja_id', $lowongan->id)->first()))
                            <a href="{{ route('lowongan_kerja.pertanyaan', $lowongan->slug) }}" class="btn btn-primary px-5 py-2"><i class="bi bi-lightning-charge me-2"></i>Apply Now</a>
                        @else
                            <a href="{{ route('lowongan_kerja.lamar', $lowongan->slug) }}" class="btn btn-primary px-5 py-2"><i class="bi bi-lightning-charge me-2"></i>Apply Now</a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection