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
            <h2 class="text-center mb-4 title-underline mb-5">My Profile</h2>
        </div>
        <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex gap-3 justify-content-center">
                <div class="col-11 col-md-3 bg-white shadow p-3 rounded-4">
                    <img src="{{ (Auth::user()->image) ? asset('userdata/avatar/' . Auth::user()->image) : asset('image/new-user.jpg') }}" class="rounded-3 d-block mx-auto w-100 border-1" id="preview" alt="Profile">
                    <input type="file" name="image" class="form-control w-100 mt-3" id="imageInput" accept="image/*">
                    <hr>
                    <p class="mb-2 fw-bold" style="font-size: 16px">Name : {{ $user->name }}</p>
                    <p class="mb-1" style="font-size: 16px">Role : {{ $user->role }}</p>
                    @if($user->email)
                        <p class="mb-1" style="font-size: 16px">Email : {{ $user->email }}</p>
                    @endif
                    @if($crew->phone)
                        <p class="mb-1" style="font-size: 16px">Phone : {{ $crew->phone }}</p>
                    @endif
                    @if($crew->birth_place)
                        <p class="mb-1" style="font-size: 16px">Birth Place : {{ $crew->birth_place }}</p>
                    @endif
                    @if($crew->birth_date)
                        <p class="mb-1" style="font-size: 16px">Birth Date : {{ $crew->birth_date }}</p>
                    @endif
                    @if($crew->address)
                        <p class="mb-1" style="font-size: 16px">Address : {{ $crew->address }}</p>
                    @endif
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
                            <label for="phone" class="form-label">Phone Number <small class="text-danger">*</small></label>
                            <input type="number" name="phone" class="form-control" id="phone" value="{{ $crew->phone }}" required>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="birth_place" class="form-label">Birth Place <small class="text-danger">*</small></label>
                            <input type="text" name="birth_place" class="form-control" id="birth_place" value="{{ $crew->birth_place }}" required>
                        </div>
                        <div class="col mb-3">
                            <label for="birth_date" class="form-label">Birth Date <small class="text-danger">*</small></label>
                            <input type="date" name="birth_date" class="form-control" id="birth_date" value="{{ $crew->birth_date }}" required>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="gender" class="form-label"> Gender <small class="text-danger">*</small></label>
                            <select name="gender" id="gender" class="form-select" required>
                                <option value="{{ $crew->gender ?? '' }}">{{ $crew->gender ?? 'Select Gender' }}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label for="religion" class="form-label">Religion <small class="text-danger">*</small></label>
                            <select name="religion" id="religion" class="form-select">
                                <option value="{{ $crew->religion ?? '' }}" selected>{{ $crew->religion ?? '-- Select Religion --' }}</option>
                                <option value="Islam">Islam</option>
                                <option value="Christian">Christian</option>
                                <option value="Catholic">Catholic</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="address" class="form-label">Address <small class="text-danger">*</small></label>
                            <textarea name="address" class="form-control" id="" rows="3">{{ $crew->address ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="current_address" class="form-label">Current Address <small class="text-danger">*</small></label>
                            <textarea name="current_address" class="form-control" id="" rows="3">{{ $crew->current_address ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="marital_status" class="form-label">Marital Status <small class="text-danger">*</small></label>
                            <select name="marital_status" id="marital_status" class="form-select">
                                <option value="{{ $crew->marital_status ?? '' }}" selected>{{ $crew->marital_status ?? '-- Select Marital Status --' }}</option>
                                <option value="Not Maried Yet">Not Maried Yet</option>
                                <option value="Merried">Merried</option>
                                <option value="Widowed">Widowed</option>
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
                            <div class="d-flex gap-3">
                                <a href="{{ asset('file/profile/KTP.pdf') }}" target="_blank" class="text-primary" style="font-size: 16px">Example File</a>
                                @if ($crew->ktp != NULL)
                                    <a href="{{ asset('userdata/ktp/' . $crew->ktp) }}" target="_blank" class="text-primary" style="font-size: 16px">Preview</a>
                                @endif
                            </div>
                        </div>
                        <div class="col mb-3">
                            <label for="cv" class="form-label">Upload CV <small class="text-danger">*</small></label>
                            <input type="file" name="cv" class="form-control mb-2" id="cv" accept="application/pdf">
                            <small class="text-danger" style="font-size: 12px">CV Updated, File In Pdf Format</small>
                            <div class="d-flex gap-3">
                                <a href="{{ asset('file/profile/cv.pdf') }}" target="_blank" class="text-primary" style="font-size: 16px">Example File</a>
                                @if ($crew->curriculum_vitae != NULL)
                                    <a href="{{ asset('userdata/cv/' . $crew->curriculum_vitae) }}" target="_blank" class="text-primary" style="font-size: 16px">Preview</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="coc" class="form-label">Upload Certificate of Competency (COC)</label>
                            <input type="file" name="coc" class="form-control mb-2" id="coc" accept="application/pdf">
                            <small class="text-danger" style="font-size: 12px">(ANT/ATT/Ratings/Cook Handling) *Make 1 File in Pdf Format</small>
                            <div class="d-flex gap-3">
                                <a href="{{ asset('file/profile/COC.pdf') }}" target="_blank" class="text-primary" style="font-size: 16px">Example File</a>
                                @if ($crew->certificate_of_competency != NULL)
                                    <a href="{{ asset('userdata/coc/' . $crew->certificate_of_competency) }}" target="_blank" class="text-primary" style="font-size: 16px">Preview</a>
                                @endif
                            </div>
                        </div>
                        <div class="col mb-3">
                            <label for="cop" class="form-label">Certificate Of Proficiency (COP)</label>
                            <input type="file" name="cop" class="form-control mb-2" id="cop" accept="application/pdf">
                            <small class="text-danger" style="font-size: 12px">(BST, AFF, SAT, MFA, etc.) *Make 1 File In Pdf Format</small>
                            <div class="d-flex gap-3">
                                <a href="{{ asset('file/profile/COP.pdf') }}" target="_blank" class="text-primary" style="font-size: 16px">Example File</a>
                                @if ($crew->certificate_of_proficiency != NULL)
                                    <a href="{{ asset('userdata/cop/' . $crew->certificate_of_proficiency) }}" target="_blank" class="text-primary" style="font-size: 16px">Preview</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="smc" class="form-label">Seafarer’s Medical Certificate (SMC)</label>
                            <input type="file" name="smc" class="form-control mb-2" id="smc" accept="application/pdf">
                            <small class="text-danger" style="font-size: 12px">(Latest MCU At Lease 6 Months) *Pdf Format</small>
                            <div class="d-flex gap-3">
                                <a href="{{ asset('file/profile/SMC.pdf') }}" target="_blank" class="text-primary" style="font-size: 16px">Example File</a>
                                @if ($crew->seaferer_medical_certificate != NULL)
                                    <a href="{{ asset('userdata/smc/' . $crew->seaferer_medical_certificate) }}" target="_blank" class="text-primary" style="font-size: 16px">Preview</a>
                                @endif
                            </div>
                        </div>
                        <div class="col mb-3">
                            <label for="seamans_book" class="form-label">Upload Your Seaman's Book</label>
                            <input type="file" name="seamans_book" class="form-control mb-2" id="seamans_book" accept="application/pdf">
                            <small class="text-danger" style="font-size: 12px">*Make 1 File In Pdf Format</small>
                            <div class="d-flex gap-3">
                                <a href="{{ asset('file/profile/SEAMANS BOOK.pdf') }}" target="_blank" class="text-primary" style="font-size: 16px">Example File</a>
                                @if ($crew->seamans_book != NULL)
                                    <a href="{{ asset('userdata/seamans_book/' . $crew->seamans_book) }}" target="_blank" class="text-primary" style="font-size: 16px">Preview</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col mb-3">
                            <label for="additional_document" class="form-label">Upload Your Additional Documents</label>
                            <input type="file" name="additional_document" class="form-control mb-2" id="additional_document" accept="application/pdf">
                            <small class="text-danger" style="font-size: 12px">(Passport, Visa, Yellow Fever, etc.) *Make 1 File In Pdf Format</small>
                            <div class="d-flex gap-3">
                                <a href="{{ asset('file/profile/PASPOR.pdf') }}" target="_blank" class="text-primary" style="font-size: 16px">Example File</a>
                                @if ($crew->additional_documents != NULL)
                                    <a href="{{ asset('userdata/additional_document/' . $crew->additional_documents) }}" target="_blank" class="text-primary" style="font-size: 16px">Preview</a>
                                @endif
                            </div>
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
