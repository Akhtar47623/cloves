    @extends('layouts.front.app')
    @section('title', 'Login')
    @section('content')
    <!-- banner start -->
    <section class="main_slider inr">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset($banner->image_path)}}" class="img-fluid" alt="...">
                <div class="carousel-caption">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="banner-text iner cntct lgn">
                                    <h4 class="btn-shine ">{{$banner->heading}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroldwn inr">
            <a href="#lgin"><img src="{{asset('web-assets/images/mouse.png')}}" alt="">
                <p>Scroll Down</p>
            </a>
        </div>
    </section>
    <!-- banner end -->

    <!-- loign start -->
    <section class="log-p" id="lgin">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <form action="javascript:void(0)" method="POST" id="LoginForm">
                @csrf
              <div class="log-form">
                <h2 class="wow fadeInUp">Login To Your Account</h2>
                  <input type="email" placeholder="User Name" name="reg_email" class="wow fadeIn" data-wow-delay=".25s" id="email">
                    <span class="text-danger" id="emailError"></span>
                  <input type="password" placeholder="Password" name="password" class="wow fadeIn" data-wow-delay=".45s" id="password">
                    <span class="text-danger" id="passwordError"></span>
                  <button class="theme_btn">LOGIN</button>
                  <div class="log-form-footer">
                  <div>
                    <input type="checkbox">
                    <a href="#">Remember me</a>
                  </div>
                  <div>
                      <a href="{{route('PasswordReset')}}">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-lg-6">
            <form action="javascript:void(0)" method="POST" id="RegisterForm">
                  @csrf
              <div class="log-form">
                  <h2 class="wow fadeInUp">Register Your Account</h2>
                  <div class="row">
                      <div class="col-lg-6">
                          <input type="text" name="first_name" placeholder="First Name" class="wow fadeIn" data-wow-delay=".25s" value="{{old('first_name')}}" id="first_name">
                          <span class="text-danger" id="first_nameError"></span>
                      </div>
                      <div class="col-lg-6">
                          <input type="text" name="last_name" placeholder="Last Name" class="wow fadeIn" data-wow-delay=".45s" value="{{old('last_name')}}" id="last_name">
                          <span class="text-danger" id="last_nameError"></span>
                      </div>
                  </div>
                  <input type="email" name="email" placeholder="Email Address" class="wow fadeIn" data-wow-delay=".65s" value="{{old('email')}}" id="reg_email">
                  <span class="text-danger" id="regEmailError"></span>
                  <input type="text" name="organization" placeholder="Pharmacy name/organization" class="wow fadeIn" data-wow-delay=".70s" value="{{old('organization')}}" id="organization">
                  <span class="text-danger" id="organizationError"></span>
                  <input type="password" name="password" placeholder="Password" class="wow fadeIn" data-wow-delay=".85s" id="reg_password">
                  <span class="text-danger" id="regPasswordError"></span>
                  <input type="password" name="password_confirmation" placeholder="Retype Password" class="wow fadeIn" data-wow-delay="1s" id="confirm_password">
                  <span class="text-danger" id="confirmPasswordError"></span>
                  <p class="wow fadeInRight">By creating an account, You agree to our <a href="#"> Term &amp; Condition </a> 
                  </p>
                  <button class="theme_btn">CREATE ACCOUNT</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- loign end -->
    @include('layouts.front.template.footer')
    @endsection
    @push('js')
         <script type="text/javascript">
  $('#LoginForm').on('submit',function(e){
  e.preventDefault();
  let email = $('#email').val();
  let password = $('#password').val();
  $.ajax({
    url: "{{ route('login') }}",
    type:"POST",
    data:{
      "_token": "{{ csrf_token() }}",
      email:email,
      password:password,
    },
    success:function(response){
      if (response) {
        window.location = "{{URL('')}}";
      }
    },
    error: function(response) {
      console.log(response);
      $('#emailError').text(response.responseJSON.errors.email);
      $('#passwordError').text(response.responseJSON.errors.password);
    },
  });
});

</script>
<script type="text/javascript">
    $('#RegisterForm').on('submit',function(e){
    e.preventDefault();
    let first_name = $('#first_name').val();
    let last_name = $('#last_name').val();
    let reg_email = $('#reg_email').val();
    let organization = $('#organization').val();
    let reg_password = $('#reg_password').val();
    let password_confirmation = $('#confirm_password').val();
    $.ajax({
      url: "{{ route('register') }}",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        first_name:first_name,
        last_name:last_name,
        reg_email:reg_email,
        organization:organization,
        reg_password:reg_password,
        password_confirmation:password_confirmation,
      },
      success:function(response){
        console.log(response);
        if (response) {
          window.location = "{{URL('/user')}}";
        }
      },
      error: function(response) {
        console.log(response);
         $('#first_nameError').text((response.responseJSON.errors.first_name == undefined)? '' :response.responseJSON.errors.first_name);
        $('#last_nameError').text((response.responseJSON.errors.last_name == undefined)? '' :response.responseJSON.errors.last_name);
        $('#regEmailError').text((response.responseJSON.errors.reg_email == undefined)? '' :response.responseJSON.errors.reg_email);
        $('#organizationError').text((response.responseJSON.errors.organization == undefined)? '' :response.responseJSON.errors.organization);
        $('#regPasswordError').text((response.responseJSON.errors.reg_password == undefined)? '' :response.responseJSON.errors.reg_password);
        $('#confirmPasswordError').text((response.responseJSON.errors.password_confirmation == undefined)? '' :response.responseJSON.errors.password_confirmation);
      },
      });
    });
  </script>
     <script>
  @if(Session::has('success'))

  toastr.options =
  {
    "positionClass": "toast-top-full-width",
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "6000",
    "extendedTimeOut": "6000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
  }
  toastr.success("{{ session('success') }}");
  @endif

  @if(Session::has('error1'))
  toastr.options =
  {
    "positionClass": "toast-top-full-width",
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "6000",
    "extendedTimeOut": "6000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  toastr.error("{{ session('error1') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "6000",
    "extendedTimeOut": "6000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "6000",
    "extendedTimeOut": "6000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  toastr.warning("{{ session('warning') }}");
  @endif
</script>
@endpush