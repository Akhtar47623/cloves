    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="fot-abt wow bounceInLeft">
                        <div class="fot-abt">
                            <h5>About ClovesRX Global</h5>
                            <p>{{returnFlag(58)}}</p>
                            <ul>
                                <li><a href="{{returnFlag(682)}}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="{{returnFlag(1960)}}" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                                <li><a href="{{returnFlag(1963)}}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                <li><a href="{{returnFlag(1962)}}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="fot-qucks wow bounceInDown">
                        <h5>Quick Link</h5>
                        <ul>
                            <li><a href="{{route('webIndexPage')}}">- Home</a></li>
                            <li><a href="{{route('webAboutPage')}}">- About us</a></li>
                            <li><a href="{{route('webServicePage')}}">- Services</a></li>
                            <li><a href="{{route('webWhyChoosePage')}}">- Why choose us</a></li>
                            <li><a href="{{route('webFaqsPage')}}">- Faq's</a></li>
                            <li><a href="{{route('webContactPage')}}">- Contact Us</a></li>
                            <li><a href="{{route('webRequestPage')}}">- Request Delivery Service </a> </li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="fot-helpful wow bounceInUp">
                        <h5>Helpful Link</h5>
                        <ul>
                            <li><a href="javascript:void(0)">- Lorum Ipsum</a></li>
                            <li><a href="javascript:void(0)">- Lorum Ipsum</a></li>
                            <li><a href="javascript:void(0)">- Lorum Ipsum</a></li>
                            <li><a href="javascript:void(0)">- Lorum Ipsum</a></li>
                            <li><a href="javascript:void(0)">- Lorum Ipsum</a></li>
                            <li><a href="javascript:void(0)">- Lorum Ipsum</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="fot-loc wow bounceInRight">
                        <h5>Our Location</h5>
                        <img src="{{asset('web-assets/images/fot-map.png')}}" alt="">
                        <a>Address: <?= wordwrap(returnFlag(56),30,"<br>\n");?>
                            </a>
                        <a href="mailto:{{returnFlag(50)}}">Email: {{returnFlag(50)}}</a>
                        <a href="tel:{{returnFlag(52)}}">Phone: {{returnFlag(52)}}</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="copy-rit">
            <p>{{returnFlag(59)}}</p>
        </div>
    </footer>
    <!-- large modal -->
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">USER REGISTRATION</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                      <div class="img-box">
                        <img src="https://banner2.cleanpng.com/20180708/cgi/kisspng-computer-icons-user-profile-north-vancouver-avatar-silhouette-user-5b42dad75986a6.1152267815311080553667.jpg" width="250" height="250">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="img-box">
                        <img src="https://banner2.cleanpng.com/20180708/cgi/kisspng-computer-icons-user-profile-north-vancouver-avatar-silhouette-user-5b42dad75986a6.1152267815311080553667.jpg" width="250" height="250">
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="rgstr-btn">
                      <button type="button" class="btn btn-success"><a href="{{route('userRegisterPage')}}">REGISTER AS LEAD</a></button>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="rgstr-btn">
                      <button type="button" class="btn btn-success"><a href="{{route('vendorRegisterPage')}}">REGISTER AS VENDOR</a></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <p class="text-white">Already Register ?</p>
                <button type="button" class="btn btn-success text-white"><a href="{{route('Login')}}">LOGIN</a></button>
              </div>
            </div>
          </div>
        </div>

       
        <!-- Register Modal -->
      @push('js')
        <script type="text/javascript">
            $(document).ready(function(){
                $('#file').change(function(){
                    $('#doc').submit();
                });
            });
        </script>
    @endpush