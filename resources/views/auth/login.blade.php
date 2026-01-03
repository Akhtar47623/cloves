    @extends('layouts.login')
    @section('title','login')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
     <style type="text/css">
      .single-page-bg{
    background: url('{{asset('assets/imgs/webb.png')}}');
    opacity:0.7;

}
    </style>
    @section('content')
    <div class="container">
        <div class="" style="">
            <div class="container mt-5 mb-5 ">
                <div class="row">
                  <div class="col-lg-4"></div>
                    <div class="col-lg-4 ">
                        <div class="card-1 bg-white border-0">
                          <div class="card-body">
                            <div class="image-box justify-content-center">
                              <a class="navbar-brand" href="{{route('webIndexPage')}}">
                                <img src="{{asset(getImage())}}" class="responsive">
                              </a>
                             <div class="image-box justify-content-">
                              <img src="{{asset('assets/imgs/login.png')}}" class="responsive">
                            </div>
                            </div>
                            <form method="POST" class="form bordered-input" id="LoginForm">
                                @csrf
                                <div class="">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label for="example-search-input" class="col-form-label font-12 ">Email</label>
                                            <input class="form-control pl-2 font-12" type="text" placeholder="email" name="email" value="{{ old('email') }}" required autofocus id="email">
                                            <span class="text-danger" id="emailError"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label for="example-search-input" class="col-form-label font-12 focus ">Password</label>
                                            <input class="form-control font-12  pl-2 {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" placeholder="password" value="" id="password">
                                            <span class="text-danger" id="passwordError"></span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group row ">
                                        <div class="col-12">
                                            <a href="javascript:void(0)" id="login" style="background-color: #7fb200;"
                                                    class="btn btn-rounded m-b-20 waves-effect waves-light btn-block text-white">
                                                Login
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="clearfix"></div>
                            </form>
                            </div>
                        </div>
                
                    </div>
                  <div class="col-lg-4"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
  @section('js')
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
    $('#login').on('click',function(e){
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
       if(response.roles=='admin'){
          // toastr.success('You are Successfully Logged In!');
          window.location = "{{URL('admin')}}";
        }
        else{
          toastr.warning('User Cannot Login!');
          window.location = "{{URL('logout')}}";
        }
    },
    error: function(response) {
      $('#emailError').text(response.responseJSON.errors.email);
      $('#passwordError').text(response.responseJSON.errors.password);
    },
  });
});
  @if(Session::has('message'))

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
  toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
    // "positionClass": "toast-top-full-width",
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
  toastr.error("{{ session('error') }}");
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
@endsection

