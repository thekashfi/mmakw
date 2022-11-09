<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use File;
use Image;
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
//case
use App\Cases;
use App\CasesAttach;
use App\CasesUpdates;
use App\CasesUpdatesAttach;
use App\CaseType;

class accountController extends Controller
{
//account view
    public function index(){
	  $settingInfo    = Settings::where("keyname","setting")->first();
	   //get practice area 
	  $practiceareaMenus = Practice::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get services  
	  $servicesMenus     = Services::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get members  
	  $memberslists      = Memberships::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get members  
	  $NewsLists         = NewsEvents::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
	  //save logs
	  $client_id = Auth::guard('webs')->user()->id;
	  $message   = Auth::guard('webs')->user()->name." is visited to dashboard";
	  Common::saveClientLogs($client_id,$message);
	  //end
			
	  return view('website.account',compact('settingInfo','practiceareaMenus','servicesMenus','NewsLists','memberslists'));
	}
	
	
	
	//edit profile view
	public function editprofileForm(){
	   $settingInfo       = Settings::where("keyname","setting")->first();
	   //get practice area 
	  $practiceareaMenus = Practice::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get services  
	  $servicesMenus     = Services::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get members  
	  $memberslists      = Memberships::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	
	  return view('website.editprofile',compact('settingInfo','practiceareaMenus','servicesMenus','memberslists'));
	  
	}
	
