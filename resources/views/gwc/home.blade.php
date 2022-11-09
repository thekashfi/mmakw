<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>{{__('adminMessage.websiteName')}}|{{__('adminMessage.login')}}</title>
		<meta name="description" content="Login page example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--css files -->
		@include('gwc.css.login')
        <!--token -->     
        <meta name="csrf-token" content="{{ csrf_token() }}">
		
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
   @php
   use Illuminate\Support\Facades\Cookie;
   @endphp 
							<div class="kt-login__signin">
								<div class="kt-login__head">
									<h3 class="kt-login__title">{{__('adminMessage.signinadminpanel')}}</h3>
								</div>
   
								<form class="kt-form"  name="AdmloginForm" id="AdmloginForm" method="POST" action='{{ route("adminlogin") }}'>
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
										<input value="@if(Cookie::get('login_username')) {{Cookie::get('login_username')}} @endif" class="form-control  @if($errors->has('login_username')) is-invalid @endif" type="text" placeholder="{{__('adminMessage.enter_username')}}" name="login_username" id="login_username" autocomplete="off">
                                        @if($errors->has('login_username'))
                                        <div class="invalid-feedback">{{ $errors->first('login_username') }}</div>
                                        @endif
									</div>
									<div class="input-group ">
										<input value="@if(Cookie::get('login_password')) {{Cookie::get('login_password')}} @endif" class="form-control @if($errors->has('login_password')) is-invalid @endif" type="password" placeholder="{{__('adminMessage.enter_password')}}" name="login_password" id="login_password" autocomplete="off">
                                        @if($errors->has('login_password'))
                                        <div class="invalid-feedback">{{ $errors->first('login_password') }}</div>
                                        @endif
									</div>
									<div class="row kt-login__extra">
										<div class="col">
											<label class="kt-checkbox">
												<input @if(Cookie::get('remember_me')) checked @endif type="checkbox" name="remember_me" id="remember_me" value="1"> {{__('adminMessage.rememberme')}}
												<span></span>
											</label>
                                            <a style="color:#FFFFFF;" href="{{url('gwc/forgot')}}" class="pull-right">{{__('adminMessage.forgot_password')}}?</a>
										</div>
									</div>
									<div class="kt-login__actions">
										<button type="submit" id="" class="btn btn-pill kt-login__btn-primary">{{__('adminMessage.signin')}}</button>
									</div>
								</form>
							</div>
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