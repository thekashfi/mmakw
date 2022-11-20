<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-4">

        @if($settingInfo->logo)<a class="navbar-brand" href="{{url('/#home')}}"><img src="{{url('uploads/logo/'.$settingInfo->logo)}}" class="logo-small" alt="@if(app()->getLocale()=='en') {{$settingInfo->name_en}} @else {{$settingInfo->name_ar}} @endif"></a>@endif
        <br>
          {{app()->getLocale() == 'en' ? $settingInfo->footer_about_en : $settingInfo->footer_about_ar}}
      </div>
      <div class="col-lg-5">
          <h3>{{__('webMessage.contactus')}}</h3>
          <div class="widget widget-address">
              <address>
                <span>{{$settingInfo['address_' . app()->getLocale()]}}</span>
                @if($settingInfo->phone)
                    <span><strong>{{__('webMessage.phone')}}:</strong>{{$settingInfo->phone}}</span>
                @endif
                @if($settingInfo->fax)
                    <span><strong>{{__('webMessage.fax')}}:</strong>{{$settingInfo->fax}}</span>
                @endif
                @if($settingInfo->email)
                    <span><strong>{{__('webMessage.email')}}:</strong><a href="mailto:{{$settingInfo->email}}">{{$settingInfo->email}}</a></span>
                @endif
                <span><strong>{{__('webMessage.web')}}:</strong><a href="{{ url('') }}">{{ url('') }}</a></span>
              </address>
          </div>
      </div>

      <div class="col-lg-3">
        <div class="widget widget_recent_post">
          <h3>Main Menu</h3>
          <ul>
            <li><a href="{{url('/')}}">{{__('webMessage.home')}}</a></li>
            <li><a href="{{url('/#about')}}">{{__('webMessage.aboutus')}}</a></li>
            <li><a href="{{ url('') .'/practice/'. \App\Practice::first()->slug }}">{{__('webMessage.practicearea')}}</a></li>
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
          {!!__('webMessage.copyrights')!!}
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

            @if($settingInfo->social_facebook)
              <a href="{{$settingInfo->social_facebook}}" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
            @endif
            @if($settingInfo->social_twitter)
              <a href="{{$settingInfo->social_twitter}}" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
            @endif
            @if($settingInfo->social_instagram)
              <a href="{{$settingInfo->social_instagram}}" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
            @endif
            @if($settingInfo->social_youtube)
              <a href="{{$settingInfo->social_youtube}}" target="_blank"><i class="fa fa-youtube fa-lg"></i></a>
            @endif
            @if($settingInfo->social_linkedin)
              <a href="{{$settingInfo->social_linkedin}}" target="_blank"><i class="fa fa-linkedin fa-lg"></i></a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <a href="#" id="back-to-top"></a>
</footer>