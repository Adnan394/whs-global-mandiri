@extends('layout.crewing')

@section('content')
<main id="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-5">
                        <h5 class="card-title">Add Ship</h5>
                        <form action="{{ route('ship.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                                <div class="w-100 m-0">
                                    <label class="form-label">Capacity</label>
                                    <input type="text" class="form-control" name="kapasitas" required>
                                </div>
                            </div>
                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">Type</label>
                                    <select name="tipe" id="" class="form-select" required>
                                        <option value=""> -- Select Type -- </option>
                                        <option value="Tugboat"> Tugboat </option>
                                        <option value="SPB"> SPB </option>
                                        <option value="SPOB"> SPOB </option>
                                        <option value="Cargo"> Cargo </option>
                                        <option value="Utility Tug"> Utility Tug </option>
                                        <option value="Dredger"> Dredger </option>
                                        <option value="Harbour Tug"> Harbour Tug </option>
                                    </select>
                                </div>
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">Flag</label>
                                    <input type="text" name="bendera" id="bendera" class="form-control">
                                </div>
                            </div>
                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">Status</label>
                                    <select name="status" id="" class="form-select" required>
                                        <option value=""> -- Select Status -- </option>
                                        <option value="0"> Standby </option>
                                        <option value="1"> Docking </option>
                                        <option value="2"> Operate </option>
                                    </select>
                                </div>
                                <div class="w-100 m-0">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 w-100 py-2 m-0">Add Ship</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
