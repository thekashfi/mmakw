<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teams;
use App\Settings;
use Image;
use File;
use Response;
use PDF;
use Hash;
use Auth;

class AdminTeamsController extends Controller
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
        $TeamLists = Teams::orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
        return view('gwc.teams.index',['TeamLists' => $TeamLists]);
    }
	
	
	/**
	Display the Services listings
	**/
	public function create()
    {
	$lastOrderInfo = Teams::OrderBy('display_order','desc')->first();
	if(!empty($lastOrderInfo->display_order)){
	$lastOrder=($lastOrderInfo->display_order+1);
	}else{
	$lastOrder=1;
	}
	return view('gwc.teams.create',compact('lastOrder'));
	}
	

	
	/**
	Store New Services Details
	**/
	public function store(Request $request)
    {
	    
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
		$image_big_w = 550;
		$image_big_h = 550;
		}
		//field validation
	    $this->validate($request, [
		    'name_en'      => 'required|min:3|max:192|string|unique:gwc_teams,name_en',
			'name_ar'      => 'required|min:3|max:192|string|unique:gwc_teams,name_ar',
			'email'        => 'required|email|min:3|max:150|string|unique:gwc_teams,email',
			'mobile'       => 'required|min:8|max:11|string|unique:gwc_teams,mobile',
			'position_en'  => 'required|min:3|max:150|string',
			'position_ar'  => 'required|min:3|max:150|string',
			'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
		
		//upload image
		$imageName="";
		if($request->hasfile('image')){
		$imageName = 'm-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
		$request->image->move(public_path('uploads/teams'), $imageName);
		// open file a image resource
		$imgbig = Image::make(public_path('uploads/teams/'.$imageName));
		//resize image
		$imgbig->resize($image_big_w,$image_big_h);//Fixed w,h
		if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
		// insert watermark at bottom-right corner with 10px offset
		$imgbig->insert(public_path('uploads/teams/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
		}
		// save to imgbig thumb
		$imgbig->save(public_path('uploads/teams/'.$imageName));
		
		//create thumb
		// open file a image resource
		$img = Image::make(public_path('uploads/teams/'.$imageName));
		//resize image
		$img->resize($image_thumb_w,$image_thumb_h);//Fixed w,h
		// save to thumb
		$img->save(public_path('uploads/teams/thumb/'.$imageName));
		}

		$teams = new Teams;

		$teams->name_en=$request->input('name_en');
		$teams->name_ar=$request->input('name_ar');
		$teams->email=$request->input('email');
		$teams->mobile=$request->input('mobile');
		$teams->position_en=$request->input('position_en');
		$teams->position_ar=$request->input('position_ar');
		$teams->is_active=!empty($request->input('is_active'))?$request->input('is_active'):'0';
		$teams->display_order=!empty($request->input('display_order'))?$request->input('display_order'):'0';
		$teams->image=$imageName;
		$teams->save();
		
		//save logs
		$key_name   = "team";
		$key_id     = $teams->id;
		$message    = "A new team record is added.(".$request->input('name_en').")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs

        return redirect('/gwc/teams')->with('message-success','Team information is added successfully');
	}
	
	 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $editteams = Teams::find($id);
        return view('gwc.teams.edit',compact('editteams'));
    }
	
	
	 /**
     * Show the details of the services.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
		$teamDetails = Teams::find($id);
        return view('gwc.teams.view',compact('teamDetails'));
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
		$image_big_w = 500;
		$image_big_h = 500;
		}
		
		
		$this->validate($request, [
		    'name_en'      => 'required|min:3|max:192|string|unique:gwc_teams,name_en,'.$id,
			'name_ar'      => 'required|min:3|max:192|string|unique:gwc_teams,name_ar,'.$id,
			'email'        => 'required|email|min:3|max:150|string|unique:gwc_teams,email,'.$id,
			'mobile'       => 'required|min:8|max:11|string|unique:gwc_teams,mobile,'.$id,
			'position_en'  => 'required|min:3|max:150|string',
			'position_ar'  => 'required|min:3|max:150|string',
			'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
		
	$teams = Teams::find($id);
	$imageName='';
	//upload image
	if($request->hasfile('image')){
	//delete image from folder
	if(!empty($teams->image)){
	$web_image_path = "/uploads/teams/".$teams->image;
	$web_image_paththumb = "/uploads/teams/thumb/".$teams->image;
	if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	 }
	}
	//
	$imageName = 'c-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
	
	$request->image->move(public_path('uploads/teams'), $imageName);
	//create thumb
	// open file a image resource
    $imgbig = Image::make(public_path('uploads/teams/'.$imageName));
	//resize image
	$imgbig->resize($image_big_w,$image_big_h);//Fixed w,h
	
	if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
	// insert watermark at bottom-right corner with 10px offset
    $imgbig->insert(public_path('uploads/teams/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
	}
	// save to imgbig thumb
	$imgbig->save(public_path('uploads/teams/'.$imageName));
	
	//create thumb
	// open file a image resource
    $img = Image::make(public_path('uploads/teams/'.$imageName));
	//resize image
	$img->resize($image_thumb_w,$image_thumb_h);//Fixed w,h
	// save to thumb
	$img->save(public_path('uploads/teams/thumb/'.$imageName));
	
	}else{
	$imageName = $teams->image;
	}
	
	$teams->name_en=$request->input('name_en');
	$teams->name_ar=$request->input('name_ar');
	$teams->email=$request->input('email');
	$teams->mobile=$request->input('mobile');
	$teams->position_en=$request->input('position_en');
	$teams->position_ar=$request->input('position_ar');
	$teams->display_order=!empty($request->input('display_order'))?$request->input('display_order'):'0';
	$teams->is_active=!empty($request->input('is_active'))?$request->input('is_active'):'0';
	$teams->image=$imageName;
	$teams->save();
	
	//save logs
		$key_name   = "team";
		$key_id     = $teams->id;
		$message    = "Team record is edited.(".$request->input('name_en').")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
	return redirect('/gwc/teams')->with('message-success','Team information is updated successfully');
	}
	
	/**
     * Delete the Image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	
	public function deleteImage($id){
	$teams = Teams::find($id);
	//delete image from folder
	if(!empty($teams->image)){
	$web_image_path = "/uploads/teams/".$teams->image;
	$web_image_paththumb = "/uploads/teams/thumb/".$teams->image;
	if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	 }
	}
	   //save logs
		$key_name   = "team";
		$key_id     = $teams->id;
		$message    = "Team image is removed.(".$teams->name_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
	$teams->image='';
	$teams->save();
	return redirect()->back()->with('message-success','Image is deleted successfully');	
	}
	
	/**
     * Delete teams along with childs via ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function destroy($id){
	 //check param ID
	 if(empty($id)){
	 return redirect('/gwc/teams')->with('message-error','Param ID is missing'); 
	 }
	 //get cat info
	 $teams = Teams::find($id);
	 //check cat id exist or not
	 if(empty($teams->id)){
	 return redirect('/gwc/teams')->with('message-error','No record found'); 
	 }

	 //delete parent cat mage
	 if(!empty($teams->image)){
	 $web_image_path = "/uploads/teams/".$teams->image;
	 $web_image_paththumb = "/uploads/teams/thumb/".$teams->image;
	 if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	  }
	 }
	 
	 //save logs
		$key_name   = "team";
		$key_id     = $teams->id;
		$message    = "Team record is removed.(".$teams->name_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
	 //end deleting parent cat image
	 $teams->delete();
	 return redirect()->back()->with('message-success','Team information is deleted successfully');	
	 }
	 
	 
	 
		//download pdf
	
	public function downloadPDF(){
	  $teams = Teams::get();
      $pdf = PDF::loadview('gwc.teams.pdf', compact('teams'));
      return $pdf->download('teams.pdf');
    }
	
    //update status
	public function updateStatusAjax(Request $request)
    {
		$recDetails = Teams::where('id',$request->id)->first(); 
		if($recDetails['is_active']==1){
			$active=0;
		}else{
			$active=1;
		}
		
		//save logs
		$key_name   = "team";
		$key_id     = $recDetails->id;
		$message    = "Team status is changed to ".$active." .(".$recDetails->name_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
		$recDetails->is_active=$active;
		$recDetails->save();
		return ['status'=>200,'message'=>'Status is modified successfully'];
	} 
	
}
