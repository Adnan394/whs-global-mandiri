@extends('layout.crewing')

@section('content')
<main id="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-5">
                        <h5 class="card-title">Edit Assignment</h5>
                        <form action="{{ route('signonoff.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">Crew</label>             
                                    <select name="crew_id" id="crewSelect" class="form-select" required>
                                        <option value=""> -- Select Crew -- </option>
                                        @foreach ($crews as $item)
                                            @if($item->id == $data->crew_id)
                                                <option value="{{ $item->id }}" data-rank="{{ $item->rank_id }}" selected>
                                                    {{ $item->fullname }}
                                                </option>
                                            @endif
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
                                        <option value="{{ $data->name }}">{{ $data->name }}</option>

                                        <option value="Sign On">Sign On</option>
                                        <option value="Promot Rank">Promot Rank</option>
                                    </select>
                                </div>

                                <div class="w-100 m-0">
                                    <label class="form-label">Rank</label>
                                    <select name="rank_id" id="rankSelect" class="form-select" required>
                                        <option value="">-- Select Rank --</option>
                                        @foreach ($ranks as $item)
                                            @if($item->id === $data->rank_id)
                                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @endif
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">File</label>
                                    <input type="file" class="form-control" name="file" >
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

                            <button type="submit" class="btn btn-primary mt-4 w-100 py-2 m-0">Edit Assignment</button>
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

    function updateRank() {
        const selectedOption = crewSelect.options[crewSelect.selectedIndex];
        const rankId = selectedOption.getAttribute('data-rank');

        rankSelect.value = rankId ? rankId : '';
    }

    // jalan saat change
    crewSelect.addEventListener('change', updateRank);

    // 🔥 langsung jalan saat pertama kali halaman load
    updateRank();
});
</script>

