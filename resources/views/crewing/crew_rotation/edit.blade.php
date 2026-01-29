@extends('layout.crewing')

@section('content')
<main id="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-5">
                        <h5 class="card-title">Edit Crew Rotation</h5>

                        <form action="{{ route('crew_rotation.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">Crew</label>             
                                    <select name="crew_id" id="crewSelect" class="form-select" required>
                                        <option value=""> -- Select Crew -- </option>
                                        @foreach ($crews as $item)
                                            @if($item->crew_id == $data->crew_id)
                                                <option value="{{ $item->crew_id }}" data-ship="{{ $item->ship_id }}" selected>
                                                    {{ $item->fullname }}
                                                </option>
                                            @endif
                                            <option value="{{ $item->crew_id }}" data-ship="{{ $item->ship_id }}">
                                                {{ $item->fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label class="form-label">Title</label>
                                    <select name="name" id="" class="form-select" required>
                                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        <option value="Initial Contract">Initial Contract</option>
                                        <option value="Extended Contract">Extended Contract</option>
                                    </select>
                                </div>

                                <div class="w-100 m-0">
                                    <label class="form-label">Ship</label>
                                    <select name="ship_id" id="shipSelect" class="form-select" required>
                                        @foreach ($ships as $item)
                                            @if($item->id == $data->ship_id)
                                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @endif
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="start_date" required class="form-control" value="{{ $data->start_date }}">
                                </div>
                                <div class="w-100 m-0">
                                    <label class="form-label">End Date</label>
                                    <input type="date" name="end_date" required class="form-control" value="{{ $data->end_date }}">
                                </div>
                            </div>

                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">File</label>
                                    <input type="file" class="form-control" name="file">
                                </div>
                            </div>
                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">Change Status</label>
                                    <select name="status" id="" class="form-select" required>
                                        <option value="">-- Select Status --</option>
                                        <option value="2">Accepted</option>
                                        <option value="3">Decline</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 w-100 py-2 m-0">Edit Crew Rotation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const crewSelect = document.getElementById('crewSelect');
    const shipSelect = document.getElementById('shipSelect');

    crewSelect.addEventListener('change', function() {
        const selectedOption = crewSelect.options[crewSelect.selectedIndex];
        const shipId = selectedOption.getAttribute('data-ship');

        if (shipId) {
            // otomatis pilih ship yang sesuai
            shipSelect.value = shipId;
        } else {
            shipSelect.value = '';
        }
    });
});
</script>
