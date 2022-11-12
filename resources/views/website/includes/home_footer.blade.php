<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-4">

        @if($settingInfo->logo)<a class="navbar-brand" href="{{url('/#home')}}"><img src="{{url('uploads/logo/'.$settingInfo->logo)}}" class="logo-small" alt="@if(app()->getLocale()=='en') {{$settingInfo->name_en}} @else {{$settingInfo->name_ar}} @endif"></a>@endif
        <br>
        MMA Law understands the business philosophy we are keen to keep the smooth transactions between our clients and the relevant parties, we believe that the smooth transactions will be guaranteed through our involvement before the commencement of business transactions to explain the legal rules which will govern the transactions
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
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Practice Areas</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Membership &amp; Listings</a></li>
            <li><a href="#">News &amp; Events</a></li>
            <li><a href="#">Contact us</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="subfooter">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          &copy; Copyright 2022 MMA Kuwait - Al Rights Reserved
        </div>
        <div class="col-md-6 text-right">

          <div class="social-icons">

            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            <div id="google_translate_element" style="float: right; margin-left:30px;"></div>
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