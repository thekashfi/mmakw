<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="irstheme">

    <title>@if(app()->getLocale()=="en") {{$settingInfo->name_en}} @else {{$settingInfo->name_ar}} @endif | {{__('webMessage.login')}}</title>
    
    <meta name="description" content="@if(app()->getLocale()=="en") {{$settingInfo->seo_description_en}} @else {{$settingInfo->seo_description_ar}} @endif" />
    <meta name="abstract" content="@if(app()->getLocale()=="en") {{$settingInfo->seo_description_en}} @else {{$settingInfo->seo_description_ar}} @endif">
    <meta name="keywords" content="@if(app()->getLocale()=="en") {{$settingInfo->seo_keywords_en}} @else {{$settingInfo->seo_keywords_ar}} @endif" />
    <meta name="Copyright" content="{{$settingInfo->name_en}}, Kuwait Copyright 2020 - {{date('Y')}}" />
    <meta name="author" content="Gulfweb Web Design, Kuwait" />
    <META NAME="Designer" CONTENT="Gulfweb Web Design Kuwait">
    <meta name="Country" content="Kuwait" />
    <META NAME="city" CONTENT="Kuwait City">
    <META NAME="Language" CONTENT="English">
    <META NAME="Geography" CONTENT="@if(app()->getLocale()=="en") {{$settingInfo->address_en}} @else {{$settingInfo->address_ar}} @endif">
    <META NAME="Revisit-After" CONTENT="2 days">
    <meta name="robots" CONTENT="all">
    <META NAME="distribution" CONTENT="Global">
    @if($settingInfo->favicon)
    <link rel="icon" href="{{url('uploads/logo/'.$settingInfo->favicon)}}">
    @endif
    <link href="{{url('assets/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/flaticon.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/bootstrap-notify.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/owl.theme.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/slick.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/slick-theme.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/swiper.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/owl.transitions.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/style.css')}}" rel="stylesheet">
	@if(app()->getLocale()=="ar")
    <link href="{{url('assets/css/arstyle.css')}}" rel="stylesheet">
    @endif
	<link rel="stylesheet" href="{{url('assets/animation/animations.css')}}" type="text/css" media="all">
	
    <meta name="csrf-token" content="{{ csrf_token() }}">
	

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="home" data-appear-top-offset='-300'>

    <!-- start page-wrapper -->
    <div class="page-wrapper">

    <!-- start preloader -->
    <div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>        
    </div>
    <!-- end preloader -->

        <!-- Start header -->
        @include('website.includes.top_home_header')
        <!-- end of header -->


        <!-- start of hero -->
        <section class="inner_page" style="background:url({{url('assets/images/slider/slide-3.jpg')}}) no-repeat;">
            <h2 class="text-center">{{__('webMessage.login')}}</h2>
        </section>
        <!-- end of hero slider -->
   @php
   use Illuminate\Support\Facades\Cookie;
   @endphp 
        
        <!-- start about-section -->
        <section class="about-section" id="about">
            <div class="container">
            <form method="post" class="contact-validation-active" id="login-form-main-form" action="{{route('loginform')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                
                <div class="row animatedParent">
                    <div class="col col-md-4 col-xs-12 col-sm-12">&nbsp;</div>
                    <div class="col col-md-4 col-xs-12 col-sm-12">
                @if(session('session_msg'))
                <div class="alert alert-success">{{session('session_msg')}}</div>
                @endif
                @if($errors->has('invalidlogin'))
                <div class="alert alert-danger" role="alert">
                {{ $errors->first('invalidlogin') }}
                </div>
                @endif
                    
							<input value="@if(Cookie::get('xlogin_username')) {{Cookie::get('xlogin_username')}} @elseif(old('login_username')) {{old('login_username')}} @endif" name="login_username" type="text" class="login_input slower animated  @if($errors->has('login_username')) error @endif" placeholder="{{__('webMessage.enter_username')}}" onFocus="this.placeholder=''" onBlur="this.placeholder='{{__('webMessage.enter_username')}}'">
                                @if($errors->has('login_username'))
                                <label id="name-error" class="error" for="login_username">{{ $errors->first('login_username') }}</label>
                                @endif
							   <div class="my_clear20x"></div>
							
							<input value="@if(Cookie::get('xlogin_password')) {{Cookie::get('xlogin_password')}} @elseif(old('login_password')) {{old('login_password')}} @endif" name="login_password" type="password" class="login_input slower animated  @if($errors->has('login_password')) error @endif" placeholder="{{__('webMessage.enter_password')}}" onFocus="this.placeholder=''" onBlur="this.placeholder='{{__('webMessage.enter_password')}}'">
                                @if($errors->has('login_password'))
                                <label id="name-error" class="error" for="login_password">{{ $errors->first('login_password') }}</label>
                                @endif
							<div class="my_clear20x"></div>
							<label for="remember_me"><input @if(Cookie::get('xremember_me')) checked @endif type="checkbox" name="remember_me" id="remember_me" value="1">&nbsp;{{__('webMessage.remember_me_txt')}}</label>
							<a href="{{url('/password/reset')}}" class="@if(app()->getLocale()=='en') pull-right @else pull-left @endif">{{__('webMessage.forgot_password_txt')}}</a>
							<div class="my_clear50x"></div>
							
							<div class="text-center"><button type="submit" class="mybutton slower animated ">{{__('webMessage.login_btn')}}</button></div>
							
							<p style="height:150px;">&nbsp;</p>
							
							
                    </div>
					<div class="col col-md-4">&nbsp;</div>
                </div>
                </form>
            </div> <!-- end container -->
        </section>
        <!-- end about-section -->


        <!-- start site-footer -->
        @include('website.includes.home_footer')  
        <!-- end site-footer -->

<div class='notifications top-right'></div>

    </div>
    <!-- end of page-wrapper -->

    <!-- All JavaScript files
    ================================================== -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
	<script src="{{url('assets/js/jquery.min.js')}}"></script>
	<script src="{{url('assets/animation/css3-animate-it.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>

    <script src="{{url('assets/js/jquery-plugin-collection.js')}}"></script>
    <script src="{{url('assets/js/script.js')}}"></script>
    <script src="{{url('assets/js/bootstrap-notify.js')}}"></script>
    <script>
	$(document).ready(function(){
	    $.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	    $("#subscribeBtn").click(function(e){ 
		 var newsletter_email = $("#newsletter_email").val(); 
	     $.ajax({
             url: 'subscribe_newsletter',
             data: {'newsletter_email': newsletter_email},
             type: 'POST',
             datatype: 'JSON',
             success: function(msg) { 
			    if(msg.status=="200"){
                $('.top-right').notify({message:{text: msg.message},type:'success'}).show();
				}else{
				$('.top-right').notify({message:{text: msg.message},type:'danger'}).show();
				}
             },
             error: function(msg) {
                $('.top-right').notify({message:{text: 'Error Found'},type:'danger'}).show();
             }
           });
		});
		
	});
	</script>
	
</body>
</html>
