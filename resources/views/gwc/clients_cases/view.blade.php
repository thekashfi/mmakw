<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<base href="../../">
		<meta charset="utf-8" />
		<title>{{__('adminMessage.websiteName')}}|{{__('adminMessage.case_details')}}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--css files -->
		@include('gwc.css.user')
        <link rel="stylesheet" href="{!! url('admin_assets/assets/plugins/jstree/dist/themes/default/style.min.css') !!}" />
		<!-- token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				@php
                $settingDetailsMenu = App\Http\Controllers\AdminDashboardController::getSettingsDetails();
                @endphp
                <a href="{{url('/gwc/home')}}">
                @if($settingDetailsMenu['logo'])
				<img alt="{{__('adminMessage.websiteName')}}" src="{!! url('uploads/logo/'.$settingDetailsMenu['logo']) !!}" height="40" />
                @endif
			   </a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				
				<button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<!-- begin:: Aside -->
				@include('gwc.includes.leftmenu')

				<!-- end:: Aside -->
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					@include('gwc.includes.header')
                   

					<!-- end:: Header -->
					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

						<!-- begin:: Subheader -->
						<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
									<h3 class="kt-subheader__title">{{__('adminMessage.cases')}}</h3>
									<span class="kt-subheader__separator kt-subheader__separator--v"></span>
									<div class="kt-subheader__breadcrumbs">
										<a href="{{url('home')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
										<span class="kt-subheader__breadcrumbs-separator"></span>
										<a href="javascript:;" class="kt-subheader__breadcrumbs-link">{{__('adminMessage.case_details')}}</a>
									</div>
								</div>
								<div class="kt-subheader__toolbar"><a href="{{url('gwc/clients_cases/'.$viewcases->client_id)}}" class="btn btn-default btn-bold">{{__('adminMessage.back')}}</a>
								</div>
							</div>
						</div>

						<!-- end:: Subheader -->

						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                           @if(Session::get('message-success'))
							<div class="alert alert-light alert-success" role="alert">
								<div class="alert-icon"><i class="flaticon-alert kt-font-brand btn-icon-sm"></i></div>
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
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											{{__('adminMessage.casedetails')}} {{__('adminMessage.for')}} <span class="kt-badge kt-badge--brand kt-badge--inline">{{$clientInfo->name}}</span>
										</h3>
									</div>
								</div>
                      
								<div class="kt-portlet__body">
                                @if(auth()->guard('admin')->user()->can('clients-case-view'))
                                <div class="row">
                                <div class="col-lg-6">
                                @if($viewcases->title_en)<div class="kt-section kt-section--space-sm kt-font-boldest ">{{$viewcases->title_en}}</div>@endif  
                                @if($viewcases->details_en)<div class="kt-section kt-section--space-sm">{!!$viewcases->details_en!!}</div>@endif  
                                @if($CaseType->title_en)<div class="kt-section kt-section--space-sm "><label class="kt-font-boldest">{{__('adminMessage.case_type')}} : </label> {{$CaseType->title_en}}</div>@endif  
                               <div class="kt-section kt-section--space-sm "><label class="kt-font-boldest">{{__('adminMessage.date')}} : </label> {{$viewcases->case_date}}</div>
                               <div class="kt-section kt-section--space-sm "><label class="kt-font-boldest">{{__('adminMessage.reference_number')}} : </label> {{$viewcases->reference_number}}</div>
                               
                               <div class="kt-section kt-section--space-sm "><label class="kt-font-boldest">{{__('adminMessage.created_at')}} : </label> {{$viewcases->created_at}}</div>
                                
                                </div>
                                <div class="col-lg-6" dir="rtl" align="right">
                                @if($viewcases->title_ar)<div class="kt-section kt-section--space-sm kt-font-boldest">{{$viewcases->title_ar}}</div>@endif  
                                @if($viewcases->details_ar)<div class="kt-section kt-section--space-sm">{!!$viewcases->details_ar!!}</div>@endif  
                                </div>
                                </div>   
                                @if(!empty($caseattachlists) && count($caseattachlists)>0)
                                <div class="kt-font-boldest"><p>{{__('adminMessage.attachments')}} :</p></div>
                                <div class="row">
                                @foreach($caseattachlists as $key=>$caseattachlist)
                                <div class="col-lg-2"><a class="btn btn-success trackCaseLogs" title="clicked to attachment : @if($viewcases->title_en) {{$viewcases->title_en}} @endif" href="{{url('uploads/attach/'.$caseattachlist->file_name)}}" target="_blank">@if($caseattachlist->title_en) {{$caseattachlist->title_en}} @else {{__('adminMessage.download')}}-{{$key}} @endif</a></div>
                                @endforeach
                                </div>
                                @endif
                                
                                
                                
                                 
                                @else
                                <div class="alert alert-light alert-warning" role="alert">
                                    <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                    <div class="alert-text">{{__('adminMessage.youdonthavepermission')}}</div>
                                </div>
                                @endif
									<!--end: Datatable -->
								</div>
                                
                                
							</div>
                            
                            <!-- show updates time line -->
                            @if(auth()->guard('admin')->user()->can('clients-case-view'))
                              <!--Begin::Portlet-->
							<div class="kt-portlet">
								<div class="kt-portlet__head">
									<div class="kt-portlet__head-label">
										<h3 class="kt-portlet__head-title">
											{{__('adminMessage.caseupdates')}}
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">
									<div class="row">
										<div class="col-xl-1">
										</div>
										<div class="col-xl-10">
											<div class="kt-timeline-v1">
												<div class="kt-timeline-v1__items">
													<div class="kt-timeline-v1__marker"></div>
                                     @if(!empty($caseupdateslists) && count($caseupdateslists)>0)   
                                     @foreach($caseupdateslists as $caseupdateslist)            
													<div class="kt-timeline-v1__item kt-timeline-v1__item--left kt-timeline-v1__item--first">
														<div class="kt-timeline-v1__item-circle">
															<div class="{{$caseupdateslist->is_read=='0'?'kt-bg-danger':'kt-bg-success'}}"></div>
														</div>
														<span class="kt-timeline-v1__item-time kt-font-brand">
															{{ \Carbon\Carbon::parse($caseupdateslist->created_at)->diffForHumans() }}
														</span>
														<div class="kt-timeline-v1__item-content">
                                                            @if($caseupdateslist->details_en)
															<div class="kt-timeline-v1__item-body">
															{!! $caseupdateslist->details_en !!}
															</div>
                                                            @endif
                                                            @if($caseupdateslist->details_ar)
															<div class="kt-timeline-v1__item-body" dir="rtl" align="right">
															{!! $caseupdateslist->details_ar !!}
															</div>
                                                            @endif
                                                            
                                        @php
                                        $updateAttachs = App\Http\Controllers\AdminCasesController::getUpdatesAttach($viewcases->id,$caseupdateslist->id);
                                       
                                        @endphp 
                                                            @if($updateAttachs) 
                                                            <div class="kt-font-boldest"><p>{{__('adminMessage.attachments')}} :</p></div>   
                                                            <div class="row">
                                                            @foreach($updateAttachs as $updateAttach)   
															<div class="kt-timeline-v1__item-actions col-lg-3">
																<a href="{{url('uploads/attach/'.$updateAttach->file_name)}}" class="btn btn-label-success btn-bold btn-sm trackCaseLogs" target="_blank" title="Clicked to attachment file : @if($updateAttach->title_en){{$updateAttach->title_en}}@endif">@if($updateAttach->title_en) {{$updateAttach->title_en}} @else {{__('adminMessage.download')}}-{{$key}} @endif</a>
															</div>
                                                            @endforeach
                                                            </div>
                                                            @endif
														</div>
													</div>
                                        @endforeach            
										@endif			
													
													
												</div>
											</div>
											
										</div>
										<div class="col-xl-1">
										</div>
									</div>
								</div>
							</div>

							<!--End::Portlet-->
                            @endif
                            <!-- end timeline-->
						</div>

						<!-- end:: Content -->
					</div>

					<!-- begin:: Footer -->
					@include('gwc.includes.footer');

					<!-- end:: Footer -->
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Quick Panel -->
		

		<!-- end::Quick Panel -->

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->

		<!-- js files -->
		@include('gwc.js.user')
         
    
	</body>
	<!-- end::Body -->
</html>