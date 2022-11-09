<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{url('new_assets')}}/images/icon.png" type="image/gif" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@if(app()->getLocale()=="en") {{$settingInfo->name_en}} @else {{$settingInfo->name_ar}} @endif</title>

    <meta name="description" content="@if(app()->getLocale()=="en") {{$settingInfo->seo_description_en}} @else {{$settingInfo->seo_description_ar}} @endif" />
    <meta name="abstract" content="@if(app()->getLocale()=="en") {{$settingInfo->seo_description_en}} @else {{$settingInfo->seo_description_ar}} @endif">
    <meta name="keywords" content="@if(app()->getLocale()=="en") {{$settingInfo->seo_keywords_en}} @else {{$settingInfo->seo_keywords_ar}} @endif" />
    <meta name="Copyright" content="{{$settingInfo->name_en}}, Kuwait Copyright 2020 - {{date('Y')}}" />
    <meta name="author" content="Gulfweb Web Design, Kuwait" />
    <META NAME="Designer" CONTENT="Gulfweb Web Design Kuwait">
    <meta name="Country" content="Kuwait" />
    <META NAME="city" CONTENT="Kuwait City">
    <META NAME="Language" CONTENT="English">
    <META NAME="Geography" CONTENT="@if(app()->getLocale()=="en") {{$settingInfo->address_en}} @else {{$settingInfo->address_ar}} @endif">
    <META NAME="Revisit-After" CONTENT="2 days">
    <meta name="robots" CONTENT="all">
    <META NAME="distribution" CONTENT="Global">

    <!-- CSS Files
    ================================================== -->
    <link href="{{url('new_assets')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap" />
    <link href="{{url('new_assets')}}/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css" id="bootstrap-grid" />
    <link href="{{url('new_assets')}}/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css" id="bootstrap-reboot" />
    <link href="{{url('new_assets')}}/css/plugins.css" rel="stylesheet" type="text/css">
    <link href="{{url('new_assets')}}/css/style.css" rel="stylesheet" type="text/css">
    <link href="{{url('new_assets')}}/css/color.css" rel="stylesheet" type="text/css">

    <!-- custom background -->
    <link rel="stylesheet" href="{{url('new_assets')}}/css/bg.css" type="text/css">

    <!-- color scheme -->
    <link rel="stylesheet" href="{{url('new_assets')}}/css/colors/blue.css" type="text/css" id="colors">

    <!-- revolution slider -->
    <link rel="stylesheet" href="{{url('new_assets')}}/rs-plugin/css/settings.css" type="text/css">
    <link rel="stylesheet" href="{{url('new_assets')}}/css/rev-settings.css" type="text/css">

    <!-- custom font -->
    <link rel="stylesheet" href="{{url('new_assets')}}/css/font-style-2.css" type="text/css">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body id="homepage">

    <div id="wrapper">

        <!-- header begin -->
        @include('website.includes.top_home_header')
        <!-- header close -->

        <!-- content begin -->
        <div id="content" class="no-bottom no-top">

            <!-- <section id="section-hero" class="no-top no-bottom full-height vertical-center text-white jarallax" aria-label="section" data-video-src="mp4:video/local-video.mp4">
                    <div class="de-front">
                        <div class="container">
                            <div class="row g-5 align-items-center">
                                <div class="sm-spacer-double"></div>
                                <div class="col-lg-4 col-md-12 wow fadeInRight" data-wow-delay=".2s">
                                    <div class="de_count ultra-big s2 text-center">
                                        <h3 class="timer" data-to="25" data-speed="2000">0</h3>
                                        <span class="text-white">Years of Experience</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-sm-30 wow fadeInRight" data-wow-delay=".4s">
                                    <h2 class="style-2 id-color">We Are MMA Law</h2>
                                    <h2 class="style-4">We Are The Most Populer Law Firm With Various Law Services!</h2>
                                </div>
                                <div class="sm-spacer-double"></div>
                            </div>
                        </div>
                    </div>
                    <div class="overlay-bg"></div>
            </section> -->

            <!-- revolution slider begin -->
            <section id="section-hero" class="fullwidthbanner-container" aria-label="section-slider">
                <div id="revolution-slider">
                    <ul>
                        <li data-transition="fade" data-slotamount="10" data-masterspeed="200" data-thumb="">
                            <!--  BACKGROUND IMAGE -->
                            <img src="{{url('new_assets')}}/images/slider/wide1.jpg" alt="" />
                            <div class="tp-caption big-white sft" data-x="0" data-y="150" data-speed="800" data-start="400" data-easing="easeInOutExpo"
                                 data-endspeed="450">
                                Our Expertise For
                            </div>

                            <div class="tp-caption ultra-big-white customin customout start" data-x="0" data-y="center" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:2;scaleY:2;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                 data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.85;scaleY:0.85;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                 data-speed="800" data-start="400" data-easing="easeInOutExpo" data-endspeed="400">
                                Interior Design
                            </div>

                            <div class="tp-caption sfb" data-x="0" data-y="335" data-speed="400" data-start="800" data-easing="easeInOutExpo">
                                <a href="#" class="btn-slider">Our Portfolio
                                </a>
                            </div>
                        </li>

                        <li data-transition="fade" data-slotamount="10" data-masterspeed="200" data-thumb="">
                            <!--  BACKGROUND IMAGE -->
                            <img src="{{url('new_assets')}}/images/slider/wide2.jpg" alt="" />
                            <div class="tp-caption big-white sft" data-x="0" data-y="160" data-speed="800" data-start="400" data-easing="easeInOutExpo"
                                 data-endspeed="450">
                                Featured Project
                            </div>

                            <div class="tp-caption ultra-big-white customin customout start" data-x="0" data-y="center" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:2;scaleY:2;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                 data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.85;scaleY:0.85;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                 data-speed="800" data-start="400" data-easing="easeInOutExpo" data-endspeed="400">
                                Green Interior
                            </div>

                            <div class="tp-caption sfb" data-x="0" data-y="335" data-speed="400" data-start="800" data-easing="easeInOutExpo">
                                <a href="#" class="btn-slider">Our Portfolio
                                </a>
                            </div>
                        </li>

                        <li data-transition="fade" data-slotamount="10" data-masterspeed="200" data-thumb="">
                            <!--  BACKGROUND IMAGE -->
                            <img src="{{url('new_assets')}}/images/slider/wide3.jpg" alt="" />
                            <div class="tp-caption big-white sft" data-x="0" data-y="160" data-speed="800" data-start="400" data-easing="easeInOutExpo"
                                 data-endspeed="450">
                                Interior Remodeling To Makes
                            </div>

                            <div class="tp-caption ultra-big-white customin customout start" data-x="0" data-y="center" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:2;scaleY:2;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                 data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.85;scaleY:0.85;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                                 data-speed="800" data-start="400" data-easing="easeInOutExpo" data-endspeed="400">
                                Your Life Easier
                            </div>

                            <div class="tp-caption sfb" data-x="0" data-y="335" data-speed="400" data-start="800" data-easing="easeInOutExpo">
                                <a href="#" class="btn-slider">Our Portfolio
                                </a>
                            </div>
                        </li>

                    </ul>
                </div>
            </section>
            <!-- revolution slider close -->

            <!-- section begin -->
            <section id="section-services" class="no-top mt150">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 mt-70 sm-mt0 text-middle text-light wow fadeInRight" data-wow-delay="0">
                            <div class="shadow-soft" data-bgimage="url({{url('new_assets')}}/images/services/p1_b.jpg)">
                                <div class="padding40 overlay60">
                                    <h3> Oil &amp; Gas </h3>
                                    <p>Our commitment to quality and services ensure our clients happy. With years of experiences
                                        and continuing research, our team is ready to serve your interior design needs. We're
                                        happy to make you feel more comfortable on your home.</p>
                                    <a href="service-1.html" class="btn-line btn-fullwidth">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mt-70 sm-mt0 mt-sm-none text-middle text-light wow fadeInRight" data-wow-delay=".1s">
                            <div class="shadow-soft" data-bgimage="url({{url('new_assets')}}/images/services/p3_b.jpg)">
                                <div class="padding40 overlay60">
                                    <h3> Infrastructure &amp; Construction </h3>
                                    <p>Our commitment to quality and services ensure our clients happy. With years of experiences
                                        and continuing research, our team is ready to serve your interior design needs. We're
                                        happy to make you feel more comfortable.</p>
                                    <a href="service-1.html" class="btn-line btn-fullwidth">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mt-70 sm-mt0 mt-sm-none text-middle text-light wow fadeInRight" data-wow-delay=".3s">
                            <div class="shadow-soft" data-bgimage="url({{url('new_assets')}}/images/services/p4_a.jpg)">
                                <div class="padding40 overlay60">
                                    <h3> Information Technology </h3>
                                    <p>Our commitment to quality and services ensure our clients happy. With years of experiences
                                        and continuing research, our team is ready to serve your interior design needs. We're
                                        happy to make you feel more comfortable on your home.</p>
                                    <a href="service-1.html" class="btn-line btn-fullwidth">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mt-70 sm-mt0 mt-sm-none text-middle text-light wow fadeInRight" data-wow-delay=".3s">
                            <div class="shadow-soft" data-bgimage="url({{url('new_assets')}}/images/services/p4_b.jpg)">
                                <div class="padding40 overlay60">
                                    <h3> Investment </h3>
                                    <p>Our commitment to quality and services ensure our clients happy. With years of experiences
                                        and continuing research, our team is ready to serve your interior design needs. We're
                                        happy to make you feel more comfortable on your home.</p>
                                    <a href="service-1.html" class="btn-line btn-fullwidth">Read More</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- section close -->

            <!-- section begin -->
            <section id="section-portfolio" class="no-top no-bottom" aria-label="section-portfolio">
                <div class="container">

                    <div class="spacer-single"></div>

                    <!-- portfolio filter begin -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <ul id="filters" class="wow fadeInUp" data-wow-delay="0s">
                                <li><a href="#" data-filter="*" class="selected">All Services</a></li>
                                <li><a href="#" data-filter=".residential">ADR &amp; Arbitration</a></li>
                                <li><a href="#" data-filter=".hospitaly"> Banking &amp; Finance </a></li>
                                <li><a href="#" data-filter=".office"> Merger &amp; Acquisition </a></li>
                                <li><a href="#" data-filter=".commercial">General Corporate &amp; Commercial</a></li>
                            </ul>

                        </div>
                    </div>
                    <!-- portfolio filter close -->

                </div>

                <div id="gallery" class="gallery full-gallery de-gallery pf_full_width wow fadeInUp" data-wow-delay=".3s">

                    <!-- gallery item -->
                    <div class="item residential">
                        <div class="picframe">
                            <a class="simple-ajax-popup-align-top" href="project-details-1.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">ADR &amp; Arbitration</span>
                                    </span>
                                </span>
                            </a>
                            <img src="{{url('new_assets')}}/images/portfolio/cols-4/pf%20(1).jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->

                    <!-- gallery item -->
                    <div class="item hospitaly">
                        <div class="picframe">
                            <a class="simple-ajax-popup-align-top" href="project-details-2.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Banking &amp; Finance</span>
                                    </span>
                                </span>
                            </a>

                            <img src="{{url('new_assets')}}/images/portfolio/cols-4/pf%20(2).jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->

                    <!-- gallery item -->
                    <div class="item hospitaly">
                        <div class="picframe">
                            <a class="simple-ajax-popup-align-top" href="project-details-3.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Merger &amp; Acquisition</span>
                                    </span>
                                </span>
                            </a>

                            <img src="{{url('new_assets')}}/images/portfolio/cols-4/pf%20(3).jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->

                    <!-- gallery item -->
                    <div class="item residential">
                        <div class="picframe">
                            <a class="simple-ajax-popup-align-top" href="project-details-youtube.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">General Corporate &amp; Commercial</span>
                                    </span>
                                </span>
                            </a>
                            <img src="{{url('new_assets')}}/images/portfolio/cols-4/pf%20(4).jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->

                    <!-- gallery item -->
                    <div class="item office">
                        <div class="picframe">
                            <a class="simple-ajax-popup-align-top" href="project-details-vimeo.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name"> Administrative Law &amp; Governmental Sector </span>
                                    </span>
                                </span>
                            </a>
                            <img src="{{url('new_assets')}}/images/portfolio/cols-4/pf%20(5).jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->

                    <!-- gallery item -->
                    <div class="item commercial">
                        <div class="picframe">
                            <a class="simple-ajax-popup-align-top" href="project-details.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">General Corporate &amp; Commercial</span>
                                    </span>
                                </span>
                            </a>
                            <img src="{{url('new_assets')}}/images/portfolio/cols-4/pf%20(6).jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->

                    <!-- gallery item -->
                    <div class="item residential">
                        <div class="picframe">
                            <a class="simple-ajax-popup-align-top" href="project-details-youtube.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Governmental Compliance</span>
                                    </span>
                                </span>
                            </a>

                            <img src="{{url('new_assets')}}/images/portfolio/cols-4/pf%20(7).jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->

                    <!-- gallery item -->
                    <div class="item office">
                        <div class="picframe">
                            <a class="simple-ajax-popup-align-top" href="project-details-vimeo.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Claims Preparation</span>
                                    </span>
                                </span>
                            </a>

                            <img src="{{url('new_assets')}}/images/portfolio/cols-4/pf%20(8).jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->

                </div>

                <div id="loader-area">
                    <div class="project-load"></div>
                </div>
            </section>
            <!-- section close -->

            <!-- section begin -->
            <section id="section-features" class="text-light jarallax">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 text-center wow fadeInUp">
                            <h1>Why Choose Us?</h1>
                            <div class="separator"><span><i class="fa fa-circle"></i></span></div>
                            <div class="spacer-single"></div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-4 wow fadeIn" data-wow-delay="0s">
                            <div class="box-number square">
                                <span class="number bg-color wow rotateIn" data-wow-delay=".5s">1</span>
                                <div class="text">
                                    <h3><span class="id-color">Interior Expertise</span></h3>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                        laudantium, totam rem aperiam, eaque ipsa.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow fadeIn" data-wow-delay=".25s">
                            <div class="box-number square">
                                <span class="number bg-color wow rotateIn" data-wow-delay=".75s">2</span>
                                <div class="text">
                                    <h3><span class="id-color">Awards Winning</span></h3>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                        laudantium, totam rem aperiam, eaque ipsa.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow fadeIn" data-wow-delay=".5s">
                            <div class="box-number square">
                                <span class="number bg-color wow rotateIn" data-wow-delay="1s">3</span>
                                <div class="text">
                                    <h3><span class="id-color">Affordable Price</span></h3>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                        laudantium, totam rem aperiam, eaque ipsa.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow fadeIn" data-wow-delay=".75s">
                            <div class="box-number square">
                                <span class="number bg-color wow rotateIn" data-wow-delay="1.25s">4</span>
                                <div class="text">
                                    <h3><span class="id-color">Free Consultation</span></h3>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                        laudantium, totam rem aperiam, eaque ipsa.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow fadeIn" data-wow-delay="1s">
                            <div class="box-number square">
                                <span class="number bg-color wow rotateIn" data-wow-delay="1.5s">5</span>
                                <div class="text">
                                    <h3><span class="id-color">Guaranteed Works</span></h3>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                        laudantium, totam rem aperiam, eaque ipsa.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow fadeIn" data-wow-delay="1.25s">
                            <div class="box-number square">
                                <span class="number bg-color wow rotateIn" data-wow-delay="1.75s">6</span>
                                <div class="text">
                                    <h3><span class="id-color">24 / 7 Support</span></h3>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                        laudantium, totam rem aperiam, eaque ipsa.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->

            <section id="section-about-us-2" class="side-bg no-padding">
                <div class="image-container col-md-5 pull-left" data-delay="0"></div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-6 " data-animation="fadeInRight" data-delay="200">
                            <div class="inner-padding">
                                <h3><span class="id-color">About MMA Kuwait</span></h3>
                                <h2><span class="font">We Are The Most Populer Law Firm With Various Law Services!</span></h2>

                                <p class="intro">Established by Mr. Mohammad Meslet Thaar Al-Otaibi, the MMA Law Firm enjoys a distinguished reputation built upon a record of excellence of service and successful outcomes in the legal arena combined with profound understanding of the markets in which it operated and offers services. MMA Law is a multilingual practice offering clients a unique grouping of specialized international and local attorneys.</p>

                                <h4><span>Mohammad Meslet Thaar Al-Otaibi</span></h4>
                                - Founder and Chairman
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>


            <section id="section-features" class="text-light jarallax">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 text-center wow fadeInUp">
                            <h1>Membership &amp; Listings</h1>
                            <div class="separator"><span><i class="fa fa-circle"></i></span></div>
                            <div class="spacer-single"></div>
                        </div>
                    </div>

                    <div class="row mt50">
                        <div class="col-lg-4 mt-70 sm-mt0 mt-sm-none fadeInRight" data-wow-delay=".3s">
                            <img src="{{url('new_assets')}}/images/aea.jpg" alt="">
                        </div>

                        <div class="col-lg-4 mt-70 sm-mt0 mt-sm-none fadeInRight" data-wow-delay=".3s">
                            <img src="{{url('new_assets')}}/images/jl.jpg" alt="">
                        </div>

                        <div class="col-lg-4 mt-70 sm-mt0 mt-sm-none fadeInRight" data-wow-delay=".3s">
                            <img src="{{url('new_assets')}}/images/500.jpg" alt="">
                        </div>
                    </div>
                </div>
            </section>

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
                            <h3 class="text-dark size-2 no-margin">Do you need Best Law Services?</h3>
                        </div>

                        <div class="col-lg-4 col-md-5 text-right">
                            <a href="#" class="btn-line black wow fadeInUp">Contact Us Now</a>
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



    <!-- Javascript Files
    ================================================== -->
    <script src="{{url('new_assets')}}/js/plugins.js"></script>
    <script src="{{url('new_assets')}}/js/designesia.js"></script>

    <!-- SLIDER REVOLUTION SCRIPTS  -->
    <script src="{{url('new_assets')}}/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
    <script src="{{url('new_assets')}}/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>


