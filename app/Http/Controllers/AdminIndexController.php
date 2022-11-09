<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Spatie\Permission\Models\Role;
use Hash;
use App\Admin;//model
use Common;

use App\Mail\SendGrid;
use Mail;
use Illuminate\Support\Str;
class AdminIndexController extends Controller
{
    
	use AuthenticatesUsers;	
	
	public function __construct()
    {
	   $this->middleware('guest:admin')->except('logout');
	}
	
	//view home page
	public function index()
    {
	 return view('gwc.home');
	}
	//view forgot password screen
	public function forgotview(){
	return view('gwc.forgot');
	}
	public function showResetForm(){
	return view('gwc.forgot');
	}
	
	//process login 
	public function login(Request $request)
    {
	

	
	    $this->validate($request, [
            'login_username' => 'required|min:4',
            'login_password' => 'required|min:6'
            ],[
			'login_username.required' => 'Please enter login username',
			'login_password.required' => 'Please enter login password'
			]
		);
		
        $remember = $request->remember_me ? true : false;
		
        if (Auth::guard('admin')->attempt(['username' => $request->login_username, 'password' => $request->login_password,'is_active'=>1],$remember)) {
		    //save logs
			$key_name   = "login";
			$key_id     = Auth::guard('admin')->user()->id;
			$message    = Auth::guard('admin')->user()->name."(".Auth::guard('admin')->user()->userType.") is logged in to Admin Panel.";
			$created_by = Auth::guard('admin')->user()->id;
			
			Common::saveLogs($key_name,$key_id,$message,$created_by);
			//end save logs
		    //store values in cookies 
			if($remember==true){
			$minutes=3600;
			Cookie::queue('login_username', $request->login_username, $minutes);
			Cookie::queue('login_password', $request->login_password, $minutes);
			Cookie::queue('remember_me', 1, $minutes);
			}else{
			$minutes=0;
			Cookie::queue('login_username', '', $minutes);
			Cookie::queue('login_password', '', $minutes);
			Cookie::queue('remember_me', 0, $minutes);
			}
            return redirect()->intended('/gwc/home/');
        }
		
        return back()->withInput()->withErrors(['invalidlogin'=>'Invalid login credentials']);

	}
	//forgot password
	//send link
	public function sendResetLinkEmail(Request $request){
	//field validation
	  $validator = Validator::make($request->all(),[
            'email'   => 'required|email'
            ],[ 
			'email.required'   => trans('adminMessage.email_required'),
			]
			);
	    if ($validator->fails()) {
            return redirect('/gwc/forgot')
                        ->withErrors($validator)
                        ->withInput();
        }
		
	$adminInfo = Admin::where("email",$request->email)->first();	
	if(empty($adminInfo->id)){
	return redirect('/gwc/forgot')
                        ->withErrors(['email'=>trans('adminMessage.email_not_register')])
                        ->withInput();
	}else{
	 $token = (string)Str::uuid();
	 $adminInfo->password_token=$token;
	 $adminInfo->save();
	 
	 $appendMessage = "<b><a href='".url('gwc/forgot/'.$token)."'>".trans('adminMessage.passwordresetlink')."</b>";
	 $data = [
	 'dear' => trans('adminMessage.dear').' '.$adminInfo->name,
	 'footer' => trans('adminMessage.email_footer'),
	 'message' => trans('adminMessage.you_have_reqtest_fp')."<br><br>".$appendMessage,
	 'subject' =>'Admin Forgot Password Reset Link',
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
	 
	        //save logs
			$key_name   = "forgot";
			$key_id     = $adminInfo->id;
			$message    = $adminInfo->name." has requested a forgot password link.";
			$created_by = $adminInfo->id;
			Common::saveLogs($key_name,$key_id,$message,$created_by);
			//end save logs 
	 
	return redirect('/gwc/forgot')
	                 ->with('info',trans('adminMessage.password_reset_link_sent'));		
	}
	}
	
	
	
	public function resets(Request $request,$token){

	//field validation
	  $validator = Validator::make($request->all(),[
            'email'           => 'required|email',
			'new_password'    => 'required|min:3|max:150|string',
			'confirm_password'=> 'required|min:3|max:150|string|same:new_password',
            ],[ 
			'email.required'  => trans('adminMessage.email_required'),
			'new_password.required'      => trans('adminMessage.new_password_required'),
			'confirm_password.required'  => trans('adminMessage.confirm_password_required'),
			'confirm_password.same'      =>trans('adminMessage.confirm_password_mismatched'),
			]
			);
	    if ($validator->fails()) {
            return redirect('/gwc/forgot/'.$token)
                        ->withErrors($validator)
                        ->withInput();
        }
		
	$adminInfo = Admin::where("email",$request->email)->where("password_token",$token)->first();	
	if(empty($adminInfo->id)){
	
	return redirect('/gwc/forgot/'.$token)
                        ->withErrors(['email'=>trans('adminMessage.email_not_register_or_token')])
                        ->withInput();
	}else{
	
	 $token = (string)Str::uuid();
	 $adminInfo->password_token=$token;
	 $adminInfo->password   = bcrypt($request->new_password);
	 $adminInfo->save();
	 $appendMessage  ="";
	 $appendMessage .= "<b>".trans('adminMessage.username')." : </b>".$adminInfo->username;
	 $appendMessage .= "<br><b>".trans('adminMessage.password')." : </b>".$request->new_password;
	 $data = [
	 'dear' => trans('adminMessage.dear').' '.$adminInfo->name,
	 'footer' => trans('adminMessage.email_footer'),
	 'message' => trans('adminMessage.password_reset_done_success')."<br><br>".$appendMessage,
	 'subject' =>'Admin Password Successfully Reset',
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
	 
	        //save logs
			$key_name   = "forgot";
			$key_id     = $adminInfo->id;
			$message    = $adminInfo->name." has reset his old password";
			$created_by = $adminInfo->id;
			Common::saveLogs($key_name,$key_id,$message,$created_by);
			//end save logs 
			
	return redirect('/gwc')
	                 ->with('info',trans('adminMessage.password_reset_done'));		
	}
	
	}
	
}
