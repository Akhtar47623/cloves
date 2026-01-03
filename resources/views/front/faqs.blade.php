    @extends('layouts.front.app')
    @section('title', 'FAQS')
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
            <a href="#fq"><img src="{{asset('web-assets/images/mouse.png')}}" alt="">
                <p>Scroll Down</p>
            </a>
        </div>
    </section>
    <!-- banner end -->
    <!-- FAQ PAGE STRT -->
    <section class="faq_page" id="fq">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <h6>{{$faqs_cms->title}}</h6>
                    <div class="faq_wrap">
                        <div class="accordion" id="accordionExample">
                            @foreach($faqs as $key => $faq)
                            <div class="accordion-item active_ac ">
                                <h2 class="accordion-header" id="heading{{$key}}">
                                    <button class="accordion-button {{($key>0)?'collapsed':''}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="{{($key==0)?'true':'false'}}" aria-controls="collapse{{$key}}">
                                        {{$faq->question}}
                                    </button>
                                </h2>
                                <div id="collapse{{$key}}" class="accordion-collapse collapse {{($key==0)?'show':''}}" aria-labelledby="heading{{$key}}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>{{$faq->answer}} </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="faqs-btn">Load More <i class="fa-solid fa-arrow-down"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ PAGE END -->
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
     