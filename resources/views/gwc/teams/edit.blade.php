<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>{{__('adminMessage.websiteName')}}|{{__('adminMessage.editteams')}}</title>
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
									<h3 class="kt-subheader__title">{{__('adminMessage.teams')}}</h3>
									<span class="kt-subheader__separator kt-hidden"></span>
									<div class="kt-subheader__breadcrumbs">
										<a href="{{url('gwc/home')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
										<span class="kt-subheader__breadcrumbs-separator"></span>
										<a href="javascript:;" class="kt-subheader__breadcrumbs-link">{{__('adminMessage.editteams')}}</a>
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
										<h3 class="kt-portlet__head-title">{{__('adminMessage.editteams')}}</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												
												@if(auth()->guard('admin')->user()->can('teams-list'))
												<a href="{{url('gwc/teams')}}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="la la-list-ul"></i>{{__('adminMessage.listteams')}}</a> @endif
											</div>
										</div>
									</div>
								</div>				
										<!--begin::Form-->
					@if(auth()->guard('admin')->user()->can('teams-edit'))
                    <form name="tFrm"  id="form_validation"  method="post"
                          class="kt-form" enctype="multipart/form-data" action="{{route('teams.update',$editteams->id)}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="kt-portlet__body">
                                        <div class="form-group row">
                                                <div class="col-lg-6">	
                                           <div class="form-group row">
													<label class="col-3 col-form-label">{{__('adminMessage.isactive')}}</label>
													<div class="col-3">
														<span class="kt-switch">
															<label>
																<input type="checkbox" {{$editteams->is_active==1?'checked':''}} name="is_active"  id="is_active" value="1"/>
																<span></span>
															</label>
														</span>
													</div>
                                                    <label class="col-3 col-form-label">{{__('adminMessage.displayorder')}}</label>
													<div class="col-3">
														<input type="text" class="form-control @if($errors->has('display_order')) is-invalid @endif" name="display_order"  value="{{$editteams->display_order?$editteams->display_order:old('display_order')}}" autocomplete="off" />
                                                               @if($errors->has('display_order'))
                                                               <div class="invalid-feedback">{{ $errors->first('display_order') }}</div>
                                                               @endif
													</div>
										   </div>
                                           </div>
                                           </div>
                                           
                                           <div class="form-group"><h5>{{__('adminMessage.basicinformation')}}</h5></div>
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                <label>{{__('adminMessage.name')}}(En)</label>
                                                <input type="text" class="form-control @if($errors->has('name_en')) is-invalid @endif" name="name_en"
                                                               value="{{$editteams->name_en?$editteams->name_en:old('name_en')}}" autocomplete="off" placeholder="{{__('adminMessage.enter_name_en')}}*" />
                                                               @if($errors->has('name_en'))
                                                               <div class="invalid-feedback">{{ $errors->first('name_en') }}</div>
                                                               @endif
                                                </div>
                                                <div class="col-lg-6">
                                                <label>{{__('adminMessage.name')}}(Ar)</label>
                                                <input type="text" class="form-control @if($errors->has('name_ar')) is-invalid @endif" name="name_ar"
                                                               value="{{$editteams->name_ar?$editteams->name_ar:old('name_ar')}}" autocomplete="off" placeholder="{{__('adminMessage.enter_name_ar')}}*" />
                                                               @if($errors->has('name_ar'))
                                                               <div class="invalid-feedback">{{ $errors->first('name_ar') }}</div>
                                                               @endif
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                <label>{{__('adminMessage.mobile')}}</label>
                                                <input type="text" class="form-control @if($errors->has('mobile')) is-invalid @endif" name="mobile"
                                                               value="{{$editteams->mobile?$editteams->mobile:old('mobile')}}" autocomplete="off" placeholder="{{__('adminMessage.enter_mobile')}}*" />
                                                               @if($errors->has('mobile'))
                                                               <div class="invalid-feedback">{{ $errors->first('mobile') }}</div>
                                                               @endif
                                                </div>
                                                <div class="col-lg-6">
                                                <label>{{__('adminMessage.email')}}</label>
                                                <input type="text" class="form-control @if($errors->has('email')) is-invalid @endif" name="email"
                                                               value="{{$editteams->email?$editteams->email:old('email')}}" autocomplete="off" placeholder="{{__('adminMessage.enter_email')}}*" />
                                                               @if($errors->has('email'))
                                                               <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                                               @endif
                                                </div>
                                            </div> 													
                                     
                                            
                                         <div class="form-group row">
                                                <div class="col-lg-6">
                                                <label>{{__('adminMessage.position')}}(En)</label>
                                                <input type="text" class="form-control @if($errors->has('position_en')) is-invalid @endif" name="position_en"
                                                               value="{{$editteams->position_en?$editteams->position_en:old('position_en')}}" autocomplete="off" placeholder="{{__('adminMessage.enter_position_en')}}*" />
                                                               @if($errors->has('position_en'))
                                                               <div class="invalid-feedback">{{ $errors->first('position_en') }}</div>
                                                               @endif
                                                </div>
                                                <div class="col-lg-6">
                                                <label>{{__('adminMessage.name')}}(Ar)</label>
                                                <input type="text" class="form-control @if($errors->has('position_ar')) is-invalid @endif" name="position_ar"
                                                               value="{{$editteams->position_ar?$editteams->position_ar:old('position_ar')}}" autocomplete="off" placeholder="{{__('adminMessage.enter_position_ar')}}*" />
                                                               @if($errors->has('position_ar'))
                                                               <div class="invalid-feedback">{{ $errors->first('position_ar') }}</div>
                                                               @endif
                                                </div>
                                                
                                            </div>
                                            
                                            
                                         <div class="form-group row">
                                                
                                                <div class="col-lg-6">
                                                <label>{{__('adminMessage.image')}}</label>
                                                        <div class="custom-file @if($errors->has('image')) is-invalid @endif">
														<input type="file" class="custom-file-input @if($errors->has('image')) is-invalid @endif"  id="image" name="image">
														<label class="custom-file-label" for="image">{{__('adminMessage.chooseImage')}}</label>
													    </div>
                                                               @if($errors->has('image'))
                                                               <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                                               @endif
                                                </div>
                                                <div class="col-lg-2">
                                                @if($editteams->image)
                                                <img src="{!! url('uploads/teams/thumb/'.$editteams->image) !!}" width="40">
                                                <a href="javascript:;" data-toggle="kt-popover" data-trigger="focus" title="{{__('adminMessage.alert')}}" data-html="true" data-content="{{__('adminMessage.areyousuretodelete')}}<br><br><a href='{{url('gwc/teams/deleteteamsImage/'.$editteams->id)}}' class='btn btn-brand btn-danger btn-icon-sm btn-sm'>YES</a>" class="btn btn-brand btn-danger btn-icon-sm btn-sm"><i class="la la-trash"></i>{{__('adminMessage.delete')}}</a>
                                                @endif
                                                </div>
                                            </div>
                                            
                                                     
                                                     
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<button type="submit" class="btn btn-success">{{__('adminMessage.save')}}</button>
													<button type="button" onClick="Javascript:window.location.href='{{url('gwc/teams')}}'"  class="btn btn-secondary cancelbtn">{{__('adminMessage.cancel')}}</button>
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
       </script>
	</body>

	<!-- end::Body -->
</html>