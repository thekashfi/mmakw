@extends('website.layout')

@section('title', __('webMessage.contactus'))

@section('content')

    <!-- subheader -->
    <section id="subheader" data-speed="8" data-type="background" style="background-image: url({{ url('') }}/uploads/contactus.webp)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{__('webMessage.contactus')}}</h1>
                    <ul class="crumb">
                        <li><a href="{{ url('') }}">{{__('webMessage.home')}}</a></li>
                        <li class="sep">/</li>
                        <li>{{__('webMessage.contactus')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- subheader close -->

    <!-- content begin -->
    <div id="content" class="no-top">
        <section id="de-map" aria-label="map-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="map-container map-fullwidth">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13938.142999145952!2d48.1134324876605!3d29.148880755746475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fcf0907fa1e4a5d%3A0x19d132e53b4fc50a!2sMahboula!5e0!3m2!1sen!2skw!4v1666197073572!5m2!1sen!2skw" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="row" id="form">

                <div class="col-md-8">
                    <form action="{{ url('') }}/contactform" id='contact_form' method="post">
                        @csrf
                        <input type='hidden' name='subject' value="{{ \App\Subjects::first()->id }}">
                        <div class="row">
                            <div class="col-md-12 mb10">
                                <h3>{{__('webMessage.send_us_message')}}</h3>
                            </div>
                            <div class="col-md-6">
                                @if($errors->has('name'))
                                    <div id='name_error' class='error d-block'>{{ $errors->first('name') }}</div>
                                @endif
                                <div>
                                    <input type='text' name='name' id='name' class="form-control" placeholder="{{__('webMessage.enter_your_name')}}" value="{{ old('name') }}" required>
                                </div>


                                @if($errors->has('email'))
                                    <div id='name_error' class='error d-block'>{{ $errors->first('email') }}</div>
                                @endif
                                <div>
                                    <input type='email' name='email' id='email' class="form-control" placeholder="{{__('webMessage.enter_your_email')}}" value="{{ old('email') }}" required>
                                </div>

                                @if($errors->has('mobile'))
                                    <div id='name_error' class='error d-block'>{{ $errors->first('mobile') }}</div>
                                @endif
                                <div>
                                    <input type='text' name='mobile' id='mobile' class="form-control" placeholder="{{__('webMessage.enter_your_phone')}}" value="{{ old('mobile') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if($errors->has('message'))
                                    <div id='name_error' class='error d-block'>{{ $errors->first('message') }}</div>
                                @endif
                                <div>
                                    <textarea name='message' id='message' class="form-control" placeholder="{{__('webMessage.write_some_text')}}" required>{{ old('message') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="g-recaptcha" data-sitekey="6LeMueQUAAAAAJ-ZUe9ZqGK3pma9VwbeoaYDgJte"></div>
                                <p id='submit' class="mt20">
                                    <input type='submit' id='send_message' value='{{__('webMessage.sendnow')}}' class="btn btn-line">
                                </p>
                            </div>
                        </div>
                    </form>




                    @if ($message = Session::get('message-success'))
                        <div id="success_message" class='success d-block'>
                            {{ $message }}
                        </div>
                    @endif

{{--                    @if($errors->any())--}}
{{--                        <div id="error_message" class='error d-block'>--}}
{{--                            {{ implode('', $errors->all('<div>:message</div>')) }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

                    @if($message = Session::get('message-failed'))
                        <div id="error_message" class='error d-block'>
                            {{ $message }}
                        </div>
                    @endif

                </div>

                <div id="sidebar" class="col-md-4">

                    <div class="widget widget_text">
                        <h3>{{__('webMessage.contact_info')}}</h3>
                        <address>
                            @if($settingInfo['address_' . app()->getLocale()])
                                <span><strong>{{__('webMessage.address')}}:</strong>{{$settingInfo['address_' . app()->getLocale()]}}</span>
                            @endif
                            @if($settingInfo->phone)
                                <span><strong>{{__('webMessage.phone')}}:</strong>{{$settingInfo->phone}}</span>
                            @endif
                            @if($settingInfo->fax)
                                <span><strong>{{__('webMessage.fax')}}:</strong>{{$settingInfo->fax}}</span>
                            @endif
                            @if($settingInfo->email)
                                <span><strong>{{__('webMessage.email')}}:</strong><a href="mailto:{{$settingInfo->email}}">{{$settingInfo->email}}</a></span>
                            @endif
                            @if($settingInfo['office_hours_' . app()->getLocale()])
                                <span><strong>{{__('webMessage.officehours')}}</strong>{{$settingInfo['office_hours_' . app()->getLocale()]}}</span>
                            @endif
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection