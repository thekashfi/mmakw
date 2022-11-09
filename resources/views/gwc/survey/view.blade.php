<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<base href="../../">
		<meta charset="utf-8" />
		<title>{{__('adminMessage.websiteName')}}|{{__('adminMessage.surveydetails')}}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--css files -->
		@include('gwc.css.user')
        <link rel="stylesheet" href="{!! url('admin_assets/assets/plugins/jstree/dist/themes/default/style.min.css') !!}" />
		<!-- token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
		.form-control{border:1px #FFFFFF solid;}
		</style>
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
									<h3 class="kt-subheader__title">{{__('adminMessage.surveydetails')}}</h3>
									<span class="kt-subheader__separator kt-subheader__separator--v"></span>
									<div class="kt-subheader__breadcrumbs">
										<a href="{{url('home')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
										<span class="kt-subheader__breadcrumbs-separator"></span>
										<a href="javascript:;" class="kt-subheader__breadcrumbs-link">{{__('adminMessage.surveydetails')}}</a>
									</div>
								</div>
								<div class="kt-subheader__toolbar"><a href="{{url('gwc/survey')}}" class="btn btn-default btn-bold">{{__('adminMessage.back')}}</a>
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
											{{__('adminMessage.surveydetails')}}
										</h3>
									</div>
								</div>
                      
								<div class="kt-portlet__body">
                            @if(auth()->guard('admin')->user()->can('survey-view'))
						    <!--Begin:: Portlet-->
							<div class="kt-widget kt-widget--user-profile-3">
										<div class="kt-widget__top">
                                            
                                            
											<div class="kt-widget__content">
												<div class="kt-widget__head">
													<div class="kt-widget__user">
														<h2>{{$surveyDetails->name}}</h2>
													</div>
												</div>
												<div class="kt-widget__subhead">
													@if($surveyDetails->email)
                                                    <a href="javascript:;"><i class="flaticon2-new-email"></i>{{$surveyDetails->email}}</a>
                                                    @endif
                                                    
                                                    @if($surveyDetails->phone)
                                                    <a href="javascript:;"><i class="flaticon2-phone"></i>{{$surveyDetails->phone}}</a>
                                                    @endif
                                                    
                                                    @if($surveyDetails->job_title)
                                                    <a href="javascript:;"><i class="flaticon2-user"></i>{{$surveyDetails->job_title}}</a>
                                                    @endif
                                                    
                                                    
													
												</div>
												<div class="kt-widget__info">
													<div class="kt-widget__desc">
														
            
            <div class="form-group">
            <strong for="whats_company">{{trans('webMessage.whats_company')}}</strong>
            <div class="form-control">{{$surveyDetails->whats_company}}</div>
            </div>
            
            <div class="form-group">
            <strong for="company_sector">{!!trans('webMessage.company_sector')!!}</strong>
            <div class="form-control">{{$surveyDetails->company_sector}}</div>
            </div>
            
            <div class="form-group">
            <strong>{!!trans('webMessage.company_sale')!!}</strong>
            <div class="form-control">{{$surveyDetails->company_sale}}</div>
            </div>
            
            <div class="form-group">
            <strong>{!!trans('webMessage.company_operating')!!}</strong>
            <div class="form-control">{{$surveyDetails->company_operating}}</div>
            </div>
            
            <h4>{{trans('webMessage.company_branches_shut')}}</h4>
            
            <div class="form-group row">
            <strong for="Temporarily" class="col-sm-2 col-form-strong">{{trans('webMessage.Temporarily')}}</strong>
            <div class="col-sm-10">
            <div class="form-control">{{$surveyDetails->Temporarily}}</div>
            </div>
            </div>
            
            <div class="form-group row">
            <strong for="Permanently" class="col-sm-2 col-form-strong">{{trans('webMessage.Permanently')}}</strong>
            <div class="col-sm-10">
            <div class="form-control">{{$surveyDetails->Permanently}}</div>
            </div>
            </div>
            
            <div class="form-group">
            <strong>{!!trans('webMessage.shutdown_causes')!!}</strong>
            <div class="form-control">{{$surveyDetails->shutdown_causes}}</div>
            </div>
            
            <div class="form-group">
            <strong>{!!trans('webMessage.company_space')!!}</strong>
            <div class="form-control">{{$surveyDetails->company_space}}</div>
            </div>
            
            
            <div class="form-group">
            <strong for="if_selected_rent">{{trans('webMessage.if_selected_rent')}}</strong>
            <div class="form-control">{{$surveyDetails->if_selected_rent}}</div>
            </div>
            <div class="form-group">
            <strong for="total_rent_paid">{{trans('webMessage.total_rent_paid')}}</strong>
            <div class="form-control">{{$surveyDetails->total_rent_paid}}</div>
            </div>
            <div class="form-group">
            <strong for="annual_revenue">{{trans('webMessage.annual_revenue')}}</strong>
            <div class="form-control">{{$surveyDetails->annual_revenue}}</div>
            </div>
            <div class="form-group">
            <strong for="company_value">{{trans('webMessage.company_value')}}</strong>
            <div class="form-control">{{$surveyDetails->company_value}}</div>
            </div>
            <div class="form-group">
            <strong for="expected_budget">{{trans('webMessage.expected_budget')}}</strong>
            <div class="form-control">{{$surveyDetails->expected_budget}}</div>
            </div>
            
            
            <div class="form-group">
            <strong>{{trans('webMessage.people_employed')}}</strong>
            <div class="row">
            <div class="col-lg-6">
            <div class="form-group">
            <strong for="" class="col-sm-4 col-form-strong">{{trans('webMessage.before_pandemic')}}</strong>
            <div class="col-sm-4">
            <div class="form-control">Kuwaiti : {{$surveyDetails->before_pandemic_kuwaiti}}</div>
            </div>
            <div class="col-sm-4">
            <div class="form-control">Non Kuwaiti : {{$surveyDetails->before_pandemic_nonkuwaiti}}</div>
            </div>
            </div>
            </div>
             <div class="col-lg-6">
            <div class="form-group">
            <strong for="" class="col-sm-4 col-form-strong">{{trans('webMessage.currently')}}</strong>
            <div class="col-sm-4">
            <div class="form-control">Kuwaiti : {{$surveyDetails->currently_kuwaiti}}</div>
            </div>
             <div class="col-sm-4">
            <div class="form-control">Non Kuwaiti : {{$surveyDetails->currently_nonkuwaiti}}</div>
            </div>
            </div>
            </div>
            </div>
            </div>
            
            <div class="form-group">
            <strong for="other_services">{{trans('webMessage.other_services')}}</strong>
            <div class="form-control">{{$surveyDetails->other_services}}</div>
            </div>
            
            <div class="form-group">
            <strong>{!!trans('webMessage.company_provide_online')!!}</strong>
             <div class="form-control">{{$surveyDetails->company_provide_online}}</div>
            </div>
            
            <div class="form-group">
            <strong>{!!trans('webMessage.online_platform')!!}</strong>
            <div class="form-control">{{$surveyDetails->online_platform}}</div>
            </div>
            
            
            <div class="form-group">
            <strong>{!!trans('webMessage.affected_your_company')!!}</strong>
            <div class="form-control">{{$surveyDetails->affected_your_company}}</div>
            </div>
            
            <div class="form-group">
            <strong>{!!trans('webMessage.chance_to_shut')!!}</strong>
            <div class="form-control">{{$surveyDetails->chance_to_shut}}</div>
            </div>
            
            
            <div class="form-group">
            <strong for="additional_cost">{{trans('webMessage.additional_cost')}}</strong>
            <div class="form-control">{{$surveyDetails->additional_cost}}</div>
            </div>
            
            <div class="form-group">
            <strong for="additional_comments">{{trans('webMessage.additional_comments')}}</strong>
            <div class="form-control">{{$surveyDetails->additional_comments}}</div>
            </div>

													</div>
													
												</div>
											</div>
										</div>
										
									</div>

							<!--End:: Portlet-->	
                            @else
                            <div class="alert alert-light alert-warning" role="alert">
								<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
								<div class="alert-text">{{__('adminMessage.youdonthavepermission')}}</div>
							</div>
                            @endif
									<!--end: Datatable -->
								</div>
							</div>
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