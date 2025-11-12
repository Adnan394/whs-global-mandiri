@extends('layout.crewing')

@section('content')
    <main id="main">
        <div class="container">
            <section class="section">
                <div class="row">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Lowongan Kerja</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                    </nav>
                    <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h5 class="card-title">Data Lowongan Kerja</h5>
                                <a href="{{ route('lowongan.create') }}" class="btn btn-primary px-5 py-2 mb-3 me-2"><i class="bi bi-plus"></i> Tambah</a>
                            </div>
                        <!-- Table with stripped rows -->
                        <table class="table datatable table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">Tipe</th>
                                <th scope="col">Gaji</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><a href="{{ env('APP_URL') . '/images/lowongan_kerja/' . $item->image }}" target="_blank"><img src="{{ asset('images/lowongan_kerja/' . $item->image) }}" alt="" width="80px"></a></td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->rank->name }}</td>
                                        <td>{{ $item->employment_type->name }}</td>
                                        <td>{{ $item->sallary }}</td>
                                        <td>
                                            <a href="{{ route('lowongan_kerja.slug', $item->slug) }}" target="_blank" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('lowongan.edit', $item->id) }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                            <form action="{{ route('lowongan.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                        </div>
                    </div>

                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection