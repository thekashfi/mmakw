<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="irstheme">

    <title>@if(app()->getLocale()=="en") {{$settingInfo->name_en}} @else {{$settingInfo->name_ar}} @endif | {{__('webMessage.editprofile')}}</title>
    
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
            <h2 class="text-center">{{__('webMessage.editprofile')}}</h2>
        </section>
        <!-- end of hero slider -->

        
        <!-- start about-section -->
        <section class="about-section" id="about">
            <div class="container">
                <div class="row animatedParent">
                    <div class="col col-md-3 col-xs-12 col-sm-12 mobi-t-20">
					@include('website.includes.left_menu')
					</div>
					
                    <div class="col col-md-9 col-xs-12 col-sm-12 mobi-t-20">
                            @if(Session::get('message-success'))
							<div class="alert alert-light alert-success" role="alert">
								<div class="alert-icon"><i class="flaticon-alert kt-font-brand"></i></div>
								<div class="alert-text">
									{{ Session::get('message-success') }}
								</div>
							</div>
                           @endif 
                           @if(Session::get('message-error'))
							<div class="alert alert-light alert-warning" role="alert">
								<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
								<div class="alert-text">
									{{ Session::get('message-error') }}
								</div>
							</div>
                           @endif
                          

						
                     <form method="post" class="contact-validation-active" id="editprofile-form-main-form" name="editprofile-form-main-form" action="{{route('editprofileSave')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">				
					    
                        
						<div class="row form-group">
                        <div class="col col-md-6 col-xs-12 col-sm-12">
                        <label>{{__('webMessage.name')}}</label>
                        <input name="name" id="name" type="text" class="login_input mb-10  slower animated  @if($errors->has('name')) is-invalid @endif" value="{{Auth::guard('webs')->user()->name}}" placeholder="{{__('webMessage.enter_name')}}">
                         @if($errors->has('name'))
                          <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                         @endif
                        </div>
                        <div class="col col-md-6 col-xs-12 col-sm-12">
                        <label>{{__('webMessage.email')}}</label>
                        <input name="email" id="email" type="email" class="login_input mb-10  slower animated  @if($errors->has('email')) is-invalid @endif" value="{{Auth::guard('webs')->user()->email}}" placeholder="{{__('webMessage.enter_email')}}">
                        @if($errors->has('email'))
                          <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                         @endif
                        </div>
                        </div>
                        
                        <div class="row form-group">
                        <div class="col col-md-4 col-xs-12 col-sm-12">
                        <label>{{__('webMessage.mobile')}}-1</label>
                        <input name="mobile1" id="mobile1" type="number" class="login_input mb-10  slower animated  @if($errors->has('mobile1')) is-invalid @endif" value="{{Auth::guard('webs')->user()->mobile1}}" placeholder="{{__('webMessage.enter_mobile')}}">
                        @if($errors->has('mobile1'))
                          <div class="invalid-feedback">{{ $errors->first('mobile1') }}</div>
                         @endif
                        </div>
                        <div class="col col-md-4 col-xs-12 col-sm-12">
                        <label>{{__('webMessage.mobile')}}-2</label>
                        <input name="mobile2" id="mobile2" type="number" class="login_input mb-10  slower animated " value="{{Auth::guard('webs')->user()->mobile2}}" placeholder="{{__('webMessage.enter_mobile')}}">
                        </div>
                        <div class="col col-md-4 col-xs-12 col-sm-12">
                        <label>{{__('webMessage.mobile')}}-3</label>
                        <input name="mobile3" id="mobile3" type="number" class="login_input mb-10  slower animated " value="{{Auth::guard('webs')->user()->mobile3}}" placeholder="{{__('webMessage.enter_mobile')}}">
                        </div>
                        </div>
                        
                        
                        <div class="row form-group">
                        <div class="col col-md-4 col-xs-12 col-sm-12">
                        <label>{{__('webMessage.image')}}</label>
                        <input name="image" id="image" type="file" class="login_input mb-10  slower animated  @if($errors->has('image')) is-invalid @endif" >
                        @if($errors->has('image'))
                          <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                         @endif
                        </div>
                        <div class="col col-md-4 col-xs-12 col-sm-12">
                        <br>
                        @if(Auth::guard('webs')->user()->image)
                        <img src="{{url('uploads/clients/thumb/'.Auth::guard('webs')->user()->image)}}" width="50">
                        @endif
                        </div>
                        </div>
						
						
						<div class="my_clear20x"></div>
						
						<div class="text-center"><button class="mybutton slower animated ">{{__('webMessage.save_changes')}}</button></div>
						
					   </form>      
						
                  </div>
                </div>
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
