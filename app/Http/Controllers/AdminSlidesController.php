<?php

namespace App\Http\Controllers;

use App\Services;
use App\Settings;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdminSlidesController extends Controller
{
    public function index()
    {
        $settingInfo = Settings::where("keyname","setting")->first();
        $SlidesLists = Slide::orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
        return view('gwc.slides.index',['SlidesLists' => $SlidesLists]);
    }

    public function create()
    {
        $lastOrderInfo = Slide::OrderBy('display_order','desc')->first();
        if(!empty($lastOrderInfo->display_order)){
            $lastOrder=($lastOrderInfo->display_order+1);
        }else{
            $lastOrder=1;
        }
        return view('gwc.slides.create')->with(['lastOrder'=>$lastOrder]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title_en'     => 'nullable|max:255|string',
            'title_ar'     => 'nullable|max:255|string',
            'sub_title_en' => 'nullable|max:255|string',
            'sub_title_ar' => 'nullable|max:255|string',
            'link'         => 'nullable|max:255|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
        // nullable|mimes:mp4,mov,ogg,qt,video/avi,video/mpeg,video/quicktime|max:22528

        //upload image
        $imageName= null;
        if($request->hasfile('image')){
            $imageName = 'b-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/slides'), $imageName);
            // open file a image resource
            $imgbig = Image::make(public_path('uploads/slides/'.$imageName));
            //resize image
            // $imgbig->resize($image_big_w,$image_big_h);//Fixed w,h
            // if($settingInfo->is_watermark==1 && !empty($settingInfo->watermark_img)){
            //     $imgbig->insert(public_path('uploads/services/'.$settingInfo->watermark_img), 'bottom-right', 10, 10);
            // }
            $imgbig->save(public_path('uploads/slides/'.$imageName));

            //create thumb
            $img = Image::make(public_path('uploads/slides/'.$imageName));
            $img->widen(200);
            $img->save(public_path('uploads/slides/thumb/'.$imageName));
        }

        //upload video
        $videoName = null;
        if($request->hasfile('video')){
            $videoName = 'b-'.md5(time()).'.'.$request->video->getClientOriginalExtension();
            $request->video->move(public_path('uploads/slides'), $videoName);
        }

        $is_active = !empty($request->input('is_active')) ? $request->input('is_active') : 0;
        $request = new Request($request->all());
        $request->merge(['image' => $imageName, 'video' => $videoName, 'is_active' => $is_active]);
        $slide = Slide::create($request->merge(['image' => $imageName, 'video' => $videoName, 'is_active' => $is_active])->all());

        //save logs
        $key_name   = "slides";
        $key_id     = $slide->id;
        $message    = "A slide is added (".$slide->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        return redirect('/gwc/slides')->with('message-success','slides is added successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $slide = Slide::find($id);
        return view('gwc.slides.edit',compact('slide'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title_en'     => 'nullable|max:255|string',
            'title_ar'     => 'nullable|max:255|string',
            'sub_title_en' => 'nullable|max:255|string',
            'sub_title_ar' => 'nullable|max:255|string',
            'link'         => 'nullable|max:255|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        $slide = Slide::find($id);
        $imageName= null;
        //upload image
        if($request->hasfile('image')){
            //delete image from folder
            if(!empty($services->image)){
                $web_image_path = "/uploads/slides/".$slide->image;
                $web_image_paththumb = "/uploads/slides/thumb/".$slide->image;
                if(File::exists(public_path($web_image_path))){
                    File::delete(public_path($web_image_path));
                    File::delete(public_path($web_image_paththumb));
                }
            }
            //
            $imageName = 'b-'.md5(time()).'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path('uploads/slides'), $imageName);
            $imgbig = Image::make(public_path('uploads/slides/'.$imageName));
            $imgbig->save(public_path('uploads/slides/'.$imageName));

            //create thumb
            $img = Image::make(public_path('uploads/slides/'.$imageName));
            $img->widen(200);
            $img->save(public_path('uploads/slides/thumb/'.$imageName));
        }else{
            $imageName = $slide->image;
        }

        //upload video
        $videoName = null;
        if($request->hasfile('video')){
            if(!empty($slide->video)) {
                $video_path = "/uploads/slides/".$slide->video;
                if(File::exists(public_path($video_path))) {
                    File::delete(public_path($video_path));
                }
            }
            $videoName = 'b-'.md5(time()).'.'.$request->video->getClientOriginalExtension();
            $request->video->move(public_path('uploads/slides'), $videoName);
        }else{
            $videoName = $slide->video;
        }

        $is_active = !empty($request->input('is_active')) ? $request->input('is_active') : 0;
        $request = new Request($request->all());
        $request->merge(['image' => $imageName, 'video' => $videoName, 'is_active' => $is_active]);

        $slide->fill($request->all())->save();

        //save logs
        $key_name   = "slides";
        $key_id     = $slide->id;
        $message    = "A slide information is edited (".$slide->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        return redirect('/gwc/slides')->with('message-success','Information is updated successfully');
    }

    public function destroy($id)
    {
        if(empty($id)){
            return redirect('/gwc/slides')->with('message-error','Param ID is missing');
        }

        $slide = Slide::find($id);
        if(empty($slide->id)){
            return redirect('/gwc/slides')->with('message-error','No record found');
        }

        //delete parent cat mage
        if(!empty($slide->image)){
            $web_image_path = "/uploads/slides/".$slide->image;
            $web_image_paththumb = "/uploads/slides/thumb/".$slide->image;
            if(File::exists(public_path($web_image_path))){
                File::delete(public_path($web_image_path));
                File::delete(public_path($web_image_paththumb));
            }
        }

        //delete video
        if(!empty($slide->video)) {
            $video_path = "/uploads/slides/".$slide->video;
            if(File::exists(public_path($video_path))) {
                File::delete(public_path($video_path));
            }
        }

        //save logs
        $key_name   = "slides";
        $key_id     = $slide->id;
        $message    = "Record is removed for slide (".$slide->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        //end deleting parent cat image
        $slide->delete();
        return redirect()->back()->with('message-success','slides is deleted successfully');
    }

    public function deleteImage(Request $request, $id)
    {
        $slide = Slide::find($id);

        //delete image
        if(!empty($slide->image)){
            $web_image_path = "/uploads/slides/".$slide->image;
            $web_image_paththumb = "/uploads/slides/thumb/".$slide->image;
            if(File::exists(public_path($web_image_path))){
                File::delete(public_path($web_image_path));
                File::delete(public_path($web_image_paththumb));
            }
        }

        //save logs
        $key_name   = "slides";
        $key_id     = $slide->id;
        $message    = "Image is removed for service (".$slide->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);

        $slide->image= null;
        $slide->save();
        return redirect()->back()->with('message-success','Image is deleted successfully');
    }

    public function deleteVideo(Request $request, $id)
    {
        $slide = Slide::find($id);

        //delete video
        if(!empty($slide->video)) {
            $video_path = "/uploads/slides/".$slide->video;
            if(File::exists(public_path($video_path))) {
                File::delete(public_path($video_path));
            }
        }

        //save logs
        $key_name   = "slides";
        $key_id     = $slide->id;
        $message    = "Video is removed for slide (".$slide->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);

        $slide->video= null;
        $slide->save();
        return redirect()->back()->with('message-success','Video is deleted successfully');
    }

    //update status
    public function updateStatusAjax(Request $request)
    {
        $recDetails = Slide::where('id',$request->id)->first();
        if($recDetails['is_active']==1){
            $active=0;
        }else{
            $active=1;
        }

        //save logs
        $key_name   = "slides";
        $key_id     = $recDetails->id;
        $message    = "Status is changed for slide (".$recDetails->title_en.") to ".$active;
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        $recDetails->is_active=$active;
        $recDetails->save();
        return ['status'=>200,'message'=>'Status is modified successfully'];
    }
}
