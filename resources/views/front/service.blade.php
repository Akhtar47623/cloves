    @extends('layouts.front.app')
    @section('title','Service')
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
            <a href="#srvs"><img src="{{asset('web-assets/images/mouse.png')}}" alt="">
                <p>Scroll Down</p>
            </a>
        </div>
    </section>
    <!-- banner end -->
    <section id="srvs">
        <div class="iner-services-sec">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="iner-services-heading">
                    <h2>{{$services_content->title}}</h2>
                            <p>{{$services_content->description}}</p>
                        </div>
                    </div>
                </div>
                <div class="iner-ser-images-text-row">
                    <?php 
                        foreach ($services as $key => $service) {
                            echo '<div class="row">';
                            $i=0;
                        foreach ($service as $key1 => $value) {
                            if($key%2==0){
                                if($i==0){
                                echo '
                                <div class="col-lg-6 col-sm-12">
                                <div class="iner-services-img">
                                    <img src='.asset($service->image1).' align="img" class="rounded-circle">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="iner-services-text">
                                    <h2>'.$service->title.'</h2>
                                    <p>'.$service->long_description.'</p>
                                </div>
                            </div>';
                            }
                        }
                            else if($i==0){
                                echo'
                                <div class="col-lg-6 col-sm-12">
                                <div class="iner-services-text">
                                    <h2>'.$service->title.'</h2>
                                    <p>'.$service->long_description.'</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="iner-services-img">
                                    <img src='.asset($service->image1).' align="img" class="rounded-circle">
                                </div>
                            </div>';

                            }
                        $i++;
                        }

                            echo'</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
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
                  <!--       <div class="col-lg-6 col-md-6">
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