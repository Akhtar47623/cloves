@extends('layouts.front.app')
@section('title', 'Login')
<link href="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.js"></script>

<!-- Geocoder plugin -->
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css' type='text/css' />

<!-- Turf.js plugin -->
<script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>
  <style>
body { margin: 0; padding: 0; }
#map { position: absolute; top: 0; bottom: 0; width: 100%; }
.geocoder {
    position: absolute;
    /* z-index: 1; */
    width: 591PX;
    left: 16PX;
    /* margin-left: -24%; */
    top: -171px;
}
.mapboxgl-ctrl-geocoder {
min-width: 100%;
}
#map {
margin-top: 75px;
}
    .coordinates {
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        position: absolute;
        bottom: 40px;
        left: 10px;
        padding: 5px 10px;
        margin: 0;
        font-size: 11px;
        line-height: 18px;
        border-radius: 3px;
        display: none;
    }
    .container {
  padding: 2rem 0rem;
}
#map { 
    position: absolute; 
    /*top: 0; 
    bottom: 0; */
    width: auto;
    height: auto; 
    margin-top: 0px;
}
/*.modal-content {
    height: 770px;
}*/
.modal-content{
    height: 500px !important;
}
.mapboxgl-ctrl-geocoder--icon-search {
height: 40px;
}
.mapboxgl-ctrl-geocoder--icon-close{
    height: 40px;
}

.modal-body {
    padding-top: 0px !important;
}
div#map {
    width: 100%;
    height: 85%;
    padding: 0px;
    margin: -16px;
}
canvas.mapboxgl-canvas {
    position: absolute;
    width: 100% !important;
    height: 327px !important;
}
.modal-footer{
    margin-top: 350px;
}
#loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(255, 255, 255, 1) url( https://raw.githubusercontent.com/niklausgerber/PreLoadMe/master/img/status.gif) no-repeat center center;
  z-index: 10000;
}


