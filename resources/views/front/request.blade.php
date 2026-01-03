    @extends('layouts.front.app')
    @section('title', 'Request')
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
                                <div class="banner-text iner  rqst ">
                                    <h4 class="btn-shine fnt-sml">{{$banner->heading}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroldwn inr">
            <a href="#rqst"><img src="{{asset('web-assets/images/mouse.png')}}" alt="">
                <p>Scroll Down</p>
            </a>
        </div>
    </section>
    <!-- banner end -->
    <!-- request satrt -->
    <section class="request" id="rqst">
        <div class="container">
            <form action="{{route('webRequestPage')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <label>Name</label>
                        <input type="text" name="name" value="{{old('name')}}" placeholder="Name">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <br>
                    </div>
                    <div class="col-lg-6">
                        <label>Pharmacy Name</label>
                        <input type="text" name="pharmacy_name" id="pharmacy_name" value="{{old('pharmacy_name')}}" placeholder="Pharmacy Name">
                        @error('pharmacy_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-lg-12 mt-3">
                        <label>Address</label>
                        <input type="text" name="address" value="{{old('address')}}" placeholder="Address">
                          @error('address')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6 mt-3">
                        <label>Best Contact Number</label>
                        <input type="text" name="phone" id="phone" value="{{old('phone')}}" placeholder="(000) 000-0000">
                          @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <!-- <div class="col-lg-6 mt-3">
                        <div class="rqst-inpt">
                            <i class="fa-thin fa-calendar-days"></i>
                            <input type="text" name="date" value="{{old('date')}}" placeholder="MM/DD/YYYY" onfocus="(this.type='date')">
                                @error('date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                    </div> -->
                    <div class="col-lg-6 mt-3">
                        <label>Best Contact Time</label>
                        <div class="rqst-inpt">
                            <input type="text" name="time" value="{{old('time')}}" placeholder="HH:MM:AM" onfocus="(this.type='time')">
                                @error('time')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            <i class="fa-regular fa-clock"></i>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <label>Estimated Daily Deliveries</label>
                        <input type="text" name="daily_delivery" value="{{old('daily_delivery')}}" placeholder="Dail Delivery">
                          @error('daily_delivery')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label  class="mt-3">Where do you deliver?</label>
                        <input type="text" name="deliver_to" value="{{old('deliver_to')}}" placeholder="Where Do You Deliver">
                        @error('deliver_to')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-lg-12 mt-3">
                        <label>Farthest Delivery Destinations</label>
                        <input type="text" name="delivery_destination" value="{{old('delivery_destination')}}" placeholder="Farthest Delivery Destination">
                          @error('delivery_destination')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-lg-12 mt-3">
                        <label> Additional Information</label>
                        <textarea name="description" placeholder=" Description">{{old('description')}}</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="theme_btn">Submit Now</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- request end -->
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
            <!--             <div class="col-lg-6 col-md-6">
                             <div class="excel-sample">
                                <a class="float-right offset-8 text-white" href="{{asset('uploads/admin/Doc/orders.xlsx')}}" download=""><i class="fa-solid fa-cloud-arrow-down"></i>Download Form</a> 
                            </div>
                            <form action="{{route('uploadDocument')}}" method="POST" id="doc" enctype="multipart/form-data">
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
            $('html, body').animate({scrollTop:750},'50');
             
        @endif
        });
    </script>
    @endpush