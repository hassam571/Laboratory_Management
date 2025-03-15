
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
<meta name="author" content="Zoyothemes"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />

<link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />







    <title>
        @if(View::hasSection('breadcrumb_parent') && View::hasSection('breadcrumb_child'))
            @yield('breadcrumb_parent') - @yield('breadcrumb_child')
        @else
            @yield('page_title', 'LMS')
        @endif
    </title>



</head>


