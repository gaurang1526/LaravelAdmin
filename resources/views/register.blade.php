<!DOCTYPE html>
<html>
@include('include.header')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{route('welcome')}}"><b>Goto</b>Website</a>
  </div>


  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="{{route('register-user-db')}}" method="post">
         @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" value="{{$value=old('name')}}" required name="name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
          @if(count($errors) > 0)
              @foreach($errors->get('name') as $er)
                  <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
              @endforeach
          @endif
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" value="{{$value=old('email')}}" required name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
          @if(count($errors) > 0)
              @foreach($errors->get('email') as $er)
                  <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
              @endforeach
          @endif
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" required name="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" required name="Password_confirmation">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
         @if(count($errors) > 0)
              @foreach($errors->get('Password') as $er)
                  <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
              @endforeach
          @endif
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" required value="agree">
              <label for="agreeTerms">
               I agree to the terms
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      <a href="{{ route('user-login') }}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

</body>
</html>
