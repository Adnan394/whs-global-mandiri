@extends('layout.crewing')

@section('content')
    <main id="main">
        <div class="container">
            <section class="section">
                <div class="row">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Crew Rotation</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                    </nav>
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <h5 class="card-title">Data Crew Rotation</h5>
                                    <div class="d-flex gap-2 align-items-center">
                                        <a href="{{ route('crew_rotation.create') }}" class="btn btn-primary px-5 py-2 mb-3 me-2"><i class="bi bi-plus"></i> Add</a>
                                    </div>
                                </div>
                                <!-- Table with stripped rows -->
                                <table class="table datatable table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Crew</th>
                                        <th scope="col">Ship</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">File TTD</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ \App\Models\crew::where('id', $item->crew_id)->first()->fullname }}</td>
                                            <td>{{ \App\Models\Ship::where('id', $item->ship_id)->first()->name }}</td>
                                            <td>{{ $item->start_date }}</td>
                                            <td>{{ $item->end_date }}</td>
                                            <td>
                                                <a href="{{ asset('userdata/crew_rotation/'.$item->file_ttd) }}" target="_blank" class="">{{ $item->file_ttd ?? 'Empty' }}</a>
                                            </td>
                                            <td>
                                                @switch($item->status)
                                                    @case(0)
                                                        <span class="badge text-bg-secondary">Need Sign</span>
                                                        @break
                                            
                                                    @case(1)
                                                        <span class="badge text-bg-warning">Need Review</span>
                                                        @break
                                            
                                                    @case(2)
                                                        <span class="badge text-bg-success">Accepted</span>
                                                        @break
                                            
                                                    @default
                                                        <span class="badge text-bg-danger">Decline</span>
                                                @endswitch
                                            </td>
                                            <td class="">
                                                <a href="{{ route('crew_rotation.edit', $item->id) }}" class="btn btn-warning mb-2"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ route('crew_rotation.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection