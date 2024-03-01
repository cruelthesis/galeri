@extends('adminFront')
@section('admincontent')
    

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Declined Post</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
        
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Menu</h3>
        
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body p-0">
                      <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                          <a href="{{ url('approve') }}" class="nav-link">
                            <i class="fas fa-envelope-open"></i> Pending Post
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ url('decline') }}" class="nav-link">
                            <i class="fas fa-trash"></i> Declined Post
                          </a>
                        </li>
                        
                      </ul>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                  <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                  <div class="card card-primary card-outline" style="height: 400px;">
                    <div class="card-header">
                      <h3 class="card-title">Inbox</h3>
        
                      <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Username</th>
                                  <th>Judul</th>
                                  <th>Foto</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($data as $p)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $p->username }}</td>
                                    <td>
                                        <a href="" data-toggle="modal" data-target="#modal-preview{{ $p->id }}">
                                            {{ $p->judul }}
                                        </a>
                                    </td>
                                    <td>
                                        <img src="{{ asset('img/'.$p->foto) }}" height="80" alt="">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-xs">{{ $p->status }}</button>
                                    </td>
                                    <td>{{ $p->created_at->diffForHumans() }}</td>
                                    <td>
                                        <form action="{{ route('approve.update',$p->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" name="status" value="accept" class="btn btn-success"><i class="fas fa-check-circle"></i></button>
                                        </form>
                                    </td>
                                </tr>




                                {{-- MODAL POST PREVIEW --}}
                                <div class="modal fade" id="modal-preview{{ $p->id }}">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Preview Post</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="post">
                                                <div class="user-block">
                                                  @if ($p->fotoprofil)
                                                  <img class="img-circle img-bordered-sm" src="{{ asset('img/'.$p->fotoprofil) }}" alt="user image">
                                                  @endif
                                                  @if (!$p->fotoprofil)
                                                  <img class="img-circle img-bordered-sm" src="{{ asset('img/profil.jpg') }}" alt="user image">
                                                  @endif
                                                  <span class="username">
                                                    <a href="#" class="link-black">{{$p->nama }}</a>
                                                  </span>
                                                  <span class="description">{{ $p->username }}</span>
                                                </div>
                                                <!-- /.user-block -->
                                                <div class="row">
                                                  <div class="col-sm-4">
                          
                                                  </div>
                                                  <div class="col-sm-4 py-2">
                                                    <img src="{{ asset('img/'.$p->foto) }}" alt="" class="img-fluid">
                                                  </div>
                                                  <div class="col-sm-4">
                                                    
                                                  </div>
                                                </div>
                                                <h6>{{ $p->judul }}</h6>
                                                <p>
                                                  {{ $p->deskripsi }}
                                                </p>
                          
                        
                          
                                              </div>

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                                {{-- MODAL POST PREVIEW --}}


                            @endforeach
                          </tbody>
                        </table>
                        <!-- /.table -->
                      </div>
                      <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer p-0">
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
        </div>
        <!-- /.row -->
    </section>
  

@endsection