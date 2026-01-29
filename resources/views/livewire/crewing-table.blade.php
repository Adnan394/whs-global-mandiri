    <div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h5 class="card-title">Data Crew</h5>

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

                <a href="{{ route('export.crewing',  ['rank_id' => $rank_id, 'status' => $status]) }}" class="btn btn-success px-4 py-2">
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
                        <td class="d-flex gap-2">
                            <a href="{{ route('data_crew.detail', $item->user_id) }}" class="btn btn-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('data_crew.download', $item->user_id) }}" target="_blank" class="btn btn-success">
                                <i class="bi bi-box-arrow-in-down"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
