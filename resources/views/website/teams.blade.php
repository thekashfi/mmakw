@extends('website.layout')

@section('title', __('webMessage.teams'))

@section('content')
    <!-- subheader -->
    <section id="subheader" data-speed="8" data-type="background" style="background:url({{url('assets/images/slider/slide-3.jpg')}}) no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>@if(app()->getLocale()=="en") {{$settingInfo->team_title_en}} @else {{$settingInfo->team_title_ar}} @endif</h1>
                    <ul class="crumb">
                        <li><a href="{{url('/#home')}}">{{__('webMessage.home')}}</a></li>
                        <li class="sep">/</li>
                        <li><a href="{{url('/#about')}}">{{__('webMessage.aboutus')}}</a></li>
                        <li class="sep">/</li>
                        <li>{{__('webMessage.team')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- subheader close -->

    <!-- content begin -->
    <div id="content">
        <div class="container">
            <div class="row">
                <div id="sidebar" class="col-md-3 wow fadeInUp">
                    <ul id="services-list">
                        <li><a href="{{url('/mission')}}">{{__('webMessage.mission')}}</a></li>
                        <li><a href="{{url('/vision')}}">{{__('webMessage.vision')}}</a></li>
                        <li class="active"><a href="{{url('/team')}}">{{__('webMessage.team')}}</a></li>
                    </ul>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6 wow fadeInUp" data-wow-delay=".3s">
                            @if(app()->getLocale()=="en") {!!$settingInfo->team_content_en!!} @else  {!!$settingInfo->team_content_ar!!} @endif
                        </div>
                        <div class="col-md-6 pic-services wow fadeInUp" data-wow-delay=".6s">
                            <img src="{{url('assets/images/slider/slide-3.jpg')}}" class="img-responsive" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

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
                        <img src="images/logo/1.png" class="img-responsive" alt="">
                        <img src="images/logo/2.png" class="img-responsive" alt="">
                        <img src="images/logo/3.png" class="img-responsive" alt="">
                        <img src="images/logo/4.png" class="img-responsive" alt="">
                        <img src="images/logo/5.png" class="img-responsive" alt="">
                        <img src="images/logo/6.png" class="img-responsive" alt="">
                        <img src="images/logo/7.png" class="img-responsive" alt="">
                        <img src="images/logo/8.png" class="img-responsive" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection