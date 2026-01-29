<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siraka | Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            height: 100vh;
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
            border-radius: 1rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(115, 103, 240, 0.25);
            border-color: #468dd4;
        }
        .btn-custom {
            background-color: #468dd4;
            border: none;
        }
        .btn-custom:hover {
            background-color: #3772ad;
        }

        body {
            height: 100vh;
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
            background: rgba(0,0,0,0.6); /* hitam dengan opacity 0.6 */
            z-index: 0;
        }

        .login-card {
            position: relative;
            z-index: 1; /* biar card di atas overlay */
            max-width: 400px;
            width: 100%;
            border-radius: 1rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
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
    <div class="card login-card p-4 pt-2">
        <div class="text-center mb-4">
            <img src="{{ asset('image/siraka-logo.png') }}" height="70px" alt="">
            <p class="text-muted">Login to your account!</p>
        </div>

        <form action="" method="POST">
            @csrf
            @if (session('status'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    id="email" 
                    name="email" 
                    placeholder="Enter your email address" 
                    required 
                    autofocus
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="password" 
                    name="password" 
                    placeholder="Enter your password" 
                    required
                >
            </div>
            <a href="{{ route('forgot_password') }}" style="font-size: 14px" class="text-decoration-none text-center">Forgot Password</a>
            <button type="submit" class="btn btn-custom w-100 py-2 mt-3 text-white">Login</button>
            <a href="{{ route('register') }}" style="font-size: 14px" class="text-decoration-none text-center">Don't have an account yet? Register now</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>
