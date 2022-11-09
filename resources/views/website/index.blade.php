@extends('website.layout')

@section('content')
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
            @include('website.includes.home_slider')
            <!-- revolution slider close -->

            <!-- section begin -->
            @include('website.includes.home_services')
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

            @include('website.includes.home_aboutus')

            @include('website.includes.home_members')

@endsection