<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>后台登录</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('css/xadmin.css') }}">
	<link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('lib/layui/layui.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('js/xadmin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dj.js') }}"></script>
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style>
	*{
		margin: 0px;
		padding: 0px;
	}
	video{
		position: fixed;  
	    right: 0px;  
	    bottom: 0px;  
	    min-width: 100%;  
	    min-height: 100%;  
	    height: 100%;  
	    width: 100%;  
	    /*加滤镜*/
	    /*filter: blur(15px); //背景模糊设置 */
	    /*-webkit-filter: grayscale(100%);*/  
	    /*filter:grayscale(100%); //背景灰度设置*/  
	    z-index:-11;
		object-fit:fill

	}  
	source{  
	    min-width: 100%;  
	    min-height: 100%;  
	    height: auto;  
	    width: auto;  
	} 
</style>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
		<audio controls autoplay="autoplay"  loop="true" controls="controls" hidden="hidden" id="music1">
			<source src="{{  asset('images/2086.mp3')  }}" type="audio/mp3">
			<!-- <source src="{{  asset('images/2086.ogg')  }}" type="audio/ogg"> -->
			<!-- <embed height="50px" width="100px" src="{{  asset('images/2086.mp3')  }}"> -->
		</audio>
		<!-- 这是一个可以控制背景音乐播放暂停的开关 -->
		<img id="btn" class="active" src="{{  asset('images/2086.mp3')  }}" alt="" />
		
        <div class="message">欢迎管理员登录</div>
        <div id="darkbannerwrap"></div>
        
        <form method="post" class="layui-form"  action="{{ URL('/admin/doLogin') }}" >
			{{ csrf_field() }}
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>
	<video autoplay="preload" loop="loop" muted >
		<source src="{{  asset('video/梦碎.mp4')  }}" type="video/mp4"  >
	</video>
	

    <!-- 底部结束 -->
	<script>
		var audio = document.getElementById('music1');
		$("#btn").bind("touchstart", function bf() {
		
			if(audio !== null) {
			//检测播放是否已暂停.audio.paused 在播放器播放时返回false.
			//alert(audio.paused);
				if(audio.paused) {
					audio.play(); //audio.play();// 这个就是播放
					$("#btn").addClass("active")
				} else {
					audio.pause(); // 这个就是暂停
					$("#btn").removeClass("active")
				}
			}
		})
	</script>
    <script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>