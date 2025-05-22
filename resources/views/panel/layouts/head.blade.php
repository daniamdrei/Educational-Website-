<head><base href="">
		<meta charset="utf-8" />
	    <title>{{ $title?? __('translate.app_name') }}</title>
		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->

      <meta name="csrf-token" content="{{ csrf_token() }}">
		 <!--begin::Page Vendors Styles(used by this page)-->
    @stack('panel_css')
    <!--end::Page Vendors Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->


    @if(app()->isLocale('ar'))
        <link href="{{ asset('assets/css/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/style.bundle.rtl.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/themes/layout/header/base/light.rtl.min.css') }}" rel="stylesheet"type="text/css"/>
        <link href="{{ asset('assets/css/themes/layout/header/menu/light.rtl.min.css') }}" rel="stylesheet"type="text/css"/>
        <link href="{{ asset('assets/css/themes/layout/brand/dark.rtl.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/themes/layout/aside/dark.rtl.min.css') }}" rel="stylesheet" type="text/css"/>

    @else
        <link href="{{ asset('assets/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/prismjs.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/style.bundle.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/themes/layout/header/base/light.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/themes/layout/header/menu/light.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/themes/layout/brand/dark.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/themes/layout/aside/dark.min.css') }}" rel="stylesheet" type="text/css"/>

    @endif

	</head>
