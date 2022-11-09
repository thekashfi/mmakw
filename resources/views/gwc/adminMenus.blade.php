<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<base href="../../">
		<meta charset="utf-8" />
		<title>{{__('adminMessage.websiteName')}} | Menus</title>
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
									<h3 class="kt-subheader__title">Menus</h3>
									<span class="kt-subheader__separator kt-hidden"></span>
									<div class="kt-subheader__breadcrumbs">
										<a href="{{url('home')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
										<span class="kt-subheader__breadcrumbs-separator"></span>
										<a href="javascript:;" class="kt-subheader__breadcrumbs-link">Menus listing</a>
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
											Menus
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												@if(auth()->guard('admin')->user()->can('menu-create'))												
												<a href="{{url('gwc/menus/new')}}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="la la-plus"></i>New Record</a>@endif
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
                                @if(auth()->guard('admin')->user()->can('menu-list'))
									<!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
										<thead>
											<tr>
												<th>#</th>
												<th>Title</th>
												<th>Link</th>
												<th>Icon</th>
												<th>Sort Order</th>
												<th>Status</th>
												<th>Created At</th>
												<th>Updated At</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
                                        @if(count($menusLists))
                                        @php $p=1; @endphp
                                        @foreach($menusLists as $menusList)
											<tr>
												<td>{{$p}}</td>
												<td>{!! $menusList->name !!}</td>
												<td>{!! $menusList->link !!}</td>
												<td>{!! $menusList->icon !!}</td>
												<td>{!! $menusList->display_order !!}</td>
												<td>
                                                <span class="kt-switch"><label><input value="{{$menusList['id']}}" {{!empty($menusList->is_active)?'checked':''}} type="checkbox"  id="menus" class="change_status"><span></span></label></span>
                                                </td>
												<td>{!! $menusList->created_at !!}</td>
												<td>{!! $menusList->updated_at !!}</td>
                                                <td class="kt-datatable__cell">
                                                 <span style="overflow: visible; position: relative; width: 80px;">
                                                 <div class="dropdown">
                                                 <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown"><i class="flaticon-more-1"></i></a>
                                                 <div class="dropdown-menu dropdown-menu-right">
                                                 <ul class="kt-nav">
                                                 @if(auth()->guard('admin')->user()->can('menu-edit'))
                                                 <li class="kt-nav__item"><a href="{{url('gwc/menus/edit/'.$menusList->id)}}" class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-contract"></i><span class="kt-nav__link-text">Edit</span></a></li>
                                                 @endif
                                                 @if(auth()->guard('admin')->user()->can('menu-delete'))
                                                 <li class="kt-nav__item"><a href="javascript:;" data-toggle="modal" data-target="#kt_modal_{{$menusList->id}}" class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-trash"></i><span class="kt-nav__link-text">Delete</span></a></li>
                                                 @endif
                                                 </ul>
                                                 </div>
                                                 </div>
                                                 </span>
                                                 
                                                 <!--Delete modal -->
 <div class="modal fade" id="kt_modal_{{$menusList->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Alert !</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											</button>
										</div>
										<div class="modal-body">
											<h6 class="modal-title">Are you sure to delete this record? <br>Note : Once you delete the record it can not be rollback.</h6>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
											<button type="button" class="btn btn-danger"  onClick="Javascript:window.location.href='{{url('gwc/menus/delete/'.$menusList->id)}}'">Yes</button>
										</div>
									</div>
								</div>
							</div>
                                                </td>
											</tr>
                                        @if(count($menusList->submenu)>0)
                                        @php $c=1; @endphp
                                        @foreach($menusList->submenu as $submenu)  
                                           <tr>
												<td>{{$p}}>{{$c}}</td>
												<td>{!! $submenu->name !!}</td>
												<td>{!! $submenu->link !!}</td>
												<td>{!! $submenu->icon !!}</td>
												<td>{!! $submenu->display_order !!}</td>
												<td>
                                                <span class="kt-switch"><label><input value="{{$submenu['id']}}" {{!empty($submenu->is_active)?'checked':''}} type="checkbox"  id="menus" class="change_status"><span></span></label></span>
                                                </td>
												<td>{!! $submenu->created_at !!}</td>
												<td>{!! $submenu->updated_at !!}</td>
<td class="kt-datatable__cell">
 <span style="overflow: visible; position: relative; width: 80px;">
 <div class="dropdown">
 <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown"><i class="flaticon-more-1"></i></a>
 <div class="dropdown-menu dropdown-menu-right">
 <ul class="kt-nav">
 <li class="kt-nav__item"><a href="{{url('gwc/menus/edit/'.$submenu->id)}}" class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-contract"></i><span class="kt-nav__link-text">Edit</span></a></li>
 <li class="kt-nav__item"><a href="javascript:;" class="kt-nav__link" data-toggle="modal" data-target="#kt_modal_{{$submenu->id}}"><i class="kt-nav__link-icon flaticon2-trash"></i><span class="kt-nav__link-text">Delete</span></a></li>
 </ul>
 </div>
 </div>
 </span>
 <!--Delete modal -->
 <div class="modal fade" id="kt_modal_{{$submenu->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Alert !</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											</button>
										</div>
										<div class="modal-body">
											<h6>Are you sure to delete this record? <br>Note : Once you delete the record it can not be rollback.</h6>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
											<button type="button" class="btn btn-danger"  onClick="Javascript:window.location.href='{{url('gwc/menus/delete/'.$submenu->id)}}'">Yes</button>
										</div>
									</div>
								</div>
							</div>
                            
 </td>
											</tr>
                                            @php $c++; @endphp
                                        @endforeach  
                                        @endif
                                        @php $p++; @endphp
                                        @endforeach    
                                        @else
                                        <tr><td colspan="9" class="text-center">No Record(s) Found</td></tr>
                                        @endif    
										</tbody>
									</table>
                              @else
                              <div class="alert alert-light alert-warning" role="alert">
								<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
								<div class="alert-text">You don't have permission to view this page</div>
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


		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->

		<!-- js files -->
		@include('gwc.js.menus')
        
        
	</body>

	<!-- end::Body -->
</html>