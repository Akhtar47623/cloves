@extends('layouts.admin.app')
@section('title', 'Dashboard')
<style type="text/css">
    /*Preloader*/
        #preloader {
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #fff;
          /* change if the mask should have another color then white */
          z-index: 99;
          /* makes sure it stays on top */
        }

        #status {
          width: 200px;
          height: 200px;
          position: absolute;
          left: 50%;
          /* centers the loading animation horizontally one the screen */
          top: 50%;
          /* centers the loading animation vertically one the screen */
          background-image: url(https://raw.githubusercontent.com/niklausgerber/PreLoadMe/master/img/status.gif);
          /* path to your loading animation */
          background-repeat: no-repeat;
          background-position: center;
          margin: -100px 0 0 -100px;
          /* is width and height divided by two */
        }
</style>
@section('content')
    <!-- Preloader -->
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
    <div class="container-fluid">
        <div class="row">
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="dashboard">
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <h1 style="text-align: center; margin: 10px 0px 30px">Welcome To {{ env('APP_NAME') }}</h1>
                    <img alt="" style=" width: 220px; margin: 0px auto; display: flex; " class="img-responsive" id="blah1" src="{{ asset(getImage()) }}">
                </div>
            </div>
        </div>
        @include('layouts.admin.includes.templates.footer')
    </div>
@endsection
@push('js')
<script type="text/javascript">
    $(window).on('load', function() { // makes sure the whole site is loaded 
      $('#status').fadeOut(); // will first fade out the loading animation 
      $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
      $('body').delay(350).css({'overflow':'visible'});
    });
</script>
<script src="{{asset('plugins/vendors/d3/d3.min.js')}}"></script>
<script src="{{asset('plugins/vendors/c3-master/c3.min.js')}}"></script>
<script src="{{asset('plugins/vendors/knob/jquery.knob.js')}}"></script>
<script src="{{asset('plugins/vendors/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('plugins/vendors/raphael/raphael-min.js')}}"></script>
<script src="{{asset('plugins/vendors/morrisjs/morris.js')}}"></script>
<script src="{{asset('plugins/vendors/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script>
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
</script>
<script src="{{asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('plugins/vendors/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('assets/js/dashboard-shop-2.js')}}"></script>
<script src="{{asset('plugins/vendors/styleswitcher/jQuery.style.switcher.js')}}"></script>
@endpush
