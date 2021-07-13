<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>结算-小米商城</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
		<script src="{{ asset('js/jquery.min.js' )}}" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	<!-- start header -->
	<!--end header -->

<!-- start banner_x -->
		<div class="banner_x center">
			<a href="/front/index" target="_blank"><div class="logo fl"></div></a>
			
			<div class="wdgwc fl ml40">结算</div>
			<div class="wxts fl ml20">温馨提示：产品是否购买成功，以最终下单为准哦，请尽快结算</div>
			<div class="dlzc fr">
				<ul>
					@if(session("frontuser"))
						<li>欢迎：{{session("frontuser")}}</li>
						<li><a href="{{ URL('/front/outLogin') }}" >注销</a></li>
					@else
						<li><a href="{{ URL('/front/login') }}" >登录</a></li>
					@endif
					<li>|</li>
					<li><a href="{{ URL('/front/reg') }}" target="_blank" >注册</a></li>
				</ul>
				
			</div>
			<div class="clear"></div>
		</div>
		<div class="xiantiao"></div>
		@if(session("frontuser"))
		<form action="{{ URL('/front/orderAdd')}}" method="post">
			{{ csrf_field() }}
			<div class="gwcxqbj">
				<div class="gwcxd center">
					<input type="hidden" id="totalPrice" name="totalPrice" value="{{ $totalPrice }}">
					<input type="hidden" id="totalNum" name="totalNum" value="{{ $totalNum }}">
					<div class="form-group">
					  <label for="num" class="col-sm-2 control-label">收件人：</label>
					  <!-- <div class="col-sm-10"> </div>-->
					    <input type="text" class="form-control" id="username" name="username" placeholder="收件人">
					  
					</div>
					<div class="form-group">
					  <label for="price" class="col-sm-2 control-label">收件地址：</label>
					  
					    <input type="text" class="form-control" id="address" name="address" placeholder="收件地址">

					</div>
					
					<div class="form-group">
					  <label for="desc" class="col-sm-2 control-label">联系方式：</label>

					    <input type="text" class="form-control" id="phone" name="phone" placeholder="联系方式">

					</div>
				</div>
				<!-- 购买循环操作 -->
				<div class="gwcxd center">
					@foreach( $carts as $k =>$v )
					<div class="content2 center">
						<div class="sub_content fl"><img style="width: 100%; height: 100%;" src='{{ URL("$v->pic") }}'></div>
						<div class="sub_content fl ">{{ $v->price }}元</div>
						<div class="sub_content fl">{{ $v->goodsname }}</div>
						<div class="sub_content fl">
							{{ $v->num }}
						</div>
						<div class="sub_content fl">{{ $v->price * $v->num}}元</div>
						<div class="clear"></div>
					</div>
					@endforeach
				</div>
				<div class="jiesuandan mt20 center">
					<div class="tishi fl ml20">
						<ul>
							<li><a href="{{ URL('/list') }}">继续购物</a></li>
							<li>|</li>
							<li>共<span>{{ $totalNum }}</span>件商品，已选择<span>1</span>件</li>
							<div class="clear"></div>
						</ul>
					</div>
					<div class="jiesuan fr">
						<div class="jiesuanjiage fl">合计（不含运费）：<span>{{ $totalPrice }}</span></div>
						<div class="jsanniu fr">
								<input class="jsan"  type="submit" name="jiesuan"  value="下单"/></div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				
			</div>
			@else
				请先去登录
			@endif
		</form>	
       	<div class="clear"></div>
		
			
	<!-- footer -->
	<footer class="center">
			
			<div class="mt20">小米商城|MIUI|米聊|多看书城|小米路由器|视频电话|小米天猫店|小米淘宝直营店|小米网盟|小米移动|隐私政策|Select Region</div>
			<div>©mi.com 京ICP证110507号 京ICP备10046444号 京公网安备11010802020134号 京网文[2014]0059-0009号</div> 
			<div>违法和不良信息举报电话：185-0130-1238，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试</div>
		</footer>

	</body>
</html>

