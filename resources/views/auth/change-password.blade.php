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
            <h2 class="text-center mb-4 title-underline mb-5">Change Password</h2>
        </div>
        <form action="{{ route('change_password.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex gap-3 justify-content-center">
                <div class="col-11 col-md-5 bg-white shadow p-4 rounded-4">
                    <div class="mb-3">
                        <label for="" class="form-label">Old Password</label>
                        <input type="password" name="old_password" id="" class="form-control"> 
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">New Password</label>
                        <input type="password" name="password" id="" class="form-control"> 
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
