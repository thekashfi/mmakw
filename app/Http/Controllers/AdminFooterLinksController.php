<?php

namespace App\Http\Controllers;

use App\Box;
use App\FooterLink;
use App\ServiceCategory;
use App\Services;
use App\Settings;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdminFooterLinksController extends Controller
{
    public function index()
    {
        $settingInfo = Settings::where("keyname","setting")->first();
        $links = FooterLink::orderBy('display_order', $settingInfo->default_sort)->paginate($settingInfo->item_per_page_back);
        return view('gwc.footer-links.index', compact('links'));
    }

    public function create()
    {
        $lastOrderInfo = FooterLink::OrderBy('display_order','desc')->first();
        if(!empty($lastOrderInfo->display_order)){
            $lastOrder=($lastOrderInfo->display_order+1);
        }else{
            $lastOrder=1;
        }
        return view('gwc.footer-links.create')->with(['lastOrder'=>$lastOrder]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_en'          => 'required|max:50|string',
            'name_ar'          => 'required|max:50|string',
            'link'             => 'required|max:255|string',
            'display_order'    => 'integer',
        ]);

        $request->merge(['is_active' => !empty($request->input('is_active')) ? $request->input('is_active') : 0]);
        $link = FooterLink::create($request->all());

        //save logs
        $key_name   = "footer-links";
        $key_id     = $link->id;
        $message    = "A footer-link is added (".$link->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        return redirect('/gwc/footer-links')->with('message-success','footer-link is added successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $link = FooterLink::find($id);
        return view('gwc.footer-links.edit',compact('link'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name_en'          => 'required|max:50|string',
            'name_ar'          => 'required|max:50|string',
            'link'             => 'required|max:255|string',
            'display_order'    => 'integer',
        ]);


        $link = FooterLink::find($id);


        $request->merge(['is_active' => !empty($request->input('is_active')) ? $request->input('is_active') : 0]);
        $link->fill($request->all())->save();

        //save logs
        $key_name   = "footer-links";
        $key_id     = $link->id;
        $message    = "A footer-links information is edited (".$link->title_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        return redirect('/gwc/footer-links')->with('message-success','Information is updated successfully');
    }

    public function destroy($id)
    {
        if(empty($id)){
            return redirect('/gwc/footer-links')->with('message-error','Param ID is missing');
        }

        $link = FooterLink::find($id);
        if(empty($link->id)){
            return redirect('/gwc/footer-links')->with('message-error','No record found');
        }

        //save logs
        $key_name   = "footer-links";
        $key_id     = $link->id;
        $message    = "Record is removed for footer-links (".$link->name_en.")";
        $created_by = Auth::guard('admin')->user()->id;
        Common::saveLogs($key_name,$key_id,$message,$created_by);
        //end save logs

        $link->delete();
        return redirect()->back()->with('message-success','footer-link is deleted successfully');
    }
}
