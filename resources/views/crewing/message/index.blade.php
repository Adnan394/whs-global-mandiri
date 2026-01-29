@extends('layout.crewing')

@section('content')
<main id="main" style="height: 100vh; overflow: hidden;">
    <div class="container-fluid py-3" style="height: 100%;">
        <section class="section" style="height: 100%;">
            <div class="row h-100 card">
                <div class="col-12" style="height: calc(100vh - 250px);">
                    {{-- Layout utama seperti WhatsApp --}}
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <h4>Message</h4>
                        <div>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#broadcastModal">
                                <i class="bi bi-megaphone"></i> Broadcast Message
                            </button>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tulisPesanModal">
                                <i class="bi bi-pencil-square"></i> Write Message
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex m-0 p-0" style="height: 100%;">
                        {{-- LIST PESAN (KIRI) --}}
                        <div class="col-4 border-end px-3 bg-light d-flex flex-column" style="height: 100%;">
                            {{-- <input type="text" placeholder="Find user..." class="form-control my-3"> --}}
                            <div class="flex-grow-1 mt-3" style="overflow-y: auto;">
                                @foreach ($data as $item)
                                    @php
                                        $crew = \App\Models\crew::find($item->crew_id);
                                        $lastMessage = \App\Models\Message::where('crew_id', $item->crew_id)
                                            ->where('crewing_id', $item->crewing_id)
                                            ->orderBy('created_at', 'desc')
                                            ->first();
                                        $chatData = \App\Models\Message::where('crew_id', $item->crew_id)
                                            ->where('crewing_id', $item->crewing_id)
                                            ->orderBy('created_at', 'asc')
                                            ->get();
                                        
                                        foreach($chatData as &$chat) {
                                            $chat['crew_name'] = \App\Models\crew::where('id', $chat->crew_id)->first()->fullname;
                                            $chat['crewing_name'] = \App\Models\crewing::where('id', $chat->crewing_id)->first()->fullname;
                                        }

                                        unset($chat);
                                    @endphp
                                    <ul class="list-unstyled mb-1 bg-white p-3 rounded-3 border border-1" style="cursor: pointer">
                                        <li class="list-group-item list-group-item-action pointer"
                                            onclick='openChat(@json($chatData), {{ Auth::user()->id }})'>
                                            <strong>{{ $crew->fullname }}</strong><br>
                                            <small>{{ $lastMessage->message ?? '' }}</small>
                                        </li>
                                    </ul>
                                @endforeach
                            </div>
                        </div>

                        {{-- ISI PESAN (KANAN) --}}
                        <div class="col-8 p-0 d-flex flex-column" style="height: 100%;">
                            <div id="chat-header" class="p-3 border-bottom bg-white d-flex justify-content-between align-items-center">
                                <div>
                                    <strong id="chat-name">Select Conversation</strong>
                                    <br>
                                    <small id="chat-status">Online</small>
                                </div>
                            </div>

                            <div id="chat-body" class="flex-grow-1 p-3" style="overflow-y: auto; background-color: #f7f7f7;">
                                <div class="text-center text-muted mt-5">
                                    <em>nothing selected conversation</em>
                                </div>
                            </div>

                            <div id="chat-footer" class="p-3 border-top bg-white">
                                <form action="{{ route('message.store') }}" method="POST" id="messageForm">
                                    @csrf
                                    <input type="hidden" name="crew_id" id="message_crew_id" value="">
                                    <div class="d-flex">
                                        <input type="text" id="messageInput" name="message" class="form-control me-2" placeholder="type message..." disabled>
                                        <button class="btn btn-primary px-4" type="submit" disabled id="sendBtn">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</main>

