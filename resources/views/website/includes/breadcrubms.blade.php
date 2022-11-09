<ul class="crumb">
    <li><a href="{{url('/#home')}}">{{__('webMessage.home')}}</a></li>
    <li class="sep">/</li>
    <li><a href="{{url('/#about')}}">{{__('webMessage.aboutus')}}</a></li>
    <li class="sep">/</li>
    <li>@if(app()->getLocale()=="en") {{$settingInfo->mission_title_en}} @else  {{$settingInfo->mission_title_ar}} @endif</li>
</ul>