</style>
    @section('content')
    <!-- banner start -->
    <div id="loader"></div>
    <section class="main_slider inr" id="Login">

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
                     <form action="javascript:void(0)" id="RegisterForm">
                        @csrf
                        <input type="text" name="long" id="long" hidden="">
                        <input type="text" name="lat" id="lat" hidden="">
                        <input type="text" name="country" id="country" hidden="">
                        <input type="text" name="city" id="city" hidden="">
                        <input type="text" name="postcode" id="postcode" hidden="">
                        <input type="text" name="address" id="address" hidden="">
                        <div class="log-form">
                            <h2 class="wow fadeInUp">Register Your Account</h2>
                            <div style="display:flex; flex-direction: row; align-items: center">
                                    <input style="width: 20px;" type="checkbox"  name="vendor" id="vendor">
                                    <label>Register as Vendor</label>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="first_name" placeholder="First Name" class="wow fadeIn" data-wow-delay=".25s" value="{{old('first_name')}}" id="first_name">
                                    <span class="text-danger mx-3" id="first_nameError"></span>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="last_name" placeholder="Last Name" class="wow fadeIn" data-wow-delay=".45s" value="{{old('last_name')}}" id="last_name">
                                    <span class="text-danger mx-3" id="last_nameError"></span>
                                </div>
                            </div>
                            <span class="text-danger mx-3" id="order_idError"></span>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="phone" placeholder="Phone Number" class="wow fadeIn form-control" data-wow-delay=".70s" value="{{old('phone')}}" id="phone">
                                    <span class="text-danger mx-3" id="phoneError"></span>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" placeholder="Email Address" class="wow fadeIn form-control" data-wow-delay=".65s" value="{{old('email')}}" id="reg_email">
                                    <span class="text-danger mx-3" id="regEmailError"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="organization" placeholder="Pharmacy/organization" class="fadeIn form-control" value="{{old('organization')}}" id="organization" disabled="" >
                                      <span class="text-danger mx-3" id="organizationError"></span>
                                </div>
                              </div>
                            <input type="text" name="location" placeholder="Location" value="{{old('location')}}" class="form-control" id="location" data-toggle="modal" data-target="#glassAnimals" readonly="">
                              <span class="text-danger mx-3" id="locationError"></span>
                            <input type="password" name="password" placeholder="Password" class="wow fadeIn form-control" data-wow-delay=".85s" id="reg_password">
                              <span class="text-danger mx-3" id="regPasswordError"></span>
                            <input type="password" name="password_confirmation" placeholder="Retype Password" class="wow fadeIn form-control" data-wow-delay="1s" id="confirm_password">
                                    <span class="text-danger mx-3" id="confirmPasswordError"></span>
                            <p class="wow fadeInRight">By creating an account, You agree to our <a href="{{route('webTermsPage')}}"> Term &amp; Condition </a> </p>
                            <button class="theme_btn">CREATE ACCOUNT</button>

                            <!-- Modal -->
                        <div class="modal fade" id="glassAnimals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Location</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <!-- <div id="map" style="width: 100% !important;height: 100% !important; padding: 0px; margin: -16px;">
                                </div> -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="map" class="form-control"></div>
                                        <pre id="coordinates" class="coordinates" hidden=""></pre>
                                        <div id="geocoder" class="geocoder"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-info" id="modal_btn" data-dismiss="modal">Save</button>
                              </div>
                            </div>
                          </div>
                        </div>
                            <!-- Modal -->

                        </div>
                    </form>


                </div>
            </div>

        </div>
    </section>
    <!-- loign end -->
    <!-- upload document satrt -->
    <section class="upload">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="excel-sample">
                        <a class="float-right offset-8" href="{{asset('uploads/admin/Doc/orders.xlsx')}}" download=""><i class="fa-solid fa-cloud-arrow-down"></i>Download sample</a> 
                    </div>
                     <form action="{{ route('import') }}" method="POST" id="doc" enctype="multipart/form-data">
                        @csrf
                        <div class="upload-sid">
                            <input type="file" id="file" name="upload_file" value="">
        
                            <h5>Browse Files</h5>
                            <p>Drag And Drop Files Here</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- upload document end -->
    @include('layouts.front.template.footer')
    @endsection
    @push('js')
    <script>
        $(document).ready(function(){
            $('#organization').addClass('d-none');
            $('#organization').val('');
        });
    $('#vendor').on('click',function(){
        if($('#vendor').is(':checked') == false){
            // $('#organization').prop('disabled','disabled');
            $('#organization').addClass('d-none');
            $('#organization').val('');
        }
        
        else if($('#vendor').is(':checked') == true){
            $('#organization').prop('disabled',false);
            $('#organization').removeClass('d-none'); 
        }
    })
  mapboxgl.accessToken = 'pk.eyJ1IjoiaG1teTAwOTAiLCJhIjoiY2sza3I1dHp2MG41MDNnbjR1MmViaHJ2aCJ9.gEf6RrLwMe_kUPMrkuOX0Q';
   const map = new mapboxgl.Map({
    container: 'map', // Container ID
    style: 'mapbox://styles/mapbox/streets-v12', // Map style to use
    center: [-122.25948, 37.87221], // Starting position [lng, lat]
    zoom: 12, // Starting zoom level
  });

    $('.mapboxgl-marker mapboxgl-marker-anchor-center').click(function(){
    });
    const marker = new mapboxgl.Marker({
        map: map,
        draggable: true
        // title:"Drag me!"
    })

    //     .setLngLat([0, 0])
    //     .addTo(map);

    // function onDragEnd() {
    //     const lngLat = marker.getLngLat();
    //     coordinates.style.display = 'block';
    //     $('#long').val(lngLat.lng);
    //     $('#lat').val(lngLat.lat)
    //     // coordinates.innerHTML = `Longitude: ${lngLat.lng}<br />Latitude: ${lngLat.lat}`; 
    // }


    // marker.on('dragend', onDragEnd);

    const geocoder = new MapboxGeocoder({
        draggable: false,
        accessToken: mapboxgl.accessToken, // Set the access token
        mapboxgl: mapboxgl, // Set the mapbox-gl instance
        marker:{
        draggable:false,
        map:map,

      }, 
      bbox: [-125.0011, 24.9493, -66.9326, 49.5904]
      // bbox: [-171.791110603, 18.91619, -66.96466, 71.3577635769]
    });
    map.addControl(geocoder, 'top-left');
    marker.on('dragend', function (e) {
    document.getElementById('lat').value = marker.getLatLng().lat;
    document.getElementById('long').value = marker.getLatLng().lng;
});
       geocoder.on('results', function(results) {
      $('#long').val(results.features[0].center[0]);
      $('#lat').val(results.features[0].center[1]);
});
        //   geocoder.on('result', (event) => {
        //     console.log($('#lon').val(event.result.geometry.coordinates[0]));
        //     $('#lat').val(event.result.geometry.coordinates[1]);
        // });

        $('#modal_btn').on('click',function(){
        var settings = {
          "url": "https://api.mapbox.com/geocoding/v5/mapbox.places/"+$('#long').val()+","+$('#lat').val()+".json?access_token=pk.eyJ1IjoiaG1teTAwOTAiLCJhIjoiY2sza3I1dHp2MG41MDNnbjR1MmViaHJ2aCJ9.gEf6RrLwMe_kUPMrkuOX0Q",
          "method": "GET",
          "timeout": 0,
          "headers": {
            "Content-Type": "application/json"
          },
        };

        $.ajax(settings).done(function (response) {
            console.log(response);
            $('#country').val(response.features[6].text);
            $('#city').val(response.features[5].text);
            $('#postcode').val(response.features[2].text);
            $('#address').val(response.features[0].properties.address);

        });
                });
             $('#modal_btn').on('click',function(){
                let $search_val=$('.mapboxgl-ctrl-geocoder--input').val();
                    $('#location').val($search_val);
                     $('#glassAnimals').modal('hide');
        });

        </script>
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
       if(response.roles=='user'){
          toastr.success('You are Successfully Logged In!');
          window.location = "{{URL('/')}}";
        }
        else if(response.roles=='vendor'){
          toastr.success('You are Successfully Logged In!');
          window.location = "{{URL('/')}}";
        }
        else{
          toastr.error('Credentials does not exist!');
          window.location = "{{URL('logout')}}";
        }
    },
    error: function(response) {
      $('#emailError').text(response.responseJSON.errors.email);
      $('#passwordError').text(response.responseJSON.errors.password);

    },
  });
});

