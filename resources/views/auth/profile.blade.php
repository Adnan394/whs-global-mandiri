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
            <h2 class="text-center mb-4 title-underline mb-5">Profile Anda</h2>
        </div>
        <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex gap-3 justify-content-center">
                <div class="col-11 col-md-3 bg-white shadow p-3 rounded-4">
                    <img src="{{ (Auth::user()->image) ? asset('userdata/avatar/' . Auth::user()->image) : asset('image/new-user.jpg') }}" class="rounded-3 d-block mx-auto w-100 border-1" id="preview" alt="Profile">
                    <input type="file" name="image" class="form-control w-100 mt-3" id="imageInput" accept="image/*">
                    <hr>
                    <h5 class="text-center mb-2 fw-bold">{{ $user->name }}</h5>
                    <p class="text-center mb-0">{{ $user->role }}</p>
                </div>
                <div class="col-11 col-md-8 bg-white shadow p-4 rounded-4">
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Name <small class="text-danger">*</small></label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="col mb-3">
                            <label for="nickname" class="form-label">Nickname <small class="text-danger">*</small></label>
                            <input type="text" name="nickname" class="form-control" id="nickname" value="{{ $crew->nickname }}" required>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                            <input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="col mb-3">
                            <label for="phone" class="form-label">No Telepon <small class="text-danger">*</small></label>
                            <input type="number" name="phone" class="form-control" id="phone" value="{{ $crew->phone }}" required>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="birth_place" class="form-label">Tempat Lahir <small class="text-danger">*</small></label>
                            <input type="text" name="birth_place" class="form-control" id="birth_place" value="{{ $crew->birth_place }}" required>
                        </div>
                        <div class="col mb-3">
                            <label for="birth_date" class="form-label">Tanggal Lahir <small class="text-danger">*</small></label>
                            <input type="date" name="birth_date" class="form-control" id="birth_date" value="{{ $crew->birth_date }}" required>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="gender" class="form-label">Jenis Kelamin <small class="text-danger">*</small></label>
                            <input type="text" name="gender" class="form-control" id="gender" value="{{ $crew->gender }}" required>
                        </div>
                        <div class="col mb-3">
                            <label for="religion" class="form-label">Agama <small class="text-danger">*</small></label>
                            <select name="religion" id="religion" class="form-select">
                                <option value="{{ $crew->religion ?? '' }}" selected>{{ $crew->religion ?? '-- Select Religion --' }}</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Konghucu">Konghucu</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="address" class="form-label">Alamat <small class="text-danger">*</small></label>
                            <textarea name="address" class="form-control" id="" rows="3">{{ $crew->address ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="current_address" class="form-label">Alamat Sekarang <small class="text-danger">*</small></label>
                            <textarea name="current_address" class="form-control" id="" rows="3">{{ $crew->current_address ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="marital_status" class="form-label">Status Pernikahan <small class="text-danger">*</small></label>
                            <select name="marital_status" id="marital_status" class="form-select">
                                <option value="{{ $crew->marital_status ?? '' }}" selected>{{ $crew->marital_status ?? '-- Select Marital Status --' }}</option>
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Janda">Janda</option>
                                <option value="Duda">Duda</option>
                            </select>
                        </div>
                        {{-- <div class="col mb-3">
                            <label for="standby_on" class="form-label">Stanby On? <small class="text-danger">*</small></label>
                            <select name="standby_on" id="standby_on" class="form-select">
                                <option value="{{ $crew->standby_on ?? '' }}" selected>{{ $crew->standby_on ?? '-- Select Standby --' }}</option>
                                <option value="Offboard">Offboard</option>
                                <option value="Onboard">Onboard</option>
                            </select>
                        </div> --}}
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="ktp" class="form-label">Upload ID <small class="text-danger">*</small></label>
                            <input type="file" name="ktp" class="form-control mb-2" id="ktp" accept="application/pdf">
                            <small class="text-danger" style="font-size: 12px">(KTP, Akta Kelahiran, KK) *Make 1 File In Pdf Format</small>
                        </div>
                        {{-- === FILE KTP === --}}
                        {{-- <div class="col mb-3">
                            <label for="ktp" class="form-label">Upload ID <small class="text-danger">*</small></label>
                            @if(!empty($crew->ktp))
                                <div class="mb-2">
                                    <iframe src="{{ asset('userdata/ktp/'.$crew->ktp) }}" 
                                            width="100%" height="300" 
                                            style="border: 1px solid #ccc; border-radius: 10px;"></iframe>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-danger btn-sm" 
                                            onclick="deleteFile('ktp')">Hapus File</button>

                                    <label class="btn btn-primary btn-sm mb-0">
                                        Ganti File
                                        <input type="file" name="ktp" class="d-none" id="ktp" accept="application/pdf" onchange="previewPDF(this, 'ktpPreview')">
                                    </label>
                                </div>
                            @else
                                <input type="file" name="ktp" class="form-control mb-2" id="ktp" accept="application/pdf" onchange="previewPDF(this, 'ktpPreview')">
                            @endif

                            <iframe id="ktpPreview" width="100%" height="300" style="border:none;display:none;"></iframe>
                            <small class="text-danger" style="font-size: 12px">(KTP, Akta Kelahiran, KK) *Make 1 File In Pdf Format</small>
                        </div> --}}
                        <div class="col mb-3">
                            <label for="cv" class="form-label">Upload CV <small class="text-danger">*</small></label>
                            <input type="file" name="cv" class="form-control mb-2" id="cv" accept="application/pdf">
                            <small class="text-danger" style="font-size: 12px">CV Updated, File In Pdf Format</small>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="coc" class="form-label">Upload Certificate of Competency (COC)</label>
                            <input type="file" name="coc" class="form-control mb-2" id="coc" accept="application/pdf">
                            <small class="text-danger" style="font-size: 12px">(Ratings/ANT/ATT/Cook Handling) *Make 1 File In Pdf Format</small>
                        </div>
                        <div class="col mb-3">
                            <label for="cop" class="form-label">Certificate Of Proficiency (COP)</label>
                            <input type="file" name="cop" class="form-control mb-2" id="cop" accept="application/pdf">
                            <small class="text-danger" style="font-size: 12px">(BST, AFF, SAT, MFA, etc.) *Make 1 File In Pdf Format</small>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="smc" class="form-label">Seafarer’s Medical Certificate (SMC)</label>
                            <input type="file" name="smc" class="form-control mb-2" id="smc" accept="application/pdf">
                            <small class="text-danger" style="font-size: 12px">(Latest MCU At Lease 6 Months) *Pdf Format</small>
                        </div>
                        <div class="col mb-3">
                            <label for="additional_document" class="form-label">Upload Your Additional Documents</label>
                            <input type="file" name="additional_document" class="form-control mb-2" id="additional_document" accept="application/pdf">
                            <small class="text-danger" style="font-size: 12px">(Passport, Visa, Yellow Fever, etc.) *Make 1 File In Pdf Format</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Preview gambar otomatis saat input file berubah
    document.getElementById('imageInput').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(file);
        }
    });
</script>

<script>
    // Preview file PDF sebelum upload
    function previewPDF(input, previewId) {
        const file = input.files[0];
        const preview = document.getElementById(previewId);

        if (file && file.type === "application/pdf") {
            preview.src = URL.createObjectURL(file);
            preview.style.display = "block";
        } else {
            preview.src = "";
            preview.style.display = "none";
        }
    }
</script>

@endsection
