<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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
use App\User;

class userController extends Controller
{
   
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/account';	
	
	public function __construct()
    {
	   $this->middleware('guest:webs')->except('logout');
	}

	////////user section
	//show login form
	public function loginForm(){
	  $settingInfo       = Settings::where("keyname","setting")->first();
	   //get practice area 
	  $practiceareaMenus = Practice::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get services  
	  $servicesMenus     = Services::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get members  
	  $memberslists      = Memberships::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get members  
	  $NewsLists         = NewsEvents::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
	  
	  return view('website.login',compact('settingInfo','practiceareaMenus','servicesMenus','NewsLists','memberslists'));
	}
	
	//process login 
	public function loginAuthenticate(Request $request)
    {
	
	
	    $this->validate($request, [
            'login_username' => 'required|min:4',
            'login_password' => 'required|min:6'
            ],[
			'login_username.required' => trans('webMessage.username_required'),
			'login_password.required' => trans('webMessage.password_required'),
			]
		);
		
        $remember = $request->remember_me ? true : false;
		
        if (Auth::guard('webs')->attempt(['username' => $request->login_username, 'password' => $request->login_password,'is_active'=>1],$remember)) {
		    //store values in cookies 
			if($remember==true){
			$minutes=3600;
			Cookie::queue('xlogin_username', $request->login_username, $minutes);
			Cookie::queue('xlogin_password', $request->login_password, $minutes);
			Cookie::queue('xremember_me', 1, $minutes);
			}else{
			$minutes=0;
			Cookie::queue('xlogin_username', '', $minutes);
			Cookie::queue('xlogin_password', '', $minutes);
			Cookie::queue('xremember_me', 0, $minutes);
			}
			//save logs
			$client_id = Auth::guard('webs')->user()->id;
			$message   = Auth::guard('webs')->user()->name." is logged in";
			Common::saveClientLogs($client_id,$message);
			//end
            return redirect()->intended('/account');
        }
		
        return back()->withInput()->withErrors(['invalidlogin'=>'Invalid login credentials']);

	}	
		
}
