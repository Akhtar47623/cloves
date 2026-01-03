    @extends('layouts.front.app')
    @section('title', 'About')
    <style type="text/css">
        ul{
            justify-content: center;
        }
            .about-certifications-text p{
                justify-content: center;
            }
            section.areas-we-surve:after{
                background-image:url("{{asset($location_cms->image_path)}}");
            }
    </style>
    @section('content')
    <!-- banner start -->
    <section class="main_slider inr">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset($banner->image_path)}}" class="img-fluid" alt="...">
                <div class="carousel-caption">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="banner-text iner">

                                    <h4 class="btn-shine ">{{$banner->heading}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroldwn inr">
            <a href="#abt"><img src="{{asset('web-assets/images/mouse.png')}}" alt="">
                <p>Scroll Down</p>
            </a>
        </div>
    </section>
    <!-- banner end -->

    <!-- About Us Start -->

    <section id="abt">
        <div class="-inner-about-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-about-img">
                            <img src="{{asset($about_us_cms->image_path)}}" align="img">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-about-text">
                            <h2>{{$about_us_cms->title}}</h2>
                            <p>{!!$about_us_cms->description!!}

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="inner-about-sec-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-about-text-2">
                            <h2>{{$about_work_cms->title}}</h2>
                            {!!$about_work_cms->description!!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-about-img-2">
                            <img src="{{asset($about_work_cms->image_path)}}" align="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="about-certifications">
            <div class="container">
                <div class="row">
                        <div class="about-certifications-heading">
                            <h2>{{$memberships_cms->title}}</h2>
                        </div>
                        <div class="col-lg-3"></div>
                    <div class="col-lg-6 col-md-12 col-sm-12 justify-content-center">
                        @foreach($membership as $key => $member)
                        <div class="about-certifications-text">
                            <h3>0{{$key+1}}</h3>
                            <p>{{$member->description}}<span><a href="{{$member->link}}" target="_blank">{{$member->link}}</a></span>
                            </p>
                        </div>
                        <div class="col-lg-3"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us End -->
    <!-- areas we surve start -->
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
                    <!--     <div class="col-lg-6 col-md-6">
                             <div class="excel-sample">
                                <a class="float-right offset-8 text-white" href="{{asset('uploads/admin/Doc/orders.xlsx')}}" download=""><i class="fa-solid fa-cloud-arrow-down"></i>Download Form</a> 
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
            </div>
        </div>
    </section> 
    @include('layouts.front.template.footer')
    @endsection
