<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<base href="../../">
		<meta charset="utf-8" />
		<title>{{__('adminMessage.websiteName')}} | Manage Menus</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--css files -->
		@include('gwc.css.dashboard')
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
									<h3 class="kt-subheader__title">Manage Menu</h3>
									<span class="kt-subheader__separator kt-hidden"></span>
									<div class="kt-subheader__breadcrumbs">
										<a href="{{url('gwc/home')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
										<span class="kt-subheader__breadcrumbs-separator"></span>
										<a href="{{url('gwc/menus')}}" class="kt-subheader__breadcrumbs-link">Menus</a>
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
						@if(auth()->guard('admin')->user()->hasAnyPermission(['menu-create','menu-edit']))
                        			
                         <form name="tFrm" class="kt-form" id="form_validation"  enctype="multipart/form-data" method="post" action="{{route('newmenu')}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="id" value="{{isset($menusDetails['id']) && $menusDetails['id']<>''?$menusDetails['id']:'0'}}">
											<div class="kt-portlet__body">
																								
												<div class="form-group">
													<label for="exampleSelectd">Parent</label>
                                                   <select name="parent_id" id="parent_id" class="form-control">
                                                    <option value="0">None</option>
                                                    @foreach($menuDropDownList as $menuDrop)
                                                    @php
                                                    if(isset($menusDetails['id']) && $menusDetails['parent_id']==$menuDrop->id){
                                                    $sel='selected';
                                                    }else{
                                                    $sel='';
                                                    }
                                                    @endphp
                                                    <option value="{{$menuDrop->id}}" {{$sel}}>{{$menuDrop->name}}</option>
                                                    @endforeach
                                                    </select>
												</div>
                                                
                                                <div class="form-group row">
                                                <div class="col-lg-6">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                               value="{{isset($menusDetails['name']) && $menusDetails['name']<>''?$menusDetails['name']:''}}" autocomplete="off"
                                                                required/>
                                                </div>
                                                <div class="col-lg-6">
                                                        <label for="link">Link</label>
                                                        <input type="text" class="form-control" name="link"
                                                               value="{{isset($menusDetails['link']) && $menusDetails['link']<>''?$menusDetails['link']:''}}" autocomplete="off"
                                                               required/>
                                                </div>
                                            </div>
                                            
                                           <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label for="icon">Icon Code </label>
                                                        <input type="text" class="form-control" name="icon"
                                                               value="{{isset($menusDetails['icon']) && $menusDetails['icon']<>''?$menusDetails['icon']:''}}" autocomplete="off" required/>
                                                </div>
                                                <div class="col-lg-6">
                                                        <label for="display_order">Display Order</label>
                                                        <input type="text" class="form-control" name="display_order"
                                                               value="{{isset($menusDetails['display_order']) && $menusDetails['display_order']<>''?$menusDetails['display_order']:''}}" autocomplete="off" required/>
                                                </div>
                                            </div>
                                            
                                            
                                            
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<button type="submit" class="btn btn-success">Save</button>
													<button type="button" onClick="Javascript:window.location.href='{{url('gwc/menus')}}'"  class="btn btn-secondary cancelbtn">Cancel</button>
												</div>
											</div>
										</form>
                                        @else
                                        <div class="alert alert-light alert-warning" role="alert">
                                            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                            <div class="alert-text">You don't have permission to view this page</div>
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
		@include('gwc.js.menus')
	</body>

	<!-- end::Body -->
</html>