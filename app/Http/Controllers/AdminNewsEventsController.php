<?php

namespace App\Http\Controllers;

use App\NewsCategory;
use Illuminate\Http\Request;
use App\NewsEvents;
use App\Settings;
use Image;
use File;
use Response;
use App\Services\NewsEventsSlug;
use PDF;
use Auth;

class AdminNewsEventsController extends Controller
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
        $NewsEventsLists = NewsEvents::where('name_en','LIKE','%'.$q.'%')
		                    ->orwhere('name_ar','LIKE','%'.$q.'%')
                            ->orderBy('id', 'DESC')
                            ->paginate(50);  
        $NewsEventsLists->appends(['q' => $q]);
		
        }else{*/
        $newseventsLists = NewsEvents::orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
        //}
        return view('gwc.newsevents.index',['newseventsLists' => $newseventsLists]);
    }
	
	
	/**
	Display the newsevents listings
	**/
	public function create()
    {
	
	$lastOrderInfo = NewsEvents::OrderBy('display_order','desc')->first();
	if(!empty($lastOrderInfo->display_order)){
	$lastOrder=($lastOrderInfo->display_order+1);
	}else{
	$lastOrder=1;
	}
	return view('gwc.newsevents.create')->with(['lastOrder'=>$lastOrder, 'categories' => NewsCategory::get()]);
	}
	

	
	/**
	Store New newsevents Details
	**/
	public function store(Request $request)
    {
	    
		ini_set('memory_limit', '256M');
		
		$settingInfo = Settings::where("keyname","setting")->first();
		//if(!empty($settingInfo->image_thumb_w) && !empty($settingInfo->image_thumb_h)){
		//$image_thumb_w = $settingInfo->image_thumb_w;
		//$image_thumb_h = $settingInfo->image_thumb_h;
		//}else{
		$image_thumb_w = 360;
		$image_thumb_h = 239;
		//}
		
		//if(!empty($settingInfo->image_big_w) && !empty($settingInfo->image_big_h)){
		//$image_big_w = $settingInfo->image_big_w;
		//$image_big_h = $settingInfo->image_big_h;
		//}else{
		$image_big_w = 600;
		$image_big_h = 399;
		//}
		//field validation
	    $this->validate($request, [
			'title_en'     => 'required|min:3|max:190|string|unique:gwc_newsevents,title_en',
			'title_ar'     => 'required|min:3|max:190|string|unique:gwc_newsevents,title_ar',
			'details_en'   => 'required|min:3',
			'details_ar'   => 'required|min:3',
			'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
		
		//upload image
		$imageName="";
		if($request->hasfile('image')){
		$imageName = 'b-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
		$request->image->move(public_path('uploads/newsevents'), $imageName);
		// open file a image resource
		$imgbig = Image::make(public_path('uploads/newsevents/'.$imageName));
		//resize image
		$imgbig->resize($image_big_w,$image_big_h);//Fixed w,h
		if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
		// insert watermark at bottom-right corner with 10px offset
		$imgbig->insert(public_path('uploads/newsevents/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
		}
		// save to imgbig thumb
		$imgbig->save(public_path('uploads/newsevents/'.$imageName));
		
		//create thumb
		// open file a image resource
		$img = Image::make(public_path('uploads/newsevents/'.$imageName));
		//resize image
		$img->resize($image_thumb_w,$image_thumb_h);//Fixed w,h
		// save to thumb
		$img->save(public_path('uploads/newsevents/thumb/'.$imageName));
		}

		$newsevents = new NewsEvents;
		//slug
		$slug = new NewsEventsSlug;
		
		$newsevents->slug=$slug->createSlug($request->title_en);
        $newsevents->category_id=$request->input('category_id') != 'null' ? $request->input('category_id') : null;
		$newsevents->title_en=$request->input('title_en');
		$newsevents->title_ar=$request->input('title_ar');
		$newsevents->details_en=$request->input('details_en');
		$newsevents->details_ar=$request->input('details_ar');
		$newsevents->seo_keywords_en=$request->input('seo_keywords_en');
		$newsevents->seo_keywords_ar=$request->input('seo_keywords_ar');
		$newsevents->seo_description_en=$request->input('seo_description_en');
		$newsevents->seo_description_ar=$request->input('seo_description_ar');
		$newsevents->is_active=!empty($request->input('is_active'))?$request->input('is_active'):'0';
		$newsevents->display_order=!empty($request->input('display_order'))?$request->input('display_order'):'0';
		$newsevents->ntype=!empty($request->input('ntype'))?$request->input('ntype'):'news';
		$newsevents->news_Date=!empty($request->input('news_Date'))?$request->input('news_Date'):date("Y-m-d");

		$newsevents->image=$imageName;
		$newsevents->save();

        //save logs
		$key_name   = "news";
		$key_id     = $newsevents->id;
		$message    = "A new record for news & events is added. (".$newsevents->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
        return redirect('/gwc/newsevents')->with('message-success','newsevents is added successfully');
	}
	
	 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $editnewsevents = NewsEvents::find($id);
        $categories = NewsCategory::get();
        return view('gwc.newsevents.edit',compact('editnewsevents', 'categories'));
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
	    //if(!empty($settingInfo->image_thumb_w) && !empty($settingInfo->image_thumb_h)){
		//$image_thumb_w = $settingInfo->image_thumb_w;
		//$image_thumb_h = $settingInfo->image_thumb_h;
		//}else{
		$image_thumb_w = 360;
		$image_thumb_h = 239;
		//}
		
		//if(!empty($settingInfo->image_big_w) && !empty($settingInfo->image_big_h)){
		//$image_big_w = $settingInfo->image_big_w;
		//$image_big_h = $settingInfo->image_big_h;
		//}else{
		$image_big_w = 600;
		$image_big_h = 399;
		//}
		
	 //field validation  
	   $this->validate($request, [
			'title_en'     => 'required|min:3|max:190|string|unique:gwc_newsevents,title_en,'.$id,
			'title_ar'     => 'required|min:3|max:190|string|unique:gwc_newsevents,title_ar,'.$id,
			'details_en'   => 'required|min:3',
			'details_ar'   => 'required|min:3',
			'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
		
	$newsevents = NewsEvents::find($id);
	$imageName='';
	//upload image
	if($request->hasfile('image')){
	//delete image from folder
	if(!empty($newsevents->image)){
	$web_image_path = "/uploads/newsevents/".$newsevents->image;
	$web_image_paththumb = "/uploads/newsevents/thumb/".$newsevents->image;
	if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	 }
	}
	//
	$imageName = 'b-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
	
	$request->image->move(public_path('uploads/newsevents'), $imageName);
	//create thumb
	// open file a image resource
    $imgbig = Image::make(public_path('uploads/newsevents/'.$imageName));
	//resize image
	$imgbig->resize($image_big_w,$image_big_h);//Fixed w,h
	
	if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
	// insert watermark at bottom-right corner with 10px offset
    $imgbig->insert(public_path('uploads/newsevents/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
	}
	// save to imgbig thumb
	$imgbig->save(public_path('uploads/newsevents/'.$imageName));
	
	//create thumb
	// open file a image resource
    $img = Image::make(public_path('uploads/newsevents/'.$imageName));
	//resize image
	$img->resize($image_thumb_w,$image_thumb_h);//Fixed w,h
	// save to thumb
	$img->save(public_path('uploads/newsevents/thumb/'.$imageName));
	
	}else{
	$imageName = $newsevents->image;
	}
	
	//slug
		$slug = new NewsEventsSlug;
		
		$newsevents->slug=$slug->createSlug($request->title_en,$id);
        $newsevents->category_id=$request->input('category_id') != 'null' ? $request->input('category_id') : null;
		$newsevents->title_en=$request->input('title_en');
		$newsevents->title_ar=$request->input('title_ar');
		$newsevents->details_en=$request->input('details_en');
		$newsevents->details_ar=$request->input('details_ar');
		$newsevents->seo_keywords_en=$request->input('seo_keywords_en');
		$newsevents->seo_keywords_ar=$request->input('seo_keywords_ar');
		$newsevents->seo_description_en=$request->input('seo_description_en');
		$newsevents->seo_description_ar=$request->input('seo_description_ar');
		$newsevents->is_active=!empty($request->input('is_active'))?$request->input('is_active'):'0';
		$newsevents->display_order=!empty($request->input('display_order'))?$request->input('display_order'):'0';
		$newsevents->ntype=!empty($request->input('ntype'))?$request->input('ntype'):'news';
		$newsevents->news_Date=!empty($request->input('news_Date'))?$request->input('news_Date'):date("Y-m-d");
		$newsevents->image=$imageName;
		$newsevents->save();
		
		
		//save logs
		$key_name   = "news";
		$key_id     = $newsevents->id;
		$message    = "Record for news & events is edited. (".$newsevents->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
	    return redirect('/gwc/newsevents')->with('message-success','Information is updated successfully');
	}
	
	/**
     * Delete the Image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	
	public function deleteImage($id){
	$newsevents = NewsEvents::find($id);
	//delete image from folder
	if(!empty($newsevents->image)){
	$web_image_path = "/uploads/newsevents/".$newsevents->image;
	$web_image_paththumb = "/uploads/newsevents/thumb/".$newsevents->image;
	if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	 }
	}
	
	$newsevents->image='';
	$newsevents->save();
	
	   //save logs
		$key_name   = "news";
		$key_id     = $newsevents->id;
		$message    = "Image is removed. (".$newsevents->title_en.")";
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
	 return redirect('/gwc/newsevents')->with('message-error','Param ID is missing'); 
	 }
	 //get cat info
	 $newsevents = NewsEvents::find($id);
	 //check cat id exist or not
	 if(empty($newsevents->id)){
	 return redirect('/gwc/newsevents')->with('message-error','No record found'); 
	 }

	 //delete parent cat mage
	 if(!empty($newsevents->image)){
	 $web_image_path = "/uploads/newsevents/".$newsevents->image;
	 $web_image_paththumb = "/uploads/newsevents/thumb/".$newsevents->image;
	 if(File::exists(public_path($web_image_path))){
	   File::delete(public_path($web_image_path));
	   File::delete(public_path($web_image_paththumb));
	  }
	 }
	 
	 //save logs
		$key_name   = "news";
		$key_id     = $newsevents->id;
		$message    = "A record is removed. (".$newsevents->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
	 //end deleting parent cat image
	 $newsevents->delete();
	 return redirect()->back()->with('message-success','newsevents is deleted successfully');	
	 }
	 
	 
	 
		//download pdf
	
	public function downloadPDF(){
	  $newsevents = NewsEvents::get();
      $pdf = PDF::loadview('gwc.newsevents.pdf', compact('newsevents'));
      return $pdf->download('newsevents.pdf');
    }
	
    //update status
	public function updateStatusAjax(Request $request)
    {
		$recDetails = NewsEvents::where('id',$request->id)->first(); 
		if($recDetails['is_active']==1){
			$active=0;
		}else{
			$active=1;
		}
		
		//save logs
		$key_name   = "news";
		$key_id     = $recDetails->id;
		$message    = "news & events status is changed to ".$active." (".$recDetails->title_en.")";
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
		
		$recDetails->is_active=$active;
		$recDetails->save();
		return ['status'=>200,'message'=>'Status is modified successfully'];
	} 
	
}