{{-- Modal Broadcast --}}
<div class="modal fade" id="broadcastModal" tabindex="-1" aria-labelledby="broadcastModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Broadcast Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('message.broadcast') }}" method="POST">
            @csrf
            <div id="broadcast-step-1">
                <h6>Select User</h6>
                
                <input type="text" onInput="searchUser(event)" class="form-control mb-2" placeholder="Search user...">
                
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="selectAll()">Select All</button>
                </div>
                <div style="max-height: 300px; overflow-y: auto;">
                    <ul class="list-group" id="userList">
                        @foreach ($crews as $crew)
                            <li class="list-group-item">
                                <input type="checkbox" class="form-check-input me-2" name="crew_id[]" value="{{ $crew->id }}"> {{ $crew->fullname }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn btn-primary mt-3 float-end" onclick="nextToMessage()">Selanjutnya</button>
            </div>

            <div id="broadcast-step-2" style="display: none;">
                <h6>Write Broadcast Message</h6>
                <textarea class="form-control" rows="4" name="message" placeholder="write message here..." id="broadcastMessage"></textarea>
                <div class="mt-3 text-end">
                    <button type="button" class="btn btn-secondary me-2" onclick="backToUser()">Back</button>
                    <button class="btn btn-success" type="submit">Send Broadcast</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Modal Tulis Pesan --}}
<div class="modal fade" id="tulisPesanModal" tabindex="-1" aria-labelledby="tulisPesanModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('message.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="">Select Crew</label>
                <select name="crew_id" class="form-select">
                    <option value="">Select Crew</option>
                    @foreach ($crews as $crew)
                        <option value="{{ $crew->id }}">{{ $crew->fullname }}</option>
                    @endforeach
                </select>
            </div>
            <textarea class="form-control mt-3" name="message" rows="4" placeholder="write message..." id="singleMessage"></textarea>
            <div class="text-end mt-3">
                <button class="btn btn-primary" type="submit" id="sendSingleMessage">Send Message</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

<script>
function openChat(data, user_id) {
    if (!data || data.length === 0) {
        document.getElementById('chat-body').innerHTML = `
            <div class="text-center text-muted mt-5"><em>nothing selected conversation</em></div>
        `;
        return;
    }

    document.getElementById('chat-name').innerText = data[0].crew_name ?? 'Tanpa Nama';
    document.getElementById('message_crew_id').value = data[0].crew_id;
    document.getElementById('chat-body').innerHTML = '';

    data.forEach(item => {
        const date = new Date(item.created_at);
        const formattedDate = date.toLocaleDateString('id-ID', {
            day: '2-digit', month: 'short', year: 'numeric'
        }).replace('.', '') + ', ' + 
        date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', hour12: false });

        const isMe = item.user_id == user_id;
        document.getElementById('chat-body').innerHTML += `
            <div class="p-2 mb-2 ${isMe ? 'bg-primary text-white ms-auto' : 'bg-white text-dark me-auto'} d-block"
                style="max-width: 50%; border-radius: ${isMe ? '10px 0 10px 10px' : '0 10px 10px 10px'};">
                ${item.message}
                <p class="${isMe ? 'text-end' : 'text-start'} mt-2 mb-0" style="font-size: 10px;">${formattedDate}</p>
            </div>
        `;
    });

    document.getElementById('messageInput').disabled = false;
    document.getElementById('sendBtn').disabled = false;

    // auto scroll ke bawah
    const chatBody = document.getElementById('chat-body');
    chatBody.scrollTop = chatBody.scrollHeight;
}

// broadcast step navigation
function nextToMessage() {
    document.getElementById('broadcast-step-1').style.display = 'none';
    document.getElementById('broadcast-step-2').style.display = 'block';
}
function backToUser() {
    document.getElementById('broadcast-step-2').style.display = 'none';
    document.getElementById('broadcast-step-1').style.display = 'block';
}

// select all checkbox
function selectAll() {
    document.querySelectorAll('#userList input[type=checkbox]').forEach(cb => cb.checked = true);
}


function searchUser(e) {
    let keyword = e.target.value.toLowerCase();
    let list = document.querySelectorAll('#userList li');

    list.forEach(function (item) {
        let text = (item.textContent || "").toLowerCase();
        item.style.display = text.includes(keyword) ? '' : 'none';
    });
}

</script>
