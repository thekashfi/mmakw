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

class AdminCasesController extends Controller
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
		$clientInfo = Clients::where("id",$request->client_id)->first();
        //check search queries
		
		//check search queries
        if(!empty($request->get('q'))){
        $q = $request->get('q');
        }else{
        $q = $request->q;
        }
        
        
        //menus records
        if(!empty($q)){
        $CasesLists = Cases::where('client_id',$request->client_id)
		                    ->where(function($sq) use ($q){
		                    $sq->where('title_en','LIKE','%'.$q.'%')
		                    ->orwhere('title_ar','LIKE','%'.$q.'%')
							->orwhere('reference_number','LIKE','%'.$q.'%')
							->orwhere('case_date','LIKE','%'.$q.'%')
							->orwhere('details_en','LIKE','%'.$q.'%')
							->orwhere('details_ar','LIKE','%'.$q.'%');
							});
							
		//dste filter
		if(!empty(Cookie::get('case_start')) && !empty(Cookie::get('case_end'))){
		$start_date = date("Y-m-d",strtotime(Cookie::get('case_start')));
		$end_date   = date("Y-m-d",strtotime(Cookie::get('case_end')));
		$CasesLists = $CasesLists->whereBetween('case_date',[$start_date,$end_date]);
		}			
							
        $CasesLists = $CasesLists->orderBy('id', 'DESC')
                                  ->paginate($settingInfo->item_per_page_back);  
        $CasesLists->appends(['q' => $q]);
		
        }else{
        $CasesLists = Cases::where('client_id',$request->client_id);
		//dste filter
		if(!empty(Cookie::get('case_start')) && !empty(Cookie::get('case_end'))){
		$start_date = date("Y-m-d",strtotime(Cookie::get('case_start')));
		$end_date   = date("Y-m-d",strtotime(Cookie::get('case_end')));
		$CasesLists = $CasesLists->whereBetween('case_date',[$start_date,$end_date]);
		}	
		$CasesLists = $CasesLists->orderBy('id', 'DESC')
		                         ->paginate($settingInfo->item_per_page_back);
		}
		
		//save logs
		$key_name   = "case";
		$key_id     = 0;
		$message    = "Visited to case listing page";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
        return view('gwc.clients_cases.index',compact('CasesLists','clientInfo'));
    }
	
	
	public function updateLogs(Request $request){
	    //save logs
		$key_name   = "case";
		$key_id     = 0;
		$message    = $request->title;
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		return ['status'=>200,'message'=>'Status is modified successfully'];
	}
	
	public function DateFilterAjax(Request $request){
	if(empty($request->case_start) && empty($request->case_end)){
	return ['status'=>400,'message'=>'Please choose a date for filter'];
	}
	
	$minutes=3600;
	Cookie::queue('case_start', $request->case_start, $minutes);
	Cookie::queue('case_end', $request->case_end, $minutes);
	return ['status'=>200,'message'=>''];
	}
	
	//reset cookie
	public function DateFilterAjaxReset(){
	$minutes=0;
	Cookie::queue('case_start','', $minutes);
	Cookie::queue('case_end', '', $minutes);
	return ['status'=>200,'message'=>''];
	}
	/**
	Display the Services listings
	**/
	public function create()
    {
	//case type
	$listCaseTypes = CaseType::where('is_active','1')->OrderBy('display_order','asc')->get();
	//save logs
		$key_name   = "case";
		$key_id     = 0;
		$message    = "Visited to 'add new case' page";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
	//end save logs
		
	return view('gwc.clients_cases.create',compact('listCaseTypes'));
	}
	

	
	/**
	Store New Services Details
	**/
	public function store(Request $request,$client_id)
    {
	    
		
		//field validation
	    $this->validate($request, [
		    'case_type'    => 'required',
			'case_date'    => 'required',
			'reference_number'=> 'required|min:3|max:100|string|unique:gwc_cases,reference_number',
		    'title_en'     => 'required|min:3|max:150|string|unique:gwc_cases,title_en',
			'title_ar'     => 'required|min:3|max:150|string|unique:gwc_cases,title_ar',
			'details_en'   => 'required|min:3',
			'details_ar'   => 'required|min:3',
			//'attach.*'     => 'mimes:jpeg,png,jpg,gif,zip,pdf|max:2048'
        ]);
		
		
		$Cases = new Cases;
		$Cases->client_id=$client_id;
		$Cases->type_id=$request->input('case_type');
		$Cases->case_date=$request->input('case_date');
		$Cases->reference_number=$request->input('reference_number');
        $Cases->title_en=$request->input('title_en');
		$Cases->title_ar=$request->input('title_ar');
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
			    $filerec= new CasesAttach();
                $imageName=$key.'-'.md5(time()).'.'.$file['attach_file']->getClientOriginalExtension();
                $file['attach_file']->move(public_path('uploads/attach/'),$imageName);  
				$filerec->case_id   = $Cases->id;
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
		$key_name   = "case";
		$key_id     = $Cases->id;
		$message    = "New case record is added. ref : (".$request->input('reference_number').")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs

        return redirect('/gwc/clients_cases/'.$client_id)->with('message-success','Case type is added successfully');
	}
	
	 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	
	    $listCaseTypes = CaseType::where('is_active','1')->OrderBy('display_order','asc')->get();
		$editcases = Cases::where('id',$id)->first();
		$caseattachlists = CasesAttach::where("case_id",$id)->get();
		
		//save logs
		$key_name   = "case";
		$key_id     = 0;
		$message    = "Visited to case edit page";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
        return view('gwc.clients_cases.edit',compact('editcases','listCaseTypes','caseattachlists'));
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
		$message    = "Visited to case details page";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
        return view('gwc.clients_cases.view',compact('viewcases','CaseType','caseattachlists','clientInfo','caseupdateslists'));
    }
	
	public static function getUpdatesAttach($case_id,$update_id){
	$caseattachlists = CasesUpdatesAttach::where("case_id",$case_id)->where('update_id',$update_id)->get();
	return $caseattachlists;
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
	 
	 //field validation  
	 $this->validate($request,[
			'case_type'    => 'required',
			'case_date'    => 'required',
			'reference_number'=> 'required|min:3|max:100|string|unique:gwc_cases,reference_number,'.$id,
		    'title_en'     => 'required|min:3|max:150|string|unique:gwc_cases,title_en,'.$id,
			'title_ar'     => 'required|min:3|max:150|string|unique:gwc_cases,title_ar,'.$id,
			'details_en'   => 'required|min:3',
			'details_ar'   => 'required|min:3'
        ]);
		
	$Cases = Cases::find($id);
	$Cases->type_id=$request->input('case_type');
	$Cases->case_date=$request->input('case_date');
	$Cases->reference_number=$request->input('reference_number');
    $Cases->title_en=$request->input('title_en');
	$Cases->title_ar=$request->input('title_ar');
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
			    $filerec= new CasesAttach();
                $imageName=$key.'-'.md5(time()).'.'.$file['attach_file']->getClientOriginalExtension();
                $file['attach_file']->move(public_path('uploads/attach/'),$imageName);  
				$filerec->case_id   = $Cases->id;
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
		$key_name   = "case";
		$key_id     = $Cases->id;
		$message    = "Case details are updated. ref : (".$request->input('reference_number').")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
			 
		 
	return redirect('/gwc/clients_cases/'.$request->input('client_id'))->with('message-success','Case information is updated successfully');
	}
	
	/**
     * Delete clients along with childs via ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function destroy($client_id,$id){
	 //check param ID
	 if(empty($id)){
	 return redirect('/gwc/clients_cases/'.$client_id)->with('message-error','Param ID is missing'); 
	 }
	 //get cat info
	 $cases = Cases::where('id',$id)->where('client_id',$client_id)->first();
	 //check cat id exist or not
	 if(empty($cases->id)){
	 return redirect('/gwc/clients_cases/'.$client_id)->with('message-error','No record found'); 
	 }
	 //delete case attach files
	 $this->deleteAttach($cases->id);
	 //delete updates
	 $this->deleteCaseUpdates($cases->id);
	 
	    //save logs
		$key_name   = "case";
		$key_id     = $cases->id;
		$message    = "Case record is removed. ref : (".$cases->reference_number.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
	 //delete case
	 $cases->delete();
	 return redirect()->back()->with('message-success','Case is deleted successfully');	
	 }
	 
	 
	 //delete attach
	 public function destroyAttach($case_id,$id){
	  $attachimg = CasesAttach::where('id',$id)->where('case_id',$case_id)->first();
		//delete image from folder
		if(!empty($attachimg->file_name)){
		$web_image_path = "/uploads/attach/".$attachimg->file_name;
		if(File::exists(public_path($web_image_path))){
		   File::delete(public_path($web_image_path));
		 }
		}
		
		//save logs
		$key_name   = "case";
		$key_id     = $attachimg->id;
		$message    = "Case attach files are removed.";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		$attachimg->delete();

		return redirect()->back()->with('message-success','Attached file is deleted successfully');
	 }
	 
	 //delete case attached files
	 public function deleteAttach($case_id){
	  $attachimgs = CasesAttach::where('case_id',$case_id)->get();
	  if(!empty($attachimgs) && count($attachimgs)>0){
	  foreach($attachimgs as $attachimg){
	   $attachimgy = CasesAttach::find($attachimg->id);
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
	///delete updates
	public function deleteCaseUpdates($case_id){
	$caseupdates = CasesUpdates::where('case_id',$case_id)->get();
	  if(!empty($caseupdates)){
	   foreach($caseupdates as $caseupdate){
	      $attachimgy = CasesUpdates::find($caseupdate->id);
	      $this->deleteUpdateAttach($caseupdate->id);
		  $attachimgy->delete(); // update cases 	
	   }
	  }
	 
	}
	
	
	public function deleteUpdateAttach($update_id){
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
		$recDetails = Cases::where('id',$request->id)->first(); 
		if($recDetails['is_active']==1){
			$active=0;
		}else{
			$active=1;
		}
		$recDetails->is_active=$active;
		
		//save logs
		$key_name   = "case";
		$key_id     = $recDetails->id;
		$message    = "Case status is changed to ".$active." ref : ".$recDetails->reference_number;
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
		$recDetails->save();
		return ['status'=>200,'message'=>'Status is modified successfully'];
	} 
	
	
	//update attach details
	public function updateCaseAttachAjax(Request $request){
	

	 $filerec = CasesAttach::find($request->id);
	 $filerec->title_en  = $request->title_en;
	 $filerec->title_ar  = $request->title_ar;
	 $filerec->doc_date  = $request->doc_date;
	 $filerec->save();
				
	return ['status'=>200,'message'=>'Information is updated successfully'];
	}
	
	
	//get case type name for view
	  public static function getCaseType($id){
	   $recDetails = CaseType::where('id',$id)->first();
	   return $recDetails['title_en'];
	  }	
	  
	  
	  //check update seen or not
	public static function isReadUpdates($case_id){
	$Info       = CasesUpdates::where('case_id',$case_id)->where('is_active','1')->where('is_read','0')->get()->count();
	return $Info;
	}
	
	
}
