<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-4">

        @if($settingInfo->logo)<a class="navbar-brand" href="{{url('/#home')}}"><img src="{{url('uploads/logo/'.$settingInfo->logo)}}" class="logo-small" alt="@if(app()->getLocale()=='en') {{$settingInfo->name_en}} @else {{$settingInfo->name_ar}} @endif"></a>@endif
        <br>
          {{$settingInfo->footer_about}}
      </div>

      <div class="col-lg-5">
        <h3>{{__('webMessage.contactus')}}</h3>
        <div class="widget widget-address">
          <address>
            <span>{{$settingInfo->address_en}}</span>
            <span><strong>Phone:</strong>(+965) 2227 2212, (+965) 2227 2213</span>
            <span><strong>Fax:</strong>(+965) 2227 2213</span>
            <span><strong>Email:</strong><a href="mailto:info@mmakw.com">info@mmakw.com</a></span>
            <span><strong>Web:</strong><a href="#">https://www.mmakw.com</a></span>
          </address>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="widget widget_recent_post">
          <h3>Main Menu</h3>
          <ul>
            <li><a href="{{url('/')}}">{{__('webMessage.home')}}</a></li>
            <li><a href="{{url('/#about')}}">{{__('webMessage.aboutus')}}</a></li>
            <li><a href="#">{{__('webMessage.practicearea')}}</a></li>
            <li><a href="{{url('/#services')}}">{{__('webMessage.services')}}</a></li>
            <li><a href="{{url('/members')}}">{{__('webMessage.membershiplistings')}}</a></li>
            <li><a href="{{url('/news')}}">{{__('webMessage.newsevents')}}</a></li>
            <li><a href="{{url('/contactus')}}">{{__('webMessage.contactus')}}</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="subfooter">
    <div class="container">
      <div class="row">
        <div class="col-md-6" class="{{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
          &copy; Copyright 2022 MMA Kuwait - Al Rights Reserved
        </div>
        <div class="col-md-6 text-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}">

          <div class="social-icons">

            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            <div id="google_translate_element" style="float: right; margin-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}:30px;"></div>
            <script type="text/javascript">
              function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
              }
            </script>

            <a href="https://www.linkedin.com/company/mma-law/" target="_blank"><i class="fa fa-linkedin fa-lg"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <a href="#" id="back-to-top"></a>
</footer>