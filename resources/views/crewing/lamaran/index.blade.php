@extends('layout.crewing')

@section('content')
    <main id="main">
        <div class="container">
            <section class="section">
                <div class="row">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Lamaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                    </nav>
                    <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h5 class="card-title">Data Lamaran</h5>
                            </div>
                        <!-- Table with stripped rows -->
                        <table class="table datatable table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Lowongan Kerja</th>
                                <th scope="col">Pertanyaan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ \App\Models\LowonganKerja::where('id', $item->lowongan_kerja_id)->first()->title }}</td>
                                        <td>
                                            @php
                                                $userPertanyaan = \App\Models\UserPertanyaan::where('user_id', $item->user_id)->get()   
                                            @endphp

                                            @foreach ($userPertanyaan as $pertanyaan)
                                                <p class="mb-0">{{ $loop->iteration }}. {{ \App\Models\Pertanyaan::where('id', $pertanyaan->pertanyaan_id)->first()->pertanyaan }}</p>
                                                <a class="mb-2 ms-3 text-primary" data-bs-toggle="collapse" href="#collapseExample{{ $pertanyaan->id }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $pertanyaan->id }}">Jawaban</a>
                                                <div class="collapse" id="collapseExample{{ $pertanyaan->id }}">
                                                    <div class="card p-2 ms-4">
                                                        <small class="">{{ $pertanyaan->jawaban }}</small>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($item->status == 0)
                                                <span class="badge text-bg-secondary">Lamaran Dikirim</span>
                                            @elseif($item->status == 1)
                                                <span class="badge text-bg-primary">Terhubung HRD</span>
                                            @elseif($item->status == 2)
                                                <span class="badge text-bg-primary">Interview</span>
                                            @elseif($item->status == 3)
                                                <span class="badge text-bg-success">Diterima</span>
                                            @elseif($item->status == 4)
                                                <span class="badge text-bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#UbahStatus{{ $item->id }}"><i class="bi bi-pencil"></i></button>
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pesan{{ $item->id }}"><i class="bi bi-envelope"></i></button>
                                        </td>
                                    </tr>

                                                                        
                                    <!-- Modal ubah status-->
                                    <div class="modal fade" id="UbahStatus{{ $item->id }}" tabindex="-1" aria-labelledby="UbahStatusLabel" aria-hidden="true">
                                        <form action="{{ route('lamaran.update_status', $item->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="UbahStatusLabel">Ubah Status</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <p>Nama : {{ \App\Models\User::where('id', $item->user_id)->first()->name }}</p>
                                                            <p>Lowongan Kerja : {{ \App\Models\LowonganKerja::where('id', $item->lowongan_kerja_id)->first()->title }}</p>
        
                                                            <p>Status : </p>
                                                            <div class="">
                                                                <select name="status" id="" class="form-select">
                                                                    <option value="">-- Pilih Status --</option>
                                                                    <option value="0">Lamaran Dikirim</option>
                                                                    <option value="1">Terhubung HRD</option>
                                                                    <option value="2">Interview</option>
                                                                    <option value="3">Diterima</option>
                                                                    <option value="4">Ditolak</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                                                        
                                    <!-- Modal pesan-->
                                    <div class="modal fade" id="pesan{{ $item->id }}" tabindex="-2" aria-labelledby="pesanLabel" aria-hidden="true">
                                        <form action="{{ route('kirim_pesan') }}" method="POST">
                                            @csrf
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header align-items-start">
                                                        {{-- <h1 class="modal-title fs-5 fw-bold" id="pesanLabel">Pesan</h1> --}}
                                                        <div class="row">
                                                            <p class="mb-2">Nama : {{ \App\Models\User::where('id', $item->user_id)->first()->name }}</p>
                                                            <p>Lowongan Kerja : {{ \App\Models\LowonganKerja::where('id', $item->lowongan_kerja_id)->first()->title }}</p>
                                                        </div>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="height: 450px; background: #eaeaea">
                                                        <div class="row px-3">
                                                            @php
                                                             $chats = \App\Models\Chat::where('user_lamaran_id', $item->id)->get();   
                                                            @endphp

                                                            @foreach ($chats as $chat)
                                                                @if($chat->user_id == Auth::user()->id)
                                                                    <div class="p-3 mb-3 bg-primary text-white w-75 d-block ms-auto" style="border-radius: 20px 0 20px 20px">
                                                                        <small class="mb-2">{{ $chat->message }}</small><br>
                                                                        <small style="font-size: 12px" class="text-white mt-3 d-flex justify-content-end">{{ $chat->created_at }}</small>
                                                                    </div>
                                                                @else
                                                                    <div class="p-3 mb-3 bg-white w-75" style="border-radius: 0 20px 20px 20px">
                                                                        <small class="mb-2">{{ $chat->message }}</small><br>
                                                                        <small style="font-size: 12px" class="text-muted mt-3">{{ $chat->created_at }}</small>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-2 p-3">
                                                        <input type="hidden" name="user_lamaran_id" value="{{ $item->id }}">
                                                        <input type="text" name="message" class="form-control" placeholder="Kirim Pesan">
                                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                        </div>
                    </div>

                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection