<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="irstheme">

    <title>@if(app()->getLocale()=="en") {{$settingInfo->name_en}} @else {{$settingInfo->name_ar}} @endif | {{__('webMessage.casesupdates')}} | @if(app()->getLocale()=="en") {{$casedetails->title_en}} @else {{$casedetails->title_ar}} @endif</title>
    
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
            <h2 class="text-center">{{__('webMessage.casesupdates')}}</h2>
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
						
                        <div class="row form-group">
                        <div class="col col-md-10 col-sm-10 font-weight-bold"><span class="my_title">{{__('webMessage.details')}}</span></div>
                        <div class="col col-md-2 col-sm-2"><a href="{{url('/casesupdates')}}" class="mybutton btn btn-sm">{{__('webMessage.back')}}</a></div>
                        </div>
                        
						<div class="my_clear20x"></div>
                        
                        <div class="row form-group">
                        <div class="col col-md-3 font-weight-bold"><b>{{__('webMessage.title')}}</b></div>
                        <div class="col col-md-9">@if(app()->getLocale()=="en") {{$casedetails->title_en}} @else {{$casedetails->title_ar}} @endif</div>
                        </div>
                        
                        <div class="row form-group">
                        <div class="col col-md-3 font-weight-bold"><b>{{__('webMessage.date')}}</b></div>
                        <div class="col col-md-9">{{$casedetails->case_date}}</div>
                        </div>
                        
                        <div class="row form-group">
                        <div class="col col-md-3 font-weight-bold"><b>{{__('webMessage.reference_number')}}</b></div>
                        <div class="col col-md-9">{{$casedetails->reference_number}}</div>
                        </div>
                        
                        @php 
                        $typeDetails = App\Http\Controllers\accountController::getCaseType($casedetails->type_id);
                        @endphp
                        
                        <div class="row form-group">
                        <div class="col col-md-3 font-weight-bold"><b>{{__('webMessage.type')}}</b></div>
                        <div class="col col-md-9">@if(app()->getLocale()=="en") {{$typeDetails->title_en}} @else {{$typeDetails->title_ar}} @endif</div>
                        </div>
                        
                        <div class="row form-group">
                        <div class="col col-md-3 font-weight-bold"><b>{{__('webMessage.details')}}</b></div>
                        <div class="col col-md-9 text-justify slower animated">
                        
                        @if(app()->getLocale()=="en") {!!$casedetails->details_en!!} @else  {!!$casedetails->details_ar!!} @endif
                       
                        </div>
                        </div>
                        
                        @php 
                        $caseAttachs = App\Http\Controllers\accountController::getCaseAttach($casedetails->id);
                        @endphp
                        @if(!empty($caseAttachs))
                        <div class="row form-group alert alert-outline-brand alert-success ">
                        <div class="col col-md-3 font-weight-bold"><b>{{__('webMessage.attachements')}}</b></div>
                        <div class="col col-md-9">
                        @foreach($caseAttachs as $caseAttach)
                        <p>@if(app()->getLocale()=='en') {{$caseAttach->title_en}} @else  {{$caseAttach->title_ar}} @endif</p>
                        <p>{{$caseAttach->doc_date}}</p>
                        <a href="{{url('uploads/attach/'.$caseAttach->file_name)}}" target="_blank" class="btn btn-info" title="@if(app()->getLocale()=='en') {{$caseAttach->title_en}} @else  {{$caseAttach->title_ar}} @endif">{{__('webMessage.download')}}</a>
                        <hr>
                        @endforeach
                        </div>
                        </div>
                        @endif
                        
                        
                        @php 
                        $getCasesUpdates = App\Http\Controllers\accountController::getCasesUpdates($casedetails->id);
                        @endphp
                        @if(!empty($getCasesUpdates))
                        <div class="form-group">
                        <span  class="my_title">{{__('webMessage.casesupdates')}}</span>
                        </div>
                        
                        @foreach($getCasesUpdates as $getCasesUpdate)
                        <div class="row form-group">
                        <div class="col col-md-3 font-weight-bold"><b>{{__('webMessage.date')}}</b></div>
                        <div class="col col-md-9">{{$getCasesUpdate->case_date}}</div>
                        </div>   
                        
                        <div class="row form-group">
                        <div class="col col-md-3 font-weight-bold"><b>{{__('webMessage.message')}}</b></div>
                        <div class="col col-md-9 text-justify slower animated">
                        @if(app()->getLocale()=="en") {!!$getCasesUpdate->details_en!!} @else  {!!$getCasesUpdate->details_ar!!} @endif
                        </div>
                        </div> 
                           
                        <!-- update sttach-->
                        @php 
                        $caseAttachsUpdates = App\Http\Controllers\accountController::getCasesUpdatesAttach($getCasesUpdate->id);
                        @endphp
                        @if(!empty($caseAttachsUpdates) && count($caseAttachsUpdates)>0)
                        <div class="row form-group alert alert-outline-brand alert-info">
                        <div class="col col-md-3 font-weight-bold"><b>{{__('webMessage.attachements')}}</b></div>
                        <div class="col col-md-9">
                        @foreach($caseAttachsUpdates as $caseAttachsUpdate)
                        <p>@if(app()->getLocale()=='en') {{$caseAttachsUpdate->title_en}} @else  {{$caseAttachsUpdate->title_ar}} @endif</p>
                        <p>{{$caseAttachsUpdate->doc_date}}</p>
                        <a href="{{url('uploads/attach/'.$caseAttachsUpdate->file_name)}}" target="_blank" class="btn btn-warning" title="@if(app()->getLocale()=='en') {{$caseAttachsUpdate->title_en}} @else  {{$caseAttachsUpdate->title_ar}} @endif">{{__('webMessage.download')}}</a>
                        <hr>
                        @endforeach
                        </div>
                        </div>
                        @endif
                        <!-- end -->  
                        <div class="my_clear20x"><hr></div>                  
                        @endforeach
						
				        @endif
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
