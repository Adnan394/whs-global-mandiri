@extends('layout.app')

<style>
    /* opsional styling tambahan */
    #preview {
        object-fit: cover;
        border: 2px solid #ddd;
        height: 300px;
    }
</style>

@section('content')
<div class="hero-container mb-5" style="padding-top: 150px">
    <div class="container rounded-4">
        <div class="d-flex justify-content-center">
            {{-- Adjusted title for Phase 1 --}}
            <h2 class="text-center mb-4 title-underline mb-5">Forgot Password</h2>
        </div>

        {{-- Route standard for sending password reset link: 'password.email' --}}
        <form action="{{ route('forgot_password.store') }}" method="POST">
            @csrf
            <div class="row d-flex gap-3 justify-content-center">
                <div class="col-11 col-md-5 bg-white shadow p-4 rounded-4">
                    
                    <p class="text-center text-muted">We will send you a link to reset your password.</p>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-control" 
                            value="" 
                            required 
                            autocomplete="email" 
                            autofocus
                        >
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">Send Password Reset Link</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
