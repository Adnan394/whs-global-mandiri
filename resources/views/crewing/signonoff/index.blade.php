@extends('layout.crewing')

@section('content')
    <main id="main">
        <div class="container">
            <section class="section">
                <div class="row">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Sign On / Off</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                    </nav>
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <h5 class="card-title">Data Assignment</h5>
                                    <div class="d-flex gap-2 align-items-center">
                                        {{-- <select wire:model.live="status" class="form-select mb-3" style="width:200px;">
                                            <option value="">-- All Status --</option>
                                            <option value="0">Standby</option>
                                            <option value="1">Docking</option>
                                            <option value="2">Operation</option>
                                        </select> --}}
                                        {{-- <a href="{{ route('export.ship', ['status' => $status]) }}" class="btn btn-success px-3 py-2 mb-3 me-0"><i class="bi bi-plus"></i> Export </a> --}}
                                        <a href="{{ route('signonoff.create') }}" class="btn btn-primary px-5 py-2 mb-3 me-2"><i class="bi bi-plus"></i> Add</a>
                                    </div>
                                </div>
                                <!-- Table with stripped rows -->
                                <table class="table datatable table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Crew</th>
                                        <th scope="col">File</th>
                                        <th scope="col">Rank</th>
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
                                            <td>{{ $item->file }}</td>
                                            <td>{{ \App\Models\rank::where('id', $item->rank_id)->first()->name }}</td>
                                            @switch($item->status)
                                                @case($item->name == 'Sign On')
                                                    <td><a href="{{asset('userdata/signon/' . $item->file_ttd)}}">{{$item->file_ttd ?? 'Empty'}}</a></a></td>
                                                    @break
                                        
                                                @case($item->name == 'Sign Off')
                                                    <td><a href="{{asset('userdata/signoff/' . $item->file_ttd)}}">{{$item->file_ttd ?? 'Empty'}}</a></a></td>
                                                    @break
                                        
                                                @case($item->name == 'Promotion')
                                                    <td><a href="{{asset('userdata/promotion/' . $item->file_ttd)}}">{{$item->file_ttd ?? 'Empty'}}</a></a></td>
                                                    @break
                                        
                                                @case($item->name == 'Leave')
                                                    <td><a href="{{asset('userdata/leave/' . $item->file_ttd)}}">{{$item->file_ttd ?? 'Empty'}}</a></a></td>
                                                    @break
                                        
                                                @case($item->name == 'Change Ship')
                                                    <td><a href="{{asset('userdata/change_ship/' . $item->file_ttd)}}">{{$item->file_ttd ?? 'Empty'}}</a></a></td>
                                                    @break
                                        
                                                @default
                                                'Empty'
                                            @endswitch
                                            
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
                                                <a href="{{ route('signonoff.edit', $item->id) }}" class="btn btn-warning mb-2"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ route('signonoff.destroy', $item->id) }}" method="POST">
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