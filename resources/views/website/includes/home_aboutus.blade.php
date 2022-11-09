
     <section class="about-section section-padding" id="about">
            <div class="container">
                <div class="row animatedParent">
                    <div class="col col-md-4">
                        <div class="left-col">
                            <div class="section-title slow animated bounceInLeft">
                                <span>@if(app()->getLocale()=="en" && $settingInfo->about_title_1_en) {{$settingInfo->about_title_1_en}} @else {{$settingInfo->about_title_1_ar}} @endif</span>
                                <h3>@if(app()->getLocale()=="en" && $settingInfo->about_title_2_en) {{$settingInfo->about_title_2_en}} @else {{$settingInfo->about_title_2_ar}} @endif</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="mid-col slower animated bounceIn">
                            @if($settingInfo->image)
                            <img src="{{url('uploads/aboutus/'.$settingInfo->image)}}" alt>
                            @endif
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="right-col">
                        @if(app()->getLocale()=="en" && $settingInfo->about_details_en) {!! $settingInfo->about_details_en !!} @else {!!$settingInfo->about_details_ar!!} @endif
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        
