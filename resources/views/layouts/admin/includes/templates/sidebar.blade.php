    <style type="text/css">
    span.counts {
        background: #1c3e7f;
        color: #fff;
        margin-left: 8px;
        padding: 1px 8px;
        border-radius: 7px;
        float: right;
    }
</style>
<?php
$home_page_count = App\model\CMS::where('page_name','Home Page')->count();
$about_count = App\model\CMS::where('page_name','About Us')->count();
$contact_count = App\model\CMS::where('page_name','Contact Us')->count();
$membership = App\model\CMS::where('page_name','Certifications and Memberships')->count();
$service_count = App\model\CMS::where('page_section','Services')->count();
$why_choose_us = App\model\CMS::where('page_name','Why Choose Us')->count();
$faqs_count = App\model\CMS::where('page_name','FAQS')->count();
$terms_count = App\model\CMS::where('page_name','Terms & Conditions')->count();
$partner_count = App\model\CMS::where('page_name','Home Page')->where('page_section','Partner Section')->count();
?>

<aside class="left-sidebar">
    <ul class="nav-bar  @if(!auth()->check()) d-none @endif navbar-inverse hidden-xs-down">
    </ul>
    <div class="scroll-sidebar">
        @if(auth()->check())
        <nav class="sidebar-nav ">
            <ul id="sidebarnav">
                @if(auth()->user()->hasRole('admin'))
                <li class="clearfix"></li>
                <li class=""><a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="fas fa-home"></i>
                    <span class="hide-menu">Home</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <i class="fa-solid fa-greater-than"></i><a href="{{url('admin/dashboard')}}" class="">Dashboard</a></li>
                        <li><a href="{{ url('/') }}" target="_blank" class="">Visit Website</a></li>
                        <li><a href="{{url('admin/favicon')}}" class="">Favicon Management</a></li>
                        <li><a href="{{url('admin/banner')}}"><span class="hide-menu">Banner Management</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{url('admin/main-banner')}}" class="">Main Banner</a></li>
                            <li><a href="{{url('admin/banner')}}" class="">Site Banners</a></li>
                        </ul>
                        </li>
                        <li><a href="{{url('admin/header-logo')}}"><span class="hide-menu">Logo Management</span></a></li>
                        </li>
                        <li><a href="{{url('admin/config')}}" class="">Config</a></li>
                    </ul>
                </li>

                <hr>
                <li class=""><a class="has-arrow waves-effect waves-dark" href="{{url('dashboard')}}" aria-expanded="false"><i class="fas fa-box"></i>
                    <span class="hide-menu">CMS</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('dashboard')}}" class="">Pages</a>

                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('/admin/homepage-content')}}" class="">Home Page <span class="counts"><?= $home_page_count ?></span></a></li>
                                <!-- <li><a href="{{ url('/admin/term-and-condition') }}" class="">Terms And Condition</a></li> -->
                                <li><a href="{{ url('/admin/about-us') }}" class="">About Us <span class="counts"><?= $about_count ?></span></a></li>
                                <li><a href="{{ url('/admin/services-content') }}" class="">Services<span class="counts"><?= $service_count ?></span></a></li>
                                <li><a href="{{ url('/admin/contact-us') }}" class="">Contact Us <span class="counts"><?= $contact_count ?></span></a></li>
                                <li><a href="{{ url('/admin/choose-us-content') }}" class="">Why Choose Us<span class="counts"><?= $why_choose_us ?></span></a></li>
                                <li><a href="{{ url('/admin/faqs-content') }}" class="">FAQS<span class="counts"><?= $faqs_count ?></span></a></li>
                                <li><a href="{{ url('/admin/terms-conditions') }}" class="">Terms & Conditions<span class="counts"><?= $terms_count ?></span></a></li>
                                <!-- <li><a href="{{ url('/admin/privacy-policy') }}" class="">Policy</a></li> -->
                            </ul>

                        </li>
                    </ul>
                </li>


                <hr>
                <li><a href="{{url('admin/services')}}"><i class="fa fa-cogs" aria-hidden="true"></i><span class="hide-menu">Services</span></a></li>
                 <hr>
                <li><a href="{{url('admin/membership')}}"><i class="fas fa-user-tie"></i><span class="hide-menu"> Membership</span></a></li>
                <hr>
               <li class=""><a class="has-arrow waves-effect waves-dark" href="{{url('panel')}}" aria-expanded="false"><i class="fas fa-box"></i>
                    <span class="hide-menu">Stock Management</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('admin/product-category')}}"><span class="hide-menu"></span>Manage Category</a>
                        </li>
                        <li><a href="{{url('admin/product')}}"><span class="hide-menu">Manage Product</span></a></li>
                    </ul>
                </li>
                <hr>
                <li><a href="{{url('admin/depot-location')}}"><i class="fa fa-envelope"></i><span class="hide-menu">Depot Location</span></a></li>
                <hr>
                <li><a href="{{url('admin/pricing')}}"><i class="fa fa-envelope"></i><span class="hide-menu">Pricing</span></a></li>
                <hr>
                <li><a href="{{url('admin/invoice')}}"><i class="fa fa-envelope"></i><span class="hide-menu">Invoices</span></a></li>
                <hr>
                <li><a href="{{url('admin/order')}}"><i class="fa fa-envelope"></i><span class="hide-menu">Orders</span></a></li>
                <hr>
                <li><a href="{{url('admin/why-choose-us')}}"><i class="fas fa-calendar-alt"></i><span class="hide-menu">Why Choose Us</span></a></li>
                  <hr>
                <li class=""><a class="has-arrow waves-effect waves-dark" href="{{url('dashboard')}}" aria-expanded="false"><i class="fas fa-box"></i>
                    <span class="hide-menu">Inquiry Management</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('admin/inquiry')}}"><span class="hide-menu"></span>Contact Inquiry</a>
                        </li>
                        <li><a href="{{url('admin/delivery-inquiry')}}"><span class="hide-menu">Delivery Inquiry</span></a></li>
                    </ul>
                </li>

                <hr>
                <li><a href="{{url('admin/faqs')}}"><i class="fa fa-question"></i><span class="hide-menu">FAQS</span></a></li>
                <hr>
                <li><a href="{{url('admin/user-management')}}"><i class="fa fa-users"></i><span class="hide-menu">User Management</span></a></li>
                <hr>
                <li><a href="{{url('/admin/account/profile')}}"><i class="fa fa-cog"></i><span class="hide-menu">Account Settings</span></a>
                </li>
                @elseif(auth()->user()->hasRole('user'))
                <li><a href="{{ url('/') }}" target="_blank" class=""><i class="fa fa-globe" aria-hidden="true"></i><span class="hide-menu">Visit Website</span></a></li>
                <hr>
                <li><a href="{{url('user/order')}}"><i class="fa fa-envelope"></i><span class="hide-menu">Orders</span></a>
                </li>
                <hr>
                <li><a href="{{url('/user/account/profile')}}"><i class="fa fa-cog"></i><span class="hide-menu">Account Settings</span></a>
                </li>   
                @elseif(auth()->user()->hasRole('vendor'))
                <li><a href="{{ url('/') }}" target="_blank" class=""><i class="fa fa-globe" aria-hidden="true"></i><span class="hide-menu">Visit Website</span></a></li>
                <hr>
                <li><a href="{{url('vendor/order')}}"><i class="fa fa-envelope"></i><span class="hide-menu">Orders</span></a>
                </li>
                <hr>
                <li><a href="{{url('/vendor/account/profile')}}"><i class="fa fa-cog"></i><span class="hide-menu">Account Settings</span></a>
                </li>   
                    @endif
            </ul>
        </nav>
        @endif
    </div>
</aside>

