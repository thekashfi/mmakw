<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Cases;
use App\CaseType;
use App\Settings;
use App\Clients;
use App\CasesAttach;
use App\CasesUpdates;
use App\CasesUpdatesAttach;
use Image;
use File;
use Response;
use PDF;
use Hash;
use Auth;

use App\Mail\SendGrid;
use Mail;

class AdminCasesUpdatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	
	 public function index(Request $request) 
    {
       
	    $settingInfo = Settings::where("keyname","setting")->first();
		//get client info
		$caseInfo = Cases::where("id",$request->case_id)->first();
        
		//check search queries
        if(!empty($request->get('q'))){
        $q = $request->get('q');
        }else{
        $q = $request->q;
        }
        
        
        //menus records
        if(!empty($q)){
        $CasesUpdateLists = CasesUpdates::where('case_id',$request->case_id)
		                    ->where(function($sq) use ($q){
		                    $sq->orwhere('details_en','LIKE','%'.$q.'%')
							->orwhere('details_ar','LIKE','%'.$q.'%');
							});
							
		//dste filter
		if(!empty(Cookie::get('case_update_start')) && !empty(Cookie::get('case_update_end'))){
		$start_date = date("Y-m-d",strtotime(Cookie::get('case_update_start')));
		$end_date   = date("Y-m-d",strtotime(Cookie::get('case_update_end')));
		$CasesUpdateLists = $CasesUpdateLists->whereBetween('case_date',[$start_date,$end_date]);
		}			
							
        $CasesUpdateLists = $CasesUpdateLists->orderBy('case_date', 'DESC')
                                             ->paginate($settingInfo->item_per_page_back);  
        $CasesUpdateLists->appends(['q' => $q]);
		
        }else{
        $CasesUpdateLists = CasesUpdates::where('case_id',$request->case_id);
		//dste filter
		if(!empty(Cookie::get('case_update_start')) && !empty(Cookie::get('case_update_end'))){
		$start_date = date("Y-m-d",strtotime(Cookie::get('case_update_start')));
		$end_date   = date("Y-m-d",strtotime(Cookie::get('case_update_end')));
		$CasesUpdateLists = $CasesUpdateLists->whereBetween('case_date',[$start_date,$end_date]);
		}	
		$CasesUpdateLists = $CasesUpdateLists->orderBy('case_date', 'DESC')
		                                     ->paginate($settingInfo->item_per_page_back);
		}
		
		
		//save logs
		$key_name   = "case";
		$key_id     = 0;
		$message    = "Visited to case updates page";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
        return view('gwc.clients_cases_updates.index',compact('CasesUpdateLists','caseInfo'));
    }
	
	public function DateFilterAjax(Request $request){
	if(empty($request->case_update_start) && empty($request->case_update_end)){
	return ['status'=>400,'message'=>'Please choose a date for filter'];
	}
	
	$minutes=3600;
	Cookie::queue('case_update_start', $request->case_update_start, $minutes);
	Cookie::queue('case_update_end', $request->case_update_end, $minutes);
	return ['status'=>200,'message'=>''];
	}
	
	//reset cookie
	public function DateFilterAjaxReset(){
	$minutes=0;
	Cookie::queue('case_update_start','', $minutes);
	Cookie::queue('case_update_end', '', $minutes);
	return ['status'=>200,'message'=>''];
	}
	
	/**
	Display the Services listings
	**/
	public function create($case_id)
    {
	$caseInfo = Cases::where("id",$case_id)->first();
	return view('gwc.clients_cases_updates.create',compact('caseInfo'));
	}
	

	
	/**
	Store New Services Details
	**/
	public function store(Request $request,$case_id)
    {
	    
		$settingInfo = Settings::where("keyname","setting")->first();
		//field validation
	    $this->validate($request, [
			'case_date'    => 'required',
			'details_en'   => 'required|min:3',
			'details_ar'   => 'required|min:3',
        ]);
		
		
		$Cases = new CasesUpdates;
		$Cases->case_id=$case_id;
		$Cases->client_id=$request->input('client_id');
		$Cases->case_date=$request->input('case_date');
		$Cases->details_en=$request->input('details_en');
		$Cases->details_ar=$request->input('details_ar');
		$Cases->is_active=!empty($request->input('is_active'))?$request->input('is_active'):'0';
		$Cases->save();
		
		//upload multiple images/files
		
		if(!empty($Cases->id) && !empty($request->file('attach')) && count($request->file('attach'))>0)
         {
            foreach($request->file('attach') as $key=>$file)
            {
			    $title_en = $request->attach[$key]['atitle_en'];
				$title_ar = $request->attach[$key]['atitle_ar'];
				$doc_date = $request->attach[$key]['doc_date'];
				
				if($file['attach_file']){
			    $filerec= new CasesUpdatesAttach();
                $imageName=$key.'-update-'.md5(time()).'.'.$file['attach_file']->getClientOriginalExtension();
                $file['attach_file']->move(public_path('uploads/attach/'),$imageName);  
				$filerec->case_id   = $case_id;
				$filerec->update_id = $Cases->id;
				$filerec->file_name = $imageName;
				$filerec->title_en  = $title_en;
				$filerec->title_ar  = $title_ar;
				$filerec->doc_date  = $doc_date;
				$filerec->save(); 
				}
            }
				 	
         }
         //end uploading multiple image/files
         
		//save logs
		$key_name   = "caseupdate";
		$key_id     = $Cases->id;
		$message    = "A new case update is added.(".$request->input('details_en').")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		 $ClientsDetails  = Clients::where('id',$request->input('client_id'))->first();
		 //send email notification
		 if(!empty($ClientsDetails->email)){
		 $data = [
		 'dear' => trans('webMessage.dear').' '.$ClientsDetails->name,
		 'footer' => trans('webMessage.email_footer'),
		 'message' => $settingInfo->case_updates_notification,
		 'subject' =>'Case Updates Notification',
		 'email_from' =>'noreply@mmakw.com',
		 'email_from_name' =>'mmakw.com',
		 'email_cc' =>'info@mmakw.com',
		 'email_cc_name' =>'mmakw.com',
		 'email_bcc' =>'info@mmakw.com',
		 'email_bcc_name' =>'mmakw.com',
		 'email_replyto' =>'info@mmakw.com',
		 'email_replyto_name' =>'mmakw.com'
		 ];
		 Mail::to($ClientsDetails->email)->send(new SendGrid($data));
		 }
		 //end sending email

        return redirect('/gwc/clients_cases_updates/'.$case_id)->with('message-success','Record is added successfully');
	}
	
	 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	
		$editcases = CasesUpdates::where('id',$id)->first();
		$caseInfo  = Cases::where("id",$editcases->case_id)->first();
		$caseattachlists = CasesUpdatesAttach::where("case_id",$editcases->case_id)->get();
        return view('gwc.clients_cases_updates.edit',compact('editcases','caseInfo','caseattachlists'));
    }
	
	
	public function view($id)
    {
	
	    
		$viewcases       = Cases::where('id',$id)->first();
		$CaseType        = CaseType::where('id',$viewcases->type_id)->first();
		$clientInfo      = Clients::where('id',$viewcases->client_id)->first();
		$caseattachlists = CasesAttach::where("case_id",$id)->get();
		$caseupdateslists     = CasesUpdates::where('case_id',$id)->orderBy('case_date','DESC')->get();
		
		//save logs
		$key_name   = "case";
		$key_id     = 0;
		$message    = "Visited to case update details page";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
        return view('gwc.clients_cases_updates.view',compact('viewcases','CaseType','caseattachlists','clientInfo','caseupdateslists'));
    }
	
	public static function getUpdatesAttach($case_id,$update_id){
	$caseattachlists = CasesUpdatesAttach::where("case_id",$case_id)->where('update_id',$update_id)->get();
	}
	
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	 
	 $settingInfo = Settings::where("keyname","setting")->first();
	 
	 //field validation  
	 $this->validate($request,[
			'case_date'    => 'required',
			'details_en'   => 'required|min:3',
			'details_ar'   => 'required|min:3'
        ]);
		
	$Cases = CasesUpdates::find($id);
	$Cases->case_id    = $request->input('case_id');
	$Cases->client_id  = $request->input('client_id');
	$Cases->case_date  = $request->input('case_date');
	$Cases->details_en = $request->input('details_en');
	$Cases->details_ar = $request->input('details_ar');
	$Cases->is_active=!empty($request->input('is_active'))?$request->input('is_active'):'0';
	$Cases->is_read=0;
	$Cases->save();
	
	//upload multiple images/files
		
		if(!empty($Cases->id) && !empty($request->file('attach')) && count($request->file('attach'))>0)
         {
            foreach($request->file('attach') as $key=>$file)
            {
			    $title_en = $request->attach[$key]['atitle_en'];
				$title_ar = $request->attach[$key]['atitle_ar'];
				$doc_date = $request->attach[$key]['doc_date'];
				
				if($file['attach_file']){
			    $filerec= new CasesUpdatesAttach();
                $imageName=$key.'-update-'.md5(time()).'.'.$file['attach_file']->getClientOriginalExtension();
                $file['attach_file']->move(public_path('uploads/attach/'),$imageName);  
				$filerec->update_id = $id;
				$filerec->case_id   = $request->input('case_id');
				$filerec->file_name = $imageName;
				$filerec->title_en  = $title_en;
				$filerec->title_ar  = $title_ar;
				$filerec->doc_date  = $doc_date;
				$filerec->save(); 
				}
            }
				 	
         }
         //end uploading multiple image/files
		 
	    //save logs
		$key_name   = "caseupdate";
		$key_id     = $Cases->id;
		$message    = "Case update details are edited.(".$request->input('details_en').")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
	
	     $ClientsDetails  = Clients::where('id',$request->input('client_id'))->first();
		 //send email notification
		 if(!empty($ClientsDetails->email)){
		 $data = [
		 'dear' => trans('webMessage.dear').' '.$ClientsDetails->name,
		 'footer' => trans('webMessage.email_footer'),
		 'message' => $settingInfo->case_updates_notification,
		 'subject' =>'Case Updates Notification',
		 'email_from' =>'noreply@mmakw.com',
		 'email_from_name' =>'mmakw.com',
		 'email_cc' =>'info@mmakw.com',
		 'email_cc_name' =>'mmakw.com',
		 'email_bcc' =>'info@mmakw.com',
		 'email_bcc_name' =>'mmakw.com',
		 'email_replyto' =>'info@mmakw.com',
		 'email_replyto_name' =>'mmakw.com'
		 ];
		 Mail::to($ClientsDetails->email)->send(new SendGrid($data));
		 }
		 //end sending email
		 	
			 
	return redirect('/gwc/clients_cases_updates/'.$request->input('case_id'))->with('message-success','Information is updated successfully');
	}
	
	/**
     * Delete clients along with childs via ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function destroy($case_id,$id){
	 //check param ID
	 if(empty($id)){
	 return redirect('/gwc/clients_cases_updates/'.$case_id)->with('message-error','Param ID is missing'); 
	 }
	 //get cat info
	 $casesupdates = CasesUpdates::where('id',$id)->where('case_id',$case_id)->first();
	 //check cat id exist or not
	 if(empty($casesupdates->id)){
	 return redirect('/gwc/clients_cases_updates/'.$case_id)->with('message-error','No record found'); 
	 }
	 //delete case attach files
	 $this->deleteAttach($casesupdates->id);
	 
	 //save logs
		$key_name   = "caseupdate";
		$key_id     = $casesupdates->id;
		$message    = "Case update recored is removed.(".$casesupdates->details_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
	 //delete case
	 $casesupdates->delete();
	 return redirect()->back()->with('message-success','Case update is deleted successfully');	
	 }
	 
	 
	 //delete attach
	 public function destroyAttach($update_id,$id){
	     
	    $attachimg = CasesUpdatesAttach::where('id',$id)->where('update_id',$update_id)->first();
		//delete image from folder
		if(!empty($attachimg->file_name)){
		$web_image_path = "/uploads/attach/".$attachimg->file_name;
		if(File::exists(public_path($web_image_path))){
		   File::delete(public_path($web_image_path));
		 }
		}
		
		//save logs
		$key_name   = "caseupdate";
		$key_id     = $attachimg->id;
		$message    = "Case update attach file is removed.";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		$attachimg->delete();
		return redirect()->back()->with('message-success','Attached file is deleted successfully');
	 }
	 
	 //delete case attached files
	 public function deleteAttach($update_id){
	  $attachimgs = CasesUpdatesAttach::where('update_id',$update_id)->get();
	  if(!empty($attachimgs) && count($attachimgs)>0){
	  foreach($attachimgs as $attachimg){
	     $attachimgy = CasesUpdatesAttach::find($attachimg->id);
		 //delete image from folder
		if(!empty($attachimgy->file_name)){
		   $web_image_path = "/uploads/attach/".$attachimgy->file_name;
		   if(File::exists(public_path($web_image_path))){
		   File::delete(public_path($web_image_path));
		   }
		   $attachimgy->delete();
		}
	   }
	   }
	 }
	
	
    //update status
	public function updateStatusAjax(Request $request)
    {
		$recDetails = CasesUpdates::where('id',$request->id)->first(); 
		if($recDetails['is_active']==1){
			$active=0;
		}else{
			$active=1;
		}
		//save logs
		$key_name   = "caseupdate";
		$key_id     = $recDetails->id;
		$message    = "Case update status is changed to ".$active."(".$recDetails->details_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		$recDetails->is_active=$active;
		$recDetails->save();
		return ['status'=>200,'message'=>'Status is modified successfully'];
	}
	
	
	//update attach details
	public function updateCaseAttachAjax(Request $request){
	

	 $filerec = CasesUpdatesAttach::find($request->id);
	 $filerec->title_en  = $request->title_en;
	 $filerec->title_ar  = $request->title_ar;
	 $filerec->doc_date  = $request->doc_date;
	 $filerec->save();
				
	return ['status'=>200,'message'=>'Information is updated successfully'];
	} 
	
}
