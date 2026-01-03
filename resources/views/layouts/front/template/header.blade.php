<div class="topSec wow bounceInDown">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
                <div class="logo">
                    <a href="{{route('webIndexPage')}}"><img src="{{asset(getImage())}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="top-right">
                    <a href="mailto:{{returnFlag(50)}}">
                        <ul>
                            <li><i class="fa-solid fa-envelope"></i></li>
                            <li>
                                <p>have any queries <span>{{returnFlag(50)}}</span></p>
                            </li>
                        </ul>
                    </a>
                    <a href="tel:{{returnFlag(52)}}">
                        <ul>
                            <li><i class="fa-solid fa-phone"></i></li>
                            <li>
                                <p>Make A Call <span>{{returnFlag(52)}}</span></p>
                            </li>
                        </ul>
                    </a>
                    <!-- <a href="javascript:void(0)"> -->
                    <ul>
                        <li><i class="fa-solid fa-location-dot"></i></li>
                        <li>
                            <p>address <span><?= wordwrap(returnFlag(56), 30, "<br>\n"); ?></span>
                                </span>
                            </p>
                        </li>
                    </ul>
                    <!-- </a> -->
                    <div class="top-btn">
                        <a href="{{route('webRequestPage')}}" class="theme_btn">Request Delivery Service</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="menuSec wow bounceInUp">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8 d-none d-md-block">
                <div class="menu-left">
                    <ul id="menu">
                        <li><a href="{{route('webIndexPage')}}">Home</a></li>
                        <li><a href="{{route('webAboutPage')}}">About us</a></li>
                        <li><a href="{{route('webServicePage')}}">Services</a></li>
                        <li><a href="{{route('webWhyChoosePage')}}">Why choose us</a></li>
                        <li><a href="{{route('webFaqsPage')}}">Faq<i>s</i> </a></li>
                        <li><a href="{{route('webContactPage')}}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="menu-right">
                    <div class="men-lgn">
                        @if (Auth::check())
                        @if(auth()->user()->hasRole('admin'))
                        <a href="{{route('logout')}}">logout </a>&nbsp;
                        <a href="{{url('/admin')}}"> /My Account<i class="fa-solid fa-user"></i></a>
                        @endif
                        @if(auth()->user()->hasRole('user'))
                        <a href="{{route('logout')}}">logout </a>&nbsp;
                        <a href="{{url('/user')}}">/ My Account<i class="fa-solid fa-user"></i></a>
                        @elseif(auth()->user()->hasRole('vendor'))
                        <a href="{{route('logout')}}">logout </a>&nbsp;
                        <a href="{{url('/vendor/dashboard')}}">/ My Account<i class="fa-solid fa-user"></i></a>
                        @endif
                        @else
                        <!-- https://www.designsutility.com/login -->
                        <!-- <a href="{{route('Login')}}">Login / Register <i class="fa-solid fa-user"></i></a>    -->
                        <!-- <a href="#" class="" data-toggle="modal" data-target="#largeModal">Login / Register<i class="fa-solid fa-user"></i></a>   -->
                        <a href="{{route('Login')}}" class="">Login / &nbsp;</a>
                        <a href="{{route('vendorRegisterPage')}}" class=""> Register<i class="fa-solid fa-user"></i></a>
                        @endif
                    </div>
                    <ul>
                        <li><a href="{{returnFlag(682)}}" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="{{returnFlag(1960)}}" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href="{{returnFlag(1963)}}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        <li><a href="{{returnFlag(1962)}}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- header strat
