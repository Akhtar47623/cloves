    @extends('layouts.front.app')
    @section('title', 'Why Choose')
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
                                <div class="banner-text iner sml">
                                    <h4 class="btn-shine ">{{$banner->heading}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroldwn inr">
            <a href="#why"><img src="{{asset('web-assets/images/mouse.png')}}" alt="">
                <p>Scroll Down</p>
            </a>
        </div>
    </section>
    <!-- banner end -->
    <!-- why chose start -->
    <section class="why-chose-pg" id="why">
        <div class="container">
            <div class="row align-items-center">
                <h6>{{$choose_us_cms->title}}</h6>
            </div>
            <?php 
                $j=1;
                foreach ($why_choose_us as $key => $choose) {
                    $i=0;
              
                    echo '<div class="row align-items-center rv">';
                    foreach ($choose as $key1 => $value) {
                        if($key%2==0){
                            if($i==0){
                                echo '
                                <div class="col-lg-5">
                                    <div class="pg-img">
                                        <img src='.asset($choose->image_path).' alt="">
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="pg-txt ">
                                        <span>0'.$j.'</span>
                                        <h6> '.$choose->title.'</h6>
                                        <p>'.$choose->description.'</p>
                                    </div>

                                </div>';
                            }
                            }
                            else if($i==0){
                                 echo'<div class="col-lg-7">
                                    <div class="pg-txt two">
                                        <span>0'.$j.'</span>
                                        <h6> '.$choose->title.'</h6>
                                        <p>'.$choose->description.'</p>
                                    </div>

                                </div>
                                <div class="col-lg-5">
                                    <div class="pg-img two">
                                        <img src='.asset($choose->image_path).' alt="">
                                    </div>
                                </div>';       
                            }
                        $i++;
                    }
                    echo '</div>';
                    $j++;
                }
            ?>
        </div>
    </section>
    <!-- why chose end -->
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
                       <!--  <div class="col-lg-6 col-md-6">
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