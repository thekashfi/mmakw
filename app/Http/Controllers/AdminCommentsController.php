<?php

namespace App\Http\Controllers;

use App\Services;
use App\Settings;
use App\Comment;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdminCommentsController extends Controller
{
    public function index()
    {
        $settingInfo = Settings::where("keyname","setting")->first();
        $comments = Comment::where('is_approved', 0)->orderBy('created_at', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
        return view('gwc.comments.index', compact('comments'));
    }

    public function approve($id)
    {
        Comment::where('id', $id)->update(['is_approved' => 1]);
        return redirect()->back()->with('message-success','comment is approved successfully');
    }

    public function reject($id)
    {
        Comment::where('id', $id)->delete();
        return redirect()->back()->with('message-success','comment is rejected successfully');
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
        $attribute = Comment::create($request->merge(['is_active' => $is_active])->all());

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
        $attribute = Comment::find($id);
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

        $attribute = Comment::find($id);

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

        $category = Comment::find($id);
        if(empty($category->id)){
            return redirect('/gwc/attributes')->with('message-error','No record found');
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
        return redirect()->back()->with('message-success','attribute is deleted successfully');
    }
}
