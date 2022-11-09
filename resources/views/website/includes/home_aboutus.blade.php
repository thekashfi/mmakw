<section id="section-about-us-2" class="side-bg no-padding">
    <div class="image-container col-md-5 pull-left" data-delay="0" style='{{ $settingInfo->image ? "background: url(url(uploads/aboutus/$settingInfo->image)" : '' }}'></div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-6 " data-animation="fadeInRight" data-delay="200">
                <div class="inner-padding">
                    <h3><span class="id-color">@if(app()->getLocale()=="en" && $settingInfo->about_title_1_en) {{$settingInfo->about_title_1_en}} @else {{$settingInfo->about_title_1_ar}} @endif</span></h3>
                    <h2><span class="font">@if(app()->getLocale()=="en" && $settingInfo->about_title_2_en) {{$settingInfo->about_title_2_en}} @else {{$settingInfo->about_title_2_ar}} @endif</span></h2>

                    @if(app()->getLocale()=="en" && $settingInfo->about_details_en) {!! $settingInfo->about_details_en !!} @else {!!$settingInfo->about_details_ar!!} @endif
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>
