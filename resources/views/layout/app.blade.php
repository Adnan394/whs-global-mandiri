<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karir | Pelayaran</title>
    <link rel="icon" type="image/png" href="{{ asset('image/siraka.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-white fixed-top py-3 shadow text-black fw-500">
        <div class="container">
            <a class="navbar-brand text-black d-flex" href="/">
                <img src="{{ asset('image/siraka-logo.png') }}" height="50px" alt="">
                <img src="{{ asset('image/logo-wgm.jpg') }}" height="50px" alt="">
            </a>
            
            <div class="d-flex align-items-center gap-3 d-lg-none">
                <!-- hamburger -->
                <button class="navbar-toggler border border-0 shadow-none" type="button" 
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                    aria-controls="navbarSupportedContent" aria-expanded="false" 
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-1">
                        <a class="nav-link text-black link-home {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link text-black link-tentang {{ Request::is('/#tentang') ? 'active' : '' }}" href="/#tentang">About Us</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link text-black link-career {{ Request::is('/#karir') ? 'active' : '' }}" href="/#karir">Career</a>
                    </li>
                    <li class="nav-item mx-1 me-5">
                        <a class="nav-link text-black link-career {{ Request::is('/#gallery') ? 'active' : '' }}" href="/#gallery">Gallery</a>
                    </li>
                    @if (Auth::user())
                        <li class="nav-item mt-1">
                            <div class="dropdown">
                                <p class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ Auth::user()->image ? asset('userdata/avatar/' . Auth::user()->image) : asset('image/profile.jpg') }}"  class="me-2"
                                            style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover" alt="">
                                        <span class="text-dark" style="text-decoration: none !important; text-style: none !important">{{ \App\Models\Crew::where('user_id', Auth::user()->id)->first()->nickname ?? Auth::user()->name ?? '' }}</span>
                                </p>
    
                                <ul class="dropdown-menu border-0 bg-white shadow py-4" style="width: 15rem">
                                    <li>
                                        <img src="{{ asset('image/profile.jpg') }}" class="d-block mx-auto rounded-circle" style="width: 50px; height: 50px" alt="">
                                        <p class="text-center mt-2 text-dark fw-bold mb-1">{{ Auth::user()->name }}</p>
                                        <p class="text-center text-muted">{{ Auth::user()->role }}</p>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person-fill me-2"></i>Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ route('lamaran_saya.index') }}"><i class="bi bi-bookmark-check-fill me-2"></i>Lowongan Saya</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="bi bi-box-arrow-left me-2"></i>Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link text-black btn btn-primary px-4 text-white" href="/login">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    @yield('content')

    {{-- Sidebar Pesan --}}
    @if (Auth::user())
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body p-0 bg-light d-flex flex-column">

                {{-- 🟢 Tabs --}}
                <ul class="nav nav-tabs nav-fill" id="pesanTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="message-tab" data-bs-toggle="tab" data-bs-target="#message" type="button" role="tab" aria-controls="message" aria-selected="true">
                            Message
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="job-message-tab" data-bs-toggle="tab" data-bs-target="#job-message" type="button" role="tab" aria-controls="job-message" aria-selected="false">
                            Job Message
                        </button>
                    </li>
                </ul>

                {{-- 🟡 Tab Contents --}}
                <div class="tab-content flex-grow-1 overflow-y-auto" id="pesanTabContent">

                    {{-- 🟢 TAB 1: Message --}}
                    <div class="tab-pane fade show active p-3" id="message" role="tabpanel" aria-labelledby="message-tab">
                        <div class="flex-grow-1" style="overflow-y: auto;">
                            @php
                                $data = \App\Models\Message::where('crew_id', Auth::user()->id)
                                    ->orWhere('crewing_id', Auth::user()->id)
                                    ->orderBy('created_at', 'desc')
                                    ->get()
                                    ->unique('crew_id')
                                    ->values();
                            @endphp

                            @forelse ($data as $item)
                                @php
                                    $crew = \App\Models\Crew::find($item->crew_id);
                                    $lastMessage = \App\Models\Message::where('crew_id', $item->crew_id)
                                        ->where('crewing_id', $item->crewing_id)
                                        ->orderBy('created_at', 'desc')
                                        ->first();
                                @endphp

                                {{-- INI HANYA PEMICU MODAL --}}
                                <div data-bs-toggle="modal" data-bs-target="#messageModal{{ $item->crew_id }}" style="cursor: pointer"
                                    class="row p-3 bg-white border border-bottom-2 mb-1">
                                    <p class="mb-1 fw-bold">{{ $crew->fullname ?? 'Unknown User' }}</p>
                                    <small class="text-muted">{{ $lastMessage->message ?? 'Belum ada pesan' }}</small>
                                </div>
                                
                                {{-- 🛑 Blok Modal Telah Dihapus Dari Sini --}}

                            @empty
                                <p class="text-muted text-center mt-5">Belum ada pesan masuk.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- 🟢 TAB 2: Job Message --}}
                    <div class="tab-pane fade" id="job-message" role="tabpanel" aria-labelledby="job-message-tab">
                        @php
                            $data_lamaran = \App\Models\UserLamaran::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
                        @endphp

                        @foreach ($data_lamaran as $data)
                            @php
                                $chatTerakhir = \App\Models\Chat::where('user_lamaran_id', $data->id)->latest()->first();
                            @endphp

                            {{-- INI HANYA PEMICU MODAL --}}
                            <div data-bs-toggle="modal" data-bs-target="#jobModal{{ $data->id }}" style="cursor: pointer"
                                class="row p-3 {{ ($chatTerakhir && $chatTerakhir->user_id == Auth::user()->id) ? 'bg-light' : 'bg-white' }} border border-bottom-2">
                                <small class="text-muted mb-1">PT. WHS Global Mandiri</small>
                                <p class="mb-2">{{ \App\Models\LowonganKerja::find($data->lowongan_kerja_id)->title }}</p>
                                <small class="text-muted">{{ \Illuminate\Support\Str::limit($chatTerakhir->message ?? '', 50) }}</small>
                            </div>
                            
                            {{-- 🛑 Blok Modal Telah Dihapus Dari Sini --}}

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- ⬆️ AKHIR DARI OFF CANVAS --}}


    ---


    {{-- ⬇️ BAGIAN 2: BLOK UNTUK SEMUA MODAL --}}
    {{-- Tempatkan ini di luar Offcanvas, idealnya di bagian bawah file Blade Anda --}}

    @if (Auth::user())

        {{-- 1. Modals untuk "Message" (dari Tab 1) --}}
        @php
            // Kita perlu data ini lagi untuk membuat modal-nya
            $dataModals = \App\Models\Message::where('crew_id', Auth::user()->id)
                ->orWhere('crewing_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->unique('crew_id')
                ->values();
        @endphp

        @foreach ($dataModals as $item)
            @php
                // Ambil data yang diperlukan untuk modal
                $crew = \App\Models\Crew::find($item->crew_id);
                $chatData = \App\Models\Message::where('crew_id', $item->crew_id)
                    ->where('crewing_id', $item->crewing_id)
                    ->orderBy('created_at', 'asc')
                    ->get();
            @endphp

            {{-- Modal chat untuk setiap user --}}
            <div class="modal fade" id="messageModal{{ $item->crew_id }}" tabindex="100" aria-labelledby="pesanLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('message.store') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <div>
                                    <p class="mb-1">Chat dengan: <strong>{{ $crew->fullname ?? 'User' }}</strong></p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body" style="height: 450px; background: #f1f1f1; overflow-y: auto;">
                                <div class="row px-3">
                                    @foreach ($chatData as $chat)
                                        @if($chat->user_id == Auth::user()->id)
                                            <div class="p-3 mb-3 bg-primary text-white w-75 d-block ms-auto" style="border-radius: 20px 0 20px 20px">
                                                <small>{{ $chat->message }}</small><br>
                                                <small style="font-size: 12px" class="text-white d-flex justify-content-end">{{ $chat->created_at }}</small>
                                            </div>
                                        @else
                                            <div class="p-3 mb-3 bg-white w-75" style="border-radius: 0 20px 20px 20px">
                                                <small>{{ $chat->message }}</small><br>
                                                <small style="font-size: 12px" class="text-muted">{{ $chat->created_at }}</small>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="d-flex gap-2 p-3 border-top">
                                <input type="hidden" name="crew_id" value="{{ $item->crew_id }}">
                                <input type="hidden" name="crewing_id" value="{{ $item->crewing_id }}">
                                <input type="text" name="message" class="form-control" placeholder="Ketik pesan...">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach


        {{-- 2. Modals untuk "Job Message" (dari Tab 2) --}}
        @php
            // Kita juga perlu data ini lagi
            $dataLamaranModals = \App\Models\UserLamaran::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        @endphp

        @foreach ($dataLamaranModals as $data)
            {{-- Modal untuk Job Message --}}
            <div class="modal fade" id="jobModal{{ $data->id }}" tabindex="100" aria-labelledby="pesanLabel" aria-hidden="true">
                <form action="{{ route('kirim_pesan') }}" method="POST">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header align-items-start">
                                <div class="row">
                                    <p class="mb-2">Nama : {{ \App\Models\User::find($data->user_id)->name }}</p>
                                    <p>Lowongan Kerja : {{ \App\Models\LowonganKerja::find($data->lowongan_kerja_id)->title }}</p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="height: 450px; background: #eaeaea; overflow-y: auto">
                                <div class="row px-3">
                                    @php
                                        $chats = \App\Models\Chat::where('user_lamaran_id', $data->id)->get();   
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
                                <input type="hidden" name="user_lamaran_id" value="{{ $data->id }}">
                                <input type="text" name="message" class="form-control" placeholder="Kirim Pesan">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach

    @endif
    {{-- ⬆️ AKHIR DARI BLOK MODAL --}}

    <div data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="bg-primary d-flex justify-content-center align-items-center" style="position: fixed; bottom: 20px; right: 20px; width: 70px; height: 70px; border-radius: 50% 0 50% 50%; box-shadow: 0 4px 8px rgba(0,0,0,0.3); z-index: 1050;">
        <a class="text-white fs-4 mt-1">
            <i class="bi bi-chat-square-dots"></i>
        </a>
    </div>


    {{-- footer  --}}
    <footer style="background: #468dd4; height: 200px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-white text-center">
            <p class="m-0">Copyright &copy; 2023 Karir Pelayaran</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(".nav-link").click(function(){
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
    });
    </script>


    <script>
        if('{{ session('success') }}'){
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
            });
        }
        if('{{ session('error') }}'){
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                showConfirmButton: true,
            });
        }
    </script>
  </body>
</html>
