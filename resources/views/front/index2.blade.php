<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <link href="fontawesome5/css/all.min.css" rel="stylesheet">
    <link href="slick/slick-theme.css" rel="stylesheet" type="text/css">
    <link href="slick/slick.css" rel="stylesheet" type="text/css">
    <link href="css/slicknav.css" rel="stylesheet" type="text/css">
    <link href="css/fancybox.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>
   
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
    <link href="https://api.mapbox.com/mapbox-assembly/v1.3.0/assembly.min.css" rel="stylesheet">
    <script id="search-js" defer="" src="https://api.mapbox.com/search-js/v1.0.0-beta.14/web.js"></script>
 
  <style>
     body { margin: 0; padding: 0; }
    #map { position: absolute; top: 0; bottom: 0; width: 100%; }
  #geocoder {
  z-index: 1;
  /*margin: 20px;*/
  }
  path {
    display: none;
}
  .mapboxgl-ctrl-geocoder {
  min-width: 100%;
  }
  .mapboxgl-ctrl-geocoder {
    min-width: 100%;
    background: #242424;
    /*margin-left: -20px;*/
}
pre{
  display: none !important;
}
  </style>

    <title>Home</title>
  </head>
  <body class="back">
    <?php
    session_start();
    if(isset($_SESSION['success']))
    {?>
      <div>
        <?php 
        echo '<script type="text/javascript">';
        echo ' alert("Form Submitted Successfully !")';  //not showing an alert box.
        echo '</script>';
        ?>
      </div>
      <?php
      session_destroy();
    }
  ?>
    <section class="form-wrap">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-11 col-sm-10 col-md-10 col-lg-10 col-xl-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
              <form id="msform" action="indexAction.php" method="POST">

                <input type="hidden" id="date" name="pickup_date">
                <input type="hidden" id="form_distance" value="" name="distance">
                <input type="hidden" id="form_price" name="price" value="">
                <input type="hidden" name="source" id="sourceLocation" value="">
                <input type="hidden" name="destination" id="destinationLocation" value="">
                <input type="hidden" name="" id="sourceLong" value="">
                <input type="hidden" name="" id="sourceLat" value="">
                <input type="hidden" name="" id="destinationLong" value="">
                <input type="hidden" name="" id="destinationLat" value="">
                <!-- progressbar -->
                <ul id="progressbar">
                  <li class="active" id="account">
                    <strong>Select Route </strong>
                  </li>
                  <li id="personal">
                    <strong>estimated price </strong>
                  </li>
                  <li id="payment">
                    <strong>Personal Information </strong>
                  </li>
                </ul>
                <br>
                <!-- fieldsets -->
                <fieldset>
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Select a Route</button>
                    </li>
                   <!--  <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Track a Shipment</button>
                    </li> -->
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                      <div class="form-card">
                        <div class="row">
                          <div class="col-7">
                            <h2 class="fs-title">Car Shipping Cost</h2>
                          </div>
                          <div class="col-5"></div>
                        </div>
                          <div type="text"  id="geocoderr"  placeholder="From (ZIP or City, State)"></div>
                          <pre id="resultt"></pre>
                        <span class="text-danger" id="sourceError"></span>
                          <div type="text"  id="geocode" ></div>
                          <pre id="result"></pre>
                        <span class="text-danger" id="destinationError"></span>

                   
                        <div class="drop-down" >
                          <div class="selected" id="date-drop-down">
                            <a href="#">
                              <span>Within 7 days</span>
                            </a>
                          </div>
                          <div class="options">
                            <ul>
                              <li>
                                <a href="#">As soon as possible <span class="value"><input type="text"  value="As soon as possible"></span>
                                </a>
                              </li>
                              <li>
                                <a href="#">Within 7 days <span class="value"><input type="text"  value="Within 7 days"></span>
                                </a>
                              </li>
                              <li class="on-particular">
                                <a href="#">On a particular date <span class="value"><input type="text"  value="On a particular date"></span>
                                </a>
                              </li>
                              <li>
                                <a href="#">I don't know yet <span class="value"><input type="text"  value="I don't know yet"></span>
                                </a>
                              </li>
                            </ul>
                            <section class="calendar">
                              <div class="circle left"></div>
                              <div class="circle right"></div>
                              <div class="rope left"></div>
                              <div class="rope right"></div>
                              <div class="currentDateDisplay">
                                <p id="monthAndDate">Month Day, year</p>
                                <p id="dayOfWeek">Weekday</p>
                              </div>
                              <div id="datepicker"></div>
                              <div class="datepicker-header"></div>
                              <p class="bgText">Test</p>
                            </section>
                          </div>
                        </div>
                        <span class="text-danger" id="dateError"></span>
                      </div>
                      <!-- <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                      <input type="button" name="next" class="next action-button" value="Continue" />
                    </div>
                    <!-- <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                      <div class="form-card">
                        <div class="row">
                          <div class="col-7">
                            <h2 class="fs-title">Order Details</h2>
                          </div>
                          <div class="col-5"></div>
                        </div>
                        <label>Email Address</label>
                        <input type="Email" name="fname" placeholder="Your Email Address" />
                        <label>Order Detail</label>
                        <input type="text" name="lname" placeholder="Your name or order number" />
                      </div>
                      <input type="button" name="next" class="next action-button" value="Next" />
                      
                    </div> -->
                  </div>
                </fieldset>
                <fieldset>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="price-box form-cate">
                      <h3>From</h3>
                        <h5 id="fromSource">Victorville, CA</h5>
                    </div>
                    <div class="price-box form-cate">
                      <h3>To</h3>
                        <h5 id="toDestination">Dallas, TX</h5>
                    </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="price-box form-cate">
                      <h3>Mileage</h3>
                        <h5><span id="distance"></span>M</h5>
                    </div>
                    <div class="price-box form-cate">
                     <h3>price </h3>
                        <h5>$<span id="price"></span></h5>
                    </div>
                    </div>
                  </div>
                  <!-- <input type="button" name="next" class="next action-button" value="Submit" /> -->
                  <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                  <input type="button" name="next" class="next action-button" value="Continue" />
                </fieldset>
               

                  <fieldset>
                  <div class="row form-fold">
                    <div>
                      <input type="text" name="name" id="name" placeholder="Name">
                      <span class="text-danger" id="nameError"></span>
                      <input type="text" name="email" id="email" placeholder="Email">
                      <span class="text-danger" id="emailError"></span>
                      <input type="number" name="phone" id="phone" placeholder="Phone">
                      <span class="text-danger" id="phoneError"></span>
                    </div>
                  </div>
                  <!-- <input type="button" name="next" class="next action-button" value="Submit" /> -->
                 <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                  <button type="submit" name="submitBtn" class="action-button" id="makeCall">make a call</button>
                  <a class="action-button" href="mailto:xyz@gmail.com">Send email</a>
                </fieldset>
                  
                
              </form>
            </div>
          </div>
            <div class="col-3 pl-5">
            <div class="cal-summary">
              <h2 class="text-center pt-3">Route Details</h2>
              <span>From</span>
              <p class="from">From (ZIP or City, State)</p>
              <span>To</span>
              <p class="to">To (ZIP or City, State)</p>
              <span>Date</span>
              <p class="date">Selected Date</p>
              <span>Mileage</span>
              <p class="mileage">Distance in Miles</p>
              <span>Price</span>
              <p class="price">Price</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="slick/slick.js"></script>
    <script src="slick/slick.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/fancybox.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>
    <script src="fontawesome5/font-awesomejs/font.js"></script>>
     <script>
  mapboxgl.accessToken = 'pk.eyJ1IjoiaG1teTAwOTAiLCJhIjoiY2xmMWphbXQ2MDh4bzNycG5oaWFiZHUyeSJ9.cBsno5qtztVrViXKueIr5Q';
