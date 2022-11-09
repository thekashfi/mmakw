<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@if(app()->getLocale()=="en") {{$settingInfo->name_en}} @else {{$settingInfo->name_ar}} @endif</title>
    
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
    
    <script src='https://www.google.com/recaptcha/api.js'></script>
	<style>.g-recaptcha {transform:scale(0.90);transform-origin:0 0;}</style>

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
    @include('website.includes.top_home_header')
    <!-- start of hero -->
    @include('website.includes.home_slider')    
    <!-- end of hero slider -->
    <!-- start about-section -->
    @include('website.includes.home_aboutus')  
    <!-- end about-section -->
    <!-- start case-studies-section -->
    @include('website.includes.home_services')      
    <!-- end case-studies-section -->
    <!--membership -->
    @include('website.includes.home_members')      
    <!--end of membership-->
    <!-- start news-section -->
    @include('website.includes.home_news') 
		
	<!-- start contact-section -->
    @include('website.includes.home_contact')    
    <!-- end contact-section -->
    
	<div class="my_clear50x"></div>
	
    <!-- end news-section -->
    <!-- start site-footer -->
    @include('website.includes.home_footer')  
    <!-- end site-footer -->
     <div class='notifications top-right'></div>
    </div>
    <!-- end of page-wrapper -->
   
    <!-- All JavaScript files
    ================================================== -->
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
		@if(!empty($settingInfo->is_active_survey))
		//reload modal if available
		$("#myCovidModal").modal({backdrop: "static"});
		@endif
	});
	</script>
    
</body>
</html>
