<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>{{__('adminMessage.websiteName')}}|{{__('adminMessage.editbox')}}</title>
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
                    <img alt="{{__('adminMessage.websiteName')}}"
                         src="{!! url('uploads/logo/'.$settingDetailsMenu['logo']) !!}" height="40"/>
                @endif
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler">
                <span></span></button>

            <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                        class="flaticon-more"></i></button>
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
                                <h3 class="kt-subheader__title">{{__('adminMessage.boxes')}}</h3>
                                <span class="kt-subheader__separator kt-hidden"></span>
                                <div class="kt-subheader__breadcrumbs">
                                    <a href="{{url('gwc/home')}}" class="kt-subheader__breadcrumbs-home"><i
                                                class="flaticon2-shelter"></i></a>
                                    <span class="kt-subheader__breadcrumbs-separator"></span>
                                    <a href="javascript:;"
                                       class="kt-subheader__breadcrumbs-link">{{__('adminMessage.editbox')}}</a>
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
                                    <h3 class="kt-portlet__head-title">{{__('adminMessage.editbox')}}</h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-wrapper">
                                        <div class="kt-portlet__head-actions">

                                            @if(auth()->guard('admin')->user()->can('services-list'))
                                                <a href="{{url('gwc/boxes')}}"
                                                   class="btn btn-brand btn-elevate btn-icon-sm"><i
                                                            class="la la-list-ul"></i>{{__('adminMessage.listboxes')}}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--begin::Form-->
                            @if(auth()->guard('admin')->user()->can('services-edit'))
                                <form name="tFrm" id="form_validation" method="post" class="kt-form"
                                      enctype="multipart/form-data"
                                      action="{{route('boxes.update',$box->id)}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @method('put')
                                    <div class="kt-portlet__body">

                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>{{__('adminMessage.link')}}</label>
                                                <input type="text" class="form-control @if($errors->has('link')) is-invalid @endif" name="link"
                                                       value="{{ old('link', $box->link) }}" autocomplete="off" placeholder="{{__('adminMessage.enter_link')}}" />
                                                @if($errors->has('link'))
                                                    <div class="invalid-feedback">{{ $errors->first('link') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-lg-2"></div>

                                            <div class="col-lg-4">
                                                <div class="form-group row">
                                                    <label class="col-3 col-form-label">{{__('adminMessage.isactive')}}</label>
                                                    <div class="col-3">
														<span class="kt-switch">
															<label>
																<input type="checkbox" name="is_active"  id="is_active" {{ old('is_active', $box->is_active) ? 'checked' : '' }} value="1"/>
																<span></span>
															</label>
														</span>
                                                    </div>
                                                    <label class="col-3 col-form-label">{{__('adminMessage.displayorder')}}</label>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control @if($errors->has('display_order')) is-invalid @endif" name="display_order"  value="{{ old('display_order', $box->display_order) }}" autocomplete="off" />
                                                        @if($errors->has('display_order'))
                                                            <div class="invalid-feedback">{{ $errors->first('display_order') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--categories name -->
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>{{__('adminMessage.link_title_en')}}</label>
                                                <input type="text" class="form-control @if($errors->has('link_title_en')) is-invalid @endif" name="link_title_en"
                                                       value="{{old('link_title_en', $box->link_title_en)}}" autocomplete="off" placeholder="{{__('adminMessage.enter_link_title_en')}}" />
                                                @if($errors->has('link_title_en'))
                                                    <div class="invalid-feedback">{{ $errors->first('link_title_en') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label>{{__('adminMessage.link_title_ar')}}</label>
                                                <input type="text" class="form-control @if($errors->has('link_title_ar')) is-invalid @endif" name="link_title_ar"
                                                       value="{{old('link_title_ar', $box->link_title_ar)}}" autocomplete="off" placeholder="{{__('adminMessage.enter_link_title_ar')}}" />
                                                @if($errors->has('link_title_ar'))
                                                    <div class="invalid-feedback">{{ $errors->first('link_title_ar') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <!--categories name -->
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>{{__('adminMessage.title_en')}}</label>
                                                <input type="text" class="form-control @if($errors->has('title_en')) is-invalid @endif" name="title_en"
                                                       value="{{ old('title_en', $box->title_en) }}" autocomplete="off" placeholder="{{__('adminMessage.enter_title_en')}}" />
                                                @if($errors->has('title_en'))
                                                    <div class="invalid-feedback">{{ $errors->first('title_en') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label>{{__('adminMessage.title_ar')}}</label>
                                                <input type="text" class="form-control @if($errors->has('title_ar')) is-invalid @endif" name="title_ar"
                                                       value="{{ old('title_ar', $box->title_ar) }}" autocomplete="off" placeholder="{{__('adminMessage.enter_title_ar')}}" />
                                                @if($errors->has('title_ar'))
                                                    <div class="invalid-feedback">{{ $errors->first('title_ar') }}</div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>{{__('adminMessage.description_en')}}</label>
                                                <input type="text" class="form-control @if($errors->has('description_en')) is-invalid @endif" name="description_en"
                                                       value="{{old('description_en', $box->description_en)}}" autocomplete="off" placeholder="{{__('adminMessage.enter_description_en')}}" />
                                                @if($errors->has('description_en'))
                                                    <div class="invalid-feedback">{{ $errors->first('description_en') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>{{__('adminMessage.description_ar')}}</label>
                                                <input type="text" class="form-control @if($errors->has('description_ar')) is-invalid @endif" name="description_ar"
                                                       value="{{old('description_ar', $box->description_ar)}}" autocomplete="off" placeholder="{{__('adminMessage.enter_description_ar')}}" />
                                                @if($errors->has('description_ar'))
                                                    <div class="invalid-feedback">{{ $errors->first('description_ar') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- friendly url , status , sorting -->
                                        <div class="form-group row">

                                            <div class="col-lg-6">
                                                <label>{{__('adminMessage.image')}}</label>
                                                <div class="custom-file @if($errors->has('image')) is-invalid @endif">
                                                    <input type="file"
                                                           class="custom-file-input @if($errors->has('image')) is-invalid @endif"
                                                           id="image" name="image">
                                                    <label class="custom-file-label"
                                                           for="image">{{__('adminMessage.chooseImage')}}</label>
                                                </div>
                                                @if($errors->has('image'))
                                                    <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-lg-2">
{{--                                                @if($box->image)--}}
{{--                                                    <img src="{!! url('uploads/boxes/thumb/'.$box->image) !!}"--}}
{{--                                                         width="40">--}}
{{--                                                    <a href="javascript:;" data-toggle="kt-popover" data-trigger="focus"--}}
{{--                                                       title="{{__('adminMessage.alert')}}" data-html="true"--}}
{{--                                                       data-content="{{__('adminMessage.areyousuretodelete')}}<br><br><a href='{{url('gwc/boxes/deleteboxImage/'.$box->id)}}' class='btn btn-brand btn-danger btn-icon-sm btn-sm'>YES</a>"--}}
{{--                                                       class="btn btn-brand btn-danger btn-icon-sm btn-sm"><i--}}
{{--                                                                class="la la-trash"></i>{{__('adminMessage.delete')}}--}}
{{--                                                    </a>--}}
{{--                                                @endif--}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <button type="submit"
                                                    class="btn btn-success">{{__('adminMessage.save')}}</button>
                                            <button type="button"
                                                    onClick="Javascript:window.location.href='{{url('gwc/boxes')}}'"
                                                    class="btn btn-secondary cancelbtn">{{__('adminMessage.cancel')}}</button>
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
    <script src="{{url('admin_assets/assets/plugins/custom/tinymce/tinymce.bundle.js')}}"
            type="text/javascript"></script>
    <!--end::Page Vendors -->

    <script>
        jQuery(document).ready(function () {
            tinymce.init({
                selector: '.kt-tinymce-4',
                menubar: false,
                toolbar: [
                    'styleselect fontselect fontsizeselect',
                    'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
                    'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'],
                plugins: 'advlist autolink link image lists charmap print preview code'
            });
        });
    </script>
</body>

<!-- end::Body -->
</html>