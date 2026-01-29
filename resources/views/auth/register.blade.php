<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siraka | Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            /* height: 100vh; */
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            background-image: url('{{ asset('image/ship2.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 0;
        }

        .register-card {
            position: relative;
            z-index: 1;
            margin-top: 150px;
            max-width: 450px;
            width: 100%;
            border-radius: 1rem;
            background: white;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .btn-custom {
            background-color: #468dd4;
            border: none;
        }

        .btn-custom:hover {
            background-color: #3772ad;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white fixed-top py-1 shadow text-black fw-500">
        <div class="container">
            <a class="navbar-brand text-black d-flex" href="/">
                <img src="{{ asset('image/siraka-logo.png') }}" height="50px" alt="">
                <!--<img src="{{ asset('image/logo-wgm.jpg') }}" height="50px" alt="">-->
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
                <ul class="navbar-nav ms-auto mb-lg-0 mt-2">
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
                                        <span class="text-dark" style="text-decoration: none !important; text-style: none !important">{{ \App\Models\crew::where('user_id', Auth::user()->id)->first()->nickname ?? Auth::user()->name ?? '' }}</span>
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
<div class="bg-overlay"></div>
<div class="card register-card p-4">
    <div class="text-center mb-3">
        <img src="{{ asset('image/siraka-logo.png') }}" height="70px" alt="">
        <p class="text-muted">Register your account</p>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3" id="registerTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="crew-tab" data-bs-toggle="tab" data-bs-target="#crew" type="button" role="tab">Crew</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="crewing-tab" data-bs-toggle="tab" data-bs-target="#crewing" type="button" role="tab">Crewing</button>
        </li>
    </ul>

    <div class="tab-content" id="registerTabsContent">
        <!-- Crew Form -->
        <div class="tab-pane fade show active" id="crew" role="tabpanel" aria-labelledby="crew-tab">
            <form action="{{ route('registerCrew') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="crew">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="fullname" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nickname</label>
                    <input type="text" class="form-control" name="nickname" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Rank</label>
                    <select class="form-select" name="rank_id" required>
                        <option value="">-- Select Rank --</option>
                        @foreach($ranksCrew as $rank)
                            <option value="{{ $rank->id }}">{{ $rank->name }}</option>
                        @endforeach
                    </select>
                </div>
                <a href="{{ route('login') }}" style="font-size: 14px" class="text-decoration-none mb-3">Already have an account? Login now</a>
                <button type="submit" class="btn btn-custom w-100 py-2 mt-3 text-white">Register as Crew</button>
            </form>
        </div>

        <!-- Crewing Form -->
        <div class="tab-pane fade" id="crewing" role="tabpanel" aria-labelledby="crewing-tab">
            <form action="{{ route('registerCrewing') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="role" value="crewing">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="fullname" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nickname</label>
                    <input type="text" class="form-control" name="nickname" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Your ID</label>
                    <input type="file" class="form-control" name="card_id" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Rank</label>
                    <select class="form-select" name="rank_id" required>
                        <option value="">-- Select Rank --</option>
                        @foreach($ranksCrewing as $rank)
                            <option value="{{ $rank->id }}">{{ $rank->name }}</option>
                        @endforeach
                    </select>
                </div>
                <a href="{{ route('login') }}" style="font-size: 14px" class="text-decoration-none">Already have an account? Login now</a>
                <button type="submit" class="btn btn-custom w-100 py-2 mt-3 text-white">Register as Crewing</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
