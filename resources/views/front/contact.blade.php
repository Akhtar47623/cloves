    @extends('layouts.front.app')
    @section('title','Contact')
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
                                <div class="banner-text iner cntct">
                                    <h4 class="btn-shine ">{{$banner->heading}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroldwn inr">
            <a href="#cntct"><img src="{{asset('web-assets/images/mouse.png')}}" alt="">
                <p>Scroll Down</p>
            </a>
        </div>
    </section>
    <!-- banner end -->

    <!-- conatct us start -->
    <section class="contact-us" id="cntct">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="related_heading text-center">
                        <h2>{{$contact_cms->title}}</h2>                  
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <a href="https://goo.gl/maps/SmnaCJ9Cw7Xcfuv28">
                        <div class="contact-box">
                            <div class="con_icos">
                                <img src="{{asset('web-assets/images/icon-1.png')}}" class="contact-box-icon">
                            </div>
                            <h3>Address</h3>
                            <p>{{returnFlag(56)}}</p>
                            <div class="line"></div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="contact-box">
                        <div class="con_icos">
                            <img src="{{asset('web-assets/images/icon-2.png')}}" class="contact-box-icon">
                        </div>
                        <h3>Phones</h3>
                        <a href="tel:{{returnFlag(52)}}">{{returnFlag(52)}} - Office</a>
                        <a href="tel:{{returnFlag(54)}}">{{returnFlag(54)}} - Fax</a>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="contact-box">
                        <div class="con_icos">
                            <img src="{{asset('web-assets/images/icon-3.png')}}" class="contact-box-icon">
                        </div>
                        <h3>Email</h3>
                        <a href="mailto:{{returnFlag(50)}}">{{returnFlag(50)}}</a>
                        <a href="mailto:{{returnFlag(51)}}">{{returnFlag(51)}}</a>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="contact-box">
                        <div class="con_icos">
                            <img src="{{asset('web-assets/images/icon-4.png')}}" class="contact-box-icon">
                        </div>
                        <h3>Follow Us</h3>
                        <ul>
                            <li><a href="{{returnFlag(682)}}"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                            <li><a href="{{returnFlag(1960)}}"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="{{returnFlag(1963)}}"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                            <li><a href="{{returnFlag(60)}}"><i class="fab fa-google-plus-g" aria-hidden="true"></i></a></li>
                        </ul>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-form-1">
                        <h2>{{$contact_cms->title1}}</h2>

                    </div>
                </div>
            </div>
            <form class="contat-form" action="{{route('webContactPage')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-4 mt-4">
                        <label>Name</label>
                        <input type="text" name="name" value="{{old('name')}}" placeholder="Name">
                        @error('name')
                        <span class="text-danger error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 mt-4">
                        <label>Best Contact Number</label>
                        <input type="text" name="phone" id="phone" value="{{old('phone')}}" id="phone" placeholder="Best Contact Number">
                        @error('phone')
                        <span class="text-danger error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4 mt-4">
                        <label>Purpose of Contact</label>
                        <div class="slect-cat">
                            <select name="purpose">
                                <option disabled="" selected="">Select Purpose</option>
                                <option {{ (old('question') == 'Delivery Inquiry') ? 'selected' : '' }}>Delivery Inquiry</option>
                                <option {{ (old('question') == 'Support') ? 'selected' : '' }}>Support</option>
                                <option {{ (old('question') == 'Sales') ? 'selected' : '' }}>Sales</option>
                                <option {{ (old('question') == 'Billing') ? 'selected' : '' }}>billing</option>
                                <option {{ (old('question') == 'Other') ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('question')
                        <span class="text-danger error">{{$message}}</span>
                        @enderror
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-4">
                        <label>Address</label>
                        <input type="address" name="address" value="{{old('address')}}" placeholder="Address">
                        @error('address')
                        <span class="text-danger error">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12">

                        <label>Additional Information</label>
                        <textarea rows="7" name="message" placeholder="Additional Information">{{old('message')}}</textarea>
                    </div>
                </div>
                <div class="col-lg-12 text-center mt-2">
                    <button type="submit" class="theme_btn">Send Now</button>
                </div>
            </form>
        </div>
    </section>
    <!-- conatct us end-->
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
            $('html, body').animate({scrollTop:1250},'50');
             @endif
        });
    </script>
    @endpush