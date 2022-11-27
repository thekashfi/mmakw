<?php

namespace App\Http\Controllers;

use App\Box;
use App\ServiceCategory;
use App\Services;
use App\Settings;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdminBoxesController extends Controller
{
    public function index()
    {
        $settingInfo = Settings::where("keyname","setting")->first();
        $boxes = Box::orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
        return view('gwc.boxes.index', compact('boxes'));
    }

    public function create()
    {
        $lastOrderInfo = Box::OrderBy('display_order','desc')->first();
        if(!empty($lastOrderInfo->display_order)){
            $lastOrder=($lastOrderInfo->display_order+1);
        }else{
            $lastOrder=1;
        }
        return view('gwc.boxes.create')->with(['lastOrder'=>$lastOrder]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title_en'          => 'required|max:255|string',
            'title_ar'          => 'required|max:255|string',
            'description_en'    => 'required|string',
            'description_ar'    => 'required|string',
            'link_title_en'     => 'nullable|max:100|string',
            'link_title_ar'     => 'nullable|max:100|string',
            'link'              => 'nullable|max:255|string',
            'image'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        //upload image
        $imageName="";
        if($request->hasfile('image')){
            $imageName = 'b-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/boxes'), $imageName);
            // open file a image resource

            //create thumb
            // open file a image resource
            $img = Image::make(public_path('uploads/boxes/'.$imageName));
            //resize image
            $img->widen(200);
            // save to thumb
            $img->save(public_path('uploads/boxes/thumb/'.$imageName));
        }

        $request = new Request($request->all());
        $request->merge(['image' => $imageName]);
        $box = Box::create($request->all());

        //save logs
        $key_name   = "boxes";
        $key_id     = $box->id;
        $message    = "A box is added (".$box->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        return redirect('/gwc/boxes')->with('message-success','box is added successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $box = Box::find($id);
        return view('gwc.boxes.edit',compact('box'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title_en'          => 'required|max:255|string',
            'title_ar'          => 'required|max:255|string',
            'description_en'    => 'required|string',
            'description_ar'    => 'required|string',
            'link_title_en'     => 'nullable|max:100|string',
            'link_title_ar'     => 'nullable|max:100|string',
            'link'              => 'nullable|max:255|string',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $box = Box::find($id);

        //upload image
        $imageName= $box->image;
        if($request->hasfile('image')){
            $imageName = 'b-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/boxes'), $imageName);
            //create thumb
            // open file a image resource
            $img = Image::make(public_path('uploads/boxes/'.$imageName));
            //resize image
            $img->widen(200);
            // save to thumb
            $img->save(public_path('uploads/boxes/thumb/'.$imageName));
        }

        $is_active = !empty($request->input('is_active')) ? $request->input('is_active') : 0;
        $request = new Request($request->all());
        $request->merge(['image' => $imageName, 'is_active' => $is_active]);
        $box->fill($request->all())->save();

        //save logs
        $key_name   = "boxes";
        $key_id     = $box->id;
        $message    = "A boxes information is edited (".$box->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        return redirect('/gwc/boxes')->with('message-success','Information is updated successfully');
    }

    public function destroy($id)
    {
        if(empty($id)){
            return redirect('/gwc/boxes')->with('message-error','Param ID is missing');
        }

        $box = Box::find($id);
        if(empty($box->id)){
            return redirect('/gwc/boxes')->with('message-error','No record found');
        }

        //save logs
        $key_name   = "boxes";
        $key_id     = $box->id;
        $message    = "Record is removed for boxes (".$box->name_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        //end deleting parent cat image
        $box->delete();
        return redirect()->back()->with('message-success','box is deleted successfully');
    }

    public function deleteImage(Request $request, $id)
    {
        $box = Box::find($id);

        //delete image
        if(!empty($box->image)){
            $web_image_path = "/uploads/boxes/".$box->image;
            $web_image_paththumb = "/uploads/boxes/thumb/".$box->image;
            if(File::exists(public_path($web_image_path))){
                File::delete(public_path($web_image_path));
                File::delete(public_path($web_image_paththumb));
            }
        }

        //save logs
        $key_name   = "boxes";
        $key_id     = $box->id;
        $message    = "Image is removed for service (".$box->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);

        $box->image= null;
        $box->save();
        return redirect()->back()->with('message-success','Image is deleted successfully');
    }
    //update status
    public function updateStatusAjax(Request $request)
    {
        $recDetails = Box::where('id',$request->id)->first();
        if($recDetails['is_active']==1){
            $active=0;
        }else{
            $active=1;
        }

        //save logs
        $key_name   = "boxes";
        $key_id     = $recDetails->id;
        $message    = "Status is changed for box (".$recDetails->title_en.") to ".$active;
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        $recDetails->is_active=$active;
        $recDetails->save();
        return ['status'=>200,'message'=>'Status is modified successfully'];
    }
}
