@if($settingInfo->google_analytics)
{!!$settingInfo->google_analytics!!}
@endif
<footer class="site-footer">
            <div class="social-newsletter-area">
                <div class="container">
                    <div class="row animatedParent">
                        <div class="col col-xs-12">
                            
                              <div class="social-newsletter-content clearfix">
							  
                                <div class="social-area">
                                    <ul class="clearfix">
                                        @if($settingInfo->social_facebook)
										<li class="slower animated fadeInDown"><a href="{{$settingInfo->social_facebook}}" target="_blank"><i class="ti-facebook"></i></a></li>
                                        @endif
                                        @if($settingInfo->social_twitter)
										<li class="slower animated fadeInDown"><a href="{{$settingInfo->social_twitter}}" target="_blank"><i class="ti-twitter"></i></a></li>
                                        @endif
                                        @if($settingInfo->social_instagram)
										<li class="slower animated fadeInDown"><a href="{{$settingInfo->social_instagram}}" target="_blank"><i class="ti-instagram"></i></a></li>
                                        @endif
                                        @if($settingInfo->social_youtube)
										<li class="slower animated fadeInDown"><a href="{{$settingInfo->social_youtube}}" target="_blank"><i class="ti-youtube"></i></a></li>
                                        @endif
                                        @if($settingInfo->social_linkedin)
										<li class="slower animated fadeInDown"><a href="{{$settingInfo->social_linkedin}}" target="_blank"><i class="ti-linkedin"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
								
                                 @if($memberslists)
                                    <div class="slower animated fadeInDown">
                                    @foreach($memberslists as $memberslist)
                                    @if($memberslist->image)
										
                                    <a href="{{url('/members')}}"><img src="{{url('uploads/memberships/'.$memberslist->image)}}" alt="" class="sponcer_pic"></a>
									
									@endif
                                    @endforeach
                                    </div>
                                @endif
								
                                <div class="newsletter-area">
                                    <div class="inner">
                                        <h3 class="slower animated fadeInLeft">{{__('webMessage.newsletter')}}</h3>
                                        <form class="slower animated fadeInRight" name="newsletterForm" id="newsletterForm">
                                            <div class="input-1">
                                                <input type="email" name="newsletter_email" id="newsletter_email" class="form-control" placeholder="{{__('webMessage.enter_email')}}*" required>
                                            </div>
                                            <div class="submit clearfix">
                                                <button type="button"  id="subscribeBtn"><i class="fi flaticon-paper-plane"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
								
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="lower-footer">
                <div class="container">
                    <div class="row slower animatedParent">
                        <div class="separator"></div>
                        <div class="col col-xs-12">
                            <p class="copyright slower slower animated fadeInLeft">{!!__('webMessage.copyrights')!!}</p>
                            <div class="extra-link slower animated fadeInRight">
                                <ul>
                                    <li><a href="{{url('/#home')}}">{{__('webMessage.home')}}</a></li>
									<li><a href="{{url('/#about')}}">{{__('webMessage.aboutus')}}</a></li>
									<li><a href="{{url('/#member')}}">{{__('webMessage.members')}}</a></li>
									<li><a href="{{url('/#services')}}">{{__('webMessage.ourservices')}}</a></li>
									<li><a href="{{url('/news')}}">{{__('webMessage.newsevents')}}</a></li>
									<li><a href="{{url('/#contact')}}">{{__('webMessage.contactus')}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
  
 <!-- survey modal start -->
 @if(!empty($settingInfo->is_active_survey))
  
<div class="modal fade" id="myCovidModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-pencil"></span>&nbsp;{{__('webMessage.survey_title')}}</h4>
        </div>
        <div class="modal-body" style="max-height:600px; overflow:auto;">
          <form role="form" name="formsurvey" id="formsurvey">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h4>{{trans('webMessage.fill_the_contact')}}</h4>
            
            <div class="form-group row">
            <label for="survey_name" class="col-sm-2 col-form-label">{{trans('webMessage.name')}}</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="survey_name" name="survey_name" value="">
            </div>
            </div>
            
            <div class="form-group row">
            <label for="survey_job_title" class="col-sm-2 col-form-label">{{trans('webMessage.job_title')}}</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="survey_job_title" name="survey_job_title" value="">
            </div>
            </div>
            
            <div class="form-group row">
            <label for="survey_phone" class="col-sm-2 col-form-label">{{trans('webMessage.phone')}}</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="survey_phone" name="survey_phone" value="">
            </div>
            </div>
            
            <div class="form-group row">
            <label for="survey_email" class="col-sm-2 col-form-label">{{trans('webMessage.email')}}</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="survey_email" name="survey_email" value="">
            </div>
            </div>
            
            <div class="form-group">
            <label for="whats_company">{{trans('webMessage.whats_company')}}</label>
            <input type="text" class="form-control" id="whats_company" name="whats_company" placeholder="">
            </div>
            
            <div class="form-group">
            <label for="company_sector">{!!trans('webMessage.company_sector')!!}</label>
            <select type="text" class="form-control" id="company_sector" name="company_sector">
            <option value="">{{trans('webMessage.company_choose_option')}}</option>
            @for($i=1;$i<=19;$i++)
            <option value="{{__('webMessage.company_sector_'.$i)}}">{{__('webMessage.company_sector_'.$i)}}</option>
            @endfor
            </select>
            </div>
            
            <div class="form-group">
            <label>{!!trans('webMessage.company_sale')!!}</label>
            <div class="row">
            <div class="form-check form-check-inline col-lg-4">
              <input class="form-check-input" type="radio" name="company_sale" id="Consumers" value="{{trans('webMessage.Consumers')}}">
              <label class="form-check-label" for="Consumers">{{trans('webMessage.Consumers')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-4">
              <input class="form-check-input" type="radio" name="company_sale" id="Businesses" value="{{trans('webMessage.Businesses')}}">
              <label class="form-check-label" for="Businesses">{{trans('webMessage.Businesses')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-4">
              <input class="form-check-input" type="radio" name="company_sale" id="Both" value="{{trans('webMessage.Both')}}">
              <label class="form-check-label" for="Both">{{trans('webMessage.Both')}}</label>
            </div>
            </div>
            </div>
            
            <div class="form-group">
            <label>{!!trans('webMessage.company_operating')!!}</label>
            <div class="row">
            <div class="form-check form-check-inline col-lg-4">
              <input class="form-check-input" type="radio" name="company_operating" id="company_operating_1" value="{{trans('webMessage.company_operating_1')}}">
              <label class="form-check-label" for="company_operating_1">{{trans('webMessage.company_operating_1')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-4">
              <input class="form-check-input" type="radio" name="company_operating" id="company_operating_2" value="{{trans('webMessage.company_operating_2')}}">
              <label class="form-check-label" for="company_operating_2">{{trans('webMessage.company_operating_2')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-4">
              <input class="form-check-input" type="radio" name="company_operating" id="company_operating_3" value="{{trans('webMessage.company_operating_3')}}">
              <label class="form-check-label" for="company_operating_3">{{trans('webMessage.company_operating_3')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-4">
              <input class="form-check-input" type="radio" name="company_operating" id="company_operating_4" value="{{trans('webMessage.company_operating_4')}}">
              <label class="form-check-label" for="company_operating_4">{{trans('webMessage.company_operating_4')}}</label>
            </div>
            </div>
            </div>
            
            <h4>{{trans('webMessage.company_branches_shut')}}</h4>
            
            <div class="form-group row">
            <label for="Temporarily" class="col-sm-2 col-form-label">{{trans('webMessage.Temporarily')}}</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="Temporarily" name="Temporarily" value="">
            </div>
            </div>
            
            <div class="form-group row">
            <label for="Permanently" class="col-sm-2 col-form-label">{{trans('webMessage.Permanently')}}</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="Permanently" name="Permanently" value="">
            </div>
            </div>
            
            <div class="form-group">
            <label>{!!trans('webMessage.shutdown_causes')!!}</label>
            <div class="row">
            <div class="form-check form-check-inline col-lg-4">
              <input class="form-check-input" type="radio" name="shutdown_causes" id="shutdown_causes_1" value="{{trans('webMessage.shutdown_causes_1')}}">
              <label class="form-check-label" for="shutdown_causes_1">{{trans('webMessage.shutdown_causes_1')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-8">
              <input class="form-check-input" type="radio" name="shutdown_causes" id="shutdown_causes_2" value="{{trans('webMessage.shutdown_causes_2')}}">
              <label class="form-check-label" for="shutdown_causes_2">{{trans('webMessage.shutdown_causes_2')}}</label>
            </div>
            </div>
            </div>
            
            <div class="form-group">
            <label>{!!trans('webMessage.company_space')!!}</label>
            <div class="row">
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="company_space" id="company_space_1" value="{{trans('webMessage.company_space_1')}}">
              <label class="form-check-label" for="company_space_1">{{trans('webMessage.company_space_1')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="company_space" id="company_space_2" value="{{trans('webMessage.company_space_2')}}">
              <label class="form-check-label" for="company_space_2">{{trans('webMessage.company_space_2')}}</label>
            </div>
            </div>
            </div>
            
            
            <div class="form-group">
            <label for="if_selected_rent">{{trans('webMessage.if_selected_rent')}}</label>
            <input type="text" class="form-control" id="if_selected_rent" name="if_selected_rent" value="">
            </div>
            <div class="form-group">
            <label for="total_rent_paid">{{trans('webMessage.total_rent_paid')}}</label>
            <input type="text" class="form-control" id="total_rent_paid" name="total_rent_paid" value="">
            </div>
            <div class="form-group">
            <label for="annual_revenue">{{trans('webMessage.annual_revenue')}}</label>
            <input type="text" class="form-control" id="annual_revenue" name="annual_revenue" value="">
            </div>
            <div class="form-group">
            <label for="company_value">{{trans('webMessage.company_value')}}</label>
            <input type="text" class="form-control" id="company_value" name="company_value" value="">
            </div>
            <div class="form-group">
            <label for="expected_budget">{{trans('webMessage.expected_budget')}}</label>
            <input type="text" class="form-control" id="expected_budget" name="expected_budget" value="">
            </div>
            
            
            <div class="form-group">
            <label>{{trans('webMessage.people_employed')}}</label>
            <div class="row">
            <div class="lg-6">
            <div class="form-group">
            <label for="" class="col-sm-4 col-form-label">{{trans('webMessage.before_pandemic')}}</label>
            <div class="col-sm-4">
            <input type="text" class="form-control" id="before_pandemic_kuwaiti" name="before_pandemic_kuwaiti" value="" placeholder="{{trans('webMessage.kuwaiti')}}">
            </div>
            <div class="col-sm-4">
            <input type="text" class="form-control" id="before_pandemic_nonkuwaiti" name="before_pandemic_nonkuwaiti" value="" placeholder="{{trans('webMessage.nonkuwaiti')}}">
            </div>
            </div>
            </div>
             <div class="lg-6">
            <div class="form-group">
            <label for="" class="col-sm-4 col-form-label">{{trans('webMessage.currently')}}</label>
            <div class="col-sm-4">
            <input type="text" class="form-control" id="currently_kuwaiti" name="currently_kuwaiti" value="" placeholder="{{trans('webMessage.kuwaiti')}}">
            </div>
             <div class="col-sm-4">
            <input type="text" class="form-control" id="currently_nonkuwaiti" name="currently_nonkuwaiti" value="" placeholder="{{trans('webMessage.nonkuwaiti')}}">
            </div>
            </div>
            </div>
            </div>
            </div>
            
            <div class="form-group">
            <label for="other_services">{{trans('webMessage.other_services')}}</label>
            <textarea class="form-control" id="other_services" name="other_services" ></textarea>
            </div>
            
            <div class="form-group">
            <label>{!!trans('webMessage.company_provide_online')!!}</label>
            <div class="row">
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="company_provide_online" id="company_provide_online_1" value="{{trans('webMessage.company_provide_online_1')}}">
              <label class="form-check-label" for="company_provide_online_1">{{trans('webMessage.company_provide_online_1')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="company_provide_online" id="company_provide_online_2" value="{{trans('webMessage.company_provide_online_2')}}">
              <label class="form-check-label" for="company_provide_online_2">{{trans('webMessage.company_provide_online_2')}}</label>
            </div>
            </div>
            </div>
            
            <div class="form-group">
            <label>{!!trans('webMessage.online_platform')!!}</label>
            <div class="row">
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="online_platform" id="online_platform_1" value="{{trans('webMessage.online_platform_1')}}">
              <label class="form-check-label" for="online_platform_1">{{trans('webMessage.online_platform_1')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="online_platform" id="online_platform_2" value="{{trans('webMessage.online_platform_2')}}">
              <label class="form-check-label" for="online_platform_2">{{trans('webMessage.online_platform_2')}}</label>
            </div>
            </div>
            </div>
            
            
            <div class="form-group">
            <label>{!!trans('webMessage.affected_your_company')!!}</label>
            <div class="row">
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="affected_your_company" id="affected_your_company_1" value="{{trans('webMessage.affected_your_company_1')}}">
              <label class="form-check-label" for="affected_your_company_1">{{trans('webMessage.affected_your_company_1')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="affected_your_company" id="affected_your_company_2" value="{{trans('webMessage.affected_your_company_2')}}">
              <label class="form-check-label" for="affected_your_company_2">{{trans('webMessage.affected_your_company_2')}}</label>
            </div>
            </div>
            <div class="row">
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="affected_your_company" id="affected_your_company_3" value="{{trans('webMessage.affected_your_company_3')}}">
              <label class="form-check-label" for="affected_your_company_3">{{trans('webMessage.affected_your_company_3')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="affected_your_company" id="affected_your_company_4" value="{{trans('webMessage.affected_your_company_4')}}">
              <label class="form-check-label" for="affected_your_company_4">{{trans('webMessage.affected_your_company_4')}}</label>
            </div>
         
            </div>
            <div class="row">
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="affected_your_company" id="affected_your_company_5" value="{{trans('webMessage.affected_your_company_5')}}">
              <label class="form-check-label" for="affected_your_company_5">{{trans('webMessage.affected_your_company_5')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="affected_your_company" id="affected_your_company_6" value="{{trans('webMessage.affected_your_company_6')}}">
              <label class="form-check-label" for="affected_your_company_6">{{trans('webMessage.affected_your_company_6')}}</label>
            </div>
            </div>
            </div>
            
            <div class="form-group">
            <label>{!!trans('webMessage.chance_to_shut')!!}</label>
            <div class="row">
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="chance_to_shut" id="chance_to_shut_1" value="{{trans('webMessage.chance_to_shut_1')}}">
              <label class="form-check-label" for="chance_to_shut_1">{{trans('webMessage.chance_to_shut_1')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="chance_to_shut" id="chance_to_shut_2" value="{{trans('webMessage.chance_to_shut_2')}}">
              <label class="form-check-label" for="chance_to_shut_2">{{trans('webMessage.chance_to_shut_2')}}</label>
            </div>
            </div>
            <div class="row">
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="chance_to_shut" id="chance_to_shut_3" value="{{trans('webMessage.chance_to_shut_3')}}">
              <label class="form-check-label" for="chance_to_shut_3">{{trans('webMessage.chance_to_shut_3')}}</label>
            </div>
            <div class="form-check form-check-inline col-lg-6">
              <input class="form-check-input" type="radio" name="chance_to_shut" id="chance_to_shut_4" value="{{trans('webMessage.chance_to_shut_4')}}">
              <label class="form-check-label" for="chance_to_shut_4">{{trans('webMessage.chance_to_shut_4')}}</label>
            </div>
            </div>
            </div>
            
            
            <div class="form-group">
            <label for="additional_cost">{{trans('webMessage.additional_cost')}}</label>
            <textarea class="form-control" id="additional_cost" name="additional_cost" ></textarea>
            </div>
            
            <div class="form-group">
            <label for="additional_comments">{{trans('webMessage.additional_comments')}}</label>
            <textarea class="form-control" id="additional_comments" name="additional_comments" ></textarea>
            </div>


            
            
            <div class="checkbox">
              <label><input type="checkbox" value="1"  name="survey_terms">{!!trans('webMessage.ihavereadtermsconditions')!!}</label>
            </div>
            <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-ok"></span> {{trans('webMessage.submit')}}</button>
            <div align="center"><img src="{{url('assets/images/ajax-loader.gif')}}"  id="lodng_log" style="display:none;"/></div>
          </form>
        </div>
        <div class="modal-footer">
          <span id="responseMessage"></span>
        </div>
      </div>
    </div>
  </div>
  
  
  <div class="modal fade" id="myTermsCond" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-pencil"></span>&nbsp;@if(app()->getLocale()=='en'){!!$settingInfo->survey_terms_title_en!!}@else{!!$settingInfo->survey_terms_title_ar!!}@endif</h4>
        </div>
        <div class="modal-body">
          @if(app()->getLocale()=='en'){!!$settingInfo->survey_terms_details_en!!}@else{!!$settingInfo->survey_terms_details_ar!!}@endif
        </div>
       
      </div>
    </div>
  </div>
  @endif