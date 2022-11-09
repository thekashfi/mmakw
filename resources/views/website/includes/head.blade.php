<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{url('new_assets')}}/images/icon.png" type="image/gif" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@if(app()->getLocale()=="en") {{$settingInfo->name_en}} @else {{$settingInfo->name_ar}} @endif</title>

    <meta name="description" content="@if(app()->getLocale()=="en") {{$settingInfo->seo_description_en}} @else {{$settingInfo->seo_description_ar}} @endif" />
    <meta name="abstract" content="@if(app()->getLocale()=="en") {{$settingInfo->seo_description_en}} @else {{$settingInfo->seo_description_ar}} @endif">
    <meta name="keywords" content="@if(app()->getLocale()=="en") {{$settingInfo->seo_keywords_en}} @else {{$settingInfo->seo_keywords_ar}} @endif" />
    <meta name="Copyright" content="{{$settingInfo->name_en}}, Kuwait Copyright 2020 - {{date('Y')}}" />
    <meta name="author" content="Gulfweb Web Design, Kuwait" />
    <META NAME="Designer" CONTENT="Gulfweb Web Design Kuwait">
    <meta name="Country" content="Kuwait" />
    <META NAME="city" CONTENT="Kuwait City">
    <META NAME="Language" CONTENT="English">
    <META NAME="Geography" CONTENT="@if(app()->getLocale()=="en") {{$settingInfo->address_en}} @else {{$settingInfo->address_ar}} @endif">
    <META NAME="Revisit-After" CONTENT="2 days">
    <meta name="robots" CONTENT="all">
    <META NAME="distribution" CONTENT="Global">

    <!-- CSS Files
    ================================================== -->
    <link href="{{url('new_assets')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap" />
    <link href="{{url('new_assets')}}/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css" id="bootstrap-grid" />
    <link href="{{url('new_assets')}}/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css" id="bootstrap-reboot" />
    <link href="{{url('new_assets')}}/css/plugins.css" rel="stylesheet" type="text/css">
    <link href="{{url('new_assets')}}/css/style.css" rel="stylesheet" type="text/css">
    <link href="{{url('new_assets')}}/css/color.css" rel="stylesheet" type="text/css">

    <!-- custom background -->
    <link rel="stylesheet" href="{{url('new_assets')}}/css/bg.css" type="text/css">

    <!-- color scheme -->
    <link rel="stylesheet" href="{{url('new_assets')}}/css/colors/blue.css" type="text/css" id="colors">

    <!-- revolution slider -->
    <link rel="stylesheet" href="{{url('new_assets')}}/rs-plugin/css/settings.css" type="text/css">
    <link rel="stylesheet" href="{{url('new_assets')}}/css/rev-settings.css" type="text/css">

    <!-- custom font -->
    <link rel="stylesheet" href="{{url('new_assets')}}/css/font-style-2.css" type="text/css">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>
