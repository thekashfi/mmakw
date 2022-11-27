<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>{{__('adminMessage.websiteName')}} | {{__('adminMessage.whoweare')}}</title>
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
										<a href="javascript:;" class="kt-subheader__breadcrumbs-link">{{__('adminMessage.whoweare')}}</a>
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
                         @if(auth()->guard('admin')->user()->can('our-mission-edit'))
                           <form name="tFrm"  id="form_validation"  method="post"
                          class="kt-form" enctype="multipart/form-data" action="{{route('whopost',$settingDetails->keyname)}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="row">
								<div class="col-md-12">

									<!--begin::Portlet-->
									<div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													{{__('adminMessage.whoweare')}}
												</h3>
											</div>
										</div>

										<!--begin::Form-->

											<div class="kt-portlet__body">

												<div class="form-group">
                                                <div class="row">
								                    <div class="col-md-6">
													<label>{{__('adminMessage.title_en')}}</label>
													<input type="text"  class="form-control @if($errors->has('who_title_en')) is-invalid @endif" name="who_title_en" placeholder="{{__('adminMessage.enter_title_en')}}" value="@if($settingDetails->who_title_en) {{$settingDetails->who_title_en}} @endif">
                                                    @if($errors->has('who_title_en'))
                                                    <div class="invalid-feedback">{{ $errors->first('who_title_en') }}</div>
                                                    @endif
                                                    </div>
                                                    <div class="col-md-6">
													<label>{{__('adminMessage.title_ar')}}</label>
													<input type="text"  class="form-control @if($errors->has('who_title_ar')) is-invalid @endif" name="who_title_ar" placeholder="{{__('adminMessage.enter_title_ar')}}" value="@if($settingDetails->who_title_ar) {{$settingDetails->who_title_ar}} @endif">
                                                    @if($errors->has('who_title_ar'))
                                                    <div class="invalid-feedback">{{ $errors->first('who_title_ar') }}</div>
                                                    @endif
                                                    </div>
                                                    </div>
												</div>



                                                <div class="form-group">
													<label>{{__('adminMessage.details_en')}}</label>
													<textarea id="kt-ckeditor-1" name="who_details_en" class="form-control  @if($errors->has('who_details_en')) is-invalid @endif" placeholder="{{__('adminMessage.enter_details_en')}}">@if($settingDetails->who_details_en) {{$settingDetails->who_details_en}} @endif</textarea>
                                                    @if($errors->has('who_details_en'))
                                                  <div class="invalid-feedback">{{ $errors->first('who_details_en') }}</div>
                                                    @endif
												</div>
                                                <div class="form-group">
													<label>{{__('adminMessage.details_ar')}}</label>
													<textarea id="kt-ckeditor-2" name="who_details_ar" class="form-control  @if($errors->has('who_details_ar')) is-invalid @endif" placeholder="{{__('adminMessage.enter_details_ar')}}">@if($settingDetails->who_details_ar) {{$settingDetails->who_details_ar}} @endif</textarea>
                                                    @if($errors->has('who_details_ar'))
                                                  <div class="invalid-feedback">{{ $errors->first('who_details_ar') }}</div>
                                                    @endif
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