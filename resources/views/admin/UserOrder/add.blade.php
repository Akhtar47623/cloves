@extends('layouts.admin.app')
@section('title', 'Order')
<!-- <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.3.1/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.3.1/mapbox-gl.css' rel='stylesheet' /> -->
<link href="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.js"></script>

<!-- Geocoder plugin -->
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css' type='text/css' />
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>

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
    height: 600px;
}

.modal-body {
    padding-top: 0px !important;
}
div#map {
    width: 661px;
    height: 380px;
    padding: 0;
    margin-left: -33px;
}
canvas.mapboxgl-canvas {
    position: absolute;
    width: 100% !important;
    height: 100% !important;
}


</style>
@push('before-css')
<link href="{{asset('plugins/vendors/morrisjs/morris.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/c3-master/c3.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/pages/google-vector-map.css')}}" rel="stylesheet">
<link href="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css') }}" rel="stylesheet">

<!-- multiple images preview -->
 <meta charset="UTF-8">
    <meta http-equiv="content-language" content="en"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description"
          content="Image-Uploader is a simple jQuery Drag & Drop Image Uploader plugin made to be used in forms, withot AJAX."/>
    <meta name="keywords" content="image, upload, uploader, image-uploader, jquery, gallery, file, form, static"/>
    <meta name="author" content="Christian Bayer"/>
    <meta name="copyright" content="© 2019 - Christian Bayer"/>
    <meta property="og:url" content="https://christianbayer.github.io/image-uploader/"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Image-Uploader"/>
    <meta property="og:description" content="Image-Uploader is a simple jQuery Drag & Drop Image Uploader plugin made to be used in forms, withot AJAX."/>
    <meta property="og:image" content="https://github.githubassets.com/images/modules/logos_page/GitHub-Logo.png"/>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-10 no-block">
                        <h5 class="card-title m-b-0 align-self-center">Add Order</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                            </ul>
                        </div>
                    </div>
                    @if(auth()->user()->hasRole('user'))
                    <form action="{{url('/user/order')}}" method="POST" enctype="multipart/form-data" id="order-form">
                    @elseif(auth()->user()->hasRole('vendor'))
                    <form action="{{url('/vendor/order')}}" method="POST" enctype="multipart/form-data" id="order-form">
                    @else
                    <form action="{{url('/admin/order')}}" method="POST" enctype="multipart/form-data" id="order-form">
                        @endif
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="location">Full Name:<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id=""  name="full_name"  placeholder="Name"  value="{{old('full_name')}}">
                                @error('full_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="location">Pharmacy/Organization:</label>
                                <input type="text" class="form-control" id=""  name="organization"  placeholder="Pharmacy/Organization"  value="{{old('organization')}}">
                                @error('organization')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-row">
                            <label for="location">Location:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control location" id="pickupLocation" data-toggle="modal" data-target="#glassAnimals" name="location"  placeholder=" Location...."  value="{{old('location')}}">
                            @error('location')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-row">  
                            <div class="form-group col">
                                <label for="location">Product:<span class="text-danger">*</span></label>
                                <input type="text" placeholder="Product Name" name="product" class="form-control" value="{{old('product')}}">
                                @error('product')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label>Order Type:<span class="text-danger">*</span></label>
                               <select name="order_type" class="form-control">
                                    <option value="D">Delivery</option>
                                    <option value="P">Pickup</option>
                                    <option value="T">Task</option>
                               </select>
                                @error('delivery_locationName')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fromTime">From:</label>
                                <input type="time" name="timeFrom" class="form-control" value="{{old('timeFrom')}}">
                                @error('timeFrom')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                              <div class="form-group col-md-6">
                                <label for="To">To:</label>
                                <input type="time" class="form-control" id="duration" name="timeTo" value="{{old('timeTo')}}">
                                <span class="toTimeErrorMsg text-danger"></span>
                                @error('timeTo')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="duration">Duration:</label>
                                <input type="number" class="form-control"  id="duration" name="duration"  placeholder="Unloading time in minutes"  value="{{old('duration')}}">
                                <span class="durationErrorMsg text-danger"></span>
                                @error('duration')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="boxes">Boxes:</label>
                                <input type="number" class="form-control" id="boxes"  name="boxes"  placeholder="Number of Boxes"  value="{{old('boxes')}}">
                                @error('boxes')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                 <label for="date">Date:<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date" name="current_date"  placeholder="date"  value="{{old('current_date')}}"  min="<?= date('Y-m-d'); ?>">
                                @error('current_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="notes">Notes: <span class="text-danger">Add additional order details and mention priority.</span></label>
                                <input type="text" class="form-control mb-2" id="notes" name="notes"  placeholder="Additional notes if required.."  value="{{old('notes')}}">
                                <br>
                                @error('notes')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="latitude" id="lat">
                        <input type="hidden" name="langitude" id="lang">
                        </br>
                         <button class="btn btn-success pull-center" type="submit">Add</button>
                    </form>
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
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="map" class="form-control"></div>
                                        <pre id="coordinates" class="coordinates" hidden=""></pre>
                                        <div id="geocoder" class="geocoder"></div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-info" id="modal_btn" data-dismiss="">Save</button>
                              </div>
                            </div>
                          </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
                                        

    @include('layouts.admin.includes.templates.footer')
</div>
@endsection

@push('js')
<script src="{{asset('plugins/vendors/d3/d3.min.js')}}"></script>
<script src="{{asset('plugins/vendors/c3-master/c3.min.js')}}"></script>
<script src="{{asset('plugins/vendors/knob/jquery.knob.js')}}"></script>
<script src="{{asset('plugins/vendors/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('plugins/vendors/raphael/raphael-min.js')}}"></script>
<script src="{{asset('plugins/vendors/morrisjs/morris.js')}}"></script>
<script src="{{asset('plugins/vendors/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{asset('plugins/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<!-- slug scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- endslug scripts -->
<script src="{{asset('plugins/vendors/styleswitcher/jQuery.style.switcher.js')}}"></script>
<script src="{{asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js') }}"></script>
<script>


    $(document).ready(function(){
        $('#modal_btn').on('click',function(){
            $('#glassAnimals').modal('hide');
            $('.mapboxgl-ctrl-geocoder--input').val('');
        })
        $('.location').on('keypress',function(){
            $('#glassAnimals').modal('show');
        })
            $('.location').on('click keypress',function(){
                $('input.form-control.location.active').removeClass('active');
                $(this).addClass('active')
            });

        $('.mapboxgl-ctrl-geocoder--input').on('change',function(){
            let $search_val=$(this).val();
            $('input.form-control.location.active').val($search_val);
        });
        $('#description').summernote({
            placeholder: 'Type Description....',
            tabsize: 2,
            height: 100
        });
          
    });
    $(document).ready(function(){
        $('#duration, #check_in_time').on('keyup change',function(){
        let durationVal=$('#duration').val();
        let checkVal=$('#check_in_time').val();
        if(durationVal < 0){
            $('.durationErrorMsg').text('Please provide positive Number');
        }
        else{
            $('.durationErrorMsg').text('');
        }
        if(checkVal < 0){
            $('.checkErrorMsg').text('Please provide positive Number');
        }else{
            $('.checkErrorMsg').text('');
        }

        });
        $('#long_description').summernote({
            placeholder: 'Type Description....',
            tabsize: 2,
            height: 100
        });
          
    });


</script>


<script type="text/javascript">
    //Script To Generate slug
  $('#title').on('keyup',function(e) {
    $.get('{{ route('check_slug') }}', 
      { 'title': $(this).val() },
      function( data ) {
        $('#slug').val(data.slug);
      }
    );
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

      }, // Use the geocoder's default marker style
      bbox: [-125.0011, 24.9493, -66.9326, 49.5904]
      // bbox: [-77.210763, 38.803367, -76.853675, 39.052643] // Set the bounding box coordinates
    });
    map.addControl(geocoder, 'top-left');
    marker.on('dragend', function (e) {
    document.getElementById('lat').value = marker.getLatLng().lat;
    document.getElementById('long').value = marker.getLatLng().lng;
});
    geocoder.on('results', function(results) {
        console.log(results);
      $('#lang').val(results.features[0].center[0]);
      $('#lat').val(results.features[0].center[1]);
});
        //   geocoder.on('result', (event) => {
        //     console.log($('#lon').val(event.result.geometry.coordinates[0]));
        //     $('#lat').val(event.result.geometry.coordinates[1]);
        // });
</script>

@endpush
 
