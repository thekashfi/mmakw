<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>{{__('adminMessage.websiteName')}}|{{__('adminMessage.sendresetlink')}}</title>
		<meta name="description" content="Login page example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--css files -->
		@include('gwc.css.login')
        <!--token -->     
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<style>
		.is-invalid{border:1px #FF0000 solid !important;}
		</style>
	</head>

	<!-- end::Head -->
@php
$settingDetailsMenu = App\Http\Controllers\AdminDashboardController::getSettingsDetails();
@endphp
	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v2 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({!! url('admin_assets/assets/media/bg/bg-1.jpg') !!});">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
						<div class="kt-login__container">
							<div class="kt-login__logo">
								<a href="{{url('/gwc/home')}}">
                                @if($settingDetailsMenu['logo'])
								<img alt="{{__('adminMessage.websiteName')}}" src="{!! url('uploads/logo/'.$settingDetailsMenu['logo']) !!}" />
                                @endif
							    </a>
							</div>
                         @if(request()->token)
                         <div class="kt-login__signin">
								<div class="kt-login__head">
									<h3 class="kt-login__title">{{__('adminMessage.resetforgotpass')}}</h3>
								</div>
   
								<form class="kt-form"  name="AdmfpForm" id="AdmfpForm" method="POST" action='{{ route("gwc.token",request()->token) }}'>
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            
                                
                                @if($errors->has('invalidlogin'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('invalidlogin') }}
                                </div>
                                @endif
                                
                                @if (session('info'))
                                <div class="alert alert-success" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    {{ session('info') }}
                                </div>
                                @endif 
                           
									<div class="input-group">
										<input value="{{old('email')}}" class="form-control  @if($errors->has('email')) is-invalid @endif" type="text" placeholder="{{__('adminMessage.enter_email')}}" name="email" id="email" autocomplete="off">
                                        @if($errors->has('email'))
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        @endif
									</div>
                                    
                                    <div class="input-group">
										<input value="{{old('new_password')}}" class="form-control  @if($errors->has('new_password')) is-invalid @endif" type="password" placeholder="{{__('adminMessage.enter_new_password')}}" name="new_password" id="new_password" autocomplete="off">
                                        @if($errors->has('new_password'))
                                        <div class="invalid-feedback">{{ $errors->first('new_password') }}</div>
                                        @endif
									</div>
                                    
                                    <div class="input-group">
										<input value="{{old('confirm_password')}}" class="form-control  @if($errors->has('confirm_password')) is-invalid @endif" type="password" placeholder="{{__('adminMessage.enter_confirm_password')}}" name="confirm_password" id="confirm_password" autocomplete="off">
                                        @if($errors->has('confirm_password'))
                                        <div class="invalid-feedback">{{ $errors->first('confirm_password') }}</div>
                                        @endif
									</div>
																		
									<div class="kt-login__actions">
										<button type="submit" id="" class="btn btn-pill btn-success">{{__('adminMessage.changenow')}}</button>
                                        
									</div>
                                    
                                    <div class="row"><div class="col-md-12"></div></div>
								</form>
							</div>
                         @else   
   				         <div class="kt-login__signin">
								<div class="kt-login__head">
									<h3 class="kt-login__title">{{__('adminMessage.sendresetlink')}}</h3>
								</div>
   
								<form class="kt-form"  name="AdmfpForm" id="AdmfpForm" method="POST" action='{{ route("gwc.email") }}'>
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            
                                
                                @if($errors->has('invalidlogin'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('invalidlogin') }}
                                </div>
                                @endif
                                
                                @if (session('info'))
                                <div class="alert alert-success" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    {{ session('info') }}
                                </div>
                                @endif 
                           
									<div class="input-group">
										<input value="{{old('email')}}" class="form-control  @if($errors->has('email')) is-invalid @endif" type="text" placeholder="{{__('adminMessage.enter_email')}}" name="email" id="email" autocomplete="off">
                                        @if($errors->has('email'))
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        @endif
									</div>
																		
									<div class="kt-login__actions">
										<button type="submit" id="" class="btn btn-pill btn-success">{{__('adminMessage.sendlink')}}</button>
                                        <button type="button" onClick="window.location='{{url('gwc/')}}'" class="btn btn-pill  btn-info" style="color:#FFFFFF;">{{__('adminMessage.backtologin')}}</button>
									</div>
                                    
                                    <div class="row"><div class="col-md-12"></div></div>
								</form>
							</div>
                            @endif
                            
                            
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->
        <!-- js files -->
		@include('gwc.js.login')
        
	</body>

	<!-- end::Body -->
</html>