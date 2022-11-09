<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Hash;
use Auth;
use App\Menus;
use App\Admin;
use DB;
use App\AdminLogs;
use App\Newsletter;
use App\Settings;
use App\Survey;
use Response;
///use session;
use File;


class AdminUserController extends Controller
{
   
     
    public function index(Request $request)
    {
       $settingInfo = Settings::where("keyname","setting")->first();
        //check search queries
        if(!empty($request->get('q'))){
        $q = $request->get('q');
        }else{
        $q = $request->q;
        }
        
       
        //menus records
        if(!empty($q)){
		if(auth()->guard('admin')->user()->can('logs-list-self-only')){
		$usersLists = Admin::where('created_by',auth()->guard('admin')->user()->id)
		                     ->where('name','LIKE','%'.$q.'%')
                            ->orderBy('name', 'ASC')
                            ->paginate($settingInfo->item_per_page_back); 
		}else{
        $usersLists = Admin::where('name','LIKE','%'.$q.'%')
                            ->orderBy('name', 'ASC')
                            ->paginate($settingInfo->item_per_page_back);  
		 }					
        $usersLists->appends(['q' => $q]);
		
        }else{
		if(auth()->guard('admin')->user()->can('logs-list-self-only')){
		$usersLists = Admin::where('created_by',auth()->guard('admin')->user()->id)->orderBy('name', 'ASC')->paginate($settingInfo->item_per_page_back);
		}else{
        $usersLists = Admin::orderBy('name', 'ASC')->paginate($settingInfo->item_per_page_back);
		}
        }
        return view('gwc.adminUsers',['usersLists' => $usersLists]);
    }
	
	//sruvey
	
	 public function survey(Request $request)
    {
       $settingInfo = Settings::where("keyname","setting")->first();
        //check search queries
        if(!empty($request->get('q'))){
        $q = $request->get('q');
        }else{
        $q = $request->q;
        }
        
       
        //menus records
        if(!empty($q)){

        $surveyLists = Survey::where('name','LIKE','%'.$q.'%')
		                    ->orwhere('email','LIKE','%'.$q.'%')
							->orwhere('mobile','LIKE','%'.$q.'%')
							->orwhere('job_title','LIKE','%'.$q.'%')
                            ->orderBy('created_at', 'DESC')
                            ->paginate($settingInfo->item_per_page_back);  
		 					
        $surveyLists->appends(['q' => $q]);
		
        }else{
        $surveyLists = Survey::orderBy('created_at', 'DESC')->paginate($settingInfo->item_per_page_back);
        }
        return view('gwc.survey.index',compact('surveyLists'));
    }
	
	//view details
	public function detailsSurvey(Request $request){
	$surveyDetails = Survey::find($request->id);
	return view('gwc.survey.view',compact('surveyDetails'));
	}
	//delete survey
	
	public function deleteSurvey($id=0){
     if(!empty($id)){
		$AdminLogs = Survey::find($id);
		
		//save logs
		$key_name   = "logs";
		$key_id     = $AdminLogs->id;
		$message    = "Survey is deleted.(".$AdminLogs->name.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
			
		$AdminLogs->delete();	
        Session::flash('message-success','Record is deleted successfully.');
     }else{
        Session::flash('message-error','Failed to delete');
     }
     return redirect()->back();
    }
	//view logs
	public function logs(Request $request)
    {
       $settingInfo = Settings::where("keyname","setting")->first();
        //check search queries
        if(!empty($request->get('q'))){
        $q = $request->get('q');
        }else{
        $q = $request->q;
        }
        
       
        //menus records
        if(!empty($q)){
        $logsLists = AdminLogs::where('message','LIKE','%'.$q.'%')
                            ->orderBy('created_at', 'DESC')
                            ->paginate($settingInfo->item_per_page_back);  
        $logsLists->appends(['q' => $q]);
		
        }else{
        $logsLists = AdminLogs::orderBy('created_at', 'DESC')->paginate($settingInfo->item_per_page_back);
        }
        return view('gwc.adminLogs',['logsLists' => $logsLists]);
    }
	
	
	public function subscribers(Request $request)
    {
       $settingInfo = Settings::where("keyname","setting")->first();
        //check search queries
        if(!empty($request->get('q'))){
        $q = $request->get('q');
        }else{
        $q = $request->q;
        }
        
       
        //menus records
        if(!empty($q)){
        $subscriberLists = Newsletter::where('newsletter_email','LIKE','%'.$q.'%')
                            ->orderBy('created_at', 'DESC')
                            ->paginate($settingInfo->item_per_page_back);  
        $subscriberLists->appends(['q' => $q]);
		
        }else{
        $subscriberLists = Newsletter::orderBy('created_at', 'DESC')->paginate($settingInfo->item_per_page_back);
        }
        return view('gwc.adminSubscriber',['subscriberLists' => $subscriberLists]);
    }
    //view form
    public function adminUserForm($id="",Request $request){
	    
        if(!empty($id)){
        $userDetails = Admin::find($id); 
		$roles = Role::pluck('name','name')->all();
		$userRole = $userDetails->roles->pluck('name','name')->all();
		return view('gwc.adminUsersForm',['userDetails'=>$userDetails,'roles'=>$roles,'userRole'=>$userRole]);
        }else{
        $userDetails = array();
		$roles = Role::pluck('name','name')->all();
		$userRole = array();
		return view('gwc.adminUsersForm',['userDetails'=>$userDetails,'roles'=>$roles,'userRole'=>$userRole]);
        }
		
		
		
    }

