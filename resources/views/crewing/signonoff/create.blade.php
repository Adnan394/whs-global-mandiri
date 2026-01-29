@extends('layout.crewing')

@section('content')
<main id="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-5">
                        <h5 class="card-title">Add Assignment</h5>

                        <form action="{{ route('signonoff.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">Crew</label>             
                                    <select name="crew_id" id="crewSelect" class="form-select" required>
                                        <option value=""> -- Select Crew -- </option>
                                        @foreach ($crews as $item)
                                            <option value="{{ $item->id }}" data-rank="{{ $item->rank_id }}">
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
                                        <option value="Sign On">Sign On</option>
                                        <option value="Sign Off">Sign Off</option>
                                        <option value="Promotion">Promotion</option>
                                        <option value="Leave">Leave</option>
                                        <option value="Change Ship">Change Ship</option>
                                    </select>
                                </div>

                                <div class="w-100 m-0">
                                    <label class="form-label">Rank</label>
                                    <select name="rank_id" id="rankSelect" class="form-select" required>
                                        <option value="">-- Select Rank --</option>
                                        @foreach ($ranks as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">File</label>
                                    <input type="file" class="form-control" name="file">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 w-100 py-2 m-0">Add Assignment</button>
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
    const rankSelect = document.getElementById('rankSelect');

    crewSelect.addEventListener('change', function() {
        const selectedOption = crewSelect.options[crewSelect.selectedIndex];
        const rankId = selectedOption.getAttribute('data-rank');

        if (rankId) {
            // otomatis pilih rank yang sesuai
            rankSelect.value = rankId;
        } else {
            rankSelect.value = '';
        }
    });
});
</script>
