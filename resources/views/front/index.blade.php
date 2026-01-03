    @extends('layouts.front.app')
    @section('title', 'Home')
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.css" type="text/css" />
    <link href="https://api.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.css" rel="stylesheet" />
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
    <link
      rel="stylesheet"
      href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css"
      type="text/css"
    />
    <style type="text/css">
        body { margin: 0; padding: 0; }
        #map { position: absolute; top: 0; bottom: 0; width: 100%; };
        section.services:after{
            background-image: url("{{ asset($services_cms->image_path) }}") 
        }
        section.faqs{
        background-image: url("{{asset($faqs_cms->image_path)}}");
        }
        section.areas-we-surve:after{
            background-image:url("{{asset($location_cms->image_path)}}");
        }
        section.faqs .accordion-item {
            background: transparent;
            border: none !important;
        }
       div#map {
            height: 70vh;
            position: relative;
            top: -70px;
        }
        .mapboxgl-ctrl-directions {
            
            min-width: 300px !important;
            
        }
        div#mapbox-directions-destination-input {
            display: none;
        }

        .mapbox-directions-destination {
            display: none;
        }

        button.directions-icon.directions-icon-reverse.directions-reverse.js-reverse-inputs {
            display: none;
        }
        .fel-fre-contct ul li {
            font-size: 15px !important;
        }
        .fel-fre-contct ul{
            width: 99% !important;
        }
    </style>
    @yield('css')
    @section('content')
    <!-- banner start -->
    <section class="main_slider">
        <div id="carouselExampleControls" class="carousel slide " data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach($banners as $key => $banner)
                <div data-bs-target="#carouselExampleControls" data-bs-slide-to="{{$key}}" class="{{($key==0)?'active':''}}" aria-current="true" aria-label="Slide {{$key+1}}"><span> 0{{$key+1}}</span></div>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach($banners as $key => $banner)
                <div class="carousel-item {{($key==0)?'active':''}}" >
                    <img src="{{asset($banner->image_path)}}" class="img-fluid" alt="..." style="height:988px;">
                    <div class="carousel-caption inr">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-7 offset-lg-5">
                                    <div class="banner-text wow fadeInRight">
                                        <h3 class="btn-shine "><?= wordwrap($banner->title,35,"<br>");?> </h3>
                                        <p>{{$banner->description}}</p>
                                        <div class="undr-banr">
                                            <div class="sml-imgs">
                                                @if($banner->image1 !=null)
                                                <img src="{{asset($banner->image1)}}" alt="">
                                                @endif
                                                @if($banner->image2 !=null)
                                                <img src="{{asset($banner->image2)}}" alt="">
                                                @endif
                                                @if($banner->image3 !=null)
                                                <img src="{{asset($banner->image3)}}" alt="">
                                                @endif
                                                @if($banner->image4 !=null)
                                                <img src="{{asset($banner->image4)}}" alt="">
                                                @endif
                                            </div>
                                           <p class="offset-2">{{$banner->testimonial_title}}<span><i class="fa-solid fa-star"></i> {{$banner->rating}} &nbsp; ({{$banner->reviews}} Reviews)</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($banner->image5 != null )
                    <img src="{{asset($banner->image5)}}" class="abs-bnr" alt="">
                    @endif
                </div>
                @endforeach
            <div class="scroldwn">
                <a href="#abt"><img src="{{asset('web-assets/images/mouse.png')}}" alt="">
                    <p>Scroll Down</p>
                </a>
            </div>
        </div>

    </section>
    <!-- banner end -->
    <!-- about start -->
    <section class="about" id="abt">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-txt wow bounceInLeft">
                        <h4>{{$about_sec->title}}</h4>
                        {!!$about_sec->description!!}
                        <a href="{{route('webRequestPage')}}" class="theme_btn">{{$about_sec->button1}}</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-img wow bounceInRight">
                        <img src="{{asset($about_sec->image2)}}" alt="" class="middle">
                        <img src="{{asset($about_sec->image3)}}" class="abt-top" alt="">
                        <img src="{{asset($about_sec->image1)}}" class="abt-btm" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about end -->
    <!-- servs start -->
    <section class="services">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="srvs-hed wow bounceInDown">
                    <h3>{{$services_cms->title}}</h3>
                    <p>{{$services_cms->description}}</p>
                </div>
                @foreach($services as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="srvs-bx wow bounceInLeft">
                        <div class="srvs-img">
                            <img src="{{asset($service->image_path)}}" alt="">
                        </div>
                        <div class="service-content">
                            <h5>{{ $service->title}}</h5>
                            {!! $service->description!!}
                        </div>
                        <a href="{{route('webServicePage')}}">read more</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- servs end -->

    <!-- why chose start -->
    <section class="why-chose">
        <div class="container">
            <div class="row">
                <div class="why-chose-hed wow bounceInUp">
                    <h4>{{$choose_us_cms->title}}</h4>
                    <p>{{$choose_us_cms->description}}
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="why-chose-bx one wow bounceInLeft">
                                <div class="why-img">
                                    <img src="{{asset($choose_us_cms->image_path)}}" alt="">
                                    <span>01</span>
                                </div>
                                <div class="why-txt">
                                    <h6>{{$choose_us_cms->title1}}</h6>
                                    <p>{{$choose_us_cms->text1}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="why-chose-bx two wow bounceInDown">
                                <div class="why-txt">
                                    <h6>{{$choose_us_cms->title2}}</h6>
                                    <p>{{$choose_us_cms->text2}}</p>
                                </div>
                                <div class="why-img">
                                    <img src="{{asset($choose_us_cms->image1)}}" alt="">
                                    <span>02</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="why-chose-bx lg wow bounceInRight">
                        <div class="why-img large">
                            <img src="{{asset($choose_us_cms->image2)}}" alt="">
                            <span>03</span>
                        </div>
                        <div class="why-txt">
                            <h6>{{$choose_us_cms->title3}}</h6>
                            <p>{{$choose_us_cms->text3}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- why chose end -->

    <!-- faqs satrt -->
    <section class="faqs">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="faqs-txt wow bounceInLeft">
                        <h3>{{$faqs_cms->title}}</h3>
                        <p>{{$faqs_cms->description}}</p>
                        <a href="{{route('webFaqsPage')}}" class="theme_btn">{{$faqs_cms->button1}}</a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="faqs-acordian">
                        <div class="accordion" id="accordionExample">
                            @foreach($faqs as $key => $faq)
                            <div class="accordion-item active_ac ">
                                <h2 class="accordion-header" id="heading{{$key}}">
                                    <button class="accordion-button {{($key==0)?'collapsed':''}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="{{($key==0)?'true':'false'}}" aria-controls="collapse{{$key}}">
                                        {{$faq->question}}
                                    </button>
                                </h2>
                                <div id="collapse{{$key}}" class="accordion-collapse collapse {{($key<0)?'show':''}}" aria-labelledby="heading{{$key}}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>{{$faq->answer}} </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- faqs end -->

    <!-- contact satrt -->
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="request-srvs wow fadeInLeft">
                        <h3>Request Delivery Service</h3>
                        <form action="{{route('contactFormPage')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" placeholder="John" value="{{old('first_name')}}">
                                    @error('first_name')
                                    <span class="text-danger px-3">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" placeholder="Doe" value="{{old('last_name')}}">
                                    @error('last_name')
                                    <span class="text-danger px-3">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label>Pharmacy Name/Organization</label>
                                    <input type="text" name="organization" placeholder="Pharmacy Name/Organization" value="{{old('organization')}}">
                                    @error('organization')
                                    <span class="text-danger px-3">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label>Title</label>
                                    <input type="text" name="title" placeholder="Title" value="{{old('title')}}">
                                    @error('title')
                                    <span class="text-danger px-3">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label>Email Address</label>
                                    <input type="email" name="email" placeholder="info@example.com" value="{{old('email')}}">
                                    @error('email')
                                    <span class="text-danger px-3">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label>Phone Number </label>
                                    <input type="text" name="phone"  id="phone" placeholder="+123 456 7890" value="{{old('phone')}}">
                                    @error('phone')
                                    <span class="text-danger px-3">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <label>Message </label>
                                    <input type="text" name="message" placeholder="Your Message" value="{{old('message')}}">
                                    @error('message')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <button type="submit" class="theme_btn">Submit Now <i class="fa-solid fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fel-fre-contct wow fadeInRight">
                        <h3>Feel Free To Contact Us</h3>
                        <a href="tel:{{returnFlag(52)}}">
                            <ul>
                                <li><img src="{{asset('web-assets/images/phone.png')}}" alt=""></li>
                                <li>Phone: <span>{{returnFlag(52)}}</span></li>
                            </ul>
                        </a>
                        <a href="mailto:{{returnFlag(50)}}">
                            <ul>
                                <li><img src="{{asset('web-assets/images/envelope.png')}}" alt=""></li>
                                <li>Email: <span>{{returnFlag(50)}}</span></li>
                            </ul>
                        </a>
                        <a>
                            <ul>
                                <li><img src="{{asset('web-assets/images/location.png')}}" alt=""></li>
                                <li>Address: <span>{{returnFlag(56)}}</span></li>
                            </ul>
                        </a>
                        <div class="map-wrap">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact end -->

    <!-- areas we surve start -->
        <div class="container">
            <div id="map"></div>
        </div>
    <section class="areas-we-surve">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <h3>{{$location_cms->title}}</h3>
                </div>
                <div class="col-lg-6">
                    <div class="tags wow bounceInRight">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <!-- <ul>   -->
                                <?php
                                    $i=0;
                                     for($k=0; $k<=3; $k++) {
                                        if($i%3==0){
                                            echo '<ul>';
                                        }
                                        if($i==0){
                                        echo '<li><span class="red"></span>'.$location_cms->title1.'</li>';
                                        }
                                        if($i==1){
                                        echo '<li><span class="yelw"></span>'.$location_cms->title2.'</li>';
                                        }
                                        if($i==2){
                                        echo '<li><span class="ltblue"></span>'.$location_cms->title3.'</li>';
                                        }
                                        $i++;
                                    }
                                ?>
                            </div>
                            <div class="col-lg-6 col-md-6"> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- areas we surve end -->

    <!-- certifications start -->
    <section class="certifications">
        <div class="container-fluid">
            <div class="row">
                <h3 class="wow bounceInDown">{{$memberships_cms->title}}</h3>
                @foreach($membership as $key => $member)
                <div class="col-lg-6">
                    <ul class="member-ul">
                        <li>0{{$key +1}}</li>
                        <li>{{$member->description}} &nbsp;<span><a href="{{$member->link}}" target="_blank">{{$member->link}}</a></span> <img src="{{asset($member->image_path)}}"
                                alt=""></li>
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="partner">
                    <h3>{{$partner_cms->title}}</h3>
                    <a href="http://www.riverside-chamber.com/"><img src="{{asset($partner_cms->image_path)}}" alt=""></a>
                </div>
            </div>
        </div>
    </section>
    <!-- certifications end -->
    <section class="upload wow bounceIn">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 centerCol">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="upload-txt">
                                <h3>{{$document_cms->title}}</h3>
                                <p>{{$document_cms->description}}</p>
                            </div>
                        </div>
                      <!--   <div class="col-lg-6 col-md-6">
                            <div class="excel-sample">
                                <a class="float-right offset-8 text-white" href="{{asset('uploads/admin/Doc/orders.xlsx')}}" download=""><i class="fa-solid fa-cloud-arrow-down"></i>Download Form</a> 
                            </div>
                             <form action="{{ route('import') }}" method="POST" id="doc" enctype="multipart/form-data">
                                @if (count($errors) > 0)
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-1">
                                      <div class="alert alert-danger alert-dismissible">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                          <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                          @foreach($errors->all() as $error)
                                          {{ $error }} <br> 
                                          @endforeach      
                                      </div>
                                    </div>
                                </div>
                                @endif
                                @error('first_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
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
            </div>
        </div>
    </section> 
    @include('layouts.front.template.footer')
    @endsection
    @push('js')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="{{asset('web-assets/js/map.js')}}"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.js"></script>
       <script>
            mapboxgl.accessToken = 'pk.eyJ1IjoiaG1teTAwOTAiLCJhIjoiY2xnemhjeTFwMGp2aTNocGNhem9yZmtxciJ9.1-LQYY0UV1kCuF5qURnPCA';
   const map = new mapboxgl.Map({
    container: 'map', // Container ID
    style: 'mapbox://styles/mapbox/streets-v12', // Map style to use
    center: [-115.1803006,36.1716252], // Starting position [lng, lat]
    zoom: 12, // Starting zoom level
  });

      map.on('load', () => {
        const geocoder = new MapboxGeocoder({
          accessToken: mapboxgl.accessToken,
          mapboxgl: mapboxgl,
          zoom: 13,
          placeholder: 'Enter an address or place name',
            types: 'country,region,place,postcode,locality,neighborhood',
          bbox: [-171.791110603, 18.91619, -66.96466, 71.3577635769]
        });

        map.addControl(geocoder, 'top-left');

        const marker = new mapboxgl.Marker({
          'color': '#008000'
        });

        // geocoder.on('result', async (event) => {
          // const point = event.result.center;
          // const tileset = 'examples.dl46ljcs';
          // const radius = 1609*20;
          // const limit = 50;
          // marker.setLngLat(point).addTo(map);
          // const query = await fetch(
          //   `https://api.mapbox.com/v4/${tileset}/tilequery/${point[0]},${point[1]}.json?radius=${radius}&limit=${limit}&access_token=${mapboxgl.accessToken}`,
          //   { method: 'GET' }
          // );
          // const json = await query.json();
          // map.getSource('tilequery').setData(json);
        // });

        // map.addSource('tilequery', {
        //   type: 'geojson',
        //   data: {
        //     'type': 'FeatureCollection',
        //     'features': [
              // {
              //   type: 'Feature',
              //   geometry: {
              //     type: 'Point',
              //     coordinates: [-115.3118723,36.115658]
              //   },
              //   properties: {
              //     title: 'Washington Pharma service provider',
              //     description: 'If your location is not fall inside our radius than contact us directly to admin'
              //   }
              // },
              // {
              //   type: 'Feature',
              //   geometry: {
              //     type: 'Point',
              //     coordinates: [-115.2237702, 36.1303178]
              //   },
              //   properties: {
              //     title: 'San Francisco, California',
              //     description: 'If your location is not fall inside our radius than contact to your admin!'
              //   }
              // }
              {!!$feature!!}
        //     ]
        //   }
        // });
       // map.on('mouseenter', 'tilequery-points', (event) => {
       //    map.getCanvas().style.cursor = 'pointer';
       //    const properties = event.features[0].properties;
       //    const popup = new mapboxgl.Popup({ closeOnClick: false })
       //    .setLngLat([event.lngLat.lng,event.lngLat.lat])
       //    .setHTML(`<h5>${properties.title}</h5><p>${properties.description}</p>`)
       //    .addTo(map);
       //    map.on('mouseleave', 'tilequery-points', () => {
       //    map.getCanvas().style.cursor = '';
       //    popup.remove();
       //  });
       //  });

       {!!$pointer!!}

        // map.addLayer({
          // id: 'tilequery-points',
          // type: 'circle',
          // source: 'tilequery',
          // paint: {
          //  "circle-radius": [
          //   "interpolate", ["exponential", 2], ["zoom"],
          //     5, 1,15, 2000
          // ],
          // 'circle-color': 'green',
          // 'circle-stroke-color': 'blue',
          // 'circle-stroke-width': 1,
          // 'circle-opacity': 0.3
          // },
          {!!$radius!!}
        // });

        // map.on('mouseenter', 'tilequery-points', (event) => {
        //   map.getCanvas().style.cursor = 'pointer';
        //   // const properties = event.features[0].properties;
        //   // const obj = JSON.parse(properties.tilequery);
        //   // const coordinates = new mapboxgl.LngLat(
        //   //   properties.longitude,
        //   //   properties.latitude
        //   // );
        //   console.log(event);  

        //   // const content = `<h3>${properties.STORE_NAME}</h3><h4>${
        //   //   properties.STORE_TYPE
        //   // }</h4><p>${properties.ADDRESS_LINE1}</p><p>${(
        //   //   obj.distance / 1609.344
        //   // ).toFixed(2)} mi. from location</p>`;

        //   // popup.setLngLat(coordinates).setHTML(content).addTo(map);
        // });
          // map.addLayer({
          // id: 'unclustered-point',
          // type: 'circle',
          // source: 'tilequery',
          // filter: ['!', ['has', 'point_count']],
          // paint: {
          // 'circle-color': 'red',
          // 'circle-radius': 4,
          // 'circle-stroke-width': 1,
          // 'circle-stroke-color': '#fff'
          // }
          // });
          {!!$dot!!}

        
      });
        </script>
       <script type="text/javascript">
     new Cleave('#phone', {
            numericOnly:true,
            // prefix:'+',
            delimiter:'-',
            blocks:[3,3,4]
        });
     </script>
     <script type="text/javascript">
        $(document).ready(function(){
        @if(count($errors) > 0)
            $('html, body').animate({scrollTop:4600},'50');
             
        @endif
        });
    </script>
    @endpush
