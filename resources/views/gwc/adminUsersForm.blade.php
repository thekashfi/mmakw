<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>{{__('adminMessage.websiteName')}} | {{__('adminMessage.manageuser')}}</title>
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
									<h3 class="kt-subheader__title">{{__('adminMessage.manageuser')}}</h3>
									<span class="kt-subheader__separator kt-hidden"></span>
									<div class="kt-subheader__breadcrumbs">
										<a href="{{url('gwc/home')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
										<span class="kt-subheader__breadcrumbs-separator"></span>
										<a href="javascript:;" class="kt-subheader__breadcrumbs-link">@if(!empty($userDetails->id)) {{__('adminMessage.edituser')}} @else  {{__('adminMessage.createnewuser')}} @endif</a>
									</div>
								</div>
								<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												
												@if(auth()->guard('admin')->user()->can('user-list'))
												<a href="{{url('gwc/users')}}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="la la-list-ul"></i>{{__('adminMessage.listusers')}}</a> @endif
											</div>
										</div>
									</div>
							</div>
						</div>

						<!-- end:: Subheader -->

						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

							<!--begin::Portlet-->
									<div class="kt-portlet">
										
										<!--begin::Form-->
						 @if(request()->id)
                        
                         
                         <div class="kt-portlet__head">
									<div class="kt-portlet__head-toolbar">
										<ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
											<li class="nav-item">
												<a class="nav-link @if(Request::segment(3)=='edit') active @endif"  href="{{url('gwc/users/edit/'.request()->id)}}" role="tab">
													<i class="flaticon-avatar"></i> {{__('adminMessage.profile')}}
												</a>
											</li>
											@if(auth()->guard('admin')->user()->can('user-changepass'))
											<li class="nav-item">
												<a class="nav-link @if(Request::segment(3)=='changepass') active @endif"  href="{{url('gwc/users/changepass/'.request()->id)}}" role="tab">
													<i class="flaticon-lock"></i> {{__('adminMessage.changepassword')}}
												</a>
											</li>
											@endif
										</ul>
									</div>
								</div>
                         <div class="kt-portlet__body">
                         
										<div class="tab-content">
											<div class="tab-pane @if(Request::segment(3)=='edit') active @endif" id="kt_user_edit_tab_1" role="tabpanel">
												<div class="kt-form kt-form--label-right">
                         @if(auth()->guard('admin')->user()->can('user-edit'))	                       
                        <form name="tFrmProfile" id="tFrmProfile"  method="post"
                          class="uk-form-stacked" enctype="multipart/form-data" action="{{route('adminSaveProfile')}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="id" value="{{$userDetails->id}}" >
													<div class="kt-form__body">
														<div class="kt-section kt-section--first">
															<div class="kt-section__body">
                         @if(Session::get('message-success'))
							<div class="alert alert-light alert-success" role="alert">
								<div class="alert-icon"><i class="flaticon-alert kt-font-brand"></i></div>
								<div class="alert-text">
									{{ Session::get('message-success') }}
								</div>
							</div>
                           @endif 
																
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">{{__('adminMessage.avatar')}}</label>
																	<div class="col-lg-9 col-xl-6">
																		<div class="kt-avatar kt-avatar--outline kt-avatar--circle- @if($errors->has('image')) is-invalid @endif" id="kt_user_edit_avatar">
                        @if(isset($userDetails->image) && !empty($userDetails->image)) 
                        <div class="kt-avatar__holder" style="background-image: url('{!! URL::asset('/uploads/users/'.$userDetails->image) !!}');"></div>
                        @else 
                        <div class="kt-avatar__holder" style="background-image: url('{!! url('admin_assets/assets/media/users/default.jpg') !!}');"></div>
                        @endif
																			
																			<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
																				<i class="fa fa-pen"></i>
																				<input type="file" name="image" accept=".png, .jpg, .jpeg" >
																			</label>
																			<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
																				<i class="fa fa-times"></i>
																			</span>
																		</div>
                                                                        
                                                               @if($errors->has('image'))
                                                               <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                                               @endif
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">{{__('adminMessage.name')}}</label>
																	<div class="col-lg-9 col-xl-6">
																		<input class="form-control @if($errors->has('name')) is-invalid @endif" type="text" value="{{$userDetails->name}}" name="name" id="name" >
                                                               @if($errors->has('name'))
                                                               <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                                               @endif
																	</div>
																</div>
															
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">{{__('adminMessage.mobile')}}</label>
																	<div class="col-lg-9 col-xl-6">
																		<div class="input-group">
																			<div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
																			<input type="text" class="form-control @if($errors->has('mobile')) is-invalid @endif" value="{{$userDetails->mobile}}" placeholder="Mobile" name="mobile" aria-describedby="basic-addon1">
                                                               @if($errors->has('mobile'))
                                                               <div class="invalid-feedback">{{ $errors->first('mobile') }}</div>
                                                               @endif
																		</div>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">{{__('adminMessage.email')}}</label>
																	<div class="col-lg-9 col-xl-6">
																		<div class="input-group">
																			<div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
																			<input type="text" class="form-control @if($errors->has('email')) is-invalid @endif" value="{{$userDetails->email}}" placeholder="Email" aria-describedby="basic-addon1" name="email">
                                                               @if($errors->has('email'))
                                                               <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                                               @endif
																		</div>
																	</div>
																</div>
                                                               
                                                              
                                            <div class="form-group row">
                                              <label class="col-xl-3 col-lg-3 col-form-label">{{__('adminMessage.roles')}}</label>
                                                <div class="col-lg-9 col-xl-6">
                                                <select name="roles[]" class="form-control" multiple @if($errors->has('roles')) is-invalid @endif>
                                                    @foreach($roles as $value)
                                                        <option value="{{$value}}" {{in_array($value, $userRole) ? 'selected' : ''}}>{{ $value }}</option>
                                                    @endforeach
                                                    </select>
                                                              @if($errors->has('roles'))
                                                               <div class="invalid-feedback">{{ $errors->first('roles') }}</div>
                                                               @endif
                                                </div>
                                                
                                            </div>
                                                                
                                                                
                                                   <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
													<div class="kt-form__actions">
														<div class="row">
															<div class="col-xl-3"></div>
															<div class="col-lg-9 col-xl-6">
																<button type="submit" class="btn btn-success btn-bold">{{__('adminMessage.save')}}</button>
                                                                <button type="button" onClick="Javascript:window.location.href='{{url('gwc/users')}}'"  class="btn btn-secondary cancelbtn">{{__('adminMessage.cancel')}}</button>
															</div>
														</div>
													</div>
															</div>
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
											</div>
									@if(auth()->guard('admin')->user()->can('user-changepass'))		
                         <div class="tab-pane @if(Request::segment(3)=='changepass') active @endif" id="kt_user_edit_tab_2" role="tabpanel">
                         <div class="kt-form kt-form--label-right">
                         <form name="tFrmpass" id="tFrmpass"  method="post"
                          class="uk-form-stacked" enctype="multipart/form-data" action="{{route('adminChangePass')}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="id" value="{{$userDetails->id}}" >
													<div class="kt-form__body">
														<div class="kt-section kt-section--first">
															<div class="kt-section__body">
																@if(Session::get('message-success'))
                                                                <div class="alert alert-light alert-success" role="alert">
                                                                    <div class="alert-icon"><i class="flaticon-alert kt-font-brand"></i></div>
                                                                    <div class="alert-text">
                                                                        {{ Session::get('message-success') }}
                                                                    </div>
                                                                </div>
                                                               @endif 
																
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">{{__('adminMessage.currentpassword')}}</label>
																	<div class="col-lg-9 col-xl-6">
																		<input type="password" name="current_password" class="form-control @if($errors->has('current_password')) is-invalid @endif" value="{{old('current_password')}}" placeholder="{{__('adminMessage.entercurrentpassword')}}">                                                               @if($errors->has('current_password'))
                                                               <div class="invalid-feedback">{{ $errors->first('current_password') }}</div>
                                                               @endif
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">{{__('adminMessage.newpassword')}}</label>
																	<div class="col-lg-9 col-xl-6">
																		<input type="password" name="new_password" class="form-control @if($errors->has('new_password')) is-invalid @endif" value="{{old('new_password')}}" placeholder="{{__('adminMessage.enternewpassword')}}">                                                               @if($errors->has('new_password'))
                                                               <div class="invalid-feedback">{{ $errors->first('new_password') }}</div>
                                                               @endif
																	</div>
																</div>
																<div class="form-group form-group-last row">
																	<label class="col-xl-3 col-lg-3 col-form-label">{{__('adminMessage.confirmpassword')}}</label>
																	<div class="col-lg-9 col-xl-6">
																		<input type="password" name="confirm_password" class="form-control @if($errors->has('confirm_password')) is-invalid @endif" value="{{old('confirm_password')}}" placeholder="{{__('adminMessage.enterconfirmpassword')}}">                                                               @if($errors->has('confirm_password'))
                                                               <div class="invalid-feedback">{{ $errors->first('confirm_password') }}</div>
                                                               @endif
																	</div>
																</div>
															</div>
														</div>
													</div>
                                                    <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
													<div class="kt-form__actions">
														<div class="row">
															<div class="col-xl-3"></div>
															<div class="col-lg-9 col-xl-6">
																<button type="submit" class="btn btn-success  btn-bold">{{__('adminMessage.save')}}</button>
                                                                <button type="button" onClick="Javascript:window.location.href='{{url('gwc/users')}}'"  class="btn btn-secondary cancelbtn">{{__('adminMessage.cancel')}}</button>
															</div>
														</div>
													</div>
                                                    </form>
													
												</div>
											</div>
                                            @endif
                                            
											
										</div>
									
                                    </div>
                         
                         @else	
                         @if(auth()->guard('admin')->user()->can('user-create'))		
                         <form name="tFrm"  id="form_validation"  method="post"
                          class="uk-form-stacked" enctype="multipart/form-data" action="{{route('newuser')}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="kt-portlet__body">
																								
											<div class="form-group row"><h6>{{__('adminMessage.personalinformation')}}</h6></div> 	
                                                
                                                <div class="form-group row">
                                                <div class="col-lg-4">
                                                        <label for="name">{{__('adminMessage.name')}}</label>
                                                        <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name"
                                                               value="{{old('name')}}" autocomplete="off" placeholder="{{__('adminMessage.enterfullname')}}" />
                                                               @if($errors->has('name'))
                                                               <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                                               @endif
                                                </div>
                                                <div class="col-lg-4">
                                                        <label for="email">{{__('adminMessage.email')}}</label>
                                                        <input type="text" class="form-control @if($errors->has('email')) is-invalid @endif" name="email"
                                                               value="{{old('email')}}" autocomplete="off" placeholder="{{__('adminMessage.enteremailaddress')}}"/>
                                                               @if($errors->has('email'))
                                                               <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                                               @endif
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="mobile">{{__('adminMessage.mobile')}}</label>
                                                        <input type="text" class="form-control @if($errors->has('mobile')) is-invalid @endif" name="mobile"
                                                               value="{{old('mobile')}}" autocomplete="off" placeholder="{{__('adminMessage.entermobilenumber')}}"/>
                                                               @if($errors->has('mobile'))
                                                               <div class="invalid-feedback">{{ $errors->first('mobile') }}</div>
                                                               @endif
                                                </div>
                                            </div>
                                           <div class="form-group row"><h6>{{__('adminMessage.logininformation')}}</h6></div> 
                                           <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label for="username">{{__('adminMessage.username')}}</label>
                                                        <input type="text" class="form-control @if($errors->has('username')) is-invalid @endif" name="username"
                                                               value="{{old('username')}}" autocomplete="off" placeholder="{{__('adminMessage.enterusername')}}"/>
                                                               @if($errors->has('username'))
                                                               <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                                                               @endif
                                                </div>
                                                <div class="col-lg-6">
                                                        <label for="password">{{__('adminMessage.password')}}</label>
                                                        <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" name="password"
                                                               value="{{old('password')}}" autocomplete="off" placeholder="{{__('adminMessage.enterpassword')}}"/>
                                                               @if($errors->has('password'))
                                                               <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                                               @endif
                                                </div>
                                            </div>
                                            <div class="form-group row"><h6>{{__('adminMessage.roles')}}</h6></div> 
                                            <div class="form-group row">
                                          
                                                <div class="col-lg-12">
                                                <select name="roles[]" class="form-control" multiple>
                                                    @foreach($roles as $value)
                                                        <option value="{{$value}}">{{ $value }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            
                                            
                                            
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<button type="submit" class="btn btn-success  btn-bold">{{__('adminMessage.save')}}</button>
													<button type="button" onClick="Javascript:window.location.href='{{url('gwc/users')}}'"  class="btn btn-secondary cancelbtn">{{__('adminMessage.cancel')}}</button>
												</div>
											</div>
										</form>
                                        @else
                                        <div class="alert alert-light alert-warning" role="alert">
                                            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                            <div class="alert-text">{{__('adminMessage.youdonthavepermission')}}</div>
                                        </div>
                                        @endif
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
	</body>

	<!-- end::Body -->
</html>