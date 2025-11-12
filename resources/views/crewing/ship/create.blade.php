@extends('layout.crewing')

@section('content')
<main id="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-5">
                        <h5 class="card-title">Tambah Kapal</h5>
                        <form action="{{ route('ship.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                                <div class="w-100 m-0">
                                    <label class="form-label">Kapasitas</label>
                                    <input type="text" class="form-control" name="kapasitas" required>
                                </div>
                            </div>
                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">Tipe</label>
                                    <select name="tipe" id="" class="form-select" required>
                                        <option value=""> -- Pilih Tipe -- </option>
                                        <option value="A"> A </option>
                                        <option value="B"> B </option>
                                    </select>
                                </div>
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">Bendera</label>
                                    <input type="text" name="bendera" id="bendera" class="form-control">
                                </div>
                            </div>
                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">Status</label>
                                    <select name="status" id="" class="form-select" required>
                                        <option value=""> -- Pilih Status -- </option>
                                        <option value="0"> Standby </option>
                                        <option value="1"> Docking </option>
                                        <option value="2"> Beroperasi </option>
                                    </select>
                                </div>
                                <div class="w-100 m-0">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 w-100 py-2 m-0">Tambah Kapal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
