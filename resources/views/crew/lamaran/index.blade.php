@extends('layout.app')

@section('content')
    <main id="main" style="margin-top: 150px" class="mb-5">
        <div class="container">
            <div class="d-flex justify-content-center">
                <h2 class="text-center mb-5 title-underline">Lamaran Saya</h2>
            </div>

            <div class="row">
                @foreach ($data as $item)
                    @php
                    $lowongan = \App\Models\LowonganKerja::where('id', $item->lowongan_kerja_id)->first();   
                    @endphp
                    <div class="card p-0 mb-3 border-0 shadow-sm overflow-hidden" style="max-width: 640px;">
                        <div class="row g-0 align-items-stretch">
                            <!-- Gambar kiri -->
                            <div class="col-md-5">
                                <img src="{{ asset('images/lowongan_kerja/' . $lowongan->image) }}" 
                                    class="img-fluid w-100 h-100 object-fit-cover" 
                                    style="object-fit: cover;" 
                                    alt="{{ $lowongan->title }}">
                            </div>

                            <!-- Konten kanan -->
                            <div class="col-md-7">
                                <div class="card-body h-100 d-flex flex-column justify-content-between">
                                    <div>
                                        <small class="card-text">PT. WHS Global Mandiri</small>
                                        <h5 class="card-title mt-2">{{ $lowongan->title }}</h5>
                                        <small class="card-text text-muted">
                                            Gaji : Rp. {{ number_format($lowongan->sallary, 0, ',', '.') }}
                                        </small>
                                        <br>
                                        @if($item->status == 0) 
                                            <small class="text-muted">
                                                <i class="bi bi-send me-2"></i>Process
                                            </small>
                                        @elseif($item->status == 2)
                                            <small class="text-primary">
                                                <i class="bi bi-megaphone me-2"></i>Interview
                                            </small>
                                        @elseif($item->status == 3)
                                            <small class="text-success">
                                                <i class="bi bi-person-check me-2"></i>Accepted
                                            </small>
                                        @elseif($item->status == 4)
                                            <small class="text-danger">
                                                <i class="bi bi-ban me-2"></i>Decline
                                            </small>
                                        @endif
                                    </div>

                                    <button data-bs-toggle="modal" data-bs-target="#ModalPesan{{ $item->id }}" class="btn btn-primary mt-3 px-3 align-self-start">
                                        <i class="bi bi-send me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalPesan{{ $item->id }}" tabindex="-1" aria-labelledby="ModalPesan{{ $item->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('kirim_pesan') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_lamaran_id" value="{{ $item->id }}">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="ModalPesan{{ $item->id }}Label">Kirim Pesan ke HRD</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-0">
                                        <div class="bg-light p-3">
                                            <h5>{{ $lowongan->title }}</h5>
                                            @if($item->status == 0) 
                                                <small class="text-muted">
                                                    <i class="bi bi-send me-2"></i>Process
                                                </small>
                                            @elseif($item->status == 2)
                                                <small class="text-primary">
                                                    <i class="bi bi-megaphone me-2"></i>Interview
                                                </small>
                                            @elseif($item->status == 3)
                                                <small class="text-success">
                                                    <i class="bi bi-person-check me-2"></i>Accepted
                                                </small>
                                            @elseif($item->status == 4)
                                                <small class="text-danger">
                                                    <i class="bi bi-ban me-2"></i>Decline
                                                </small>
                                            @endif
                                        </div>
                                        <div class="mb-3 p-3">
                                            <label for="" class="form-label">Pesan</label>
                                            <textarea class="form-control" id="" name="message" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection