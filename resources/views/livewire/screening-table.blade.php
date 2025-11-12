<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center pt-3 ">
            <h5 class="card-title">Data Lamaran</h5>
            <div class="d-flex align-items-center gap-2">
                <div class="">
                    <input type="month" wire:model.live="month" class="form-control" name="month" id="">
                </div>
                <div class="">
                    <a href="{{ route('export.screening', ['month' => $month]) }}" class="btn btn-success px-4 py-2 d-inline-block">
                        Export Excel
                    </a>
                </div>
            </div>
        </div>
        <!-- Table with stripped rows -->
        <table class="table datatable table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Lowongan Kerja</th>
                <th scope="col">Pertanyaan</th>
                <th scope="col">Status</th>
                <th scope="col">Interview</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ \App\Models\LowonganKerja::where('id', $item->lowongan_kerja_id)->first()->title }}</td>
                        <td>
                            @php
                                $userPertanyaan = \App\Models\UserPertanyaan::where('user_id', $item->user_id)->get()   
                            @endphp

                            @foreach ($userPertanyaan as $pertanyaan)
                                <p class="mb-0">{{ $loop->iteration }}. {{ \App\Models\Pertanyaan::where('id', $pertanyaan->pertanyaan_id)->first()->pertanyaan }}</p>
                                <a class="mb-2 ms-3 text-primary" data-bs-toggle="collapse" href="#collapseExample{{ $pertanyaan->id }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $pertanyaan->id }}">Jawaban</a>
                                <div class="collapse" id="collapseExample{{ $pertanyaan->id }}">
                                    <div class="card p-2 ms-4">
                                        <small class="">{{ $pertanyaan->jawaban }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            @if ($item->status == 0)
                                <span class="badge text-bg-secondary">Process</span>
                            @elseif($item->status == 2)
                                <span class="badge text-bg-primary">Interview</span>
                            @elseif($item->status == 3)
                                <span class="badge text-bg-success">Accepted</span>
                            @elseif($item->status == 4)
                                <span class="badge text-bg-danger">Decline</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $jadwal = \App\Models\UserInterview::where('user_lamaran_id', $item->id)->limit(1)->orderBy('created_at', 'DESC')->first();
                            @endphp

                            @if ($jadwal)
                                {{ \Carbon\Carbon::parse($jadwal->date)->locale('id')->isoFormat('dddd, D MMMM Y') }} : {{ $jadwal->time }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#UbahStatus{{ $item->id }}"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pesan{{ $item->id }}"><i class="bi bi-envelope"></i></button>
                        </td>
                    </tr>

                                                        
                    <!-- Modal ubah status-->
                    <div class="modal fade" id="UbahStatus{{ $item->id }}" tabindex="-1" aria-labelledby="UbahStatusLabel" aria-hidden="true">
                        <form action="{{ route('lamaran.update_status', $item->id) }}" method="POST">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="UbahStatusLabel">Change Status</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <p>Name : {{ \App\Models\User::where('id', $item->user_id)->first()->name }}</p>
                                            <p>Jobs : {{ \App\Models\LowonganKerja::where('id', $item->lowongan_kerja_id)->first()->title }}</p>

                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status :</label>
                                                <select name="status" id="status{{ $item->id }}" class="form-select status-select" data-id="{{ $item->id }}">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="0">Process</option>
                                                    <option value="2">Interview</option>
                                                    <option value="3">Accepted</option>
                                                    <option value="4">Decline</option>
                                                </select>
                                            </div>

                                            {{-- Pesan --}}
                                            <div class="mb-3 d-none" id="pesanWrap{{ $item->id }}">
                                                <label class="form-label">Pesan</label>
                                                <textarea name="pesan" class="form-control" rows="5" placeholder="type somethings..."></textarea>
                                            </div>

                                            {{-- Tanggal dan Jam Interview --}}
                                            <div class="row d-none" id="interviewWrap{{ $item->id }}">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Date</label>
                                                    <input type="date" name="date_interview" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Time</label>
                                                    <input type="time" name="time_interview" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Change</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                                                        
                    <!-- Modal pesan-->
                    <div class="modal fade" id="pesan{{ $item->id }}" tabindex="-2" aria-labelledby="pesanLabel" aria-hidden="true">
                        <form action="{{ route('kirim_pesan') }}" method="POST">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header align-items-start">
                                        {{-- <h1 class="modal-title fs-5 fw-bold" id="pesanLabel">Pesan</h1> --}}
                                        <div class="row">
                                            <p class="mb-2">Nama : {{ \App\Models\User::where('id', $item->user_id)->first()->name }}</p>
                                            <p>Lowongan Kerja : {{ \App\Models\LowonganKerja::where('id', $item->lowongan_kerja_id)->first()->title }}</p>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" 
                                        style="height: 450px; background: #eaeaea; overflow-y: auto;" 
                                        id="chatContainer">
                                        <div class="row px-3">
                                            @php
                                                $chats = \App\Models\Chat::where('user_lamaran_id', $item->id)->get();   
                                            @endphp

                                            @foreach ($chats as $chat)
                                                @if($chat->user_id == Auth::user()->id)
                                                    <div class="p-3 mb-3 bg-primary text-white w-75 d-block ms-auto" 
                                                        style="border-radius: 20px 0 20px 20px">
                                                        <small class="mb-2">{{ $chat->message }}</small><br>
                                                        <small style="font-size: 12px" 
                                                            class="text-white mt-3 d-flex justify-content-end">
                                                            {{ $chat->created_at }}
                                                        </small>
                                                    </div>
                                                @else
                                                    <div class="p-3 mb-3 bg-white w-75" 
                                                        style="border-radius: 0 20px 20px 20px">
                                                        <small class="mb-2">{{ $chat->message }}</small><br>
                                                        <small style="font-size: 12px" 
                                                            class="text-muted mt-3">
                                                            {{ $chat->created_at }}
                                                        </small>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 p-3">
                                        <input type="hidden" name="user_lamaran_id" value="{{ $item->id }}">
                                        <input type="text" name="message" class="form-control" placeholder="Kirim Pesan">
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </tbody>
        </table>
        <!-- End Table with stripped rows -->
    </div>
</div>