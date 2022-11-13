@extends('website.layout')

@section('title', app()->getLocale()=="en" ? $servicedetails->title_en : $servicedetails->title_ar)

@section('description', app()->getLocale()=="en" ? $servicedetails->seo_description_en : $servicedetails->seo_description_ar)
@section('abstract', app()->getLocale()=="en" ? $servicedetails->seo_description_en : $servicedetails->seo_description_ar)
@section('keywords', app()->getLocale()=="en" ? $servicedetails->seo_keywords_en : $servicedetails->seo_keywords_ar)

@section('content')
    <!-- subheader -->
    <section id="subheader" data-speed="8" data-type="background" style="background:url({{url("uploads/services/$servicedetails->image")}}) no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>@if(app()->getLocale()=="en") {{$servicedetails->title_en}} @else  {{$servicedetails->title_ar}} @endif</h1>
                    <ul class="crumb">
                        <li><a href="{{url('/#home')}}">{{__('webMessage.home')}}</a></li>
                        <li class="sep">/</li>
                        <li><a href="#">{{__('webMessage.services')}}</a></li>
                        <li class="sep">/</li>
                        <li>@if(app()->getLocale()=="en") {{$servicedetails->title_en}} @else  {{$servicedetails->title_ar}} @endif</li>
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
                        @if(count($servicesMenus))
                            @foreach($servicesMenus as $servicesMenu)
                            <li class="{{ Request::is("services/$servicesMenu->slug") ? 'active' : '' }}"><a href="{{url('/services/'.$servicesMenu->slug)}}">{{ app()->getLocale()=="en" ? $servicesMenu->menu_name_en : $servicesMenu->menu_name_ar }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6 wow fadeInUp" data-wow-delay=".3s">
                            @if(app()->getLocale()=="en") {!!$servicedetails->details_en!!} @else  {!!$servicedetails->details_ar!!} @endif
                        </div>
                        <div class="col-md-6 pic-services wow fadeInUp" data-wow-delay=".6s">
                            <img src="{{url("uploads/services/$servicedetails->image")}}" class="img-responsive" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection