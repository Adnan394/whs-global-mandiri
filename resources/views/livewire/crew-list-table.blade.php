    <div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h5 class="card-title">Data Crew List</h5>

            <div class="d-flex align-items-center gap-2">
                <select wire:model.live="rank_id" class="form-select" style="width:200px;">
                    <option value="">-- All Rank --</option>
                    @foreach ($ranks as $rank)
                        <option value="{{ $rank->id }}">{{ $rank->name }}</option>
                    @endforeach
                </select>
                <select wire:model.live="status" class="form-select" style="width:200px;">
                    <option value="">-- All Status --</option>
                    <option value="Offboard">Offboard</option>
                    <option value="Onboard">Onboard</option>
                </select>

                <a href="{{ route('export.crew_list', ['status' => $status, 'rank_id' => $rank_id]) }}" class="btn btn-success px-4 py-2">
                    Export Excel
                </a>
                <a data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary px-5 py-2 me-2"><i class="bi bi-plus"></i> Add</a>
            </div>
        </div>

        <table class="table datatable table-striped mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fullname</th>
                    <th>Phone</th>
                    <th>Ship</th>
                    <th>Rank</th>
                    <th>File TTD</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->crew->fullname }}</td>
                        <td>{{ $item->crew->phone }}</td>
                        <td>{{ \App\Models\Ship::where('id', $item->ship_id)->first()->name }}</td>
                        <td>{{ \App\Models\rank::where('id', $item->crew->rank_id)->first()->name }}</td>
                        <td><a href="{{asset('userdata/crew_list/' . $item->file_ttd)}}">{{$item->file_ttd ?? 'Empty'}}</a></a></td>
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
                        <td>
                            <a target="_blank" class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('crew_list.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger d-block"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal edit-->
                    <div class="modal fade" id="edit{{ $item->id }}" tabindex="-2" aria-labelledby="pesanLabel" aria-hidden="true">
                        <form action="{{ route('crew_list.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="">Edit Crew List</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="">
                                                <div class="mb-3">
                                                    <label for="crew_id" class="form-label">Crew</label>
                                                    <select name="crew_id" id="crew_id" class="form-select">
                                                        <option value="{{ $item->crew_id }}">{{ \App\Models\crew::where('id', $item->crew_id)->first()->fullname }}</option>
                                                        @foreach ($crew as $item2)
                                                            <option value="{{ $item2->id }}">{{ $item2->fullname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="">
                                                <div class="mb-3">
                                                    <label for="ship_id" class="form-label">Ship</label>
                                                    <select name="ship_id" id="ship_id" class="form-select">
                                                        <option value="{{ $item->ship_id }}">{{ \App\Models\Ship::where('id', $item->ship_id)->first()->name }}</option>
                                                        @foreach ($ship as $item2)
                                                            <option value="{{ $item2->id }}">{{ $item2->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="">
                                                <div class="mb-3">
                                                    <label for="ship_id" class="form-label">File</label>
                                                    <input name="file" type="file" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="">
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Chage Status</label>
                                                    <select name="status" id="status" class="form-select">
                                                        <option value="2">Accepted</option>
                                                        <option value="3">Decline</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 p-3">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No data found.</td>
                    </tr>
                @endforelse

                <!-- Modal tambah-->
                <div class="modal fade" id="tambah" tabindex="-2" aria-labelledby="pesanLabel" aria-hidden="true">
                    <form action="{{ route('crew_list.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="">Add Crew List</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="">
                                            <div class="mb-3">
                                                <label for="crew_id" class="form-label">Crew</label>
                                                <select name="crew_id" class="form-select">
                                                    @foreach ($crew as $item)
                                                        <option value="{{ $item->crew_id }}">{{ $item->fullname }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="">
                                            <div class="mb-3">
                                                <label for="ship_id" class="form-label">Ship</label>
                                                <select name="ship_id" id="shipSelect" class="form-select">
                                                    @foreach ($ship as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="">
                                            <div class="mb-3">
                                                <label for="file" class="form-label">File</label>
                                                <input name="file" type="file" class="form-control" accept="pdf">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 p-3">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </tbody>
        </table>
    </div>