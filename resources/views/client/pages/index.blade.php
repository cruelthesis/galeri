@extends('home')
@section('userContent')
    <div class="content-header">
        <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Timeline</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


  <div class="content">
    <div class="container">
      <div class="row">


        <div class="col-md-3">

          @if (Auth::user()->fotoprofil)
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img width="200" height="100" class="profile-user-img  img-circle img-circle"
                     src="{{ asset('img/'.Auth::user()->fotoprofil) }}"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{ Auth::user()->nama }}</h3>

              <p class="text-muted text-center">{{ Auth::user()->username }} <br>{{ Auth::user()->email }}</p>

            </div>
            <!-- /.card-body -->
          </div>
          @endif

          @if (!Auth::user()->fotoprofil)
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="{{ asset('img/profil.jpg') }}"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{ Auth::user()->nama }}</h3>

              <p class="text-muted text-center">{{ Auth::user()->username }} <br>{{ Auth::user()->email }}</p>

            </div>
            <!-- /.card-body -->
          </div>
          @endif

          <!-- Profile Image -->
          
          <!-- /.card -->

        
        </div>
        <!-- /.col -->

    
        
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Aktivitas</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit Profil</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <!-- Post -->

                    <div class="mb-3 px-2 post">
                        <a href="" data-toggle="modal" data-target="#modal-upload" class="btn btn-block btn-outline-secondary text-left">Upload Sesuatu...</a>
                    </div>

                  @foreach ($galeri as $g)
                  
                  <div class="post">
                    <div class="user-block">
                      @if (Auth::user()->fotoprofil)
                      <img class="img-circle img-bordered-sm" src="{{ asset('img/'.Auth::user()->fotoprofil) }}" alt="user image">
                      @endif
                      @if (!Auth::user()->fotoprofil)
                      <img class="img-circle img-bordered-sm" src="{{ asset('img/profil.jpg') }}" alt="user image">
                      @endif
                      <span class="username">
                        <a href="#">{{ Auth::user()->nama }}</a>
                        <a href="#" data-toggle="dropdown" class="float-right btn-tool"><i class="fas fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                          <a href="" data-toggle="modal" data-target="#modal-update{{ $g->id }}" class="dropdown-item">
                            <i class="fas fa-edit mr-2"></i> Edit
                          </a>
                          <div class="dropdown-divider"></div>
                          <a href="" data-toggle="modal" data-target="#modal-hapus{{ $g->id }}" class="dropdown-item">
                            <i class="fas fa-trash mr-2"></i> Hapus
                          </a>
                        </div>
                      </span>
                      <span class="description">{{ $g->created_at->diffForHumans() }}</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="row">
                      <div class="col-sm-4">

                      </div>
                      <div class="col-sm-4 py-2">
                        <a href="" data-toggle="modal" data-target="#modal-preview{{ $g->id }}">
                          <img src="{{ asset('img/'.$g->foto) }}" alt="" class="img-fluid">
                        </a>
                      </div>
                      <div class="col-sm-4">
                        
                      </div>
                    </div>
                    <h6>{{ $g->judul }}</h6>
                    <p>
                      {{ $g->deskripsi }}
                    </p>

                    <p>
                      <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                      <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                      <span class="float-right">
                        <a href="{{ asset('img/'.$g->foto) }}" class="link-black text-sm" download="">
                          <i class="far fa-file mr-1"></i> Download Foto
                        
                        </a>
                      </span>
                    </p>

                    <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                  </div>
                    


                  {{-- hapus modal --}}
                    <div class="modal fade" id="modal-hapus{{ $g->id }}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Hapus</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Yakin ingin hapus?</p>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <a href="{{ route('galeri.show',$g->id) }}" class="btn btn-danger">Ya</a>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                  {{-- hapus modal --}}

                  {{-- update modal --}}
                    <div class="modal fade" id="modal-update{{ $g->id }}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Update</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('galeri.update',$g->id) }}" enctype="multipart/form-data" method="post">
                              @csrf
                              @method('PUT')
                              <div class="form-group">
                                <label for="">Judul</label>
                                <input type="text" name="judul" class="form-control" id="" value="{{ $g->judul }}">
                              </div>
                              <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="3">{{ $g->deskripsi }}</textarea>
                              </div>
                              <div class="form-group">
                                <label for="">Foto</label>
                                <input type="file" class="form-control" name="foto" id="">
                                <div class="col-sm-2 mt-3 mb-3">
                                  <img src="{{ asset('img/'.$g->foto) }}" class="img-fluid" alt="">
                                </div>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                              </div>
                            </form>
                          </div>
                          
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                  {{-- update modal --}}


                  {{-- preview --}}
                    <div class="modal fade" id="modal-preview{{ $g->id }}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Preview</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <img src="{{ asset('img/'.$g->foto) }}" class="img-fluid" alt="">
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                          <a href="{{ asset('img/'.$g->foto) }}" class="btn btn-primary" download="">Download</a>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                    </div>
                  {{-- preview --}}





                  @endforeach
                  <!-- /.post -->

                  
                </div>
                <!-- /.tab-pane -->
                
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                  <form action="{{ asset('updateuser/'.Auth::user()->id) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" value="{{ Auth::user()->nama }}" id="inputName">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}"   id="inputName">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}"  id="inputName">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="inputName" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Foto Profil</label>
                      <div class="col-sm-10">
                        <input type="file" class="form-control" name="foto" id="inputName">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection