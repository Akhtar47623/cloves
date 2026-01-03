<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Mintone">
    <meta name="author" content="Admin Mintone">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset(getImage('favicon'))}}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    @include('layouts.admin.includes.links')
</head> 
<body class="fix-header fix-sidebar card-no-border">
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Welcome to {{ config('app.name') }} Dashboard!</p>
    </div>
</div>
<div id="main-wrapper">
        @include('layouts.admin.includes.templates.header')
    <div class="container">
        @include('layouts.admin.includes.templates.sidebar')
        <div class="page-wrapper">
            @yield('content')
            @include('layouts.admin.includes.templates.footer')
        </div>
    </div>
</div>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<script src="{{asset('plugins/vendors/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/vendors/jquery/spartan-multi-image-picker.min.js')}}"></script>
<script src="{{asset('plugins/vendors/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('plugins/vendors/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/vendors/ps/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('assets/js/waves.js')}}"></script>
<script src="{{asset('assets/js/sidebarmenu.js')}}"></script>
<script src="{{asset('assets/js/custom.min.js')}}"></script>
<script src="{{asset('plugins/vendors/toast-master/js/jquery.toast.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/edituser.js') }}"></script>
<!-- <script src="{{asset('plugins/vendors/switchery/dist/switchery.min.js')}}"></script>
<script src="{{asset('plugins/vendors/summernote/dist/summernote.js')}}"></script>
<script src="{{asset('plugins/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script> -->
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor' );
    CKEDITOR.replace( 'summary-ckeditor1' );
    CKEDITOR.replace( 'summary-ckeditor2' );
</script>
<script>
    $('#slimtest1, #slimtest2').perfectScrollbar();
     $(document).ready(function () {

            @if(\Session::has('message'))
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('message')}}',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            @endif
            @if(\Session::has('flash_message'))
            $.toast({
                heading: 'Info!',
                position: 'top-center',
                text: '{{session()->get('flash_message')}}',
                loaderBg: '#ff6849',
                icon: 'error',
                hideAfter: 3000,
                stack: 6
            });
            @endif
            @if(\Session::has('error'))
            $.toast({
                heading: 'Info!',
                position: 'top-center',
                text: '{{session()->get('error')}}',
                loaderBg: '#ff6849',
                icon: 'error',
                hideAfter: 6000,
                stack: 6
            });
            @endif
        });
</script>
<script>
  @if(Session::has('message'))

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
    "hideMethod": "fadeOut",
  }
  toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
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
   
<script type="text/javascript">
    $(document).ready(function() { $("#e1").select2(); });
</script>
<script type="text/javascript">
    $(document).ready(function() { $("#e2").select2(); });
</script>
@stack('js')
</body>
</html>
