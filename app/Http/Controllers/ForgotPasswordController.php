<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

use Response;
use App\Settings;
use App\Newsletter;
use App\Subjects;
use App\Contactus;
use App\NewsEvents;
use App\Practice;
use App\Services;
use App\Memberships;
use App\Clients;

use App\Mail\SendGrid;
use Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    //show send link form
	public function showLinkRequestForm(){
	 	//get setting details
	  $settingInfo      = Settings::where("keyname","setting")->first();
	  //get subject 
	  $subjectLists     = Subjects::where("is_active","1")->orderBy('display_order','ASC')->get();
	  //get latest news & events
	  $newseventslists  = NewsEvents::where("is_active","1")->orderBy('news_date','DESC')->limit(2)->get();
	  //get practice area 
	  $practiceareaMenus = Practice::where("is_active","1")->orderBy('display_order','ASC')->get();
	  //get services  
	  $servicesMenus     = Services::where("is_active","1")->orderBy('display_order','ASC')->get();
	  //get members  
	  $memberslists     = Memberships::where("is_active","1")->orderBy('display_order','ASC')->get();
	  
	  
      return view('website.password.sendlink',compact('settingInfo','subjectLists','newseventslists','practiceareaMenus','servicesMenus','memberslists'));
	}
	
	//send link
	public function sendResetLinkEmail(Request $request){
	//field validation
	  $validator = Validator::make($request->all(),[
            'email'   => 'required|email'
            ],[ 
			'email.required'   => trans('webMessage.email_required'),
			]
			);
	    if ($validator->fails()) {
            return redirect('/password/reset')
                        ->withErrors($validator)
                        ->withInput();
        }
		
	$clientInfo = Clients::where("email",$request->email)->first();	
	if(empty($clientInfo->id)){
	return redirect('/password/reset')
                        ->withErrors(['email'=>trans('webMessage.email_not_register')])
                        ->withInput();
	}else{
	 $token = (string)Str::uuid();
	 $clientInfo->password_token=$token;
	 $clientInfo->save();
	 
	 $appendMessage = "<b><a href='".url('password/reset/'.$token)."'>".trans('webMessage.passwordresetlink')."</b>";
	 $data = [
	 'dear' => trans('webMessage.dearuser'),
	 'footer' => trans('webMessage.email_footer'),
	 'message' => trans('webMessage.you_have_reqtest_fp')."<br><br>".$appendMessage,
	 'subject' =>'Forgot Password Reset Link',
	 'email_from' =>'noreply@mmakw.com',
	 'email_from_name' =>'mmakw.com',
	 'email_cc' =>'info@mmakw.com',
	 'email_cc_name' =>'mmakw.com',
	 'email_bcc' =>'info@mmakw.com',
	 'email_bcc_name' =>'mmakw.com',
	 'email_replyto' =>'info@mmakw.com',
	 'email_replyto_name' =>'mmakw.com'
	 ];
     Mail::to($request->email)->send(new SendGrid($data));	 
	 
	return redirect('/password/reset')
	                 ->with('session_msg',trans('webMessage.password_reset_link_sent'));		
	}
	}
	
	//show reset form
	public function showResetForm(){
	//get setting details
	  $settingInfo      = Settings::where("keyname","setting")->first();
	  //get subject 
	  $subjectLists     = Subjects::where("is_active","1")->orderBy('display_order','ASC')->get();
	  //get latest news & events
	  $newseventslists  = NewsEvents::where("is_active","1")->orderBy('news_date','DESC')->limit(2)->get();
	  //get practice area 
	  $practiceareaMenus = Practice::where("is_active","1")->orderBy('display_order','ASC')->get();
	  //get services  
	  $servicesMenus     = Services::where("is_active","1")->orderBy('display_order','ASC')->get();
	  //get members  
	  $memberslists     = Memberships::where("is_active","1")->orderBy('display_order','ASC')->get();
	  
	  
      return view('website.password.sendlink',compact('settingInfo','subjectLists','newseventslists','practiceareaMenus','servicesMenus','memberslists'));
	}
	
	public function resets(Request $request,$token){

	//field validation
	  $validator = Validator::make($request->all(),[
            'email'           => 'required|email',
			'new_password'    => 'required|min:3|max:150|string',
			'confirm_password'=> 'required|min:3|max:150|string|same:new_password',
            ],[ 
			'email.required'  => trans('webMessage.email_required'),
			'new_password.required'      => trans('webMessage.newpassword_required'),
			'confirm_password.required'  => trans('webMessage.confirmpassword_required'),
			'confirm_password.same'      =>trans('webMessage.confirmpassword_mismatched'),
			]
			);
	    if ($validator->fails()) {
            return redirect('/password/reset/'.$token)
                        ->withErrors($validator)
                        ->withInput();
        }
		
	$clientInfo = Clients::where("email",$request->email)->where("password_token",$token)->first();	
	if(empty($clientInfo->id)){
	
	return redirect('/password/reset/'.$token)
                        ->withErrors(['email'=>trans('webMessage.email_not_register_or_token')])
                        ->withInput();
	}else{
	
	 $token = (string)Str::uuid();
	 $clientInfo->password_token=$token;
	 $clientInfo->password   = bcrypt($request->new_password);
	 $clientInfo->save();
	 $appendMessage  ="";
	 $appendMessage .= "<b>".trans('webMessage.username')." : </b>".$clientInfo->username;
	 $appendMessage .= "<br><b>".trans('webMessage.password')." : </b>".$request->new_password;
	 $data = [
	 'dear' => trans('webMessage.dearuser'),
	 'footer' => trans('webMessage.email_footer'),
	 'message' => trans('webMessage.password_reset_done_success')."<br><br>".$appendMessage,
	 'subject' =>'Password Successfully Reset',
	 'email_from' =>'noreply@mmakw.com',
	 'email_from_name' =>'mmakw.com',
	 'email_cc' =>'info@mmakw.com',
	 'email_cc_name' =>'mmakw.com',
	 'email_bcc' =>'info@mmakw.com',
	 'email_bcc_name' =>'mmakw.com',
	 'email_replyto' =>'info@mmakw.com',
	 'email_replyto_name' =>'mmakw.com'
	 ];
     Mail::to($request->email)->send(new SendGrid($data));	 
	 
	return redirect('/login')
	                 ->with('session_msg',trans('webMessage.password_reset_done'));		
	}
	
	}
}
