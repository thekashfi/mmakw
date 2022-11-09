<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use App\Admin;//model
use App\Menus;//model
use App\NewsEvents; //model
use App\Practice; //model
use App\Services; //model
use App\Clients; //model
use App\Teams; //model
use App\Contactus; //model
use App\Settings; //model
use DB;
use Common;
//gapi
use App\Gapi\Gapi;


class AdminDashboardController extends Controller
{
    
		
	
	//view home page
	public function index()
    {
	
	 //count categories
	 $countNewsEvents = count(NewsEvents::all());
	 $countPractices  = count(Practice::all());
	 $countServices   = count(Services::all());
	 $countClients    = count(Clients::all());
	 $countTeams      = count(Teams::all());
	 $countContactus  = count(Contactus::all());
	 
	 //save logs
		$key_name   = "home";
		$key_id     = 0;
		$message    = "Visited to dashboard page";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
	 return view('gwc.dashboard',compact('countNewsEvents','countPractices','countServices','countClients','countTeams','countContactus'));
	}
	
	/**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        
		//save logs
		$key_name   = "logout";
		$key_id     = Auth::guard('admin')->user()->id;
		$message    = Auth::guard('admin')->user()->name."(".Auth::guard('admin')->user()->userType.") is logged out from Admin Panel.";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		Auth::guard('admin')->logout();
        //$request->session()->flush();
        //$request->session()->regenerate();
        return redirect('/gwc/')->with("info","You have successfully logged out from Admin Panel");
    }
	
	///get setting details
	public static function getSettingsDetails(){
	 $settings = Settings::where('keyname','setting')->first(); 
	 return $settings;
	}
	
	//get unread case updates
	public static function listunreadcaseupdates(){
	
	$data = DB::table('gwc_cases_updates')
       ->join('gwc_cases', 'gwc_cases.id', '=', 'gwc_cases_updates.case_id')
       ->where('gwc_cases.is_active',1)->where('is_read',0)->select('gwc_cases.title_en','gwc_cases_updates.created_at','gwc_cases.id','gwc_cases_updates.case_id','gwc_cases_updates.details_en')
       ->get();
	return $data;
	}
	
	public static function listunreadcaseupdatesweek(){
	
	$data = DB::table('gwc_cases_updates')
       ->join('gwc_cases', 'gwc_cases.id', '=', 'gwc_cases_updates.case_id')
	   ->join('gwc_clients', 'gwc_clients.id', '=', 'gwc_cases_updates.client_id')
       ->where('gwc_cases.is_active',1)->where('gwc_cases_updates.case_date','=',date("Y-m-d"))->select('gwc_cases.title_en','gwc_cases_updates.created_at','gwc_cases.id','gwc_cases_updates.case_id','gwc_cases_updates.details_en','gwc_cases_updates.is_read','gwc_clients.name','gwc_clients.image')
       ->get();
	return $data;
	}
	
	//get unred contact us
	public static function getUnreadContacts(){
	 $contacts = Contactus::where('is_read',0)->orderBy('created_at','DESC')->get(); 
	 return $contacts;
	}
	///get details
	public static function getContactsLists(){
	 $contacts = Contactus::orderBy('created_at','DESC')->get(); 
	 return $contacts;
	}
	
	
	//ga
	public static function gareport(){
	$p12 = base_path('public/uploads/keys.p12');
	$ga_profile_id = "213877019";
	$ga = new Gapi("mmakwga@unified-ring-271508.iam.gserviceaccount.com", $p12);
    $accessToken = $ga->getToken();
    return $accessToken;
	}

}
