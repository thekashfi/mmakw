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

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
