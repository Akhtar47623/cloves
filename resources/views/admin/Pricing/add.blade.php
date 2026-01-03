@extends('layouts.admin.app')
@section('title', 'Product')

  <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

  <link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">

<style type="text/css">
    input#radius {
        position: absolute;
        z-index: 99999;
        bottom: 502px;
        width: 130px;
        height: 43px;
        left: 351px;
        border: 2px solid #a5aabe;
        border-radius: 3px;
        background: white;
    }   
    #geocoder {
        z-index: 1;
        margin: 20px;
    }
    .mapboxgl-ctrl-geocoder {
        min-width: 100%;
        border-top:unset !important;
        /*border:1px solid #b0b5cb !important;*/
    }
    .mapboxgl-ctrl-geocoder--input{
        border:1px solid #a4a9bc !important;
        height: 42px;
        border-radius: 3px;
    }
    div#geocoder {
        position: absolute;
        bottom: 58% !important;
        z-index: 99999;
        left: 63px;
        border:1px solid #a4a9bc !important;
    }
/*    .row.d-flex {
        gap: 45px;
    }*/
    input#distance,input#price,input#shipping_price,input#shipping_price,input#shipping_price {
        border: 0;
        box-shadow: 0 0 10px 2px rgba(0,0,0,.1);
        border:1px solid #b0b5cb !important;

        /*margin-top: 50px;*/
    }
    input#distance{
        fill:white;
    }
    .table-responsive.m-t-10.p-2 {
        overflow: hidden;
    }
</style>
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-10 no-block">
                        <h5 class="card-title m-b-0 align-self-center">Pricing</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                                <li>
                                    <!-- <a href="{{url('admin/product/create/')}}" class="btn waves-effect waves-light btn-rounded btn-primary">Add Product</a> -->
                                </li>
                            </ul>
                        </div>
                    </div>
                        <div class="table-responsive m-t-10 p-2">
                        <form class="ml-2 mr-2" action="{{url('/admin/pricing')}}" method="POST" enctype="multipart/data">
                            @csrf
                            <input type="hidden" name="" id="sourceLt">
                            <input type="hidden" name="" id="sourceLng">
                            <input type="hidden" name="" id="destinationLt">
                            <input type="hidden" name="" id="destinationLng">
                            <input type="hidden" name="source_location" id="source_location">
                            <input type="hidden" name="destination_location" id="destination_location">
                            <div class="form-row">
                                <div class="col-4 mt-3">
                                    <label>Source Location</label>
                                    <div id="source"><div class="mapboxgl-ctrl-geocoder mapboxgl-ctrl"></div></div>
                                    @error('source_location')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-4 mt-3">
                                    <label>Destination Location</label>
                                    <div id="destination"><div class="mapboxgl-ctrl-geocoder mapboxgl-ctrl"></div></div>
                                    @error('destination_location')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-4 mt-3">
                                    <label>Shipping rate per Kilometer</label>
                                    <input type="number" class="form-control p-2" name="shipping_price" id="shipping_price" placeholder="" min="0" value="{{old('shipping_price')}}">
                                    @error('shipping_price')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col-6">
                                    <label>Distance</label>
                                    <input class="form-control p-2" type="text" name="total_distance" id="distance" placeholder="Distance in Kilometer" readonly="" value="{{old('total_distance')}}">
                                </div>
                                <div class="col-6">
                                    <label>Total Amount</label>
                                    <input class="form-control p-2" type="text" name="total_amount" id="price" placeholder="Total Amount" readonly="" value="{{old('total_amount')}}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-3">ADD</button>
                        </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
<!-- <pre id="result"></pre> -->
    @include('layouts.admin.includes.templates.footer')
</div>
@endsection
@push('js')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{asset('plugins/vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script id="search-js" defer="" src="https://api.mapbox.com/search-js/v1.0.0-beta.14/web.js"></script>
    <script>
        // SET PLACEHOLDER
        $(document).ready(function(){
            $("div#source input.mapboxgl-ctrl-geocoder--input").attr('placeholder','Source Location');
            $("div#destination input.mapboxgl-ctrl-geocoder--input").attr('placeholder','Destination Location');
        });
      
        $(function () {
            $('#myTable').DataTable();
        });
        source.accessToken = '{{env("MAPBOX_ACCESS_TOKEN")}}';
        const distanceGeoCoding = new MapboxGeocoder({
            accessToken: source.accessToken,
            types: 'country,region,place,postcode,locality,neighborhood'
        });

        // GET COORDINATES FROM GEOCODER
        distanceGeoCoding.setBbox([-171.791110603, 18.91619, -66.96466, 71.3577635769]);
        distanceGeoCoding.addTo('#source');
        // const results = document.getElementById('result');
        distanceGeoCoding.on('result', (e) => {
            var long=e.result.geometry.coordinates[0];
            var lat=e.result.geometry.coordinates[1];
            $('#sourceLng').val(long);
            $('#sourceLt').val(lat);
            dd();
        });
        source.accessToken = '{{env("MAPBOX_ACCESS_TOKEN")}}';
        const destGeoCoding = new MapboxGeocoder({
            accessToken: source.accessToken,
            types: 'country,region,place,postcode,locality,neighborhood'
        });
        destGeoCoding.setBbox([-171.791110603, 18.91619, -66.96466, 71.3577635769]);
        destGeoCoding.addTo('#destination');
        // const results = document.getElementById('result');
        destGeoCoding.on('result', (e) => {
            var long=e.result.geometry.coordinates[0];
            var lat=e.result.geometry.coordinates[1];
            $('#destinationLng').val(long);
            $('#destinationLt').val(lat);
            dd();
        });
        const ACCESS_TOKEN = 'pk.eyJ1IjoiaG1teTAwOTAiLCJhIjoiY2sza3I1dHp2MG41MDNnbjR1MmViaHJ2aCJ9.gEf6RrLwMe_kUPMrkuOX0Q';
     
        const script = document.getElementById('search-js');
        script.onload = () => {
        const elements = document.querySelectorAll('mapbox-address-autofill');
        for (const autofill of elements) {
        autofill.accessToken = ACCESS_TOKEN;
        }
        };
        function distance(lat1, lon1, lat2, lon2, unit) {
          if ((lat1 == lat2) && (lon1 == lon2)) {
            return 0;
          }
          else {
              // alert(lat1+' '+lon1+' '+ lat2+' '+ lon2)
            var radlat1 = Math.PI * lat1/180;
            var radlat2 = Math.PI * lat2/180;
            var theta = lon1-lon2;
            var radtheta = Math.PI * theta/180;
            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
            if (dist > 1) {
              dist = 1;
            }
            dist = Math.acos(dist);
            dist = dist * 180/Math.PI;
            dist = dist * 60 * 1.1515;
            if (unit=="K") { dist = dist * 1.609344 }
            if (unit=="N") { dist = dist * 0.8684 }
            return dist;
          }
        }
        function dd(){
          var a = $('#sourceLt').val();
          var b = $('#sourceLng').val();
          var c = $('#destinationLt').val();
          var d = $('#destinationLng').val();
          if(a != '' && b != '' && c != '' && d != ''){
            $distance=Math.round(distance(a,b,c,d, "K"));
            $('#distance').val($distance +' Kilometer');
            $('#shipping_price').on('change keyup',function(){
            $shipping_price=$('#shipping_price').val();
            $('#price').val('$ '+$distance * $shipping_price);
            });
          }
        };

        $('#source input.mapboxgl-ctrl-geocoder--input').on('change',function(){
                $source=$(this).val();
                $('#source_location').val($source);
        });

        $('#destination input.mapboxgl-ctrl-geocoder--input').on('change',function(){
                $destination=$(this).val();
                $('#destination_location').val($destination);
        });

    </script>
@endpush
