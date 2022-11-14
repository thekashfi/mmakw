<?php

namespace App\Http\Controllers;

use App\Services;
use App\Settings;
use App\Attribute;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdminAttributesController extends Controller
{
    public function index()
    {
        $settingInfo = Settings::where("keyname","setting")->first();
        $attributes = Attribute::orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
        return view('gwc.attributes.index', compact('attributes'));
    }

    public function create()
    {
        $lastOrderInfo = Attribute::OrderBy('display_order','desc')->first();
        if(!empty($lastOrderInfo->display_order)){
            $lastOrder=($lastOrderInfo->display_order+1);
        }else{
            $lastOrder=1;
        }
        return view('gwc.attributes.create')->with(['lastOrder'=>$lastOrder]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title_en'     => 'required|max:255|string',
            'title_ar'     => 'required|max:255|string',
            'description_en'     => 'required|max:500|string',
            'description_ar'     => 'required|max:500|string',
        ]);


        $is_active = !empty($request->input('is_active')) ? $request->input('is_active') : 0;
        $request = new Request($request->all());
        $attribute = Attribute::create($request->merge(['is_active' => $is_active])->all());

        //save logs
        $key_name   = "attributes";
        $key_id     = $attribute->id;
        $message    = "A attribute is added (".$attribute->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        return redirect('/gwc/attributes')->with('message-success','attribute is added successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $attribute = Attribute::find($id);
        return view('gwc.attributes.edit',compact('attribute'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title_en'     => 'required|max:255|string',
            'title_ar'     => 'required|max:255|string',
            'description_en'     => 'required|max:500|string',
            'description_ar'     => 'required|max:500|string',
        ]);

        $attribute = Attribute::find($id);

        $is_active = !empty($request->input('is_active')) ? $request->input('is_active') : 0;
        $request = new Request($request->all());
        $attribute->fill($request->merge(['is_active' => $is_active])->all())->save();

        //save logs
        $key_name   = "attributes";
        $key_id     = $attribute->id;
        $message    = "A attribute information is edited (".$attribute->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        return redirect('/gwc/attributes')->with('message-success','Information is updated successfully');
    }

    public function destroy($id)
    {
        if(empty($id)){
            return redirect('/gwc/attributes')->with('message-error','Param ID is missing');
        }

        $category = Attribute::find($id);
        if(empty($category->id)){
            return redirect('/gwc/attributes')->with('message-error','No record found');
        }

        if(Services::where('category_id', $category->id)->exists()){
            return redirect('/gwc/attributes')->with('message-error','Category is used by services');
        }

        //save logs
        $key_name   = "attributes";
        $key_id     = $category->id;
        $message    = "Record is removed for attributes (".$category->name_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        //end deleting parent cat image
        $category->delete();
        return redirect()->back()->with('message-success','service category is deleted successfully');
    }
}
