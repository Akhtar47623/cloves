@extends('layouts.admin.app')
@section('title', 'Depot Location')
  <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
  <link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet">
  <script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
  <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
<style type="text/css">
    #mapid{
        margin-top: 20px;
    }
    input#radius {
        position: absolute;
        z-index: 99999;
        top: 102px;
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
        top: 182px;
        z-index: 99999;
        left: 77px;
        border:1px solid #a4a9bc !important;
    }
    input#distance,input#price,input#shipping_price,input#shipping_price,input#shipping_price {
        border: 0;
        box-shadow: 0 0 10px 2px rgba(0,0,0,.1);
        border:1px solid #b0b5cb !important;
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
                        <h5 class="card-title m-b-0 align-self-center">Depot Location</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive m-t-10 p-2">
                        <form class="ml-2 mr-2" action="{{url('/admin/depot-location/'.$depotLoc->id)}}" method="POST" enctype="multipart/data">
                            @csrf
                             @method('put')
                            <div class="row">
                                <input type="hidden" value="{{$depotLoc->depot_long}}" name="" id="depotLong">
                                <input type="hidden" name="" id="depotLat" value="{{$depotLoc->depot_lat}}">
                            <div id="mapid" style="width: 100%; height: 500px;"></div>
                                <input type="number" name="radius" value="{{$depotLoc->radius}}" min="0" class="p-1" id="radius" placeholder="Distance in Miles" oninput="changeRadius(); validity.valid || (value = this.previousValue)">
                               <input type="hidden" name="depot_long" id="sourceLong" onchange="myFunction()" >
                               <input type="hidden" name="depot_lat" id="sourceLat" onchange="myFunction()" >
                               <input type="hidden" name="depotLoc" id="depotLoc">
                            </div>
                             <div class="form-group">
                                 <label for="occupation">Status:</label>
                                  @if($depotLoc->status == 0)
                                  <select class="form-select form-control" aria-label="Default select example" name="status" >
                                    <option value="0" selected class="form-control">Inactive</option>
                                    <option value="1" class="form-control">Active</option>
                                  </select>
                                  @elseif($depotLoc->status == 1)
                                  <select class="form-control" aria-label="Default select example" name="status">
                                    <option value="1" selected class="form-control">Active</option>
                                    <option value="0" class="form-control">InActive</option>
                                  </select>
                                   @endif
                                </div>
                            <button type="submit" class="btn btn-success mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="geocoder"></div>
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
        $("div#geocoder input.mapboxgl-ctrl-geocoder--input").attr('placeholder','{{$depotLoc->depot_location}}');
    });
    // SET PLACEHOLDER
    mapboxgl.accessToken = '{{env("MAPBOX_ACCESS_TOKEN")}}';
    var mymap = L.map('mapid');
    var circle;
    setLayer(36.169090,-115.140579);
    function onMapClick(e) {
        alert("You clicked the map at " + e.latlng);
    }
 
    // POPUP COORDINATES ON MAP
    var popup = L.popup();
    function onMapClick(e) {
        console.log(features);
        popup
            .setLatLng(e.latlng)
            .setContent(features)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(mymap);
    }
    mymap.on('click', onMapClick);
    // POPUP COORDINATES ON MAP
    // GET COORDINATES FROM GEOCODER
    const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        types: 'country,region,place,postcode,locality,neighborhood'
    });
    geocoder.setBbox([-171.791110603, 18.91619, -66.96466, 71.3577635769]);
    geocoder.addTo('#geocoder');
    const results = document.getElementById('result');
    geocoder.on('result', (e) => {
        var depotLoc=e.result.place_name;
        console.log(e.result);
        var long=e.result.geometry.coordinates[0];
        var lat=e.result.geometry.coordinates[1];
        $('#sourceLong').val(long);
        $('#sourceLat').val(lat);
        $('#depotLoc').val(depotLoc);
        setLayer(lat, long);
    });
    geocoder.on('clear', () => {
        results.innerText = '';
    });
      var depotLong=$('#depotLong').val();
    var depotLat=$('#depotLat').val();
    setLayer(depotLat, depotLong);
    // GET COORDINATES FROM GEOCODER
    function setLayer(lat, long) {
        mymap.eachLayer(function (layer) {
            mymap.removeLayer(layer);
        });
        mymap.setView([lat, long], 12);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={{env("MAPBOX_ACCESS_TOKEN")}}', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mymap);
        var marker=L.marker([lat, long]).addTo(mymap);
        circle = L.circle([lat, long],1000, {
          fillColor: 'green',
          fillOpacity: 0.5
        }).addTo(mymap);
    }
    function changeRadius() {
        var radius= $('#radius').val();
        var distanceInKilometer=radius*1609;
      circle.setRadius(distanceInKilometer)
    }
    $(function () {
        $('#myTable').DataTable();
    });
    @if($depotLoc->radius)
    $(document).ready(function(){
        changeRadius();
    });
    @endif
</script>
@endpush
