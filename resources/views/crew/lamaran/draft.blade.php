@extends('layout.app')

@section('content')
    <main id="main" style="margin-top: 150px" class="mb-5">
        <div class="container">
            <div class="d-flex justify-content-center">
                <h2 class="text-center mb-5 title-underline">Upload Draft</h2>
            </div>

            <div class="row mb-3">
                <h4 class="mb-3">File Assignments</h4>
                <div class="d-flex gap-3">
                    @foreach($assignment as $assign)
                        <card class="p-3 border border-2 rounded-3" style="width: 20rem">
                            @if($assign->status == 0) 
                                <span class="badge text-bg-secondary">Need Sign</span>
                            @elseif($assign->status == 1)
                                <span class="badge text-bg-warning">Need Review</span>
                            @elseif($assign->status == 2)
                                <span class="badge text-bg-success">Accepted</span>
                            @elseif($assign->status == 3)
                                <span class="badge text-bg-danger">Decline</span>
                            @endif
                            <p class="mb-1 mt-3 fw-bold">{{$assign->name}}</p>
                            <p>{{\App\Models\rank::where('id', $assign->rank_id)->first()->name}}</p>
                            <a href="{{asset('/userdata/signon/' . $assign->file)}}" target="_blank">Download Template</a> <br>
                            <button type="button" class="btn btn-primary w-100 mt-3" data-bs-toggle="modal" data-bs-target="#assignModal">
                              Upload File <i class="bi bi-upload ms-2"></i>
                            </button>
                        </card>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <form action="{{route('lamaran_saya.upload_assign', $assign->id)}}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload File Assignment</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <label class="form-label">Upload File</label>
                                          <input type="file" class="form-control" name="file">
                                          <input type="hidden" name="name" value="{{$assign->name}}">
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                      </div>
                                    </div>
                              </form>
                          </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="row mb-3">
                <h4 class="mb-3">File Crew Lists</h4>
                <div class="d-flex gap-3">
                    @foreach($crew_list as $list)
                        <card class="p-3 border border-2 rounded-3" style="width: 20rem">
                            @if($list->status == 0) 
                                <span class="badge text-bg-secondary">Need Sign</span>
                            @elseif($list->status == 1)
                                <span class="badge text-bg-warning">Need Review</span>
                            @elseif($list->status == 2)
                                <span class="badge text-bg-success">Accepted</span>
                            @elseif($list->status == 3)
                                <span class="badge text-bg-danger">Decline</span>
                            @endif
                            <p class="mb-1 mt-3 fw-bold">{{\App\Models\Ship::where('id', $list->ship_id)->first()->name}}</p>
                            <a href="{{asset('/userdata/crew_list/' . $list->file)}}" target="_blank">Download Template</a> <br>
                            <button type="button" class="btn btn-primary w-100 mt-3" data-bs-toggle="modal" data-bs-target="#crewListModal">
                              Upload File <i class="bi bi-upload ms-2"></i>
                            </button>
                        </card>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="crewListModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <form action="{{route('lamaran_saya.upload_crew_list', $list->id)}}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload File Crew List</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <label class="form-label">Upload File</label>
                                          <input type="file" class="form-control" name="file">
                                          <input type="hidden" name="name" value="{{$list->name}}">
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                      </div>
                                    </div>
                              </form>
                          </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="row mb-3">
                <h4 class="mb-3">File Crew Rotations</h4>
                <div class="d-flex gap-3">
                    @foreach($crew_rotation as $list)
                        <card class="p-3 border border-2 rounded-3" style="width: 20rem">
                            @if($list->status == 0) 
                                <span class="badge text-bg-secondary">Need Sign</span>
                            @elseif($list->status == 1)
                                <span class="badge text-bg-warning">Need Review</span>
                            @elseif($list->status == 2)
                                <span class="badge text-bg-success">Accepted</span>
                            @elseif($list->status == 3)
                                <span class="badge text-bg-danger">Decline</span>
                            @endif
                            <p class="mb-3 mt-3">{{$list->name}}</p>
                            <p class="mb-1">{{\App\Models\Ship::where('id', $list->ship_id)->first()->name}}</p>
                            <a href="{{asset('/userdata/user_rotation/' . $list->file)}}" target="_blank">Download Template</a> <br>
                            <button type="button" class="btn btn-primary w-100 mt-3" data-bs-toggle="modal" data-bs-target="#crewRotationModal">
                              Upload File <i class="bi bi-upload ms-2"></i>
                            </button>
                        </card>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="crewRotationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <form action="{{route('lamaran_saya.crew_rotation', $list->id)}}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload File Crew Rotation</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <label class="form-label">Upload File</label>
                                          <input type="file" class="form-control" name="file">
                                          <input type="hidden" name="name" value="{{$list->name}}">
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                      </div>
                                    </div>
                              </form>
                          </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection