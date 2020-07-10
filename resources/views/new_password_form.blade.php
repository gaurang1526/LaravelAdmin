<!DOCTYPE html>
<html>
@include('include.header')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{route('welcome')}}"><b>Goto</b>Website</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Set New Password</p>

      <form action="{{route('emailcheckotp')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="Enter Your OTP" name="otp" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-pin"></span>
            </div>
          </div>
        </div>
        @if(count($errors) > 0)
            @foreach($errors->get('otp') as $er)
                <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
            @endforeach
        @endif
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Enter Your Password" name="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-pin"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password" name="Password_confirmation" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-pin"></span>
            </div>
          </div>
        </div>
        @if(count($errors) > 0)
            @foreach($errors->get('Password') as $er)
                <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
            @endforeach
        @endif
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

</body>
</html>
