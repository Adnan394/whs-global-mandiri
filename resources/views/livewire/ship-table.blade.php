<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h5 class="card-title">Data Ship</h5>
            <div class="d-flex gap-2 align-items-center">
                <select wire:model.live="status" class="form-select mb-3" style="width:200px;">
                    <option value="">-- Semua Status --</option>
                    <option value="0">Standby</option>
                    <option value="1">Docking</option>
                    <option value="2">Operation</option>
                </select>
                <a href="{{ route('export.ship', ['status' => $status]) }}" class="btn btn-success px-3 py-2 mb-3 me-0"><i class="bi bi-plus"></i> Export </a>
                <a href="{{ route('ship.create') }}" class="btn btn-primary px-5 py-2 mb-3 me-2"><i class="bi bi-plus"></i> Tambah</a>
            </div>
        </div>
        <!-- Table with stripped rows -->
        <table class="table datatable table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Tipe</th>
                <th scope="col">Bendera</th>
                <th scope="col">Kapasitas</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->flag }}</td>
                    <td>{{ $item->capacity }}</td>
                    <td>
                        @if ($item->status == 0)
                            <span class="badge bg-danger">Standby</span>
                        @elseif($item->status == 1)
                            <span class="badge bg-secondary">Docking</span>
                        @else
                            <span class="badge bg-success">Beroperasi</span>
                        @endif
                    </td>
                    <td class="">
                        <a href="{{ route('ship.edit', $item->id) }}" class="btn btn-warning mb-2"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('ship.destroy', $item->id) }}" method="POST">
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