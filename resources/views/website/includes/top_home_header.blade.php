<!-- Start header -->

        <header id="header" class="site-header header-style-1">
            <div class="topbar" dir="rtl">
                <div class="container">
                    <div class="row">
                        <div class="col col-md-8">
                            <div class="contact-info">
                                <ul class="clearfix">
                                    @if($settingInfo->phone)
                                    <li>@if(app()->getLocale()=='en') <strong>{{__('webMessage.callus')}} :</strong> {{$settingInfo->phone}} @else <strong>{{__('webMessage.callus')}} :</strong> <span dir="ltr">{{$settingInfo->phone}}</span> @endif</li>
                                    @endif
                                    <!--@if($settingInfo->address_en && app()->getLocale()=='en')
                                    <li><span>{{__('webMessage.ouraddress')}}:</span> {{$settingInfo->address_en}}</li>
                                    @else if($settingInfo->address_ar && app()->getLocale()=='ar')
                                    <li><span>{{__('webMessage.ouraddress')}}:</span> {{$settingInfo->address_ar}}</li>
                                    @endif-->
                                </ul>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="social">
                                <ul class="clearfix">
                                
                                @if(!empty($settingInfo->is_active_survey))
                                <li><a href="javascript:;" id="mySurveyModal">{{__('webMessage.survey_txt')}}</a></li>
                                @endif
                                
                                @if(empty(Auth::guard('webs')->user()->id))
                                    @if(app()->getLocale()=='en')
                                    <li><a href="{{ url('/login') }}" >{{__('webMessage.login_menu_txt')}}</a></li>
                                    @if($settingInfo->is_lang==1)
                                    <li class="arabic"><a href="{{ url('locale/ar') }}" >العربية</a></li>
                                    @endif
                                    @else
                                    <li><a href="{{ url('/login') }}" >{{__('webMessage.login_menu_txt')}}</a></li>
                                     @if($settingInfo->is_lang==1)
                                    <li><a href="{{ url('locale/en') }}" >English</a></li>
                                    @endif
                                    @endif
                                @else
                                   @if(app()->getLocale()=='en')
                                    <li><a href="{{ url('/account') }}" >{{__('webMessage.myaccount_txt')}}</a></li>
                                     @if($settingInfo->is_lang==1)
                                    <li class="arabic"><a href="{{ url('locale/ar') }}" >العربية</a></li>
                                    @endif
                                    @else
                                    <li><a href="{{ url('/account') }}" >{{__('webMessage.myaccount_txt')}}</a></li>
                                     @if($settingInfo->is_lang==1)
                                    <li><a href="{{ url('locale/en') }}" >English</a></li>
                                    @endif
                                    @endif
                                @endif    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end topbar -->

            <nav class="navigation navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="open-btn">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        @if($settingInfo->logo)<a class="navbar-brand" href="{{url('/#home')}}"><img src="{{url('uploads/logo/'.$settingInfo->logo)}}" alt="@if(app()->getLocale()=='en') {{$settingInfo->name_en}} @else {{$settingInfo->name_ar}} @endif"></a>@endif
                    </div>
                    <div id="navbar" class="navbar-collapse collapse navbar-right navigation-holder">
                        <button class="close-navbar"><i class="ti-close"></i></button>
                        <ul class="nav navbar-nav">
                            <li ><a  href="{{url('/#home')}}">{{__('webMessage.home')}}</a></li>
                            <li class="menu-item-has-children"><a href="{{url('/#about')}}">{{__('webMessage.aboutus')}}</a>
                            <ul class="sub-menu">
                            <li><a href="{{url('/mission')}}">{{__('webMessage.mission')}}</a></li>
                            <li><a href="{{url('/vision')}}">{{__('webMessage.vision')}}</a></li>
                            <li><a href="{{url('/team')}}">{{__('webMessage.team')}}</a></li>
                            </ul>
                            </li>
                            <!--Practice area-->
                            @if(count($practiceareaMenus))
							<li class="menu-item-has-children"><a href="{{url('/#home')}}">{{__('webMessage.practicearea')}}</a>
								<ul class="sub-menu" style="width:290px;">
                                    @foreach($practiceareaMenus as $practiceareaMenu)
									<li><a href="{{url('/practice/'.$practiceareaMenu->slug)}}">@if(app()->getLocale()=='en') {{$practiceareaMenu->menu_name_en}} @else {{$practiceareaMenu->menu_name_ar}} @endif</a></li>
                                    @endforeach
                               </ul>
                            </li>
                           @endif 
                           <!-- services -->
							@if(count($servicesMenus))
							<li class="menu-item-has-children"><a href="{{url('/#services')}}">{{__('webMessage.services')}}</a>
								<ul class="sub-menu" style="width:360px;">
                                    @foreach($servicesMenus as $servicesMenu)
									<li><a href="{{url('/services/'.$servicesMenu->slug)}}">@if(app()->getLocale()=='en') {{$servicesMenu->menu_name_en}} @else {{$servicesMenu->menu_name_ar}} @endif</a></li>
                                    @endforeach
                               </ul>
                            </li>
                           @endif 
                           
                            <li><a href="{{url('/members')}}">{{__('webMessage.membershiplistings')}}</a></li>
                            <li><a href="{{url('/news')}}">{{__('webMessage.newsevents')}}</a></li>
                            <li><a href="{{url('/#contact')}}">{{__('webMessage.contactus')}}</a></li>
                        </ul>
                    </div><!-- end of nav-collapse -->
                </div><!-- end of container -->
            </nav>
            
            
            
        </header>
        <!-- end of header -->
   