</script>
<script type="text/javascript">
    var spinner = $('#loader');
    $('#RegisterForm').on('submit',function(e){
    e.preventDefault();
        spinner.show();
    let country = $('#country').val();
    let city = $('#city').val();
    let postcode = $('#postcode').val();
    let address = $('#address').val();
    let first_name = $('#first_name').val();
    let last_name = $('#last_name').val();
    let reg_email = $('#reg_email').val();
    let order_id = $('#order_id').val();
    let role = $('#role').val();
    let organization = $('#organization').val();
    let phone = $('#phone').val();
    let location = $('#location').val();
    let reg_password = $('#reg_password').val();
    let password_confirmation = $('#confirm_password').val();
    $.ajax({
      url: "{{ route('register') }}",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        country:country,
        city:city,
        postcode:postcode,
        address:address,
        first_name:first_name,
        last_name:last_name,
        reg_email:reg_email,
        order_id:order_id,
        role:role,
        organization:organization,
        phone:phone,
        location:location,
        reg_password:reg_password,
        password_confirmation:password_confirmation,
      },
      success:function(response){
        spinner.hide();
        if(response){
            toastr.success('Congratulations! You are Registered Successfully.');
        window.location = (response == 'user')? "{{URL('/user')}}": "{{URL('/vendor/dashboard')}}";
        }
      },
      error: function(response) {
        spinner.hide();
          console.log(response);    
         $('#first_nameError').text((response.responseJSON.errors.first_name == undefined)? '' :response.responseJSON.errors.first_name);
        $('#last_nameError').text((response.responseJSON.errors.last_name == undefined)? '' :response.responseJSON.errors.last_name);
        $('#regEmailError').text((response.responseJSON.errors.reg_email == undefined)? '' :response.responseJSON.errors.reg_email);
        $('#order_idError').text((response.responseJSON.errors.order_id == undefined)? '' :response.responseJSON.errors.order_id);
        $('#locationError').text((response.responseJSON.errors.location == undefined)? '' :response.responseJSON.errors.location);
        $('#regPasswordError').text((response.responseJSON.errors.reg_password == undefined)? '' :response.responseJSON.errors.reg_password);
        $('#confirmPasswordError').text((response.responseJSON.errors.password_confirmation == undefined)? '' :response.responseJSON.errors.password_confirmation);
        $('#organizationError').text((response.responseJSON.errors.organization == undefined)? '' :response.responseJSON.errors.organization);
         $('#phoneError').text((response.responseJSON.errors.phone == undefined)? '' :response.responseJSON.errors.phone);
      }
      });
    });
  </script>

     <script>
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
     <script type="text/javascript">
         new Cleave('#phone', {
            numericOnly:true,
            // prefix:'+',
            delimiter:'-',
            blocks:[3,3,4]
        });
    </script>
<!-- <script type="text/javascript">
    //Script To Generate slug
$('#first_name').keyup(function() {
        let text = $(this).val().toLowerCase();
        text = text.replace(/[^a-z0-9]+/g, '-');
        $('#order_id').val(text);
    });
</script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endpush