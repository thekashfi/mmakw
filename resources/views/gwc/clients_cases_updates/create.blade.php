<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>{{__('adminMessage.websiteName')}}|{{__('adminMessage.createnewscaseupdate')}}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--css files -->
		@include('gwc.css.user')
		<!-- token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
		#field {
    margin-bottom:20px;
}
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
									<h3 class="kt-subheader__title">{{__('adminMessage.casesupdates')}}</h3>
									<span class="kt-subheader__separator kt-hidden"></span>
									<div class="kt-subheader__breadcrumbs">
										<a href="{{url('gwc/home')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
										<span class="kt-subheader__breadcrumbs-separator"></span>
										<a href="javascript:;" class="kt-subheader__breadcrumbs-link">{{__('adminMessage.createnewscaseupdate')}}</a>
									</div>
								</div>
								
							</div>
						</div>

						<!-- end:: Subheader -->

						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
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
                      
							<!--begin::Portlet-->
									<div class="kt-portlet">
						<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
										<h3 class="kt-portlet__head-title">{{__('adminMessage.createnewscaseupdate')}}</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												
												@if(auth()->guard('admin')->user()->can('clients-case-updates-list'))
												<a href="{{url('gwc/clients_cases_updates/'.request()->case_id)}}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="la la-list-ul"></i>{{__('adminMessage.listcasesupdates')}}</a> @endif
											</div>
										</div>
									</div>
								</div>				
										<!--begin::Form-->
					@if(auth()->guard('admin')->user()->can('clients-case-updates-create'))
                    
                         <form name="tFrm"  id="form_validation"  method="post"
                          class="kt-form" enctype="multipart/form-data" action="{{route('createCaseUpdate',request()->case_id)}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="client_id" value="{{ $caseInfo->client_id }}">
											<div class="kt-portlet__body">
                                            
										<!--parent categories dropdown -->	
                                           <div class="form-group row">
                                                
                                                <div class="col-lg-6">
                                                <input type="text" id="case_date" class="form-control @if($errors->has('case_date')) is-invalid @endif" name="case_date"
                                                               value="{{old('case_date')}}" autocomplete="off"  placeholder="{{__('adminMessage.date')}}" />
                                                @if($errors->has('case_date'))
                                                <div class="invalid-feedback">{{ $errors->first('case_date') }}</div>
                                                @endif
                                                </div>
                                                
                                                <div class="col-lg-6">
                                                <div class="form-group row">
													<label class="col-2 col-form-label">{{__('adminMessage.isactive')}}</label>
													<div class="col-2">
														<span class="kt-switch">
															<label>
																<input type="checkbox" checked="checked" name="is_active"  id="is_active" value="1"/>
																<span></span>
															</label>
														</span>
													</div>
													
												   </div>
                                                </div>
                                            </div>
                                            													
                                                                                
                                      <!--description -->          
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                <label>{{__('adminMessage.details_en')}}</label>
                                                        <textarea rows="3" id="details_en" name="details_en" class="kt-tinymce-4 form-control @if($errors->has('details_en')) is-invalid @endif" autocomplete="off" placeholder="{{__('adminMessage.enter_details_en')}}">{{old('details_en')}}</textarea>
                                                               @if($errors->has('details_en'))
                                                               <div class="invalid-feedback">{{ $errors->first('details_en') }}</div>
                                                               @endif
                                                </div>
                                                <div class="col-lg-6">
                                                <label>{{__('adminMessage.details_ar')}}</label>
                                                        <textarea   rows="3" id="details_ar" name="details_ar" class="kt-tinymce-4 form-control @if($errors->has('details_ar')) is-invalid @endif" autocomplete="off" placeholder="{{__('adminMessage.enter_details_ar')}}">{{old('details_ar')}}</textarea>
                                                               @if($errors->has('details_ar'))
                                                               <div class="invalid-feedback">{{ $errors->first('details_ar') }}</div>
                                                               @endif
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">{{__('adminMessage.chooseAttachFile')}}</div>
                                            
                                            <!--attach files -->
                                            
                                            
                                            <div id="kt_repeater_1">
												<div class="form-group form-group-last row" id="kt_repeater_1">
													<div data-repeater-list="attach" class="col-lg-12">
														<div data-repeater-item class="form-group row align-items-center repeatbox">
															<div class="col-md-3">
																<div class="kt-form__group--inline">
																	<div class="kt-form__control">
																	<input type="text" class="form-control" name="atitle_en" autocomplete="off" placeholder="{{__('adminMessage.enter_title_en')}}" />
																	</div>
																</div>
																<div class="d-md-none kt-margin-b-10"></div>
															</div>
															<div class="col-md-3">
																<div class="kt-form__group--inline">
																	
																	<div class="kt-form__control">
																		<input type="text" class="form-control" name="atitle_ar" autocomplete="off" placeholder="{{__('adminMessage.enter_title_ar')}}" />
																	</div>
																</div>
																<div class="d-md-none kt-margin-b-10"></div>
															</div>
                                                            
                                                            <div class="col-md-2">
																<div class="kt-form__group--inline">
																	
																	<div class="kt-form__control">
																		<input type="text" class="form-control doc_date" name="doc_date" autocomplete="off" placeholder="{{__('adminMessage.enter_doc_date')}}" />
																	</div>
																</div>
																<div class="d-md-none kt-margin-b-10"></div>
															</div>
															<div class="col-md-3">
																<div  >
														       <input type="file" class="form-control"   name="attach_file" id="attach_file">
													            </div>
															</div>
															<div class="col-md-1">
																<a href="javascript:;" title="{{__('adminMessage.delete')}}" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">
																	<i class="la la-trash-o"></i>
																</a>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group form-group-last row">
													<div class="col-lg-4">
														<a href="javascript:;" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand">
															<i class="la la-plus"></i> {{__('adminMessage.add')}}
														</a>
													</div>
												</div>
											</div>
										</div>
                                            <!-- end attach -->
                                             <div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<button type="submit" class="btn btn-success">{{__('adminMessage.save')}}</button>
													<button type="button" onClick="Javascript:window.location.href='{{url('gwc/clients_cases_updates/'.request()->case_id)}}'"  class="btn btn-secondary cancelbtn">{{__('adminMessage.cancel')}}</button>
												</div>
											</div>
                                              
											
											
										</form>
                                  
                            @else
                            <div class="alert alert-light alert-warning" role="alert">
								<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
								<div class="alert-text">{{__('adminMessage.youdonthavepermission')}}</div>
							</div>
                            @endif
										<!--end::Form-->
									</div>

									<!--end::Portlet-->
                                    
                                    
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


		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

	
		<!-- js files -->
		@include('gwc.js.user')
        
       <!--begin::Page Vendors(used by this page) -->
		<script src="{{url('admin_assets/assets/plugins/custom/tinymce/tinymce.bundle.js')}}" type="text/javascript"></script>
		<!--end::Page Vendors -->

		<script>
        jQuery(document).ready(function() {
		tinymce.init({
		selector: '.kt-tinymce-4',
		menubar: false,
		toolbar: [
		'styleselect fontselect fontsizeselect',
		'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
		'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'],
		 plugins : 'advlist autolink link image lists charmap print preview code'
		 }); 
		
		});
		
		
		$('#kt_repeater_1').repeater({
		initEmpty: false,
		defaultName: {
		'text-input': 'foo',
		},
		show: function () {
		$(this).slideDown();
		$('.doc_date').datepicker({format:"yyyy-mm-dd"});
		},
		hide: function (deleteElement) {  
		  $(this).slideUp(deleteElement);   
		 }   
	    });
		
		</script>
       
       <!--begin::Page Scripts(used by this page) -->
		<script src="{{url('admin_assets/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
        <script>
		$('#case_date').datepicker({format:"yyyy-mm-dd"});
		$('.doc_date').datepicker({format:"yyyy-mm-dd"});
		</script>
	</body>

	<!-- end::Body -->
</html>