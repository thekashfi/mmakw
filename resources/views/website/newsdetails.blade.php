@extends('website.layout')

@section('title', app()->getLocale()=="en" ? $newsdetails->title_en : $newsdetails->title_ar)
@section('description', app()->getLocale()=="en" ? $newsdetails->seo_description_en : $newsdetails->seo_description_ar)
@section('abstract', app()->getLocale()=="en" ? $newsdetails->seo_description_en : $newsdetails->seo_description_ar)
@section('keywords', app()->getLocale()=="en" ? $newsdetails->seo_keywords_en : $newsdetails->seo_keywords_ar)

@section('content')

<!-- subheader -->
<section id="subheader" data-speed="8" data-type="background" style="background:url({{url('assets/images/slider/slide-3.jpg')}}) no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>???</h1>
                <ul class="crumb">
                    <li><a href="{{url('')}}">{{__('webMessage.home')}}</a></li>
                    <li class="sep">/</li>
                    <li>Careers</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- subheader close -->

<!-- content begin -->
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-read">
                    <div class="post-content">
                        <div class="post-image">
                            @if($newsdetails->image)
                                <img alt="" src="{{url('uploads/newsevents/'.$newsdetails->image)}}">
                            @endif
                        </div>

                        <div class="date-box">
                            <div class="day">{{ $newsdetails->created_at->format('d') }}</div>
                            <div class="month">{{ strtoupper($newsdetails->created_at->format('M')) }}</div>
                        </div>

                        <div class="post-text" {!! app()->getLocale() == 'ar' ? 'style="padding-left: 0; padding-right: 100px"' : '' !!}>
                            <h2><a href="#">{{ app()->getLocale()=="en" ? $newsdetails->title_en : $newsdetails->title_ar }}</a></h2>

                            {!! app()->getLocale()=="en" ? $newsdetails->details_en : $newsdetails->details_ar !!}

                        </div>
                    </div>

                    <div class="post-meta">
{{--                        <span><i class="fa fa-user id-color"></i>By: <a href="#">Lynda Wu</a></span>--}}
                        @if($newsdetails->category)
                            <span><i class="fa fa-tag id-color"></i><a href="{{url('/news')}}?cat={{ $newsdetails->category->slug }}">{{ $newsdetails->category["name_" . app()->getLocale()] }}</a></span>
                        @endif
                        <span><i class="fa fa-comment id-color"></i><a href="#">10 Comments</a></span>
                    </div>

                    <div class="spacer-single"></div>

                    <div id="blog-comment">
                        <h3>Comments (5)</h3>

                        <div class="spacer-half"></div>

                        <ol>
                            <li>
                                <div class="avatar">
                                    <img src="images/avatar.jpg" alt="" /></div>
                                <div class="comment-info">
                                    <span class="c_name">John Smith</span>
                                    <span class="c_date id-color">8 August 2018</span>
                                    <span class="c_reply"><a href="#">Reply</a></span>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem   accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt   explicabo.</div>
                                <ol>
                                    <li>
                                        <div class="avatar">
                                            <img src="images/avatar.jpg" alt="" /></div>
                                        <div class="comment-info">
                                            <span class="c_name">John Smith</span>
                                            <span class="c_date id-color">8 August 2018</span>
                                            <span class="c_reply"><a href="#">Reply</a></span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem   accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt   explicabo.</div>
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <div class="avatar">
                                    <img src="images/avatar.jpg" alt="" /></div>
                                <div class="comment-info">
                                    <span class="c_name">John Smith</span>
                                    <span class="c_date id-color">8 August 2018</span>
                                    <span class="c_reply"><a href="#">Reply</a></span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem   accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt   explicabo.</div>
                                <ol>
                                    <li>
                                        <div class="avatar">
                                            <img src="images/avatar.jpg" alt="" /></div>
                                        <div class="comment-info">
                                            <span class="c_name">John Smith</span>
                                            <span class="c_date id-color">8 August 2018</span>
                                            <span class="c_reply"><a href="#">Reply</a></span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem   accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt   explicabo.</div>
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <div class="avatar">
                                    <img src="images/avatar.jpg" alt="" /></div>
                                <div class="comment-info">
                                    <span class="c_name">John Smith</span>
                                    <span class="c_date id-color">8 August 2018</span>
                                    <span class="c_reply"><a href="#">Reply</a></span>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem   accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt   explicabo.</div>
                            </li>
                        </ol>

                        <div class="spacer-single"></div>

                        <div id="comment-form-wrapper">
                            <h3>Leave a Comment</h3>
                            <div class="comment_form_holder">
                                <form id="contact_form" name="form1" method="post" action="#">

                                    <label>Name</label>
                                    <input type="text" name="name" id="name" class="form-control" />

                                    <label>Email <span class="req">*</span></label>
                                    <input type="text" name="email" id="email" class="form-control" />
                                    <div id="error_email" class="error">Please check your email</div>

                                    <label>Message <span class="req">*</span></label>
                                    <textarea cols="10" rows="10" name="message" id="message" class="form-control"></textarea>
                                    <div id="error_message" class="error">Please check your message</div>
                                    <div id="mail_success" class="success">Thank you. Your message has been sent.</div>
                                    <div id="mail_failed" class="error">Error, email not sent</div>

                                    <p id="btnsubmit">
                                        <input type="submit" id="send" value="Send" class="btn btn-line" /></p>



                                </form>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <div id="sidebar" class="col-md-4">
                <div class="widget widget-post">
                    <h4>{{__('webMessage.recent_posts')}}</h4>
                    <div class="small-border"></div>
                    <ul>
                        @foreach(\App\NewsEvents::where("is_active","1")->orderBy('news_date', 'desc')->take(5)->get() as $post)
                            <li><a href="{{url('newsdetails/'.$post->slug)}}">{{ app()->getLocale()=="en" ? $post->title_en : $post->title_ar }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="widget widget-text">
                    <h4>{{__('webMessage.aboutus')}}</h4>
                    <div class="small-border"></div>
                    {{app()->getLocale() == 'en' ? $settingInfo->footer_about_en : $settingInfo->footer_about_ar}}
                </div>
                @if(count($news_categories))
                    <div class="widget widget_tags">
                        <h4>{{__('webMessage.tags')}}</h4>
                        <div class="small-border"></div>
                        <ul>
                            @foreach($news_categories as $cat)
                                <li><a href="{{url('/news')}}?cat={{ $cat->slug }}">{{ $cat["name_" . app()->getLocale()] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>