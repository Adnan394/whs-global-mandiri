<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Dashboard</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="{{ asset('image/siraka.png') }}" rel="icon" />
    <link href="{{ asset('NiceAdmin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('NiceAdmin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet" />
    <link href="{{ asset('NiceAdmin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet" />
    <link href="{{ asset('NiceAdmin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet" />
    <link href="{{ asset('NiceAdmin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Template Main CSS File -->
    <link href="{{ asset('NiceAdmin/assets/css/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="sweetalert2.min.css">
    @livewireStyles
  </head>

  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="/crewing" class="logo d-flex align-items-center">
          <img src="{{ asset('image/siraka-logo.png') }}" />
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div>
      <!-- End Logo -->

      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle" href="#">
              <i class="bi bi-search"></i>
            </a>
          </li>
          <!-- End Search Icon-->

          <li class="nav-item me-3">
            @php
                
            @endphp
            <a class="nav-link text-black fs-4 mt-1" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="bi bi-chat-square-dots"></i></a>
          </li>
          <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              {{-- <img style="object-fit: cover; width: 40px; height: 40px" src="{{ isset(\App\Models\MasterUser::where('id', Auth::user()->id)->first()->foto) ? asset(\App\Models\MasterUser::where('id', Auth::user()->id)->first()->foto) : asset('assets/img/defaultpp.webp') }}" alt="" class="rounded-circle"> --}}
              <span class="d-none d-md-block dropdown-toggle ps-2 text-dark">{{ Auth::user()->name ?? 'Unknown' }}</span> </a
            ><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6>{{ Auth::user()->name ?? ''}}</h6>
                <span>{{ Auth::user()->role }}</span>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="{{route('crewing.profile')}}">
                  <i class="bi bi-person"></i>
                  <span>My Profile</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="{{route('change_password')}}">
                  <i class="bi bi-gear"></i>
                  <span>Change Password</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </a>
              </li>
            </ul>
            <!-- End Profile Dropdown Items -->
          </li>
          <!-- End Profile Nav -->
        </ul>
      </nav>
      <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->
<!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
          <a class="nav-link {{ $active == 'dashboard' ? '' : 'collapsed' }}" href="/crewing">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ in_array($active, ['data_crew', 'my_crew']) ? '' : 'collapsed' }}" 
            data-bs-target="#data_crew" 
            data-bs-toggle="collapse" 
            href="#">
            <i class="bi bi-journal-text"></i>
            <span>Crew Data</span>
            <i class="bi bi-chevron-down ms-auto"></i>
          </a>

          <ul id="data_crew" 
              class="nav-content collapse {{ in_array($active, ['data_crew', 'my_crew']) ? 'show' : '' }}" 
              data-bs-parent="#sidebar-nav">

            <li class="nav-item">
              <a class="nav-link {{ $active == 'data_crew' ? '' : 'collapsed' }}" href="{{ route('data_crew') }}">
                <span>All Crew</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link {{ $active == 'my_crew' ? '' : 'collapsed' }}" href="{{ route('my_crew') }}">
                <span>My Crew</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ in_array($active, ['lowongan_kerja', 'lamaran', 'crew_list', 'signonoff']) ? '' : 'collapsed' }}" 
            data-bs-target="#crew_management" 
            data-bs-toggle="collapse" 
            href="#">
            <i class="bi bi-journal-text"></i>
            <span>Crew Management</span>
            <i class="bi bi-chevron-down ms-auto"></i>
          </a>

          <ul id="crew_management" 
              class="nav-content collapse {{ in_array($active, ['lowongan_kerja', 'lamaran', 'crewrotation', 'signonoff', 'crew_list']) ? 'show' : '' }}" 
              data-bs-parent="#sidebar-nav">

            <li class="nav-item">
              <a class="nav-link {{ $active == 'lowongan_kerja' ? '' : 'collapsed' }}" href="{{ route('lowongan.index') }}">
                <span>Available</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link {{ $active == 'lamaran' ? '' : 'collapsed' }}" href="{{ route('lamaran.index') }}">
                <span>Screening</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link {{ $active == 'signonoff' ? '' : 'collapsed' }}" href="{{ route('signonoff.index') }}">
                <span>Assignment</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link {{ $active == 'crew_list' ? '' : 'collapsed' }}" href="{{ route('crew_list.index') }}">
                <span>Crew List</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link {{ $active == 'crewrotation' ? '' : 'collapsed' }}" href="{{ route('crew_rotation.index') }}">
                <span>Crew Rotation</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ in_array($active, ['ship']) ? '' : 'collapsed' }}" 
            data-bs-target="#ship_management" 
            data-bs-toggle="collapse" 
            href="#">
            <i class="bi bi-journal-text"></i>
            <span>Ship Management</span>
            <i class="bi bi-chevron-down ms-auto"></i>
          </a>

          <ul id="ship_management" 
              class="nav-content collapse {{ in_array($active, ['ship']) ? 'show' : '' }}" 
              data-bs-parent="#sidebar-nav">

            <li class="nav-item">
              <a class="nav-link {{ $active == 'ship' ? '' : 'collapsed' }}" href="{{ route('ship.index') }}">
                <span>Ship Board</span>
              </a>
            </li>

            {{-- <li class="nav-item">
              <a class="nav-link {{ $active == 'crew_ship' ? '' : 'collapsed' }}" href="{{ route('lamaran.index') }}">
                <span>Crew Report</span>
              </a>
            </li> --}}
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $active == 'message' ? '' : 'collapsed' }}" href="{{ route('message') }}">
            <i class="bi bi-envelope"></i>
            <span>Message</span>
          </a>
        </li>

        <!-- End Dashboard Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('logout') }}">
            <i class="bi bi-box-arrow-in-left"></i>
            <span>Logout</span>
          </a>
        </li>
        <!-- End Login Page Nav -->
      </ul>
    </aside>
    <!-- End Sidebar-->
    @yield('content');

    {{-- Sidebar Pesan --}}
    @if (Auth::user())
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Pesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0 bg-light">
                @php
                    $data_lamaran = \App\Models\UserLamaran::orderBy('id', 'DESC')->get();
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

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/php-email-form/validate.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('NiceAdmin/assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- sweet alert  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        if('{{ session('success') }}'){
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                width: '400px'
            });
        }
        if('{{ session('error') }}'){
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                showConfirmButton: true,
                width: '400px'
            });
        }
    </script>
    @livewireScripts

  </body>
</html>


