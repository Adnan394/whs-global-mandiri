@extends('layout.crewing')

@section('content')
<main id="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-5">
                        <h5 class="card-title">Add Crew Rotation</h5>

                        <form action="{{ route('crew_rotation.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">Crew</label>             
                                    <select name="crew_id" id="crewSelect" class="form-select" required>
                                        <option value=""> -- Select Crew -- </option>
                                        @foreach ($crews as $item)
                                            <option value="{{ $item->id }}" data-ship="{{ $item->ship_id }}">
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
                                        <option value="">-- Select Title -- </option>
                                        <option value="Initial Contract">Initial Contract</option>
                                        <option value="Extended Contract">Extended Contract</option>
                                    </select>
                                </div>

                                <div class="w-100 m-0">
                                    <label class="form-label">Ship</label>
                                    <select name="ship_id" id="shipSelect" class="form-select" required>
                                        <option value="">-- Select Ship --</option>
                                        @foreach ($ships as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="start_date" required class="form-control">
                                </div>
                                <div class="w-100 m-0">
                                    <label class="form-label">End Date</label>
                                    <input type="date" name="end_date" required class="form-control">
                                </div>
                            </div>

                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">File</label>
                                    <input type="file" class="form-control" name="file">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 w-100 py-2 m-0">Add Crew Rotation</button>
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
