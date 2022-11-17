@extends('website.layout')

@section('title', app()->getLocale()=="en" ? $settingInfo->vision_title_en : $settingInfo->vision_title_ar)

@section('content')
    <!-- subheader -->
    <section id="subheader" data-speed="8" data-type="background" style="background:url({{url('uploads/vision.jpg')}}) no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>@if(app()->getLocale()=="en") {{$settingInfo->vision_title_en}} @else  {{$settingInfo->vision_title_ar}} @endif</h1>
                    <ul class="crumb">
                        <li><a href="{{url('/#home')}}">{{__('webMessage.home')}}</a></li>
                        <li class="sep">/</li>
                        <li><a href="{{url('/#about')}}">{{__('webMessage.aboutus')}}</a></li>
                        <li class="sep">/</li>
                        <li>{{__('webMessage.vision')}}</li>
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
                        <li class="active"><a href="{{url('/vision')}}">{{__('webMessage.vision')}}</a></li>
                        <li><a href="{{url('/team')}}">{{__('webMessage.team')}}</a></li>
                    </ul>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6 wow fadeInUp" data-wow-delay=".3s">
                            @if(app()->getLocale()=="en") {!!$settingInfo->vision_details_en!!} @else  {!!$settingInfo->vision_details_ar!!} @endif
                        </div>
                        <div class="col-md-6 pic-services wow fadeInUp" data-wow-delay=".6s">
                            <img src="{{url('uploads/vision2.jpg')}}" class="img-responsive" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection