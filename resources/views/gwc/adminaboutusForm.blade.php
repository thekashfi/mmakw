<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>{{__('adminMessage.websiteName')}} | {{__('adminMessage.aboutus')}}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--css files -->
		@include('gwc.css.user')
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
									<h3 class="kt-subheader__title">{{__('adminMessage.catalog')}}</h3>
									<span class="kt-subheader__separator kt-hidden"></span>
									<div class="kt-subheader__breadcrumbs">
										<a href="{{url('gwc/home')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
										<span class="kt-subheader__breadcrumbs-separator"></span>
										<a href="javascript:;" class="kt-subheader__breadcrumbs-link">{{__('adminMessage.aboutus')}}</a>
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
							<div class="alert alert-light alert-danger" role="alert">
								<div class="alert-icon"><i class="flaticon-alert kt-font-brand"></i></div>
								<div class="alert-text">
									{{ Session::get('message-error') }}
								</div>
							</div>
                           @endif
                         @if(auth()->guard('admin')->user()->can('aboutus-edit'))  
                           <form name="tFrm"  id="form_validation"  method="post"
                          class="kt-form" enctype="multipart/form-data" action="{{route('aboutuspost',$settingDetails->keyname)}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="row">
								<div class="col-md-12">
                          
									<!--begin::Portlet-->
									<div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													{{__('adminMessage.aboutus')}}
												</h3>
											</div>
										</div>

										<!--begin::Form-->
                                       
											<div class="kt-portlet__body">
												
												<div class="form-group">
                                                <div class="row">
								                    <div class="col-md-6">
													<label>{{__('adminMessage.title_1_en')}}</label>
													<input type="text"  class="form-control @if($errors->has('about_title_1_en')) is-invalid @endif" name="about_title_1_en" placeholder="{{__('adminMessage.enter_title_1_en')}}" value="@if($settingDetails->about_title_1_en) {{$settingDetails->about_title_1_en}} @endif">
                                                    @if($errors->has('about_title_1_en'))
                                                    <div class="invalid-feedback">{{ $errors->first('about_title_1_en') }}</div>
                                                    @endif
                                                    </div>
                                                    <div class="col-md-6">
													<label>{{__('adminMessage.title_1_ar')}}</label>
													<input type="text"  class="form-control @if($errors->has('about_title_1_ar')) is-invalid @endif" name="about_title_1_ar" placeholder="{{__('adminMessage.enter_title_1_ar')}}" value="@if($settingDetails->about_title_1_ar) {{$settingDetails->about_title_1_ar}} @endif">
                                                    @if($errors->has('about_title_1_ar'))
                                                    <div class="invalid-feedback">{{ $errors->first('about_title_1_ar') }}</div>
                                                    @endif
                                                    </div>
                                                    </div>
												</div>
                                                
                                                <div class="form-group">
                                                <div class="row">
								                    <div class="col-md-6">
													<label>{{__('adminMessage.title_2_en')}}</label>
													<input type="text"  class="form-control @if($errors->has('about_title_2_en')) is-invalid @endif" name="about_title_2_en" placeholder="{{__('adminMessage.enter_title_2_en')}}" value="@if($settingDetails->about_title_2_en) {{$settingDetails->about_title_2_en}} @endif">
                                                    @if($errors->has('about_title_2_en'))
                                                    <div class="invalid-feedback">{{ $errors->first('about_title_2_en') }}</div>
                                                    @endif
                                                    </div>
                                                    <div class="col-md-6">
													<label>{{__('adminMessage.title_2_ar')}}</label>
													<input type="text"  class="form-control @if($errors->has('about_title_2_ar')) is-invalid @endif" name="about_title_2_ar" placeholder="{{__('adminMessage.enter_title_2_ar')}}" value="@if($settingDetails->about_title_2_ar) {{$settingDetails->about_title_2_ar}} @endif">
                                                    @if($errors->has('about_title_2_ar'))
                                                    <div class="invalid-feedback">{{ $errors->first('about_title_2_ar') }}</div>
                                                    @endif
                                                    </div>
                                                    </div>
												</div>
                                                
                                                <div class="form-group">
													<label>{{__('adminMessage.details_en')}}</label>
													<textarea id="kt-ckeditor-1" name="about_details_en" class="form-control  @if($errors->has('about_details_en')) is-invalid @endif" placeholder="{{__('adminMessage.enter_about_details_en')}}">@if($settingDetails->about_details_en) {{$settingDetails->about_details_en}} @endif</textarea>
                                                    @if($errors->has('about_details_en'))
                                                  <div class="invalid-feedback">{{ $errors->first('about_details_en') }}</div>
                                                    @endif
												</div>
                                                <div class="form-group">
													<label>{{__('adminMessage.details_ar')}}</label>
													<textarea id="kt-ckeditor-2" name="about_details_ar" class="form-control  @if($errors->has('about_details_ar')) is-invalid @endif" placeholder="{{__('adminMessage.enter_about_details_ar')}}">@if($settingDetails->about_details_ar) {{$settingDetails->about_details_ar}} @endif</textarea>
                                                    @if($errors->has('about_details_ar'))
                                                  <div class="invalid-feedback">{{ $errors->first('about_details_ar') }}</div>
                                                    @endif
												</div>
                                               
                                                
                                                
                                                
                                                <!--website logo -->
                                                <div class="form-group">
                                                <div class="row">
								                    <div class="col-md-4">
                                                    <label>{{__('adminMessage.image')}}</label>
                                                        <div class="custom-file @if($errors->has('image')) is-invalid @endif">
														<input type="file" class="custom-file-input @if($errors->has('image')) is-invalid @endif"  id="image" name="image">
														<label class="custom-file-label" for="image">{{__('adminMessage.chooseImage')}}</label>
													    </div>
                                                        @if($errors->has('image'))
                                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                                        @endif
                                                </div>
                                                <div class="col-md-4">
                                                @if($settingDetails->image)
                                                <img src="{!! url('uploads/aboutus/'.$settingDetails->image) !!}" width="40">
                                                <a href="javascript:;" data-toggle="kt-popover" data-trigger="focus" title="{{__('adminMessage.alert')}}" data-html="true" data-content="{{__('adminMessage.areyousuretodelete')}}<br><br><a href='{{url('gwc/aboutus/deleteimage/')}}' class='btn btn-brand btn-danger btn-icon-sm btn-sm'>{{__('adminMessage.yes')}}</a>" class="btn btn-brand btn-danger btn-icon-sm btn-sm"><i class="la la-trash"></i>{{__('adminMessage.delete')}}</a>
                                                @endif
                                                </div>
                                                <div class="col-md-4">
                                                </div>
                                                    </div>
												</div>
                                          	
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<button type="submit" class="btn btn-success">{{__('adminMessage.save')}}</button>
												</div>
											</div>
										

										<!--end::Form-->
									</div>

									<!--end::Portlet-->

								</div>
								
                                
							</div>
                            </form>
                            @else
                            <div class="alert alert-light alert-warning" role="alert">
								<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
								<div class="alert-text">{{__('adminMessage.youdonthavepermission')}}</div>
							</div>
                            @endif
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
		<script src="{{url('admin_assets/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}" type="text/javascript"></script>

		<!--end::Page Vendors -->

		<script>
        ClassicEditor
        .create( document.querySelector( '#kt-ckeditor-1' ) )
        .catch( error => {
            console.error( error );
        } );
		
		ClassicEditor
        .create( document.querySelector( '#kt-ckeditor-2' ) )
        .catch( error => {
            console.error( error );
        } );
       </script>

	</body>

	<!-- end::Body -->
</html>