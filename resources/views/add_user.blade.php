@extends('layout.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add User Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Add User Form</li>
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
              <form role="form" action="{{route('register-user-db')}}" method="post">
                @csrf
                
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleName">Name</label>
                    <input type="text" class="form-control" id="exampleName" placeholder="Name" name="name" value="{{$value=old('name')}}" required>
                  </div>
                  @if(count($errors) > 0)
                      @foreach($errors->get('name') as $er)
                          <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
                      @endforeach
                  @endif
                  <div class="form-group">
                    <label for="exampleRole">Role</label>
                    <select class="form-control custom-select" name="role" required>
                       <option value="1" selected>Admin</option>
                       <option value="0">User</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleEmail">Email</label>
                    <input type="text" class="form-control" value="{{$value=old('email')}}" id="exampleEmail" placeholder="Email" name="email" required>
                  </div>
                  @if(count($errors) > 0)
                      @foreach($errors->get('email') as $er)
                          <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
                      @endforeach
                  @endif
                  <div class="form-group">
                    <label for="examplePassword">Passord</label>
                    <input type="password" class="form-control" id="examplePassword" placeholder="Password" name="Password" required>
                  </div>
                  <div class="form-group">
                    <label for="examplepassword">Email</label>
                    <input type="password" class="form-control" id="examplepassword" placeholder="Confirm Password" name="Password_confirmation" required>
                  </div>
                  @if(count($errors) > 0)
                      @foreach($errors->get('Password') as $er)
                          <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
                      @endforeach
                  @endif
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
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