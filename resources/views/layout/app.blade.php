<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karir | Pelayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-white fixed-top py-3 shadow text-black fw-500">
        <div class="container">
            <a class="navbar-brand text-black" href="/">
                <img src="{{ asset('image/logo-wgm.jpg') }}" height="70px" alt="">
            </a>
            
            <div class="d-flex align-items-center gap-3 d-lg-none">
                <!-- icon pesan & notif (mobile only) -->
                <a class="nav-link text-black fs-4 mt-1" href="#"><i class="bi bi-chat-square-dots"></i></a>
                <a class="nav-link text-black fs-4 mt-1" href="#"><i class="bi bi-bell"></i></a>

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
                        <a class="nav-link text-black active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link text-black" href="/#tentang">About Us</a>
                    </li>
                    <li class="nav-item mx-1 me-5">
                        <a class="nav-link text-black" href="/#karir">Career</a>
                    </li>
                    <li class="nav-item mx-1 d-none d-md-block">
                        <a class="nav-link text-black fs-4 mt-1" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="bi bi-chat-square-dots"></i></a>
                    </li>
                    <li class="nav-item mx-1 me-3 d-none d-md-block">
                        <a class="nav-link text-black fs-4 mt-1" href="#"><i class="bi bi-bell"></i></a>
                    </li>
                    @if (Auth::user())
                        <li class="nav-item">
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
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Pesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0 bg-light">
                @php
                    $data_lamaran = \App\Models\UserLamaran::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
                @endphp
                @foreach ($data_lamaran as $data)
                    @php
                        $chatTerakhir = \App\Models\Chat::where('user_lamaran_id', $data->id)
                            ->latest()
                            ->first();
                    @endphp
                    <div data-bs-toggle="modal" data-bs-target="#pesan{{ $data->id }}" style="cursor: pointer" 
                        class="row p-3 {{ ($chatTerakhir && $chatTerakhir->user_id == Auth::user()->id) ? 'bg-light' : 'bg-white' }} border border-bottom-2">
                        <small class="text-muted mb-1">PT. WHS Global Mandiri</small>
                        <br>
                        <p class="mb-2">{{ \App\Models\LowonganKerja::find($data->lowongan_kerja_id)->title }}</p>
                        <small class="text-muted">{{ \Illuminate\Support\Str::limit($chatTerakhir->message ?? '', 50) }}</small>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 🟢 Semua modal diletakkan di luar offcanvas agar tidak tertutup layer --}}
        @foreach ($data_lamaran as $data)
            <div class="modal fade" id="pesan{{ $data->id }}" tabindex="100" aria-labelledby="pesanLabel" aria-hidden="true">
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
                            <div class="modal-body" style="height: 450px; background: #eaeaea">
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

    {{-- footer  --}}
    <footer style="background: #468dd4; height: 200px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-white text-center">
            <p class="m-0">Copyright &copy; 2023 Karir Pelayaran</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
