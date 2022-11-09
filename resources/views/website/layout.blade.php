<!DOCTYPE html>
<html lang="en">
@include('website.includes.head')
<body id="homepage">

    <div id="wrapper">

        <!-- header begin -->
        @include('website.includes.top_home_header')
        <!-- header close -->

        @yield('content')

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center wow fadeInUp">
                        <h1>Our Clients</h1>
                        <div class="separator"><span><i class="fa fa-circle"></i></span></div>
                        <div class="spacer-single"></div>
                    </div>
                    <div class="col-md-12">
                        <div id="logo-carousel" class="owl-carousel owl-theme">
                            <img src="{{url('new_assets')}}/images/logo/1.png" class="img-responsive" alt="">
                            <img src="{{url('new_assets')}}/images/logo/2.png" class="img-responsive" alt="">
                            <img src="{{url('new_assets')}}/images/logo/3.png" class="img-responsive" alt="">
                            <img src="{{url('new_assets')}}/images/logo/4.png" class="img-responsive" alt="">
                            <img src="{{url('new_assets')}}/images/logo/5.png" class="img-responsive" alt="">
                            <img src="{{url('new_assets')}}/images/logo/6.png" class="img-responsive" alt="">
                            <img src="{{url('new_assets')}}/images/logo/7.png" class="img-responsive" alt="">
                            <img src="{{url('new_assets')}}/images/logo/8.png" class="img-responsive" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="call-to-action" class="bg-color call-to-action text-light padding40" aria-label="cta">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-7">
                        <h3 class="text-dark size-2 no-margin">{{__('webMessage.footercontactusblue')}}</h3>
                    </div>

                    <div class="col-lg-4 col-md-5 text-right">
                        <a href="{{url('/#contact')}}" class="btn-line black wow fadeInUp">{{__('webMessage.footercontactusbutton')}}</a>
                    </div>
                </div>
            </div>
        </section>

            <!-- footer begin -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <img src="{{url('new_assets')}}/images/logo.png" class="logo-small" alt=""><br> MMA Law understands the business philosophy we are keen to keep the smooth transactions between our clients and the relevant parties, we believe that the smooth transactions will be guaranteed through our involvement before the commencement of business transactions to explain the legal rules which will govern the transactions
                    </div>

                    <div class="col-lg-5">
                        <h3>Contact Us</h3>
                        <div class="widget widget-address">
                            <address>
                                <span>Mahboula - Coastal Road - Block 4 Compound 54 - Villa 4, Po Box : 9337 Ahmadi - 61004 Kuwait.</span>
                                <span><strong>Phone:</strong>(+965) 2227 2212, (+965) 2227 2213</span>
                                <span><strong>Fax:</strong>(+965) 2227 2213</span>
                                <span><strong>Email:</strong><a href="mailto:info@mmakw.com">info@mmakw.com</a></span>
                                <span><strong>Web:</strong><a href="#">https://www.mmakw.com</a></span>
                            </address>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="widget widget_recent_post">
                            <h3>Main Menu</h3>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Practice Areas</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Membership &amp; Listings</a></li>
                                <li><a href="#">News &amp; Events</a></li>
                                <li><a href="#">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="subfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            &copy; Copyright 2022 MMA Kuwait - Al Rights Reserved
                        </div>
                        <div class="col-md-6 text-right">

                            <div class="social-icons">

                                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                                <div id="google_translate_element" style="float: right; margin-left:30px;"></div>
                                <script type="text/javascript">
                                    function googleTranslateElementInit() {
                                        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                                    }
                                </script>

                                <a href="https://www.linkedin.com/company/mma-law/" target="_blank"><i class="fa fa-linkedin fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" id="back-to-top"></a>
        </footer>
        <!-- footer close -->
    </div>
</div>
@include('website.includes.js')
</body>
</html>