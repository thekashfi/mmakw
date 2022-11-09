@if(count($practiceareaMenus))
<section class="hero-slider hero-style-1">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                  @foreach($practiceareaMenus as $practiceareaMenu)
                    <div class="swiper-slide">
                        <div class="slide-inner slide-bg-image" data-background="@if($practiceareaMenu->bannerimage) {{url('uploads/practice/'.$practiceareaMenu->bannerimage)}} @endif" data-text="<h4>@if(app()->getLocale()=='en') {{$practiceareaMenu->menu_name_en}} @else {{$practiceareaMenu->menu_name_ar}} @endif</h4>">
                            <div class="container">
                                <div data-swiper-parallax="300" class="slide-title">
                                    <h2>@if(app()->getLocale()=="en") {{$practiceareaMenu->title_en}} @else {{$practiceareaMenu->title_ar}} @endif</h2>
                                </div>
                            </div>
                        </div> <!-- end slide-inner --> 
                    </div> <!-- end swiper-slide -->
                  @endforeach
                </div>
                <!-- end swiper-wrapper -->

                <!-- swipper controls -->
                <div class="swiper-cust-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
  @endif      