	public function changepassForm(){
	  $settingInfo       = Settings::where("keyname","setting")->first();
	   //get practice area 
	  $practiceareaMenus = Practice::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get services  
	  $servicesMenus     = Services::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get members  
	  $memberslists      = Memberships::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  
	  
	  return view('website.changepass',compact('settingInfo','practiceareaMenus','servicesMenus','memberslists'));
	  
	}
	
	
	//edit profile
	public function editprofileSave(Request $request){
	$id = Auth::guard('webs')->user()->id;

	$settingInfo = Settings::where("keyname","setting")->first();
	 if(!empty($settingInfo->image_thumb_w) && !empty($settingInfo->image_thumb_h)){
		$image_thumb_w = $settingInfo->image_thumb_w;
		$image_thumb_h = $settingInfo->image_thumb_h;
		}else{
		$image_thumb_w = 150;
		$image_thumb_h = 150;
		}
		
		if(!empty($settingInfo->image_big_w) && !empty($settingInfo->image_big_h)){
		$image_big_w = $settingInfo->image_big_w;
		$image_big_h = $settingInfo->image_big_h;
		}else{
		$image_big_w = 800;
		$image_big_h = 800;
		}
		
	 //field validation  
	    $this->validate($request, [
		    'name'    => 'required|min:3|max:150|string',
            'email'   => 'required|email|min:3|max:150|string|unique:gwc_clients,email,'.$id,
			'mobile1' => 'required|min:3|max:10',
			'image'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[
		    'name.required' =>trans('webMessage.name_required'),
			'name.min'      =>trans('webMessage.name_min_error'),
			'name.max'      =>trans('webMessage.name_max_error'),
			'name.string'   =>trans('webMessage.name_string_error'),
			'email.required'=>trans('webMessage.email_required'),
			'email.min'     =>trans('webMessage.email_min_error'),
			'email.max'     =>trans('webMessage.email_max_error'),
			'email.string'  =>trans('webMessage.email_string_error'),
			'email.unique'  =>trans('webMessage.email_unique_error'),
			'email.email'   =>trans('webMessage.email_error'),
			'image.image'   =>trans('webMessage.image_error'),
			'image.mimes'   =>trans('webMessage.image_mime_error'),
			'image.max'     =>trans('webMessage.image_max_error'),
		  ]
		);
	
		
	$clients = Clients::find($id);
	
	$imageName='';
	//upload image
	if($request->hasfile('image')){
	//delete image from folder
	if(!empty($clients->image)){
	$web_image_path = "/uploads/clients/".$clients->image;
	$web_image_paththumb = "/uploads/clients/thumb/".$clients->image;
	if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	 }
	}
	//
	$imageName = 'c-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
	
	$request->image->move(public_path('uploads/clients'), $imageName);
	//create thumb
	// open file a image resource
    $imgbig = Image::make(public_path('uploads/clients/'.$imageName));
	//resize image
	$imgbig->resize($image_big_w,$image_big_h);//Fixed w,h
	
	if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
	// insert watermark at bottom-right corner with 10px offset
    $imgbig->insert(public_path('uploads/clients/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
	}
	// save to imgbig thumb
	$imgbig->save(public_path('uploads/clients/'.$imageName));
	
	//create thumb
	// open file a image resource
    $img = Image::make(public_path('uploads/clients/'.$imageName));
	//resize image
	$img->resize($image_thumb_w,$image_thumb_h);//Fixed w,h
	// save to thumb
	$img->save(public_path('uploads/clients/thumb/'.$imageName));
	
	}else{
	$imageName = $clients->image;
	}
	

	$clients->name=$request->input('name');
	$clients->email=$request->input('email');
	$clients->mobile1=$request->input('mobile1');
	$clients->mobile2=$request->input('mobile2');
	$clients->mobile3=$request->input('mobile3');
	$clients->image=$imageName;
	$clients->save();
	
	//save logs
	  $client_id = Auth::guard('webs')->user()->id;
	  $message   = Auth::guard('webs')->user()->name." is edited his/her profile";
	  Common::saveClientLogs($client_id,$message);
	  //end
	  
	  
	return redirect('/editprofile')->with('message-success','Information is updated successfully');	
	}
	
	//change password
	public function changepass(Request $request){
	
	    $id = Auth::guard('webs')->user()->id;
		
	    $v = Validator::make($request->all(), [
		'oldpassword'      => 'required',
        'newpassword'      => 'required',
        'confirmpassword'  => 'required|same:newpassword',
         ],[
		 'oldpassword.required'    =>trans('webMessage.oldpassword_required'),
		 'newpassword.required'    =>trans('webMessage.newpassword_required'),
		 'confirmpassword.required'=>trans('webMessage.confirmpassword_required'),
		 'confirmpassword.same'=>trans('webMessage.confirmpassword_mismatched'),
		 ]);

		if ($v->fails())
		{
			return redirect()->back()->withErrors($v->errors())->withInput();
		}
		
		$clients = Clients::find($id);
		
        if(Hash::check($request->oldpassword, $clients->password)){
        $clients->password   = bcrypt($request->newpassword);
        $clients->updated_at = date("Y-m-d H:i:s");
        $clients->save();
        Session::flash('message-success',trans('webMessage.password_updated_success'));
		//save logs
	    $client_id = Auth::guard('webs')->user()->id;
	    $message   = Auth::guard('webs')->user()->name." has changed the old password";
	    Common::saveClientLogs($client_id,$message);
	    //end
	  
        return redirect()->back();
		}else{
		$error = array('oldpassword' => trans('webMessage.oldpasswordnotexist'));
        return redirect()->back()->withErrors($error)->withInput(); 
		}
	}
	
	//view case details
	//view case updates
	public function viewcaseupdates(Request $request){
	
	  
	  $client_id = Auth::guard('webs')->user()->id;
	  
	  $settingInfo       = Settings::where("keyname","setting")->first();
	   //get practice area 
	  $practiceareaMenus = Practice::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get services  
	  $servicesMenus     = Services::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get members  
	  $memberslists      = Memberships::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //caselists
	  //check search queries
        if(!empty($request->get('q'))){
        $q = $request->get('q');
        }else{
        $q = $request->q;
        }
        
       
        //menus records
        if(!empty($q)){
        $caselists = Cases::where('client_id',$client_id)
		                    ->where('title_en','LIKE','%'.$q.'%')
		                    ->orWhere('title_ar','LIKE','%'.$q.'%')
                            ->orderBy('case_date', 'DESC')
                            ->paginate($settingInfo->item_per_page_front);
        $caselists->appends(['q' => $q]);
		
        }else{
        $caselists  =  Cases::where('client_id',$client_id)->where("is_active","1")->paginate($settingInfo->item_per_page_front);
        }
	  
	  //save logs
	    $client_id = Auth::guard('webs')->user()->id;
	    $message   = Auth::guard('webs')->user()->name." is visited to case update page";
	    Common::saveClientLogs($client_id,$message);
	    //end
		
		
	    return view('website.casesupdates',compact('settingInfo','practiceareaMenus','servicesMenus','memberslists','caselists'))->withQuery ( $q );
	 }
	 
	 //get case details
	public function viewcaseupdatesdetails($id){
	
	  $client_id = Auth::guard('webs')->user()->id;
	  
	  $settingInfo       = Settings::where("keyname","setting")->first();
	   //get practice area 
	  $practiceareaMenus = Practice::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get services  
	  $servicesMenus     = Services::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  //get members  
	  $memberslists      = Memberships::where("is_active","1")->orderBy('display_order', $settingInfo->default_sort)->get();
	  
	  $casedetails      =  Cases::where('client_id',$client_id)->where("id",$id)->first();
	  
	  //save logs
	    $client_id = Auth::guard('webs')->user()->id;
	    $message   = Auth::guard('webs')->user()->name." is visited to case update details page";
	    Common::saveClientLogs($client_id,$message);
	    //end
		
		
	  return view('website.casesupdates-details',compact('settingInfo','practiceareaMenus','servicesMenus','memberslists','casedetails'));
	} 
	// get type details
	
	public static function getCaseType($type_id){
	$typeInfo       = CaseType::find($type_id);
	return $typeInfo;
	}
	//get attach files lists
	public static function getCaseAttach($case_id){
	$Info       = CasesAttach::where('case_id',$case_id)->get();
	return $Info;
	}
	//get update status 
	public static function getCasesUpdates($case_id){
	$Info       = CasesUpdates::where('case_id',$case_id)->orderBy('case_date','desc')->get();
	//update read status
	if(!empty($Info)){
	foreach($Info as $Infos){
	$caseupdates = CasesUpdates::where('id',$Infos->id)->first();
	$caseupdates->is_read=1;
	$caseupdates->save();
	}
	}
	return $Info;
	}
	//get update attach files lists
	public static function getCasesUpdatesAttach($update_id){
	$Info       = CasesUpdatesAttach::where('update_id',$update_id)->get();
	return $Info;
	}
	//check update seen or not
	public static function isReadUpdates($case_id){
	$Info       = CasesUpdates::where('case_id',$case_id)->where('is_active','1')->where('is_read','0')->get()->count();
	return $Info;
	}
	public static function isReadUpdatesCount($client_id){
	$Info       = CasesUpdates::where('client_id',$client_id)->where('is_active','1')->where('is_read','0')->get()->count();
	return $Info;
	}
	
	
	//logout
	
	/**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        
		//save logs
	    $client_id = Auth::guard('webs')->user()->id;
	    $message   = Auth::guard('webs')->user()->name." has been logged out from his / her account";
	    Common::saveClientLogs($client_id,$message);
	    //end
		
		Auth::guard('webs')->logout();
        //$request->session()->flush();
        //$request->session()->regenerate();
        return redirect('/login')->with("session_msg",trans('webMessage.youhaveloggedoutsuccess'));
    }
}