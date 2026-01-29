<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<link rel="icon" type="image/png" href="{{ asset('image/siraka.png') }}">
<title>{{ $data->fullname }}</title>
<meta content="" name="description" />
<meta content="" name="keywords" />

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

<!-- Vendor CSS Files -->
<link href="{{ asset('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<!-- Template Main CSS File -->
<link href="{{ asset('NiceAdmin/assets/css/style.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-4">
                <img src="{{ asset('/userdata/avatar/' . $data->user->image) }}" width="100%" height="300px" style="object-fit: cover" alt="">
            </div>
            <div class="col-8">
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Fullname</div>
                    <div class="col-8">: {{ $data->fullname }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Nickname</div>
                    <div class="col-8">: {{ $data->nickname }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Email</div>
                    <div class="col-8">: {{ $data->email }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Phone</div>
                    <div class="col-8">: {{ $data->phone }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Birth Place</div>
                    <div class="col-8">: {{ $data->birth_place }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Birth Date</div>
                    <div class="col-8">: {{ $data->birth_date }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Gender</div>
                    <div class="col-8">: {{ $data->gender }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Marital Status</div>
                    <div class="col-8">: {{ $data->marital_status }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Address</div>
                    <div class="col-8">: {{ $data->address }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Current Address</div>
                    <div class="col-8">: {{ $data->current_address }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Standby On</div>
                    <div class="col-8">: {{ $data->standby_on }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Rank</div>
                    <div class="col-8">: {{ $data->rank->name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">User ID</div>
                    <div class="col-8">: <a href="{{ asset('/userdata/ktp/' . $data->ktp) }}" target="_blank">{{ $data->ktp }}</a></div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">CV</div>
                    <div class="col-8">: <a href="{{ asset('/userdata/cv/' . $data->curriculum_vitae) }}" target="_blank">{{ $data->curriculum_vitae }}</a></div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Certificate of Competency</div>
                    <div class="col-8">: <a href="{{ asset('/userdata/coc/' . $data->certificate_of_competency) }}" target="_blank">{{ $data->certificate_of_competency }}</a></div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Certificate of Proficiency</div>
                    <div class="col-8">: <a href="{{ asset('/userdata/cop/' . $data->certificate_of_proficiency) }}" target="_blank">{{ $data->certificate_of_proficiency }}</a></div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Seaferer Medical Certificate</div>
                    <div class="col-8">: <a href="{{ asset('/userdata/smc/' . $data->seaferer_medical_certificate) }}" target="_blank">{{ $data->seaferer_medical_certificate }}</a></div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Additional Documents</div>
                    <div class="col-8">: <a href="{{ asset('/userdata/additional_document/' . $data->additional_documents) }}" target="_blank">{{ $data->additional_documents }}</a></div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 fw-bold">Seaman's Book</div>
                    <div class="col-8">: <a href="{{ asset('/userdata/seamans_book/' . $data->seamans_book) }}" target="_blank">{{ $data->seamans_book }}</a></div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>