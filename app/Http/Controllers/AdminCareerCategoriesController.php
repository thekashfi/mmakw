<?php

namespace App\Http\Controllers;

use App\Career;
use App\CareerCategory;
use App\Services;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCareerCategoriesController extends Controller
{
    public function index()
    {
        $settingInfo = Settings::where("keyname","setting")->first();
        $categories = CareerCategory::orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
        return view('gwc.career_categories.index', compact('categories'));
    }

    public function create()
    {
        $lastOrderInfo = CareerCategory::OrderBy('display_order','desc')->first();
        if(!empty($lastOrderInfo->display_order)){
            $lastOrder=($lastOrderInfo->display_order+1);
        }else{
            $lastOrder=1;
        }
        return view('gwc.career_categories.create')->with(['lastOrder'=>$lastOrder]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'slug'     => 'required|max:255|string|unique:gwc_career_categories,slug',
            'name_en'     => 'required|max:255|string',
            'name_ar'     => 'required|max:255|string',
        ]);

        $category = CareerCategory::create($request->all());

        //save logs
        $key_name   = "career-categories";
        $key_id     = $category->id;
        $message    = "A career category is added (".$category->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        return redirect('/gwc/career-categories')->with('message-success','career category is added successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = CareerCategory::find($id);
        return view('gwc.career_categories.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'slug'     => 'required|max:255|string',
            'name_en'     => 'required|max:255|string',
            'name_ar'     => 'required|max:255|string',
        ]);

        $category = CareerCategory::find($id);

        $category->fill($request->all())->save();

        //save logs
        $key_name   = "career-categories";
        $key_id     = $category->id;
        $message    = "A career category information is edited (".$category->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        return redirect('/gwc/career-categories')->with('message-success','Information is updated successfully');
    }

    public function destroy($id)
    {
        if(empty($id)){
            return redirect('/gwc/career-categories')->with('message-error','Param ID is missing');
        }

        $category = CareerCategory::find($id);
        if(empty($category->id)){
            return redirect('/gwc/career-categories')->with('message-error','No record found');
        }

        if(Career::where('category_id', $category->id)->exists()){
            return redirect('/gwc/career-categories')->with('message-error','Category is used by a career');
        }

        //save logs
        $key_name   = "career-categories";
        $key_id     = $category->id;
        $message    = "Record is removed for career-categories (".$category->name_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        //end deleting parent cat image
        $category->delete();
        return redirect()->back()->with('message-success','career category is deleted successfully');
    }
}
