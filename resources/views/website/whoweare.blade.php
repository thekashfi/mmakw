@extends('website.layout')

@section('title', app()->getLocale()=="en" ? $settingInfo->who_title_en : $settingInfo->who_title_ar)

@section('content')
    <div x-data="{tab: 'who'}">
        <!-- subheader -->
        <template x-if="tab == 'mission'">
            <section id="subheader" data-speed="8" data-type="background" style="background:url({{url('uploads/mission.jpg')}}) no-repeat;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>@if(app()->getLocale()=="en") {{$settingInfo->mission_title_en}} @else  {{$settingInfo->mission_title_ar}} @endif</h1>
                            <ul class="crumb">
                                <li><a href="{{url('/#home')}}">{{__('webMessage.home')}}</a></li>
                                <li class="sep">/</li>
                                <li><a href="{{url('/#about')}}">{{__('webMessage.aboutus')}}</a></li>
                                <li class="sep">/</li>
                                <li>{{__('webMessage.mission')}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </template>
        <!-- subheader close -->

        <!-- subheader -->
        <template x-if="tab == 'vision'">
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
        </template>
        <!-- subheader close -->

        <!-- subheader -->
        <template x-if="tab == 'team'">
            <section id="subheader" data-speed="8" data-type="background" style="background:url({{url('uploads/team.jpg')}}) no-repeat;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
{{--                            <h1>@if(app()->getLocale()=="en") {{$settingInfo->team_title_en}} @else {{$settingInfo->team_title_ar}} @endif</h1>--}}
                            <h1>{{__('webMessage.ourteam')}}</h1>
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
        </template>
        <!-- subheader close -->

        <!-- subheader -->
        <template x-if="tab == 'who'">
            <section id="subheader" data-speed="8" data-type="background" style="background:url({{url('uploads/who.jpg')}}) no-repeat;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>@if(app()->getLocale()=="en") {{$settingInfo->who_title_en}} @else  {{$settingInfo->who_title_ar}} @endif</h1>
                            <ul class="crumb">
                                <li><a href="{{url('/#home')}}">{{__('webMessage.home')}}</a></li>
                                <li class="sep">/</li>
                                <li><a href="{{url('/#about')}}">{{__('webMessage.aboutus')}}</a></li>
                                <li class="sep">/</li>
                                <li>{{__('webMessage.whoweare')}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </template>
        <!-- subheader close -->

        <!-- content begin -->
        <div id="content">
            <div class="container">
                <div class="row">
                    <div id="sidebar" class="col-md-3 wow fadeInUp">
                        <ul id="services-list">
                            <li x-bind:class="{ 'active': tab == 'who' }" x-on:click.prevent="tab = 'who'"><a href="{{url('/who')}}">{{ $settingInfo["who_title_" . app()->getLocale()]}}</a></li>
                            <li x-bind:class="{ 'active': tab == 'mission' }" x-on:click.prevent="tab = 'mission'"><a href="{{url('/mission')}}">{{__('webMessage.mission')}}</a></li>
                            <li x-bind:class="{ 'active': tab == 'vision' }" x-on:click.prevent="tab = 'vision'"><a href="{{url('/vision')}}">{{__('webMessage.vision')}}</a></li>
                            <li x-bind:class="{ 'active': tab == 'team' }" x-on:click.prevent="tab = 'team'"><a href="{{url('/team')}}">{{__('webMessage.team')}}</a></li>
                        </ul>
                    </div>

                    <div class="col-md-9">
                        <div class="row" x-show="tab == 'mission'">
                            <div class="col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                @if(app()->getLocale()=="en") {!!$settingInfo->mission_details_en!!} @else  {!!$settingInfo->mission_details_ar!!} @endif
                            </div>
                            <div class="col-md-6 pic-services wow fadeInUp" data-wow-delay=".6s">
                                <img src="{{url('uploads/mission2.jpg')}}" class="img-responsive" alt="">
                            </div>
                        </div>

                        <div class="row" x-show="tab == 'vision'">
                            <div class="col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                @if(app()->getLocale()=="en") {!!$settingInfo->vision_details_en!!} @else  {!!$settingInfo->vision_details_ar!!} @endif
                            </div>
                            <div class="col-md-6 pic-services wow fadeInUp" data-wow-delay=".6s">
                                <img src="{{url('uploads/vision2.jpg')}}" class="img-responsive" alt="">
                            </div>
                        </div>

                        <div class="row" x-show="tab == 'team'">
                            <div class="col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                @if(app()->getLocale()=="en") {!!$settingInfo->team_content_en!!} @else  {!!$settingInfo->team_content_ar!!} @endif
                            </div>
                            <div class="col-md-6 pic-services wow fadeInUp" data-wow-delay=".6s">
                                <img src="{{url('uploads/team2.jpg')}}" class="img-responsive" alt="">
                            </div>
                        </div>

                        <div class="row" x-show="tab == 'who'">
                            <div class="col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                @if(app()->getLocale()=="en") {!!$settingInfo->who_details_en!!} @else  {!!$settingInfo->who_details_ar!!} @endif
                            </div>
                            <div class="col-md-6 pic-services wow fadeInUp" data-wow-delay=".6s">
                                <img src="{{url('uploads/who2.jpg')}}" class="img-responsive" alt="">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="{{url('new_assets')}}/js/alpine_3.10.js"></script>
    </div>
@endsection