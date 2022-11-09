<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaseType;
use App\Settings;
use Image;
use File;
use Response;
use PDF;
use Hash;
use Auth;
class AdminCaseTypeController extends Controller
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
        $CaseTypeLists = CaseType::orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
        return view('gwc.casetype.index',['CaseTypeLists' => $CaseTypeLists]);
    }
	
	
	/**
	Display the Services listings
	**/
	public function create()
    {
	$lastOrderInfo = CaseType::OrderBy('display_order','desc')->first();
	if(!empty($lastOrderInfo->display_order)){
	$lastOrder=($lastOrderInfo->display_order+1);
	}else{
	$lastOrder=1;
	}
	return view('gwc.casetype.create',compact('lastOrder'));
	}
	

	
	/**
	Store New Services Details
	**/
	public function store(Request $request)
    {
	    
		
		//field validation
	    $this->validate($request, [
		    'title_en'     => 'required|min:3|max:150|string|unique:gwc_cases_type,title_en',
			'title_ar'     => 'required|min:3|max:150|string|unique:gwc_cases_type,title_ar'
        ]);
		
		
		$casetype = new CaseType;
        $casetype->title_en=$request->input('title_en');
		$casetype->title_ar=$request->input('title_ar');
		$casetype->display_order=!empty($request->input('display_order'))?$request->input('display_order'):'0';
		$casetype->is_active=!empty($request->input('is_active'))?$request->input('is_active'):'0';
		$casetype->save();
		
		//save logs
		$key_name   = "casetype";
		$key_id     = $casetype->id;
		$message    = "New case type is created as ".$request->input('title_en');
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs

        return redirect('/gwc/casetype')->with('message-success','Case type is added successfully');
	}
	
	 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $editcasetype = CaseType::find($id);
        return view('gwc.casetype.edit',compact('editcasetype'));
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
		    'title_en'     => 'required|min:3|max:150|string|unique:gwc_cases_type,title_en,'.$id,
            'title_ar'     => 'required|min:3|max:150|string|unique:gwc_cases_type,title_ar,'.$id,
        ]);
		
	$casetype = CaseType::find($id);
	$casetype->title_en     =$request->input('title_en');
	$casetype->title_ar     =$request->input('title_ar');
	$casetype->display_order=!empty($request->input('display_order'))?$request->input('display_order'):'0';
	$casetype->is_active    =!empty($request->input('is_active'))?$request->input('is_active'):'0';
	$casetype->save();
	    //save logs
		$key_name   = "casetype";
		$key_id     = $casetype->id;
		$message    = "Case type is updated as ".$request->input('title_en');
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
	return redirect('/gwc/casetype')->with('message-success','Case type information is updated successfully');
	}
	
	/**
     * Delete clients along with childs via ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function destroy($id){
	 //check param ID
	 if(empty($id)){
	 return redirect('/gwc/casetype')->with('message-error','Param ID is missing'); 
	 }
	 //get cat info
	 $casetype = CaseType::find($id);
	 //check cat id exist or not
	 if(empty($casetype->id)){
	 return redirect('/gwc/casetype')->with('message-error','No record found'); 
	 }
	    //save logs
		$key_name   = "casetype";
		$key_id     = $casetype->id;
		$message    = "Case type is removed (".$casetype->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
	 //end deleting parent cat image
	 $casetype->delete();
	 return redirect()->back()->with('message-success','Case type is deleted successfully');	
	 }
	 
	
	
    //update status
	public function updateStatusAjax(Request $request)
    {
		$recDetails = CaseType::where('id',$request->id)->first(); 
		if($recDetails['is_active']==1){
			$active=0;
		}else{
			$active=1;
		}
		//save logs
		$key_name   = "casetype";
		$key_id     = $recDetails->id;
		$message    = "Case type status is modified to ".$active." (".$recDetails->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		$recDetails->is_active=$active;
		$recDetails->save();
		return ['status'=>200,'message'=>'Status is modified successfully'];
	} 
	
}
