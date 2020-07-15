@extends('layout.admin')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Setting</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Setting</li>
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
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('setting-change')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$setting->id}}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleSiteName">Site Name</label>
                    <input type="text" class="form-control" id="exampleSiteName" placeholder="Site Name" name="sitename" value="{{$setting->sitename}}" required>
                  </div>
                  @if(count($errors) > 0)
                      @foreach($errors->get('sitename') as $er)
                          <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
                      @endforeach
                  @endif
                  <div class="form-group">
                    <label for="exampleRole">Current Logo :</label>
                    <img src="/dist/img/{{$setting->logo}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleRole">Change Logo</label>
                    <input type="file" name="logo" class="form-control">
                  </div>
                  @if(count($errors) > 0)
                      @foreach($errors->get('logo') as $er)
                          <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
                      @endforeach
                  @endif
                  <div class="form-group">
                    <label for="exampleRole">Current Small Logo :</label>
                    <img src="/dist/img/{{$setting->small_logo}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleRole">Change Small Logo</label>
                    <input type="file" name="small_logo" class="form-control">
                  </div>
                  @if(count($errors) > 0)
                      @foreach($errors->get('small_logo') as $er)
                          <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
                      @endforeach
                  @endif
                  <div class="form-group">
                    <label for="examplepassword">Address</label>
                    <textarea name="address" placeholder="Enter Your Address" class="form-control">{{$setting->address}}</textarea>
                  </div>
                  @if(count($errors) > 0)
                      @foreach($errors->get('address') as $er)
                          <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
                      @endforeach
                  @endif
                  <div class="form-group">
                    <label for="exampleRole">Contact Number</label>
                    <input type="number" name="contact_number" value="{{$setting->contact_number}}" class="form-control">
                  </div>
                  @if(count($errors) > 0)
                      @foreach($errors->get('contact_number') as $er)
                          <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
                      @endforeach
                  @endif
                  <div class="form-group">
                    <label>Primary Color</label>

                    <div class="input-group my-colorpicker2">
                      <input type="color" name="primary_color" id="primary_color" value="{{$setting->primary_color}}" class="form-control my-colorpicker1">
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                  <div class="form-group">
                    <label>Secondary Color</label>

                    <div class="input-group my-colorpicker2">
                      <input type="color" name="secondary_color" value="{{$setting->secondary_color}}" class="form-control my-colorpicker1">
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="submit_setting">Save</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script>

      $( "#submit_setting" ).click(function(){
          var primary = $( "#primary_color" ).val();
          document.cookie("primary-color", primary , { expires: 30 },{ path: '/' });
          alert( document.cookie("primary-color") );
      });
  </script> -->

@endsection
