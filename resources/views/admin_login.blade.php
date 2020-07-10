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
      <p class="login-box-msg">Sign in to start your session</p>
       @if(count($errors) > 0)
          @foreach($errors->get('wrong') as $er)
              <p class="text-danger font-weight-bold mt-3">{{$er}}</p>
          @endforeach
          @foreach($errors->get('success') as $er)
              <p class="text-success font-weight-bold mt-3">{{$er}}</p>
          @endforeach
      @endif
      <form action="{{route('check')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <?php
          if(!isset($_COOKIE['email'])) {
            echo "<input type='email' class='form-control' placeholder='Email' name='email' >";
          } else {
            echo "<input type='email' class='form-control' placeholder='Email' name='email' value='" . $_COOKIE['email']. "'>";
            
          }
          ?>
          <!-- <input type="email" class="form-control" placeholder="Email" name="email" > -->
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
          <?php
          if(!isset($_COOKIE['password'])) {
            echo "<input type='password' class='form-control' placeholder='Password' name='password'>";
          } else {
            echo "<input type='password' class='form-control' placeholder='Password' name='password' value='" . $_COOKIE['password']. "'>";
            
          }
          ?>
          <!-- <input type="password" class="form-control" placeholder="Password" name="password"> -->
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     

      <p class="mb-1">
        <a href="{{route('forgot-password-form')}}">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="{{ route('register-user') }}" class="text-center">Register a new membership</a>
      </p>
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