const geocoder = new MapboxGeocoder({
accessToken: mapboxgl.accessToken,
types: 'country,region,place,postcode,locality,neighborhood',
});
geocoder.setBbox([-171.791110603, 18.91619, -66.96466, 71.3577635769]);
geocoder.addTo('#geocoderr');
 
// Get the geocoder results container.
const results = document.getElementById('resultt');
 
// Add geocoder result to container.
geocoder.on('result', (e) => {
results.innerText = JSON.stringify(e.resultt, null, 2);
var sourceLongitude=e.result.geometry.coordinates[0];
var sourceLatitude=e.result.geometry.coordinates[1];
$('#sourceLong').val(sourceLongitude);
$('#sourceLat').val(sourceLatitude);

dd();

});
 
// Clear results container when search is cleared.
geocoder.on('clear', () => {
results.innerText = '';
});
</script>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiaG1teTAwOTAiLCJhIjoiY2xmMWphbXQ2MDh4bzNycG5oaWFiZHUyeSJ9.cBsno5qtztVrViXKueIr5Q';
const geocode = new MapboxGeocoder({
accessToken: mapboxgl.accessToken,
// center: [-122.25948, 37.87221],
types: 'country,region,place,postcode,locality,neighborhood'
});
geocode.setBbox([-171.791110603, 18.91619, -66.96466, 71.3577635769]);
geocode.addTo('#geocode');
 
// Get the geocode results container.
const resultss = document.getElementById('result');
 
// Add geocode result to container.
geocode.on('result', (e) => {
results.innerText = JSON.stringify(e.result, null, 2);
var destinationLong=e.result.geometry.coordinates[0];
var destinationLat=e.result.geometry.coordinates[1];
$('#destinationLong').val(destinationLong);
$('#destinationLat').val(destinationLat);
dd();
});

 
// Clear results container when search is cleared.
geocode.on('clear', () => {
resultss.innerText = '';
});
</script>
  <script type="text/javascript">

// Autocomplete Address
const ACCESS_TOKEN = 'pk.eyJ1IjoiaG1teTAwOTAiLCJhIjoiY2sza3I1dHp2MG41MDNnbjR1MmViaHJ2aCJ9.gEf6RrLwMe_kUPMrkuOX0Q';
 
const script = document.getElementById('search-js');
script.onload = () => {
const elements = document.querySelectorAll('mapbox-address-autofill');
for (const autofill of elements) {
autofill.accessToken = ACCESS_TOKEN;
}
};
// Autocomplete Address

  // $('.location').on('change',function(){
  //     var settings = {
  //     "url": "https://api.mapbox.com/geocoding/v5/mapbox.places/Los%20Angeles.json?access_token=pk.eyJ1IjoiaG1teTAwOTAiLCJhIjoiY2sza3I1dHp2MG41MDNnbjR1MmViaHJ2aCJ9.gEf6RrLwMe_kUPMrkuOX0Q",
  //     "method": "GET",
  //     "timeout": 0,
  //     "headers": {
  //           "Content-Type": "application/json"
  //      },
  //       };

  //       $.ajax(settings).done(function (response) {
  //           console.log(response.features[0].geometry.coordinates[1]);
  //           console.log(response.features[0].geometry.coordinates[0]);

  //       });

  //     });



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
  var a = $('#sourceLat').val();
  var b = $('#sourceLong').val();
  var c = $('#destinationLat').val();
  var d = $('#destinationLong').val();
  if(a != '' && b != '' && c != '' && d != ''){
    $distance=Math.round(distance(a,b,c,d, "M"));
    $('#distance').text($distance);
    $('#price').text($distance);
  }
};

  </script>

  </body>
</html>