<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>小米商城-个人中心</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
		<script src="{{ asset('js/jquery.min.js' )}}" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="{{ asset('css/xadmin.css') }}">
	</head>
	<body>
	<!-- start header -->
		<header>
			<div class="top center">
				<div class="left fl">
					<ul>
						<li><a href="http://www.mi.com/" target="_blank">小米商城</a></li>
						<li>|</li>
						<li><a href="">MIUI</a></li>
						<li>|</li>
						<li><a href="">米聊</a></li>
						<li>|</li>
						<li><a href="">游戏</a></li>
						<li>|</li>
						<li><a href="">多看阅读</a></li>
						<li>|</li>
						<li><a href="">云服务</a></li>
						<li>|</li>
						<li><a href="">金融</a></li>
						<li>|</li>
						<li><a href="">小米商城移动版</a></li>
						<li>|</li>
						<li><a href="">问题反馈</a></li>
						<li>|</li>
						<li><a href="">Select Region</a></li>
						<div class="clear"></div>
					</ul>
				</div>
				<div class="right fr">
					<div class="gouwuche fr"><a href="{{ URL('/front/order') }}">我的订单</a></div>
					<div class="fr">
						<ul>
							@if(session("frontuser"))
								<li>欢迎：{{session("frontuser")}}</li>
								<li><a href="{{ URL('/front/outLogin') }}" >注销</a></li>
							@else
								<li><a href="{{ URL('/front/login') }}" target="_blank">登录</a></li>
							@endif
							<li>|</li>
							<li><a href="{{ URL('/front/selfinfo') }}">个人中心</a></li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</header>
	<!--end header -->
	<!-- start banner_x -->
		<div class="banner_x center">
			<a href="/front/index"><div class="logo fl"></div></a>
			<a href=""><div class="ad_top fl"></div></a>
			<div class="nav fl">
				<ul>
					<li><a href="/front/index" target="_blank">首页</a></li>
					@foreach( $firstCates as $k => $v )
						<li><a href="/front/list1/{{$v->id}}" target="_blank">{{ $v->typename }}</a></li>
					@endforeach
					<li><a href="./liebiao.html" target="_blank">社区</a></li>
				</ul>
			</div>
			<div class="search fr">
				<form action="" method="post">
					<div class="text fl">
						<input type="text" class="shuru"  placeholder="小米6&nbsp;小米MIX现货">
					</div>
					<div class="submit fl">
						<input type="submit" class="sousuo" value="搜索"/>
					</div>
					<div class="clear"></div>
				</form>
				<div class="clear"></div>
			</div>
		</div>
<!-- end banner_x -->
<!-- self_info -->
	<div class="grzxbj">
		<div class="selfinfo center">
		<div class="lfnav fl">
			<div class="ddzx">订单中心</div>
			<div class="subddzx">
				<ul>
					<li><a href="{{ URL('/front/order') }}" style="color:#ff6700;font-weight:bold;">我的订单</a></li>
					<li><a href="">意外保</a></li>
					<li><a href="">团购订单</a></li>
					<li><a href="">评价晒单</a></li>
				</ul>
			</div>
			<div class="ddzx">个人中心</div>
			<div class="subddzx">
				<ul>
					<li><a href="{{ URL('/front/selfinfo') }}">我的个人中心</a></li>
					<li><a href="">消息通知</a></li>
					<li><a href="">优惠券</a></li>
					<li><a href="">收货地址</a></li>
				</ul>
			</div>
		</div>
		<div class="rtcont fr">
			<div class="ddzxbt">交易订单</div>
			@foreach( $orders as $k => $v )
			<div class="ddxq">
				<div class="ddspt fl"><img  style="width: 100%; height: 100%;" src="../images/red30.jpg" alt=""></div>
				<div class="ddbh fl">订单号:{{ $v->id }}</div>
				<div class="ztxx fr">
					<ul>
						@if( $v->status == 1)
							<li>待发货</li>
						@elseif( $v->status == 2 )
							<li><a href="javascript:;" onclick="qrsh({{ $v->id }})">确认收货</a></li>
						@else
							<li>订单完成</li>
						@endif
						<li>{{ $v->totalPrice }}</li>
						<li>{{ date('Y-m-d H:i',$v->ctime) }}</li>
						<li><a href="/front/order_detail">订单详情></a></li>
						<div class="clear"></div>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			@endforeach
			<div class="layui-card-body ">
			    <div class="page">
			        <div>
						{{ $orders->links() }}
					</div>                                    
			    </div>
			</div>
		</div>
		<div class="clear"></div>
		</div>
	</div>
<!-- self_info -->
	<script>
		function qrsh(id){
			$.ajax({
				url:"/front/updOrder",
				type:'post',
				data:{
					id,
					_token:"{{ csrf_token() }}"
				},
				success(res){
					res = JSON.parse(res);
					location.reload();
				}
			})
		}
	</script>
		<footer class="mt20 center">			
			<div class="mt20">小米商城|MIUI|米聊|多看书城|小米路由器|视频电话|小米天猫店|小米淘宝直营店|小米网盟|小米移动|隐私政策|Select Region</div>
			<div>©mi.com 京ICP证110507号 京ICP备10046444号 京公网安备11010802020134号 京网文[2014]0059-0009号</div> 
			<div>违法和不良信息举报电话：185-0130-1238，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试</div>
		</footer>
	</body>
</html>