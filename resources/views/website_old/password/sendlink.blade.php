<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="irstheme">

    <title>@if(app()->getLocale()=="en") {{$settingInfo->name_en}} @else {{$settingInfo->name_ar}} @endif | @if(request()->token) {{__('webMessage.resetforgotpassword')}} @else {{__('webMessage.sendfplink')}} @endif</title>
    
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
            <h2 class="text-center"> @if(request()->token) {{__('webMessage.resetforgotpassword')}} @else {{__('webMessage.sendfplink')}} @endif</h2>
        </section>
        <!-- end of hero slider -->
   
        
        <!-- start about-section -->
        <section class="about-section" id="about">
            <div class="container">
            @if(request()->token)
            <form method="post" class="fpass-validation-active" id="fpass-form-main-form" action="{{route('password.token',request()->token)}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                
                <div class="row animatedParent">
                    <div class="col col-md-4 col-xs-12 col-sm-12">&nbsp;</div>
                    <div class="col col-md-4 col-xs-12 col-sm-12">
                                @if(session('session_msg'))
                                <div class="alert alert-success">{{session('session_msg')}}</div>
                                @endif
                
                    
							<input value="{{old('email')}}" name="email" type="text" class="login_input slower animated  @if($errors->has('email')) is-invalid @endif" placeholder="{{__('webMessage.enter_email')}}" onFocus="this.placeholder=''" onBlur="this.placeholder='{{__('webMessage.enter_email')}}'">
                                @if($errors->has('email'))
                                <label id="email-error" class="invalid-feedback" for="email">{{ $errors->first('email') }}</label>
                                @endif
							   <div class="my_clear20x"></div>
                               <input value="{{old('new_password')}}" name="new_password" type="text" class="login_input slower animated  @if($errors->has('new_password')) is-invalid @endif" placeholder="{{__('webMessage.enter_new_password')}}" onFocus="this.placeholder=''" onBlur="this.placeholder='{{__('webMessage.enter_new_password')}}'">
                                @if($errors->has('new_password'))
                                <label id="new_password-error" class="invalid-feedback" for="new_password">{{ $errors->first('new_password') }}</label>
                                @endif
							   <div class="my_clear20x"></div>
                               <input value="{{old('confirm_password')}}" name="confirm_password" type="text" class="login_input slower animated  @if($errors->has('confirm_password')) is-invalid @endif" placeholder="{{__('webMessage.enter_confirm_password')}}" onFocus="this.placeholder=''" onBlur="this.placeholder='{{__('webMessage.enter_confirm_password')}}'">
                                @if($errors->has('confirm_password'))
                                <label id="confirm_password-error" class="invalid-feedback" for="confirm_password">{{ $errors->first('confirm_password') }}</label>
                                @endif
							   <div class="my_clear20x"></div>
												
							<div class="text-center"><button type="submit" class="mybutton slower animated ">{{__('webMessage.save_changes')}}</button></div>
							
							<p style="height:150px;">&nbsp;</p>
							
							
                    </div>
					<div class="col col-md-4 col-xs-12 col-sm-12">&nbsp;</div>
                </div>
                </form>            
            @else
            <form method="post" class="fpass-validation-active" id="fpass-form-main-form" action="{{route('password.email')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                
                <div class="row animatedParent">
                    <div class="col col-md-4 col-xs-12 col-sm-12">&nbsp;</div>
                    <div class="col col-md-4 col-xs-12 col-sm-12">
                @if(session('session_msg'))
                <div class="alert alert-success">{{session('session_msg')}}</div>
                @endif
                
                    
							<input value="{{old('email')}}" name="email" type="text" class="login_input slower animated  @if($errors->has('email')) is-invalid @endif" placeholder="{{__('webMessage.enter_email')}}" onFocus="this.placeholder=''" onBlur="this.placeholder='{{__('webMessage.enter_email')}}'">
                                @if($errors->has('email'))
                                <label id="email-error" class="invalid-feedback" for="email">{{ $errors->first('email') }}</label>
                                @endif
							   <div class="my_clear20x"></div>
												
							<div class="text-center"><button type="submit" class="mybutton slower animated ">{{__('webMessage.send_link_btn')}}</button></div>
							
							<p style="height:150px;">&nbsp;</p>
							
							
                    </div>
					<div class="col col-md-4 col-xs-12 col-sm-12">&nbsp;</div>
                </div>
                </form>
               @endif 
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
