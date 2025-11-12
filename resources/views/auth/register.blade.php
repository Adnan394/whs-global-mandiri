<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Meeting App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
<div class="bg-overlay"></div>
<div class="card register-card p-4 mt-5">
    <div class="text-center mb-3">
        <img src="{{ asset('image/logo-wgm.jpg') }}" height="70px" alt="">
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
                <a href="{{ route('login') }}" class="text-decoration-none mb-3">Punya akun? Login</a>
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
                <a href="{{ route('login') }}" class="text-decoration-none">Punya akun? Login</a>
                <button type="submit" class="btn btn-custom w-100 py-2 mt-3 text-white">Register as Crewing</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
