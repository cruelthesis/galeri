@extends('adminFront')
@section('admincontent')

{{-- header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">User List</h1>
      </div><!-- /.col -->
      
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
{{-- header --}}


<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0" style="height: 400px;">
            <table class="table table-head-fixed text-nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Foto</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no=1;
                @endphp
                @foreach ($userList as $user)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>
                    @if ($user->fotoprofil)
                      <img src="{{ asset('img/'.$user->fotoprofil) }}" class="img-size-50 mr-3 img-circle" alt="">
                      @elseif (!$user->fotoprofil)
                      <img src="{{ asset('img/profil.jpg') }}" class="img-size-50 mr-3 img-circle" alt="">
                    @endif
                  </td>
                  <td>{{ $user->nama }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    @if ($user->approval == 1)
                      <a href="{{ url('approval/'.$user->id) }}" class="btn btn-success btn-xs">Active</a>
                    @else
                      <a href="{{ url('approval/'.$user->id) }}" class="btn btn-warning btn-xs">Pending</a>
                    @endif
                  </td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</div>

@endsection