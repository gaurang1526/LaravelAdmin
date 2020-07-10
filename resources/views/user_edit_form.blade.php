@extends('layout.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Edit Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">User Edit Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('user-update')}}" method="post">
                @csrf
                <input type="hidden" value="{{$users->id}}" name="id">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleName">Name</label>
                    <input type="text" class="form-control" id="exampleName" placeholder="Name" name="name" value="{{ $users->name }}">
                  </div>
                  @if(count($errors) > 0)
                      @foreach($errors->get('name') as $er)
                          <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
                      @endforeach
                  @endif
                  <div class="form-group">
                    <label for="exampleRole">Role</label>
                    <select class="form-control custom-select" name="role">
                      @if($users->role == 1)
                       <option value="1" selected>Admin</option>
                       <option value="0">User</option>
                      @else
                        <option value="0" selected>User</option>
                        <option value="1">Admin</option>
                      @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleEmail">Email</label>
                    <input type="text" class="form-control" id="exampleEmail" placeholder="Email" name="email" value="{{ $users->email }}">
                  </div>
                  @if(count($errors) > 0)
                      @foreach($errors->get('email') as $er)
                          <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
                      @endforeach
                  @endif
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection