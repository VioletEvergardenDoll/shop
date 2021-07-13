<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="stylesheet" href="{{ asset('css/font.css') }}">
        <link rel="stylesheet" href="{{ asset('css/xadmin.css') }}">
		<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{ asset('lib/layui/layui.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('js/xadmin.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/dj.js') }}"></script>
		
		<!-- <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script> -->
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
		
		@section('body')
		
		@show
	<!-- <script src="{{asset('js/spotLine.js')}}" type="text/javascript" charset="utf-8"></script>	 -->
	</body>
</html>