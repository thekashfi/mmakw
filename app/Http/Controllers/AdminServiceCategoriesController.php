<?php

namespace App\Http\Controllers;

use App\ServiceCategory;
use App\Services;
use App\Settings;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdminServiceCategoriesController extends Controller
{
    public function index()
    {
        $settingInfo = Settings::where("keyname","setting")->first();
        $categories = ServiceCategory::orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
        return view('gwc.service_categories.index', compact('categories'));
    }

    public function create()
    {
        $lastOrderInfo = ServiceCategory::OrderBy('display_order','desc')->first();
        if(!empty($lastOrderInfo->display_order)){
            $lastOrder=($lastOrderInfo->display_order+1);
        }else{
            $lastOrder=1;
        }
        return view('gwc.service_categories.create')->with(['lastOrder'=>$lastOrder]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_en'     => 'required|max:255|string',
            'name_ar'     => 'required|max:255|string',
        ]);

        $category = ServiceCategory::create($request->all());

        //save logs
        $key_name   = "service-categories";
        $key_id     = $category->id;
        $message    = "A category is added (".$category->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        return redirect('/gwc/service-categories')->with('message-success','categories is added successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = ServiceCategory::find($id);
        return view('gwc.service_categories.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name_en'     => 'required|max:255|string',
            'name_ar'     => 'required|max:255|string',
        ]);

        $category = ServiceCategory::find($id);

        $category->fill($request->all())->save();

        //save logs
        $key_name   = "service-categories";
        $key_id     = $category->id;
        $message    = "A service-categories information is edited (".$category->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        return redirect('/gwc/service-categories')->with('message-success','Information is updated successfully');
    }

    public function destroy($id)
    {
        if(empty($id)){
            return redirect('/gwc/service-categories')->with('message-error','Param ID is missing');
        }

        $category = ServiceCategory::find($id);
        if(empty($category->id)){
            return redirect('/gwc/service-categories')->with('message-error','No record found');
        }

        if(Services::where('category_id', $category->id)->exists()){
            return redirect('/gwc/service-categories')->with('message-error','Category is used by services');
        }

        //save logs
        $key_name   = "service-categories";
        $key_id     = $category->id;
        $message    = "Record is removed for service-categories (".$category->name_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        //end deleting parent cat image
        $category->delete();
        return redirect()->back()->with('message-success','service-categories is deleted successfully');
    }
}
