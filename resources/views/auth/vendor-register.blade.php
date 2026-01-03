@extends('layouts.front.app')
@section('title', 'Vendor Register')
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
.modal-content {
    height: 770px;
}
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
.modal-footer1{
    position: absolute;
    bottom: 19px;
    right: 14px;
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
.row.d-flex{
  justify-content: center;
}
h5#exampleModalLabel {
    color: white;
    font-weight: 600;
    font-size: 24px;
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
            <div class="row d-flex">
                <div class="col-lg-7">
                     <form action="{{route('register')}}" id="" method="POST">
                        @csrf
                        <input type="text" name="long" id="long" hidden="">
                        <input type="text" name="lat" id="lat" hidden="">
                        <input type="text" name="country" id="country" hidden="">
                        <input type="text" name="city" id="city" hidden="">
                        <input type="text" name="state" id="state" hidden="">
                        <input type="text" name="postcode" id="postcode" hidden="">
                        <input type="text" name="address" id="address" hidden="">
                        <input type="text" name="userRole" id="userRole"  value="vendor" hidden="">
                        <div class="log-form">
                            <h2 class="wow fadeInUp">{{$banner->heading}}</h2>
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="organization" placeholder="Pharmacy/organization" class="fadeIn form-control" value="{{old('organization')}}" id="organization">   
                                    @error('organization')
                                    <span class="text-danger mx-4">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                             <div class="row">
                              <div class="col-lg-6">
                                    <input type="text" name="reg_no" placeholder="Reg#No :" class="wow fadeIn form-control" data-wow-delay=".70s" value="{{old('reg_no')}}" id="reg_no">
                                      @error('reg_no')
                                    <span class="text-danger mx-4">{{$message}}</span>
                                    @enderror
                                </div>
                              <div class="col-lg-6">
                                    <input type="text" name="org_url" placeholder="Organization/Pharmacy URL" class="wow fadeIn form-control" data-wow-delay=".70s" value="{{old('org_url')}}" id="org_url">
                                      @error('org_url')
                                    <span class="text-danger mx-4">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="phone" placeholder="Phone Number" class="wow fadeIn form-control" data-wow-delay=".70s" value="{{old('phone')}}" id="phone">
                                      @error('phone')
                                    <span class="text-danger mx-4">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="reg_email" placeholder="Email Address" class="wow fadeIn form-control" data-wow-delay=".65s" value="{{old('reg_email')}}" id="reg_email">
                                    @error('reg_email')
                                    <span class="text-danger mx-4">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <input type="text" name="location" placeholder="Location" value="{{old('location')}}" class="wow fadeIn form-control" id="location" data-toggle="modal" data-target="#glassAnimals" readonly="">
                                    @error('location')
                                      <span class="text-danger mx-4">{{$message}}</span>
                                    @enderror
                                </div>
                              </div>
                            <div class="row">
                              <div class="col">
                                <input type="password" name="reg_password" placeholder="Password" class="wow fadeIn form-control" data-wow-delay=".85s" id="reg_password" value="{{old('reg_password')}}">
                                  @error('reg_password')
                                    <span class="text-danger mx-4">{{$message}}</span>
                                  @enderror
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <input type="password" name="password_confirmation" placeholder="Retype Password" class="wow fadeIn form-control" data-wow-delay="1s" id="confirm_password" value="{{old('password_confirmation')}}">
                                  @error('password_confirmation')
                                    <span class="text-danger mx-4">{{$message}}</span>
                                  @enderror
                              </div>
                            </div>
                            <p class="wow fadeInRight">By creating an account, You agree to our <a href="{{route('webTermsPage')}}"> Term &amp; Condition </a><span class="login-box"> Already Register? &nbsp;<a href="{{route('Login')}}" class="">Login</a></span></p>
                              <button class="theme_btn" type="submit">CREATE ACCOUNT</button>

                            <!-- Modal -->
                        <div class="modal fade" id="glassAnimals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ADD LOCATION</h5>
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
                                <div class="modal-footer1">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success text-white" id="vendor_loc_save" data-dismiss="modal">SAVE</button>
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
              <!--   <div class="col-lg-6 col-md-6">
                    <div class="excel-sample">
                        <a class="float-right offset-8" href="{{asset('uploads/admin/Doc/orders.xlsx')}}" download=""><i class="fa-solid fa-cloud-arrow-down"></i>Download Form</a> 
                    </div>
                     <form action="{{ route('import') }}" method="POST" id="doc" enctype="multipart/form-data">
                        @csrf
                        <div class="upload-sid">
                            <input type="file" id="file" name="upload_file" value="">
        
                            <h5>Browse Files</h5>
                            <p>Drag And Drop Files Here</p>
                        </div>
                    </form>
                </div> -->
            </div>
        </div>
    </section>
    <!-- upload document end -->
    @include('layouts.front.template.footer')
    @endsection
    @push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            @if($errors->any())
            $('html, body').animate({scrollTop:800},'50');
            @endif
            });
    </script>
    <script>
  mapboxgl.accessToken = '{{env("MAPBOX_ACCESS_TOKEN")}}';
   const map = new mapboxgl.Map({
    container: 'map', // Container ID
    style: 'mapbox://styles/mapbox/streets-v12', // Map style to use
    center: [-122.25948, 37.87221], // Starting position [lng, lat]
    zoom: 12, // Starting zoom level
  });

    // $('.mapboxgl-marker mapboxgl-marker-anchor-center').click(function(){
    // });
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
//     marker.on('dragend', function (e) {
//     document.getElementById('lat').value = marker.getLatLng().lat;
//     document.getElementById('long').value = marker.getLatLng().lng;
// });
      
          geocoder.on('result', (event) => {
            console.log(event.result);
            $('#long').val(event.result.geometry.coordinates[0]);
            $('#lat').val(event.result.geometry.coordinates[1]);
            for (let i = 0; i < event.result.context.length; ++i) {
              var index = event.result.context[i].id;
            if(index.split('.')[0]== 'country'){
                $('#country').val(event.result.context[i].text);
              }
              else if(index.split('.')[0] == 'region'){
                $('#state').val(event.result.context[i].text);
              }
                else if(index.split('.')[0] == 'place'){
                $('#city').val(event.result.context[i].text);
              }
              else if(index.split('.')[0] == 'postcode'){
               $('#postcode').val(event.result.context[i].text);

              }
              else{
                $('#country').val('United States');
              }
            }

        });
           $('#vendor_loc_save').on('click',function(){
                let $search_val=$('.mapboxgl-ctrl-geocoder--input').val();
                    $('#location').val($search_val);
                    $('#address').val($search_val);
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