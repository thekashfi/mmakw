@if(count($practiceareaMenus))
<section id="section-hero" class="fullwidthbanner-container" aria-label="section-slider">
    <div id="revolution-slider">
        <ul>
            @foreach($practiceareaMenus as $practiceareaMenu)
                <li data-transition="fade" data-slotamount="10" data-masterspeed="200" data-thumb="">
                    <!--  BACKGROUND IMAGE -->
                    <img src="@if($practiceareaMenu->bannerimage) {{url('uploads/practice/'.$practiceareaMenu->bannerimage)}} @endif" alt="" />
                    <div class="tp-caption big-white sft" data-x="0" data-y="150" data-speed="800" data-start="400" data-easing="easeInOutExpo"
                         data-endspeed="450">
                        @if(app()->getLocale()=="en") {{$practiceareaMenu->title_en}} @else {{$practiceareaMenu->title_ar}} @endif
                    </div>

                    <div class="tp-caption ultra-big-white customin customout start" data-x="0" data-y="center" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:2;scaleY:2;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.85;scaleY:0.85;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="800" data-start="400" data-easing="easeInOutExpo" data-endspeed="400">
                        @if(app()->getLocale()=='en') {{$practiceareaMenu->menu_name_en}} @else {{$practiceareaMenu->menu_name_ar}} @endif
                    </div>

                    <div class="tp-caption sfb" data-x="0" data-y="335" data-speed="400" data-start="800" data-easing="easeInOutExpo">
                        <a href="{{url('/practice/'.$practiceareaMenu->slug)}}" class="btn-slider">More Details
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>

{{--<section id="section-hero" class="no-top no-bottom full-height vertical-center text-white jarallax" aria-label="section" data-video-src="mp4:{{ url('uploads/slides') }}/football.mp4">--}}
{{--        <div class="de-front">--}}
{{--            <div class="container">--}}
{{--                <div class="row g-5 align-items-center">--}}
{{--                    <div class="sm-spacer-double"></div>--}}
{{--                    <div class="col-lg-4 col-md-12 wow fadeInRight" data-wow-delay=".2s">--}}
{{--                        <div class="de_count ultra-big s2 text-center">--}}
{{--                            <h3 class="timer" data-to="25" data-speed="2000">0</h3>--}}
{{--                            <span class="text-white">Years of Experience</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 mb-sm-30 wow fadeInRight" data-wow-delay=".4s">--}}
{{--                        <h2 class="style-2 id-color">We Are MMA Law</h2>--}}
{{--                        <h2 class="style-4">We Are The Most Populer Law Firm With Various Law Services!</h2>--}}
{{--                    </div>--}}
{{--                    <div class="sm-spacer-double"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="overlay-bg"></div>--}}
{{--</section>--}}
@endif