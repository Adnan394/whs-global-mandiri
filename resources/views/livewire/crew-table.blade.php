    <div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h5 class="card-title">Data My Crew</h5>

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

                <a href="{{ route('export.crew', ['rank_id' => $rank_id, 'status' => $status]) }}" class="btn btn-success px-4 py-2">
                    Export Excel
                </a>
            </div>
        </div>

        <table class="table datatable table-striped mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Fullname</th>
                    <th>Nickname</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Rank</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ config('app.url') . '/userdata/avatar/' . $item->user->image }}" target="_blank">
                                <img src="{{ asset('userdata/avatar/' . $item->user->image) }}" alt="" width="80px">
                            </a>
                        </td>
                        <td>{{ $item->fullname }}</td>
                        <td>{{ $item->nickname }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->standby_on }}</td>
                        <td>{{ $item->rank->name }}</td>
                        <td>
                            <a target="_blank" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#changeStatus{{ $item->id }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="{{ route('data_crew.detail', $item->user_id) }}" class="btn btn-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="changeStatus{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('changeStatus') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->user->id }}">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Status</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status? <small class="text-danger">*</small></label>
                                            <select name="status" id="status" class="form-select">
                                                <option value="{{ $crew->standby_on ?? '' }}" selected>{{ $crew->standby_on ?? '-- Select Standby --' }}</option>
                                                <option value="Offboard">Offboard</option>
                                                <option value="Onboard">Onboard</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="suubmit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
