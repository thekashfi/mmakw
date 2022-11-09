<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<base href="../../">
		<meta charset="utf-8" />
		<title>{{__('adminMessage.websiteName')}} | {{__('adminMessage.listusers')}}</title>
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
									<h3 class="kt-subheader__title">{{__('adminMessage.users')}}</h3>
									<span class="kt-subheader__separator kt-hidden"></span>
									<div class="kt-subheader__breadcrumbs">
										<a href="{{url('home')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
										<span class="kt-subheader__breadcrumbs-separator"></span>
										<a href="javascript:;" class="kt-subheader__breadcrumbs-link">{{__('adminMessage.listusers')}}</a>
									</div>
								</div>
                                  <div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												
												@if(auth()->guard('admin')->user()->can('user-create'))
												<a href="{{url('gwc/users/new')}}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="la la-plus"></i>{{__('adminMessage.createnewuser')}}</a> @endif
											</div>
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
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											{{__('adminMessage.users')}}
										</h3>
									</div>
									
								</div>
								<div class="kt-portlet__body">
                                @if(auth()->guard('admin')->user()->can('user-list'))
									<!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
										<thead>
											<tr>
												<th>#</th>
												<th>{{__('adminMessage.name')}}</th>
												<th>{{__('adminMessage.mobile')}}</th>
												<th>{{__('adminMessage.email')}}</th>
												<th>{{__('adminMessage.username')}}</th>
												<th>{{__('adminMessage.status')}}</th>
												<th>{{__('adminMessage.createdat')}}</th>
												<th>{{__('adminMessage.updatedat')}}</th>
												<th>{{__('adminMessage.actions')}}</th>
											</tr>
										</thead>
										<tbody>
                                        @if(count($usersLists))
                                        @php $p=1; @endphp
                                        @foreach($usersLists as $usersList)
											<tr>
												<td>{{$p}}</td>
												<td>{!! $usersList->name !!}</td>
												<td>{!! $usersList->mobile !!}</td>
												<td>{!! $usersList->email !!}</td>
												<td>{!! $usersList->username !!}</td>
												<td>
                                                <span class="kt-switch"><label><input value="{{$usersList['id']}}" {{!empty($usersList->is_active)?'checked':''}} type="checkbox"  id="users" class="change_status"><span></span></label></span>
                                                </td>
												<td>{!! $usersList->created_at !!}</td>
												<td>{!! $usersList->updated_at !!}</td>
                                                <td class="kt-datatable__cell">
                                                 <span style="overflow: visible; position: relative; width: 80px;">
                                                 <div class="dropdown">
                                                 <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown"><i class="flaticon-more-1"></i></a>
                                                 <div class="dropdown-menu dropdown-menu-right">
                                                 <ul class="kt-nav">
                                                 @if(auth()->guard('admin')->user()->can('user-edit'))
                                                 <li class="kt-nav__item"><a href="{{url('gwc/users/edit/'.$usersList->id)}}" class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-contract"></i><span class="kt-nav__link-text">{{__('adminMessage.edit')}}</span></a></li>
                                                 @endif
                                                 @if(auth()->guard('admin')->user()->can('user-delete'))
                                                 <li class="kt-nav__item"><a href="javascript:;" data-toggle="modal" data-target="#kt_modal_{{$usersList->id}}" class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-trash"></i><span class="kt-nav__link-text">{{__('adminMessage.delete')}}</span></a></li>
                                                 @endif
                                                 </ul>
                                                 </div>
                                                 </div>
                                                 </span>
                                                 
                                                 <!--Delete modal -->
 <div class="modal fade" id="kt_modal_{{$usersList->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">{{__('adminMessage.alert')}}</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											</button>
										</div>
										<div class="modal-body">
											<h6 class="modal-title">{!!__('adminMessage.alertDeleteMessage')!!}</h6>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('adminMessage.no')}}</button>
											<button type="button" class="btn btn-danger"  onClick="Javascript:window.location.href='{{url('gwc/users/delete/'.$usersList->id)}}'">{{__('adminMessage.yes')}}</button>
										</div>
									</div>
								</div>
							</div>
                                                </td>
											</tr>
                                        
                                        @php $p++; @endphp
                                        @endforeach    
                                        @else
                                        <tr><td colspan="9" class="text-center">{{__('adminMessage.recordnotfound')}}</td></tr>
                                        @endif    
										</tbody>
									</table>
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