    public function AddRecord(Request $request){ 
        //field validation
		$v = Validator::make($request->all(), [
		'name'    => 'required|string|min:3|max:255',
        'email'   => 'required|email|unique:gwc_users|max:255',
        'mobile'  => 'required|numeric|digits:8',
		'username'=> 'required|string|unique:gwc_users|min:3|max:255',
		'password'=> 'required|string|min:3|max:15',
		'roles'   => 'required'
         ]);

		if ($v->fails())
		{
			return redirect()->back()->withErrors($v->errors())->withInput();
		}
		
        $Admin = new Admin;

        $Admin->name     = $request->name;
        $Admin->email    = $request->email;
        $Admin->mobile   = $request->mobile;
        $Admin->username = $request->username;
        $Admin->password = bcrypt($request->password);
        $Admin->created_at = date("Y-m-d H:i:s");
        $Admin->updated_at = date("Y-m-d H:i:s");
        $Admin->save();
		//assign roles 
		$Admin->assignRole($request->input('roles'));
		
		//save logs
		$key_name   = "user";
		$key_id     = $Admin->id;
		$message    = "Account is created for ".$request->name;
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
        Session::flash('message-success','Record is added successfully.');
        return redirect("/gwc/users");
    }
	
	//save profile
	public function adminSaveProfile(Request $request){
	
	    $v = Validator::make($request->all(), [
	    'id'      => 'required',
		'name'    => 'required|string|min:3|max:255',
        'email'   => 'required|email|unique:gwc_users,email,'.$request->id.'|max:255',
        'mobile'  => 'required|numeric|digits:8',
		'image'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		'roles'   => 'required'
         ]);

		if ($v->fails())
		{
			return redirect()->back()->withErrors($v->errors());
		}
		
        $Admin = Admin::where("id",$request->id)->first();
	    //dd($Admin);
		//upload logo
		if($request->hasfile('image')){
		//delete logo from folder
		if(!empty($Admin->image)){
		$web_image_path = "/uploads/users/".$Admin->image;  // Value is not URL but directory file path
		if(File::exists(public_path($web_image_path))) {
			File::delete(public_path($web_image_path));
		  }
		}
		$imageName = 'admin-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
		$request->image->move(public_path('uploads/users'), $imageName);
        $Admin->image=$imageName;
		}
		//save logs
		$key_name   = "user";
		$key_id     = $Admin->id;
		$message    = "Profile is updated for ".$Admin['name'];
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
        $Admin->name     = $request->name;
        $Admin->email    = $request->email;
        $Admin->mobile   = $request->mobile;
        $Admin->updated_at = date("Y-m-d H:i:s");
        $Admin->save();
		//assign roles 
		DB::table('model_has_roles')->where('model_id',$request->id)->delete();
        $Admin->assignRole($request->input('roles'));
		
        Session::flash('message-success','Record is updated successfully.');
        return redirect()->back();
	}
	
