<section class="contact-section mycontact" id="contact">
            <div class="content-area clearfix">
                <div class="contact-info-col">
                    <div class="contact-info animatedParent">
                        <ul>
                            @if($settingInfo->address_en && app()->getLocale()=="en")
                            <li>
                                <i class="fi flaticon-home-3 animated rollIn"></i>
                                <h4 class="slower animated bounceInDown">{{__('webMessage.headoffice')}}</h4>
                                <p class="slower animated bounceInRight">{{$settingInfo->address_en}}</p>
                            </li>
                            @else
                            <li>
                                <i class="fi flaticon-home-3 animated rollIn"></i>
                                <h4 class="slower animated bounceInDown">{{__('webMessage.headoffice')}}</h4>
                                <p class="slower animated bounceInRight">{{$settingInfo->address_ar}}</p>
                            </li>
                            @endif
                            @if($settingInfo->email)
                            <li>
                                <i class="fi flaticon-email animated rollIn"></i>
                                <h4 class="slower animated bounceInDown">{{__('webMessage.email')}}</h4>
                                <p class="slower animated bounceInRight">{{$settingInfo->email}}</p>
                            </li>
                            @endif
                            @if($settingInfo->phone)
                            <li>
                                <i class="fi flaticon-support animated rollIn"></i>
                                <h4 class="slower animated bounceInDown">{{__('webMessage.phone')}}</h4>
                                <p class="slower animated bounceInRight" dir="ltr">{{$settingInfo->phone}}</p>
                            </li>
                            @endif
                            @if($settingInfo->office_hours_en && app()->getLocale()=="en")
                            <li>
                                <i class="fi flaticon-clock animated rollIn"></i>
                                <h4 class="slower animated bounceInDown">{{__('webMessage.officehours')}}</h4>
                                <p class="slower animated bounceInRight">{{$settingInfo->office_hours_en}}</p>
                            </li>
                            @else 
                            <li>
                                <i class="fi flaticon-clock animated rollIn"></i>
                                <h4 class="slower animated bounceInDown">{{__('webMessage.officehours')}}</h4>
                                <p class="slower animated bounceInRight">{{$settingInfo->office_hours_ar}}</p>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="contact-form-col animatedParent">
                    <div class="section-title-s2 slower animated bounceIn">
                        <h2>{{__('webMessage.tellus')}}</h2>
                    </div>

                    <div class="contact-form">
                        <form method="post" class="contact-validation-active" id="contact-form-main-form" action="{{route('contactform')}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                            <div>
                                <input type="text" class="form-control slower animated fadeInLeft @if($errors->has('name')) error @endif" name="name" id="name" placeholder="{{__('webMessage.enter_your_name')}}*" value="{{old('name')}}">
                                @if($errors->has('name'))
                                <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                                @endif
                            </div>
                            <div>
                                <input type="email" class="form-control slower animated fadeInRight @if($errors->has('email')) error @endif" name="email" id="email" placeholder="{{__('webMessage.enter_your_email')}}*" value="{{old('email')}}">
                                @if($errors->has('email'))
                                <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                                @endif
                            </div>
                            <div>
                                <input type="text" value="{{old('mobile')}}" class="form-control slower animated fadeInLeft" name="mobile" id="mobile" placeholder="{{__('webMessage.enter_your_mobile')}}*">
                                @if($errors->has('mobile'))
                                <label id="phone-error" class="error" for="mobile">{{ $errors->first('mobile') }}</label>
                                @endif
                            </div>
                            <div>
                                <select name="subject" class="form-control slower animated fadeInRight @if($errors->has('subject')) error @endif">
                                    <option disabled="disabled" selected>{{__('webMessage.choose_your_subject')}}*</option>
                                    @if(count($subjectLists))
                                    @foreach($subjectLists as $subjectList)
                                    <option value="{{$subjectList->id}}" {{old('subject')==$subjectList->id?'selected':''}}>{{$subjectList->title_en}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @if($errors->has('subject'))
                                <label id="subject-error" class="error" for="subject">{{ $errors->first('subject') }}</label>
                                @endif
                            </div>
                            <div class="fullwidth">
                                <textarea class="form-control slower animated fadeInLeft @if($errors->has('message')) error @endif" name="message"  id="message" placeholder="{{__('webMessage.write_some_text')}}*">{{old('message')}}</textarea>
                                @if($errors->has('message'))
                                <label id="message-error" class="error" for="message">{{ $errors->first('message') }}</label>
                                @endif
                            </div>
                            <div class="fullwidth">
                            <div class="g-recaptcha" data-sitekey="6LeMueQUAAAAAJ-ZUe9ZqGK3pma9VwbeoaYDgJte"></div>
                            </div>
                            <div class="submit-area">
                                <button type="submit" class="theme-btn-s3 slower animated fadeInRight">{{__('webMessage.sendnow')}}</button>
                                <div id="loader">
                                    <i class="ti-reload"></i>
                                </div>
                            </div>
                            @if(Session::get('message-success'))
                            <div class="fullwidth">
                            <div class="alert alert-success">{{Session::get('message-success')}}</div>
                            </div>
                            @endif
                            @if(Session::get('message-failed'))
                            <div class="fullwidth">
                            <div class="alert alert-danger">{{Session::get('message-failed')}}</div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div> <!-- end content-area -->
        </section>
		