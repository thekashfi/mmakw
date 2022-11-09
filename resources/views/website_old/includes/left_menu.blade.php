<p>{{__('webMessage.welcomeback')}} <strong>@if(!empty(Auth::guard('webs')->user()->name)) {{Auth::guard('webs')->user()->name}} @endif</strong></p>

<ul class="myaccount">
<li><a href="{{url('/account')}}"><i class="@if(app()->getLocale()=='en') ti-angle-double-right @else ti-angle-double-left @endif myarrow"></i> {{__('webMessage.dashboard')}}</a></li>
<li><a href="{{url('/editprofile')}}"><i class="@if(app()->getLocale()=='en') ti-angle-double-right @else ti-angle-double-left @endif myarrow"></i> {{__('webMessage.editprofile')}}</a></li>
<li><a href="{{url('/changepass')}}"><i class="@if(app()->getLocale()=='en') ti-angle-double-right @else ti-angle-double-left @endif myarrow"></i> {{__('webMessage.changepassword')}}</a></li>
 @php
 $countUnSeeen = App\Http\Controllers\accountController::isReadUpdatesCount(Auth::guard('webs')->user()->id);
 @endphp
<li><a href="{{url('/casesupdates')}}"><i class="@if(app()->getLocale()=='en') ti-angle-double-right @else ti-angle-double-left @endif myarrow"></i> {{__('webMessage.casesupdates')}}({{$countUnSeeen}})</a></li>
<!--logout -->
<li><a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-forms').submit();" target="_blank"><i class="@if(app()->getLocale()=='en') ti-angle-double-right @else ti-angle-double-left @endif myarrow"></i> {{__('webMessage.logout')}}</a></li>
</ul>


<form id="logout-forms" action="{{ url('/logout') }}" method="POST" style="display: none;">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
