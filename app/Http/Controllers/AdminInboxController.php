<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contactus;
use App\Subjects;
use App\Settings;
use Image;
use File;
use Response;
use PDF;
use Auth;

class AdminInboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	
	 public function index() //Request $request
    {
       
	    $settingInfo = Settings::where("keyname","setting")->first();
        //check search queries
        $ContactLists = Contactus::orderBy('id', 'DESC')->paginate($settingInfo->item_per_page_back);
        
        return view('gwc.contactus.index',['ContactLists' => $ContactLists]);
    }
	//view
	public function view($id){
	
	$contactDetails = Contactus::find($id)->first();
	$contactDetails->is_read=1;
	$contactDetails->save();
	return view('gwc.contactus.view',['contactDetails' => $contactDetails]);
	}
	//list subjects
   public function showSubjects() //
    {
       
	    $settingInfo = Settings::where("keyname","setting")->first();
        //check search queries
        $SubjectLists = Subjects::orderBy('id', 'DESC')->paginate($settingInfo->item_per_page_back);
		
		$lastOrderInfo = Subjects::OrderBy('display_order','desc')->first();
		if(!empty($lastOrderInfo->display_order)){
		$lastOrder=($lastOrderInfo->display_order+1);
		}else{
		$lastOrder=1;
		}
       
        return view('gwc.contactus.subjects',['SubjectLists' => $SubjectLists,'lastOrder' => $lastOrder]);
    }
	
	//save subjects
	public function saveSubject(Request $request){
	
	   //field validation
	    $this->validate($request, [
			'title_en'     => 'required|min:3|max:190|string|unique:gwc_subjects,title_en',
			'title_ar'     => 'required|min:3|max:190|string|unique:gwc_subjects,title_ar',
        ]);
	    $subjects = new Subjects;	
		$subjects->title_en=$request->input('title_en');
		$subjects->title_ar=$request->input('title_ar');
		$subjects->is_active=!empty($request->input('is_active'))?$request->input('is_active'):'0';
		$subjects->display_order=!empty($request->input('display_order'))?$request->input('display_order'):'0';
		$subjects->save();

        //save logs
		$key_name   = "subjects";
		$key_id     = $subjects->id;
		$message    = "A new subject is added.(".$subjects->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
        return redirect('/gwc/contactus/subjects')->with('message-success','services is added successfully');
			
	}
	
	
	/**
     * Delete services along with childs via ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function destroySubjects($id){
	 //check param ID
	 if(empty($id)){
	 return redirect('/gwc/contactus/subjects')->with('message-error','Param ID is missing'); 
	 }
	 //get cat info
	 $subjects = Subjects::find($id);
	 //check cat id exist or not
	 if(empty($subjects->id)){
	 return redirect('/gwc/contactus/subjects')->with('message-error','No record found'); 
	 } 
	 
	 //save logs
		$key_name   = "subjects";
		$key_id     = $subjects->id;
		$message    = "A subject is removed.(".$subjects->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
	 //end deleting parent cat image
	 $subjects->delete();
	 return redirect()->back()->with('message-success','Subject is deleted successfully');	
	 }
	 
	 
	 ///delete contact is
	 public function destroy($id){
	  //check param ID
	 if(empty($id)){
	 return redirect('/gwc/contactus/inbox')->with('message-error','Param ID is missing'); 
	 }
	 //get cat info
	 $contacts = Contactus::find($id);
	 //check cat id exist or not
	 if(empty($contacts->id)){
	 return redirect('/gwc/contactus/inbox')->with('message-error','No record found'); 
	 } 
	 
	    //save logs
		$key_name   = "contact";
		$key_id     = $contacts->id;
		$message    = "Contact message is removed.(".$contacts->message.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
	 //end deleting parent cat image
	 $contacts->delete();
	 return redirect()->back()->with('message-success','Contact is deleted successfully');	
	 }
	 
	
    //update status
	public function updateStatusAjax(Request $request)
    {
		$recDetails = Subjects::where('id',$request->id)->first(); 
		if($recDetails['is_active']==1){
			$active=0;
		}else{
			$active=1;
		}
		
		//save logs
		$key_name   = "subject";
		$key_id     = $recDetails->id;
		$message    = "Subject status is changed to ".$active.".(".$recDetails->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
		$recDetails->is_active=$active;
		$recDetails->save();
		return ['status'=>200,'message'=>'Status is modified successfully'];
	} 
	
	
   //get subject name
   public static function getSubjectName($subjectid){
   $recDetails = Subjects::where('id',$subjectid)->first(); 
   return $recDetails['title_en'];
   }	
	
}
