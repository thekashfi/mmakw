<?php

namespace App\Http\Controllers;

use App\Career;
use App\CareerCategory;
use App\NewsCategory;
use Illuminate\Http\Request;
use App\NewsEvents;
use App\Settings;
use Illuminate\Support\Str;
use Image;
use File;
use Response;
use App\Services\NewsEventsSlug;
use PDF;
use Auth;

class AdminCareersController extends Controller
{
	 public function index() //Request $request
    {
	    $settingInfo = Settings::where("keyname","setting")->first();
        $careers = Career::orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);

        return view('gwc.careers.index', compact('careers'));
    }

	public function create()
    {
	$lastOrderInfo = Career::OrderBy('display_order','desc')->first();
	if(!empty($lastOrderInfo->display_order)){
	$lastOrder=($lastOrderInfo->display_order+1);
	}else{
	$lastOrder=1;
	}
	return view('gwc.careers.create')->with(['lastOrder'=>$lastOrder, 'categories' => CareerCategory::get()]);
	}
	

	
	/**
	Store New newsevents Details
	**/
	public function store(Request $request)
    {

		ini_set('memory_limit', '256M');
		
		$settingInfo = Settings::where("keyname","setting")->first();

	    $this->validate($request, [
			'slug'     => 'required|min:3|max:255|string|unique:gwc_careers,slug',
			'title_en'     => 'required|min:3|max:255|string',
			'title_ar'     => 'required|min:3|max:255|string',
			'description_en'   => 'required|min:3',
			'description_ar'   => 'required|min:3',
			'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);
		
		//upload image
		$imageName="";
		if($request->hasfile('image')){
            $imageName = 'b-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/careers'), $imageName);
            // open file a image resource
            $imgbig = Image::make(public_path('uploads/careers/'.$imageName));
            // if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
            //     $imgbig->insert(public_path('uploads/careers/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
            // }
            // save to imgbig thumb
            $imgbig->save(public_path('uploads/careers/'.$imageName));

            //create thumb
            $img = Image::make(public_path('uploads/careers/'.$imageName));
            $img->widen(200);
            $img->save(public_path('uploads/careers/thumb/'.$imageName));
		}

        $request = new Request($request->all());
        $request->merge(['image' => $imageName, 'category_id' => $request->input('category_id') != 'null' ? $request->input('category_id') : null]);
        $career = Career::create($request->all());

        //save logs
		$key_name   = "careers";
		$key_id     = $career->id;
		$message    = "A new record for careers is added. (".$career->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
        return redirect('/gwc/careers')->with('message-success','career is added successfully');
	}
	
	 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $career = Career::find($id);
        $categories = CareerCategory::get();
        return view('gwc.careers.edit',compact('career', 'categories'));
    }
	
	
	 /**
     * Show the details of the newsevents.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
		$newseventsDetails = NewsEvents::find($id);
		//$countCats = $newseventsDetails->childs()->count();
		$countCats = $this->countChildPages($newseventsDetails);
        return view('gwc.newsevents.view',compact('newseventsDetails','countCats'));
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
	   $this->validate($request, [
            'slug'     => 'required|min:3|max:255|string|unique:gwc_careers,slug,' . $request->id,
			'title_en'     => 'required|min:3|max:190|string',
			'title_ar'     => 'required|min:3|max:190|string',
           'description_en'   => 'required|min:3',
           'description_ar'   => 'required|min:3',
           'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);
		
	$career = Career::find($id);
	$imageName='';
	//upload image
	if($request->hasfile('image')){
	//delete image from folder
	if(!empty($career->image)){
	$web_image_path = "/uploads/careers/".$career->image;
	$web_image_paththumb = "/uploads/careers/thumb/".$career->image;
	if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	 }
	}

	$imageName = 'b-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
	
	$request->image->move(public_path('uploads/careers'), $imageName);
	//create thumb
	// open file a image resource
    $imgbig = Image::make(public_path('uploads/careers/'.$imageName));
	//resize image
	
	// if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
	// // insert watermark at bottom-right corner with 10px offset
    // $imgbig->insert(public_path('uploads/careers/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
	// }
	// save to imgbig thumb
	$imgbig->save(public_path('uploads/careers/'.$imageName));
	
	//create thumb
    $img = Image::make(public_path('uploads/careers/'.$imageName));
	$img->widen(200);//Fixed w,h
	// save to thumb
	$img->save(public_path('uploads/careers/thumb/'.$imageName));
	
	}else{
	$imageName = $career->image;
	}


    $is_active = !empty($request->input('is_active')) ? $request->input('is_active') : 0;
    $request = new Request($request->all());
    $request->merge(['image' => $imageName, 'is_active' => $is_active, 'category_id' => $request->input('category_id') != 'null' ? $request->input('category_id') : null]);
    $career->fill($request->all())->save();

		
		//save logs
		$key_name   = "careers";
		$key_id     = $career->id;
		$message    = "Record for careers is edited. (".$career->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
	    return redirect('/gwc/careers')->with('message-success','Information is updated successfully');
	}
	
	/**
     * Delete the Image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	
	public function deleteImage($id){
	$career = Career::find($id);
	//delete image from folder
	if(!empty($career->image)){
	$web_image_path = "/uploads/careers/".$career->image;
	$web_image_paththumb = "/uploads/careers/thumb/".$career->image;
	if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	 }
	}
	
	$career->image='';
	$career->save();
	
	   //save logs
		$key_name   = "careers";
		$key_id     = $career->id;
		$message    = "Image is removed. (".$career->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
	return redirect()->back()->with('message-success','Image is deleted successfully');	
	}
	
	/**
     * Delete newsevents along with childs via ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function destroy($id){
         //check param ID
         if(empty($id)){
         return redirect('/gwc/careers')->with('message-error','Param ID is missing');
         }
         //get cat info
         $career = Career::find($id);
         //check cat id exist or not
         if(empty($career->id)){
         return redirect('/gwc/careers')->with('message-error','No record found');
         }

         //delete parent cat mage
         if(!empty($career->image)){
         $web_image_path = "/uploads/careers/".$career->image;
         $web_image_paththumb = "/uploads/careers/thumb/".$career->image;
         if(File::exists(public_path($web_image_path))){
           File::delete(public_path($web_image_path));
           File::delete(public_path($web_image_paththumb));
          }
         }

         //save logs
            $key_name   = "careers";
            $key_id     = $career->id;
            $message    = "A record is removed. (".$career->title_en.")";
            $created_by = Auth::guard('admin')->user()->id;
            Common::saveLogs($key_name,$key_id,$message,$created_by);
            //end save logs


         //end deleting parent cat image
         $career->delete();
         return redirect()->back()->with('message-success','career is deleted successfully');
	 }

    //update status
	public function updateStatusAjax(Request $request)
    {
		$recDetails = Career::where('id',$request->id)->first();
		if($recDetails['is_active']==1){
			$active=0;
		}else{
			$active=1;
		}
		
		//save logs
		$key_name   = "careers";
		$key_id     = $recDetails->id;
		$message    = "career status is changed to ".$active." (".$recDetails->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
		$recDetails->is_active=$active;
		$recDetails->save();
		return ['status'=>200,'message'=>'Status is modified successfully'];
	}
}