	//update loggedin profile
	public function adminSaveEditProfile(Request $request){
	   
	
	    $v = Validator::make($request->all(), [
	    'id'      => 'required',
		'name'    => 'required|string|min:3|max:255',
        'email'   => 'required|email|unique:gwc_users,email,'.$request->id.'|max:255',
        'mobile'  => 'required|numeric|digits:8',
		'image'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);

		if ($v->fails())
		{
			return redirect()->back()->withErrors($v->errors());
		}
		
        $Admin = Admin::where("id",$request->id)->first();
		//upload logo
		if($request->hasfile('image')){
		//delete logo from folder
		if(!empty($Admin->image)){
		$web_image_path = "/uploads/users/".$Admin->image;  // Value is not URL but directory file path
		if(File::exists(public_path($web_image_path))) {
			File::delete(public_path($web_image_path));
		  }
		}
		$imageName = 'admin-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
		$request->image->move(public_path('uploads/users'), $imageName);
        $Admin->image=$imageName;
		}
		
		//save logs
		$key_name   = "user";
		$key_id     = $Admin->id;
		$message    = "Profile is updated for ".$Admin['name'];
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
        $Admin->name     = $request->name;
        $Admin->email    = $request->email;
        $Admin->mobile   = $request->mobile;
        $Admin->updated_at = date("Y-m-d H:i:s");
        $Admin->save();
		
        Session::flash('message-success','Record is updated successfully.');
        return redirect()->back();
	}
	
	//change password
	public function adminChangePass(Request $request){
	
	    $v = Validator::make($request->all(), [
	    'id'                => 'required',
		'current_password'  => 'required',
        'new_password'      => 'required',
        'confirm_password'  => 'required|same:new_password',
         ]);

		if ($v->fails())
		{
			return redirect()->back()->withErrors($v->errors())->withInput();
		}
		
		$Admin = Admin::where("id",$request->id)->first();
		
        if(Hash::check($request->current_password, $Admin->password)){
		
		//save logs
		$key_name   = "user";
		$key_id     = $Admin->id;
		$message    = "Password is changed for ".$Admin['name'];
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
        $Admin->password   = bcrypt($request->new_password);
        $Admin->updated_at = date("Y-m-d H:i:s");
        $Admin->save();
        Session::flash('message-success','Password is updated successfully.');
        return redirect()->back();
		}else{
		$error = array('current_password' => 'Please enter correct current password');
        return redirect()->back()->withErrors($error)->withInput(); 
		}
	}

    public function deleteUser($id=0){
     if(!empty($id)){
		$Admin = Admin::find($id);
		//save logs
		$key_name   = "user";
		$key_id     = $Admin->id;
		$message    = "Account is deleted for ".$Admin['name'];
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		$Admin->delete();
        Session::flash('message-success','Record is deleted successfully.');
     }else{
        Session::flash('message-error','Failed to delete');
     }
     return redirect()->back();
    }
	
	public function deleteLogs($id=0){
     if(!empty($id)){
		$AdminLogs = AdminLogs::find($id);
		
		//save logs
		$key_name   = "logs";
		$key_id     = $AdminLogs->id;
		$message    = "Logs is deleted.(".$AdminLogs->message.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
			
		$AdminLogs->delete();	
        Session::flash('message-success','Record is deleted successfully.');
     }else{
        Session::flash('message-error','Failed to delete');
     }
     return redirect()->back();
    }
	
	
	public function deleteSubscriber($id=0){
     if(!empty($id)){
		$Newsletter = Newsletter::find($id);
		
		//save logs
		$key_name   = "subscribe";
		$key_id     = $Newsletter->id;
		$message    = "Email subscriber is removed.(".$Newsletter->newsletter_email.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
			
		$Newsletter->delete();	
        Session::flash('message-success','Record is deleted successfully.');
     }else{
        Session::flash('message-error','Failed to delete');
     }
     return redirect()->back();
    }


   
   //update status
	public function updateStatusAjax(Request $request)
    {
		$recDetails = Admin::where('id',$request->id)->first(); 
		if($recDetails['is_active']==1){
			$active=0;
		}else{
			$active=1;
		}
		//save logs
		$key_name   = "user";
		$key_id     = $recDetails->id;
		$message    = "Status is changed to ".$active." for ".$recDetails['name'];
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		$recDetails->is_active=$active;
		$recDetails->save();
		return ['status'=>200,'message'=>'Status is modified successfully'];
	}
	
	//edit profile
	public function editprofile(){
	return view('gwc.adminEditProfileForm');
	}
	//chane pass
	public function changepassword(){
	return view('gwc.adminEditProfileForm');
	}
	
	public static function getUserDetails($id){
	$userDetails = Admin::find($id); 
	return $userDetails;
	}
	
    //get parent menus in dropdonwn
    /*public function getMenuDropDown($id=0){
        $opt='';
        $menusLists = Menus::where('parent_id',0);
        foreach($menusLists as $menu){
        $opt.='<option value="">{{$menu->name}}</option>';
        }
        return $opt;
    }*/
	
	public function exportSubscriber()
      {
    $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=file.csv",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );

    $reviews = Newsletter::orderBy('newsletter_email','ASC')->get();
    $columns = array('newsletter_email');

    $callback = function() use ($reviews, $columns)
    {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($reviews as $review) {
            fputcsv($file, array($review->newsletter_email));
        }
        fclose($file);
    };
    return Response::stream($callback, 200, $headers);
   }
   
   
}
