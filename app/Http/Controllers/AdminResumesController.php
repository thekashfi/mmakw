<?php

namespace App\Http\Controllers;

use App\Box;
use App\Career;
use App\Mail\CVMail;
use App\Resume;
use App\ServiceCategory;
use App\Services;
use App\Settings;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AdminResumesController extends Controller
{
    public function index()
    {
        $settingInfo = Settings::where("keyname","setting")->first();
        $resumes = Resume::latest()->paginate($settingInfo->item_per_page_back);
        return view('gwc.resumes.index', compact('resumes'));
    }

    public function apply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'career_id' => 'required|integer|exists:gwc_careers,id',
            'name'      => 'nullable|max:100|string',
            'email'     => 'required|email|max:100|string',
            'message'   => 'nullable|string',
            'mobile'    => 'nullable|digits:8',
            'file'      => 'nullable|mimes:pdf,doc,docx,jpeg,png,jpg,gif,svg|max:10000',
        ]);
        if ($validator->fails()) {
            return redirect()->to(url()->previous() . "#comment-form-wrapper")
                ->withErrors($validator)
                ->withInput();
        }

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->storeAs('resumes', $fileName, 'public');
        }

        $request = new Request($request->all());
        $request->merge(['file' => $fileName, 'message' => strip_tags($request->message)]);
        $resume = Resume::create($request->all());

        $request->merge(['career' => Career::find($request->career_id)]);
        Mail::to('info@mmakw.com')->send(new CVMail($request->all()));

        return redirect()->to(url()->previous() . "#comment-form-wrapper")->with('message-success',trans('webMessage.resume_sent'));
    }

    public function show($id)
    {
        $resume = Resume::findOrFail($id);
        return view('gwc.resumes.show', compact('resume'));
    }
}
