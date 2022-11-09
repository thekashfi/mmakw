<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Practice;
use App\Settings;
use Image;
use File;
use Response;
use App\Services\PracticeSlug;
use PDF;
use Auth;
class AdminPracticeController extends Controller
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
        /*if(!empty($request->get('q'))){
        $q = $request->get('q');
        }else{
        $q = $request->q;
        }*/
        
       
        //menus records
        /*if(!empty($q)){
        $PracticeLists = Practice::where('name_en','LIKE','%'.$q.'%')
		                    ->orwhere('name_ar','LIKE','%'.$q.'%')
                            ->orderBy('id', 'DESC')
                            ->paginate(50);  
        $PracticeLists->appends(['q' => $q]);
		
        }else{*/
        $PracticeLists = Practice::orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
        //}
        return view('gwc.practice.index',['PracticeLists' => $PracticeLists]);
    }
	
	
	/**
	Display the Practice listings
	**/
	public function create()
    {
	
	$lastOrderInfo = Practice::OrderBy('display_order','desc')->first();
	if(!empty($lastOrderInfo->display_order)){
	$lastOrder=($lastOrderInfo->display_order+1);
	}else{
	$lastOrder=1;
	}
	return view('gwc.practice.create')->with(['lastOrder'=>$lastOrder]);
	}
	

	
	/**
	Store New practice Details
	**/
	public function store(Request $request)
    {
	    
		$settingInfo = Settings::where("keyname","setting")->first();
		if(!empty($settingInfo->image_thumb_w) && !empty($settingInfo->image_thumb_h)){
		$image_thumb_w = $settingInfo->image_thumb_w;
		$image_thumb_h = $settingInfo->image_thumb_h;
		}else{
		$image_thumb_w = 100;
		$image_thumb_h = 100;
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
            'menu_name_en' => 'required|min:3|max:100|string|unique:gwc_practicearea,menu_name_en',
			'menu_name_ar' => 'required|min:3|max:100|string|unique:gwc_practicearea,menu_name_ar',
			'title_en'     => 'required|min:3|max:190|string|unique:gwc_practicearea,title_en',
			'title_ar'     => 'required|min:3|max:190|string|unique:gwc_practicearea,title_ar',
			'details_en'   => 'required|min:3',
			'details_ar'   => 'required|min:3',
			'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'headerimage'  => 'headerimage|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
		
		//upload image
		$imageName="";
		if($request->hasfile('image')){
		$imageName = 'b-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
		$request->image->move(public_path('uploads/practice'), $imageName);
		// open file a image resource
		$imgbig = Image::make(public_path('uploads/practice/'.$imageName));
		//resize image
		$imgbig->resize($image_big_w,$image_big_h);//Fixed w,h
		if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
		// insert watermark at bottom-right corner with 10px offset
		$imgbig->insert(public_path('uploads/practice/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
		}
		// save to imgbig thumb
		$imgbig->save(public_path('uploads/practice/'.$imageName));
		
		//create thumb
		// open file a image resource
		$img = Image::make(public_path('uploads/practice/'.$imageName));
		//resize image
		$img->resize($image_thumb_w,$image_thumb_h);//Fixed w,h
		// save to thumb
		$img->save(public_path('uploads/practice/thumb/'.$imageName));
		}
		//upload banner
		$bannerimageName="";
		if($request->hasfile('bannerimage')){
		$bannerimageName = 'ban-'.md5(time()).'.'.$request->bannerimage->getClientOriginalExtension();
		$request->bannerimage->move(public_path('uploads/practice'), $bannerimageName);
		
		if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
		// open file a image resource
		$imgbig = Image::make(public_path('uploads/practice/'.$bannerimageName));
		// insert watermark at bottom-right corner with 10px offset
		$imgbig->insert(public_path('uploads/practice/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
		// save to imgbig thumb
		$imgbig->save(public_path('uploads/practice/'.$bannerimageName));
		}
		}

		$practice = new Practice;
		//slug
		$slug = new PracticeSlug;
		
		$practice->slug=$slug->createSlug($request->title_en);
		$practice->menu_name_en=$request->input('menu_name_en');
		$practice->menu_name_ar=$request->input('menu_name_ar');
		$practice->title_en=$request->input('title_en');
		$practice->title_ar=$request->input('title_ar');
		$practice->details_en=$request->input('details_en');
		$practice->details_ar=$request->input('details_ar');
		$practice->seo_keywords_en=$request->input('seo_keywords_en');
		$practice->seo_keywords_ar=$request->input('seo_keywords_ar');
		$practice->seo_description_en=$request->input('seo_description_en');
		$practice->seo_description_ar=$request->input('seo_description_ar');
		$practice->is_active=!empty($request->input('is_active'))?$request->input('is_active'):'0';
		$practice->display_order=!empty($request->input('display_order'))?$request->input('display_order'):'0';
		$practice->image=$imageName;
		$practice->bannerimage=$bannerimageName;
		$practice->save();

       //save logs
		$key_name   = "practice";
		$key_id     = $practice->id;
		$message    = "A new record is added for Practice areas (".$practice->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
        return redirect('/gwc/practice')->with('message-success','practice is added successfully');
	}
	
	 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $editpractice = Practice::find($id);
        return view('gwc.practice.edit',compact('editpractice'));
    }
	
	
	 /**
     * Show the details of the Practice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
		$practiceDetails = Practice::find($id);
		//$countCats = $practiceDetails->childs()->count();
		$countCats = $this->countChildPages($practiceDetails);
        return view('gwc.practice.view',compact('practiceDetails','countCats'));
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
		$image_thumb_w = 100;
		$image_thumb_h = 100;
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
            'menu_name_en' => 'required|min:3|max:100|string|unique:gwc_practicearea,menu_name_en,'.$id,
			'menu_name_ar' => 'required|min:3|max:100|string|unique:gwc_practicearea,menu_name_ar,'.$id,
			'title_en'     => 'required|min:3|max:190|string|unique:gwc_practicearea,title_en,'.$id,
			'title_ar'     => 'required|min:3|max:190|string|unique:gwc_practicearea,title_ar,'.$id,
			'details_en'   => 'required|min:3',
			'details_ar'   => 'required|min:3',
			'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'headerimage'  => 'headerimage|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
		
	$practice = Practice::find($id);
	$imageName='';
	//upload image
	if($request->hasfile('image')){
	//delete image from folder
	if(!empty($practice->image)){
	$web_image_path = "/uploads/practice/".$practice->image;
	$web_image_paththumb = "/uploads/practice/thumb/".$practice->image;
	if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	 }
	}
	//
	$imageName = 'b-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
	
	$request->image->move(public_path('uploads/practice'), $imageName);
	//create thumb
	// open file a image resource
    $imgbig = Image::make(public_path('uploads/practice/'.$imageName));
	//resize image
	$imgbig->resize($image_big_w,$image_big_h);//Fixed w,h
	
	if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
	// insert watermark at bottom-right corner with 10px offset
    $imgbig->insert(public_path('uploads/practice/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
	}
	// save to imgbig thumb
	$imgbig->save(public_path('uploads/practice/'.$imageName));
	
	//create thumb
	// open file a image resource
    $img = Image::make(public_path('uploads/practice/'.$imageName));
	//resize image
	$img->resize($image_thumb_w,$image_thumb_h);//Fixed w,h
	// save to thumb
	$img->save(public_path('uploads/practice/thumb/'.$imageName));
	
	}else{
	$imageName = $practice->image;
	}
	
	
	$bannerimageName='';
	//upload image
	if($request->hasfile('bannerimage')){
	//delete image from folder
	if(!empty($practice->bannerimage)){
	$web_image_path = "/uploads/practice/".$practice->bannerimage;
	if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	 }
	}
	//
	$bannerimageName = 'ban-'.md5(time()).'.'.$request->bannerimage->getClientOriginalExtension();
	$request->bannerimage->move(public_path('uploads/practice'), $bannerimageName);

	if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
	// open file a image resource
    $imgbig = Image::make(public_path('uploads/practice/'.$bannerimageName));
	// insert watermark at bottom-right corner with 10px offset
    $imgbig->insert(public_path('uploads/practice/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
	$imgbig->save(public_path('uploads/practice/'.$bannerimageName));
	}
	}else{
	$bannerimageName = $practice->bannerimage;
	}
	
	
	//slug
		$slug = new PracticeSlug;
		
		$practice->slug=$slug->createSlug($request->title_en,$id);
		$practice->menu_name_en=$request->input('menu_name_en');
		$practice->menu_name_ar=$request->input('menu_name_ar');
		$practice->title_en=$request->input('title_en');
		$practice->title_ar=$request->input('title_ar');
		$practice->details_en=$request->input('details_en');
		$practice->details_ar=$request->input('details_ar');
		$practice->seo_keywords_en=$request->input('seo_keywords_en');
		$practice->seo_keywords_ar=$request->input('seo_keywords_ar');
		$practice->seo_description_en=$request->input('seo_description_en');
		$practice->seo_description_ar=$request->input('seo_description_ar');
		$practice->is_active=!empty($request->input('is_active'))?$request->input('is_active'):'0';
		$practice->display_order=!empty($request->input('display_order'))?$request->input('display_order'):'0';
		$practice->image=$imageName;
		$practice->bannerimage=$bannerimageName;
		$practice->save();
		//save logs
		$key_name   = "practice";
		$key_id     = $practice->id;
		$message    = "Information is edited for Practice areas (".$practice->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
	    return redirect('/gwc/practice')->with('message-success','Information is updated successfully');
	}
	
	/**
     * Delete the Image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	
	public function deleteImage($id){
	$practice = Practice::find($id);
	//delete image from folder
	if(!empty($practice->image)){
	$web_image_path = "/uploads/practice/".$practice->image;
	$web_image_paththumb = "/uploads/practice/thumb/".$practice->image;
	if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	 }
	}
	
	$practice->image='';
	$practice->save();
	return redirect()->back()->with('message-success','Image is deleted successfully');	
	}
	/////////////////////////////////////////
	public function deletebImage($id){
	$practice = Practice::find($id);
	//delete image from folder
	if(!empty($practice->bannerimage)){
	$web_image_path = "/uploads/practice/".$practice->bannerimage;
	if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	 }
	}
	
	//save logs
		$key_name   = "practice";
		$key_id     = $practice->id;
		$message    = "Image is removed for Practice areas (".$practice->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
	$practice->bannerimage='';
	$practice->save();
	return redirect()->back()->with('message-success','Image is deleted successfully');	
	}
	
	/**
     * Delete practice along with childs via ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function destroy($id){
	 //check param ID
	 if(empty($id)){
	 return redirect('/gwc/practice')->with('message-error','Param ID is missing'); 
	 }
	 //get cat info
	 $practice = Practice::find($id);
	 //check cat id exist or not
	 if(empty($practice->id)){
	 return redirect('/gwc/practice')->with('message-error','No record found'); 
	 }

	 //delete parent cat mage
	 if(!empty($practice->image)){
	 $web_image_path = "/uploads/practice/".$practice->image;//image
	 $web_image_paththumb = "/uploads/practice/thumb/".$practice->image;//thumb
	 $web_bimage_path = "/uploads/practice/".$practice->bannerimage;//banner
	 if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	   File::delete(public_path($web_bimage_path));
	  }
	 }
	    //save logs
		$key_name   = "practice";
		$key_id     = $practice->id;
		$message    = "Record is removed for Practice areas (".$practice->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
	 //end deleting parent cat image
	 $practice->delete();
	 return redirect()->back()->with('message-success','practice is deleted successfully');	
	 }
	 
	 
		//download pdf
	
	public function downloadPDF(){
	  $practices = Practice::get();
      $pdf = PDF::loadview('gwc.practice.pdf', compact('practices'));
      return $pdf->download('practices.pdf');
    }
	
    //update status
	public function updateStatusAjax(Request $request)
    {
		$recDetails = Practice::where('id',$request->id)->first(); 
		if($recDetails['is_active']==1){
			$active=0;
		}else{
			$active=1;
		}
		
		//save logs
		$key_name   = "practice";
		$key_id     = $recDetails->id;
		$message    = "Status is changed for Practice area (".$recDetails->title_en.") to ".$active;
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
		$recDetails->is_active=$active;
		$recDetails->save();
		return ['status'=>200,'message'=>'Status is modified successfully'];
	} 
}