</body>

</html>
{{--
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@if(app()->getLocale()=="en") {{$settingInfo->name_en}} @else {{$settingInfo->name_ar}} @endif</title>

    <meta name="description" content="@if(app()->getLocale()=="en") {{$settingInfo->seo_description_en}} @else {{$settingInfo->seo_description_ar}} @endif" />
    <meta name="abstract" content="@if(app()->getLocale()=="en") {{$settingInfo->seo_description_en}} @else {{$settingInfo->seo_description_ar}} @endif">
    <meta name="keywords" content="@if(app()->getLocale()=="en") {{$settingInfo->seo_keywords_en}} @else {{$settingInfo->seo_keywords_ar}} @endif" />
    <meta name="Copyright" content="{{$settingInfo->name_en}}, Kuwait Copyright 2020 - {{date('Y')}}" />
    <meta name="author" content="Gulfweb Web Design, Kuwait" />
    <META NAME="Designer" CONTENT="Gulfweb Web Design Kuwait">
    <meta name="Country" content="Kuwait" />
    <META NAME="city" CONTENT="Kuwait City">
    <META NAME="Language" CONTENT="English">
    <META NAME="Geography" CONTENT="@if(app()->getLocale()=="en") {{$settingInfo->address_en}} @else {{$settingInfo->address_ar}} @endif">
    <META NAME="Revisit-After" CONTENT="2 days">
    <meta name="robots" CONTENT="all">
    <META NAME="distribution" CONTENT="Global">
    @if($settingInfo->favicon)
    <link rel="icon" href="{{url('uploads/logo/'.$settingInfo->favicon)}}">
    @endif
    <link href="{{url('assets/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/flaticon.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/bootstrap-notify.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/owl.theme.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/slick.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/slick-theme.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/swiper.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/owl.transitions.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/jquery.fancybox.css')}}" rel="stylesheet">

    <link href="{{url('assets/css/style.css')}}" rel="stylesheet">
    @if(app()->getLocale()=="ar")
    <link href="{{url('assets/css/arstyle.css')}}" rel="stylesheet">
    @endif

	<link rel="stylesheet" href="{{url('assets/animation/animations.css')}}" type="text/css" media="all">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src='https://www.google.com/recaptcha/api.js'></script>
	<style>.g-recaptcha {transform:scale(0.90);transform-origin:0 0;}</style>

</head>

<body id="home" data-appear-top-offset='-300'>

    <!-- start page-wrapper -->
    <div class="page-wrapper">

    <!-- start preloader -->
    <div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    </div>
    <!-- end preloader -->
    @include('website.includes.top_home_header')
    <!-- start of hero -->
    @include('website.includes.home_slider')
    <!-- end of hero slider -->
    <!-- start about-section -->
    @include('website.includes.home_aboutus')
    <!-- end about-section -->
    <!-- start case-studies-section -->
    @include('website.includes.home_services')
    <!-- end case-studies-section -->
    <!--membership -->
    @include('website.includes.home_members')
    <!--end of membership-->
    <!-- start news-section -->
    @include('website.includes.home_news')

	<!-- start contact-section -->
    @include('website.includes.home_contact')
    <!-- end contact-section -->

	<div class="my_clear50x"></div>

    <!-- end news-section -->
    <!-- start site-footer -->
    @include('website.includes.home_footer')
    <!-- end site-footer -->
     <div class='notifications top-right'></div>
    </div>
    <!-- end of page-wrapper -->

    <!-- All JavaScript files
    ================================================== -->
    <script src="{{url('assets/js/jquery.min.js')}}"></script>
	<script src="{{url('assets/animation/css3-animate-it.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>


    <script src="{{url('assets/js/jquery-plugin-collection.js')}}"></script>
    <script src="{{url('assets/js/script.js')}}"></script>
    <script src="{{url('assets/js/bootstrap-notify.js')}}"></script>


    <script>
	$(document).ready(function(){
	    $.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});

	    $("#subscribeBtn").click(function(e){
		 var newsletter_email = $("#newsletter_email").val();
	     $.ajax({
             url: 'subscribe_newsletter',
             data: {'newsletter_email': newsletter_email},
             type: 'POST',
             datatype: 'JSON',
             success: function(msg) {
			    if(msg.status=="200"){
                $('.top-right').notify({message:{text: msg.message},type:'success'}).show();
				}else{
				$('.top-right').notify({message:{text: msg.message},type:'danger'}).show();
				}
             },
             error: function(msg) {
                $('.top-right').notify({message:{text: 'Error Found'},type:'danger'}).show();
             }
           });
		});
		@if(!empty($settingInfo->is_active_survey))
		//reload modal if available
		$("#myCovidModal").modal({backdrop: "static"});
		@endif
	});
	</script>

</body>
</html>
--}}