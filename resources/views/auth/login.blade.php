<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Meeting App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="bg-overlay"></div>
    <div class="card login-card p-4 pt-2">
        <div class="text-center mb-4">
            <img src="{{ asset('image/logo-wgm.jpg') }}" height="70px" alt="">
            <p class="text-muted">Login Ke Akun Anda</p>
        </div>

        <form action="" method="POST">
            @csrf
            @if (session('status'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    id="email" 
                    name="email" 
                    placeholder="Masukan alamat email" 
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
            <a href="{{ route('register') }}" class="text-decoration-none text-center">Belum punya akun? Daftar</a>
            <button type="submit" class="btn btn-custom w-100 py-2 mt-3 text-white">Masuk</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
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
