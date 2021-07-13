<!doctype html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>商城管理系统</title>
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="stylesheet" href="{{ asset('css/font.css') }}">
        <link rel="stylesheet" href="{{ asset('css/xadmin.css') }}">
        <link rel="stylesheet" href="{{ asset('css/theme3.css')}}">
		<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{ asset('lib/layui/layui.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('js/xadmin.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/dj.js') }}"></script>
		<!-- <script src="{{asset('js/spotLine.js')}}" type="text/javascript" charset="utf-8"></script> -->
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            // 是否开启刷新记忆tab功能
            // var is_remember = false;
        </script>
    </head>
    <body class="index">
		<script type="text/javascript" src="{{ asset('js/dj.js') }}"></script>
        <!-- 顶部开始 -->
        <div class="container">
            <div class="logo">
                <a href="./index.html">商城管理系统</a></div>
            <div class="left_open">
                <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
            </div>
            <ul class="layui-nav left fast-add" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;">+新增</a>
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('最大化','http://www.baidu.com','','',true)">
                                <i class="iconfont">&#xe6a2;</i>弹出最大化</a></dd>
                        <dd>
                            <a onclick="xadmin.open('弹出自动宽高','http://www.baidu.com')">
                                <i class="iconfont">&#xe6a8;</i>弹出自动宽高</a></dd>
                        <dd>
                            <a onclick="xadmin.open('弹出指定宽高','http://www.baidu.com',500,300)">
                                <i class="iconfont">&#xe6a8;</i>弹出指定宽高</a></dd>
                        <dd>
                            <a onclick="xadmin.add_tab('在tab打开','member-list.html')">
                                <i class="iconfont">&#xe6b8;</i>在tab打开</a></dd>
                        <dd>
                            <a onclick="xadmin.add_tab('在tab打开刷新','member-del.html',true)">
                                <i class="iconfont">&#xe6b8;</i>在tab打开刷新</a></dd>
                    </dl>
                </li>
            </ul>
            <ul class="layui-nav right" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;">欢迎您：{{ session('adminuser') }}</a>
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('个人信息','http://www.baidu.com')">个人信息</a></dd>
                        <dd>
                            <a onclick="xadmin.open('切换帐号','{{URL('/admin/outLogin')}}')">切换帐号</a></dd>
                        <dd>
                            <a href="{{URL('/admin/outLogin')}}">退出</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item to-index">
                    <a href="/front/index" target="_blank">前台首页</a></li>
            </ul>
        </div>
        <!-- 顶部结束 -->
        <!-- 中部开始 -->
        <!-- 左侧菜单开始 -->
        <div class="left-nav">
            <div id="side-nav">
                <ul id="nav">
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="会员管理">&#xe6b8;</i>
                            <cite>会员管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('统计页面','welcome1.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>统计页面</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('会员列表(静态表格)','{{ URL('/member') }}')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>会员列表(静态表格)</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('会员删除','member-del.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>会员删除</cite></a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="iconfont">&#xe70b;</i>
                                    <cite>会员管理</cite>
                                    <i class="iconfont nav_right">&#xe697;</i></a>
                                <ul class="sub-menu">
                                    <li>
                                        <a onclick="xadmin.add_tab('会员删除','member-del.html')">
                                            <i class="iconfont">&#xe6a7;</i>
                                            <cite>会员删除</cite></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="订单管理">&#xe723;</i>
                            <cite>订单管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('订单列表','{{ URL('/order') }}')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>订单列表</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('订单列表1','order-list1.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>订单列表1</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="分类管理">&#xe723;</i>
                            <cite>分类管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('多级分类','{{ URL('/type') }}')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>多级分类</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="商品管理">&#xe723;</i>
                            <cite>商品管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('商品管理列表','{{ URL('/goods') }}')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>商品管理列表</cite></a>
                            </li>
                        </ul>
                    </li>
					<li>
					    <a href="javascript:;">
					        <i class="iconfont left-nav-li" lay-tips="购物车管理">&#xe723;</i>
					        <cite>购物车管理</cite>
					        <i class="iconfont nav_right">&#xe697;</i></a>
					    <ul class="sub-menu">
					        <li>
					            <a onclick="xadmin.add_tab('购物车管理列表','{{ URL('/trolley') }}')">
					                <i class="iconfont">&#xe6a7;</i>
					                <cite>购物车管理列表</cite></a>
					        </li>
					    </ul>
					</li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="管理员管理">&#xe726;</i>
                            <cite>管理员管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('管理员列表','{{ URL('/user') }}')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>管理员列表</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="图标字体">&#xe6b4;</i>
                            <cite>图标字体</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('图标对应字体','{{ URL('/unicode') }}')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>图标对应字体</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="其它页面">&#xe6b4;</i>
                            <cite>其它页面</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="/admin/login" target="_blank">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>登录页面</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="第三方组件">&#xe6b4;</i>
                            <cite>layui第三方组件</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('滑块验证','https://fly.layui.com/extend/sliderVerify/')" target="">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>滑块验证</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('富文本编辑器','https://fly.layui.com/extend/layedit/')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>富文本编辑器</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('eleTree 树组件','https://fly.layui.com/extend/eleTree/')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>eleTree 树组件</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('图片截取','https://fly.layui.com/extend/croppers/')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>图片截取</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('formSelects 4.x 多选框','https://fly.layui.com/extend/formSelects/')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>formSelects 4.x 多选框</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('Magnifier 放大镜','https://fly.layui.com/extend/Magnifier/')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>Magnifier 放大镜</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('notice 通知控件','https://fly.layui.com/extend/notice/')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>notice 通知控件</cite></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- <div class="x-slide_left"></div> -->
        <!-- 左侧菜单结束 -->
        <!-- 右侧主体开始 -->
        <div class="page-content">
            <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
                <ul class="layui-tab-title">
                    <li class="home">
                        <i class="layui-icon">&#xe68e;</i>我的桌面</li></ul>
                <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
                    <dl>
                        <dd data-type="this">关闭当前</dd>
                        <dd data-type="other">关闭其它</dd>
                        <dd data-type="all">关闭全部</dd></dl>
                </div>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <iframe src='/welcome.html' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="page-content-bg"></div>
        <style id="theme_style"></style>
        <!-- 右侧主体结束 -->
        <!-- 中部结束 -->
        <script>//百度统计可去掉
            var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
    </body>

</html>