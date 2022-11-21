<?php

namespace App\Http\Controllers;

use App\ServiceCategory;
use Illuminate\Http\Request;
use App\Services;
use App\Settings;
use Image;
use File;
use Response;
use App\Services\ServicesSlug;
use PDF;
use Auth;

class AdminServicesController extends Controller
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
        $ServicesLists = Services::where('name_en','LIKE','%'.$q.'%')
		                    ->orwhere('name_ar','LIKE','%'.$q.'%')
                            ->orderBy('id', 'DESC')
                            ->paginate(50);  
        $ServicesLists->appends(['q' => $q]);
		
        }else{*/
        $ServicesLists = Services::orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
        //}
        return view('gwc.services.index',['ServicesLists' => $ServicesLists]);
    }
	
	
	/**
	Display the Services listings
	**/
	public function create()
    {
	
	$lastOrderInfo = Services::OrderBy('display_order','desc')->first();
	if(!empty($lastOrderInfo->display_order)){
	$lastOrder=($lastOrderInfo->display_order+1);
	}else{
	$lastOrder=1;
	}
	return view('gwc.services.create')->with(['lastOrder'=>$lastOrder, 'categories' => ServiceCategory::get()]);
	}
	

	
	/**
	Store New Services Details
	**/
	public function store(Request $request)
    {
	    
		$settingInfo = Settings::where("keyname","setting")->first();
		//if(!empty($settingInfo->image_thumb_w) && !empty($settingInfo->image_thumb_h)){
		//$image_thumb_w = $settingInfo->image_thumb_w;
		//$image_thumb_h = $settingInfo->image_thumb_h;
		//}else{
		$image_thumb_w = 276;
		$image_thumb_h = 360;
		//}
		
		//if(!empty($settingInfo->image_big_w) && !empty($settingInfo->image_big_h)){
		//$image_big_w = $settingInfo->image_big_w;
		//$image_big_h = $settingInfo->image_big_h;
		//}else{
        $image_big_w = 344;
        $image_big_h = 229;
		//}
		//field validation
	    $this->validate($request, [
            'menu_name_en' => 'required|min:3|max:100|string|unique:gwc_services,menu_name_en',
			'menu_name_ar' => 'required|min:3|max:100|string|unique:gwc_services,menu_name_ar',
			'title_en'     => 'required|min:3|max:190|string|unique:gwc_services,title_en',
			'title_ar'     => 'required|min:3|max:190|string|unique:gwc_services,title_ar',
			'details_en'   => 'required|min:3',
			'details_ar'   => 'required|min:3',
			'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
		
		//upload image
		$imageName="";
		if($request->hasfile('image')){
		$imageName = 'b-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
		$request->image->move(public_path('uploads/services'), $imageName);
		// open file a image resource
		$imgbig = Image::make(public_path('uploads/services/'.$imageName));
		//resize image
		$imgbig->resize($image_big_w,$image_big_h);//Fixed w,h
		if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
		// insert watermark at bottom-right corner with 10px offset
		$imgbig->insert(public_path('uploads/services/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
		}
		// save to imgbig thumb
		$imgbig->save(public_path('uploads/services/'.$imageName));
		
		//create thumb
		// open file a image resource
		$img = Image::make(public_path('uploads/services/'.$imageName));
		//resize image
		$img->resize($image_thumb_w,$image_thumb_h);//Fixed w,h
		// save to thumb
		$img->save(public_path('uploads/services/thumb/'.$imageName));
		}

		$services = new Services;
		//slug
		$slug = new ServicesSlug;
		
		$services->slug=$slug->createSlug($request->title_en);
        $services->category_id=$request->input('category_id') != 'null' ? $request->input('category_id') : null;
        $services->menu_name_en=$request->input('menu_name_en');
		$services->menu_name_ar=$request->input('menu_name_ar');
		$services->title_en=$request->input('title_en');
		$services->title_ar=$request->input('title_ar');
		$services->details_en=$request->input('details_en');
		$services->details_ar=$request->input('details_ar');
		$services->seo_keywords_en=$request->input('seo_keywords_en');
		$services->seo_keywords_ar=$request->input('seo_keywords_ar');
		$services->seo_description_en=$request->input('seo_description_en');
		$services->seo_description_ar=$request->input('seo_description_ar');
		$services->is_active=!empty($request->input('is_active'))?$request->input('is_active'):'0';
		$services->display_order=!empty($request->input('display_order'))?$request->input('display_order'):'0';
		$services->image=$imageName;
		$services->save();
		
		//save logs
		$key_name   = "services";
		$key_id     = $services->id;
		$message    = "A service is added (".$services->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs

        return redirect('/gwc/services')->with('message-success','services is added successfully');
	}
	
	 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $editservices = Services::find($id);
        $categories = ServiceCategory::get();
        return view('gwc.services.edit',compact('editservices', 'categories'));
    }
	
	
	 /**
     * Show the details of the services.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
		$servicesDetails = Services::find($id);
		//$countCats = $servicesDetails->childs()->count();
		$countCats = $this->countChildPages($servicesDetails);
        return view('gwc.services.view',compact('servicesDetails','countCats'));
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
	    //if(!empty($settingInfo->image_thumb_w) && !empty($settingInfo->image_thumb_h)){
		//$image_thumb_w = $settingInfo->image_thumb_w;
		//$image_thumb_h = $settingInfo->image_thumb_h;
		//}else{
		$image_thumb_w = 276;
		$image_thumb_h = 360;
		//}
		
		//if(!empty($settingInfo->image_big_w) && !empty($settingInfo->image_big_h)){
		//$image_big_w = $settingInfo->image_big_w;
		//$image_big_h = $settingInfo->image_big_h;
		//}else{
        $image_big_w = 344;
        $image_big_h = 229;
		//}
		
	 //field validation  
	   $this->validate($request, [
            'menu_name_en' => 'required|min:3|max:100|string|unique:gwc_services,menu_name_en,'.$id,
			'menu_name_ar' => 'required|min:3|max:100|string|unique:gwc_services,menu_name_ar,'.$id,
			'title_en'     => 'required|min:3|max:190|string|unique:gwc_services,title_en,'.$id,
			'title_ar'     => 'required|min:3|max:190|string|unique:gwc_services,title_ar,'.$id,
			'details_en'   => 'required|min:3',
			'details_ar'   => 'required|min:3',
			'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
		
	$services = Services::find($id);
	$imageName='';
	//upload image
	if($request->hasfile('image')){
	//delete image from folder
	if(!empty($services->image)){
	$web_image_path = "/uploads/services/".$services->image;
	$web_image_paththumb = "/uploads/services/thumb/".$services->image;
	if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	 }
	}
	//
	$imageName = 'b-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
	
	$request->image->move(public_path('uploads/services'), $imageName);
	//create thumb
	// open file a image resource
    $imgbig = Image::make(public_path('uploads/services/'.$imageName));
	//resize image
	$imgbig->resize($image_big_w,$image_big_h);//Fixed w,h
	
	if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
	// insert watermark at bottom-right corner with 10px offset
    $imgbig->insert(public_path('uploads/services/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
	}
	// save to imgbig thumb
	$imgbig->save(public_path('uploads/services/'.$imageName));
	
	//create thumb
	// open file a image resource
    $img = Image::make(public_path('uploads/services/'.$imageName));
	//resize image
	$img->resize($image_thumb_w,$image_thumb_h);//Fixed w,h
	// save to thumb
	$img->save(public_path('uploads/services/thumb/'.$imageName));
	
	}else{
	$imageName = $services->image;
	}
	
	//slug
		$slug = new ServicesSlug;
		$services->slug=$slug->createSlug($request->title_en,$id);
        $services->category_id=$request->input('category_id') != 'null' ? $request->input('category_id') : null;
		$services->menu_name_en=$request->input('menu_name_en');
		$services->menu_name_ar=$request->input('menu_name_ar');
		$services->title_en=$request->input('title_en');
		$services->title_ar=$request->input('title_ar');
		$services->details_en=$request->input('details_en');
		$services->details_ar=$request->input('details_ar');
		$services->seo_keywords_en=$request->input('seo_keywords_en');
		$services->seo_keywords_ar=$request->input('seo_keywords_ar');
		$services->seo_description_en=$request->input('seo_description_en');
		$services->seo_description_ar=$request->input('seo_description_ar');
		$services->is_active=!empty($request->input('is_active'))?$request->input('is_active'):'0';
		$services->display_order=!empty($request->input('display_order'))?$request->input('display_order'):'0';
		$services->image=$imageName;
		$services->save();
		
		//save logs
		$key_name   = "services";
		$key_id     = $services->id;
		$message    = "A service information is edited (".$services->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
	    return redirect('/gwc/services')->with('message-success','Information is updated successfully');
	}
	
	/**
     * Delete the Image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	
	public function deleteImage($id){
	$services = Services::find($id);
	//delete image from folder
	if(!empty($services->image)){
	$web_image_path = "/uploads/services/".$services->image;
	$web_image_paththumb = "/uploads/services/thumb/".$services->image;
	if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	 }
	}
	   //save logs
		$key_name   = "services";
		$key_id     = $services->id;
		$message    = "Image is removed for service (".$services->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
	$services->image='';
	$services->save();
	return redirect()->back()->with('message-success','Image is deleted successfully');	
	}
	
	/**
     * Delete services along with childs via ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function destroy($id){
	 //check param ID
	 if(empty($id)){
	 return redirect('/gwc/services')->with('message-error','Param ID is missing'); 
	 }
	 //get cat info
	 $services = Services::find($id);
	 //check cat id exist or not
	 if(empty($services->id)){
	 return redirect('/gwc/services')->with('message-error','No record found'); 
	 }

	 //delete parent cat mage
	 if(!empty($services->image)){
	 $web_image_path = "/uploads/services/".$services->image;
	 $web_image_paththumb = "/uploads/services/thumb/".$services->image;
	 if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	  }
	 }
	 
	 //save logs
		$key_name   = "services";
		$key_id     = $services->id;
		$message    = "Record is removed for service (".$services->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
	 //end deleting parent cat image
	 $services->delete();
	 return redirect()->back()->with('message-success','services is deleted successfully');	
	 }
	 
	 
	 
		//download pdf
	
	public function downloadPDF(){
	  $services = Services::get();
      $pdf = PDF::loadview('gwc.services.pdf', compact('services'));
      return $pdf->download('services.pdf');
    }
	
    //update status
	public function updateStatusAjax(Request $request)
    {
		$recDetails = Services::where('id',$request->id)->first(); 
		if($recDetails['is_active']==1){
			$active=0;
		}else{
			$active=1;
		}
		
		//save logs
		$key_name   = "services";
		$key_id     = $recDetails->id;
		$message    = "Status is changed for Service (".$recDetails->title_en.") to ".$active;
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
		$recDetails->is_active=$active;
		$recDetails->save();
		return ['status'=>200,'message'=>'Status is modified successfully'];
	} 
	
}
