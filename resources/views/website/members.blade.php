@extends('website.layout')

@section('title', __('webMessage.membershiplistings'))

@section('content')
            <!-- subheader -->
            <section id="subheader" style="background:url({{url('assets/images/slider/slide-3.jpg')}}) no-repeat;" data-speed="8" data-type="background">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>{{__('webMessage.membershiplistings')}}</h1>
                            <ul class="crumb">
                                <li><a href="{{url('/#home')}}">{{__('webMessage.home')}}</a></li>
                                <li class="sep">/</li>
                                <li>{{__('webMessage.membershiplistings')}}</li>
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
                        <div class="col-12">
                        @if(count($memberslistsds))
                            @foreach($memberslistsds as $memberslist)
                                <img src="{{url('uploads/memberships/'.$memberslist->image)}}" alt="" class="pic_left w-100" style="max-width: 370px;">
                                {!! app()->getLocale()=="en" ? $memberslist->details_en : $memberslist->details_ar !!}
                                <div class="clear30x"></div>
                            @endforeach
                        @endif
                        </div>
                    </div>
                </div>
            </div>

@endsection