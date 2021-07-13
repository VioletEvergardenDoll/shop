<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>我的购物车-小米商城</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
		<script src="{{ asset('js/jquery.min.js' )}}" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	<!-- start header -->
	<!--end header -->

<!-- start banner_x -->
		<div class="banner_x center">
			<a href="/front/index" ><div class="logo fl"></div></a>
			
			<div class="wdgwc fl ml40">我的购物车</div>
			<div class="wxts fl ml20">温馨提示：产品是否购买成功，以最终下单为准哦，请尽快结算</div>
			<div class="dlzc fr">
				<ul>
					@if(session("frontuser"))
						<li>欢迎：{{session("frontuser")}}</li>
						<li><a href="{{ URL('/front/outLogin') }}" >注销</a></li>
					@else
						<li><a href="{{ URL('/front/login') }}">登录</a></li>
					@endif
					<li>|</li>
					<li><a href="{{ URL('/front/reg') }}" target="_blank" >注册</a></li>
				</ul>
				
			</div>
			<div class="clear"></div>
		</div>
		<div class="xiantiao"></div>
		@if(session("frontuser"))
		<div class="gwcxqbj">
			<div class="gwcxd center">
				<div class="top2 center">
					<div class="sub_top fl">
						<input type="checkbox" value="quanxuan" class="quanxuan" />全选
					</div>
					<div class="sub_top fl">商品名称</div>
					<div class="sub_top fl">单价</div>
					<div class="sub_top fl">数量</div>
					<div class="sub_top fl">小计</div>
					<div class="sub_top fr">操作</div>
					<div class="clear"></div>
				</div>
				@foreach( $carts as $k =>$v )
				<div class="content2 center">
					<div class="sub_content fl ">
						<input onclick="changeChecked(this,{{ $v->id }})" class="checkbox" type="checkbox" {{ $v->checked == 1 ? 'checked' : " " }} value="quanxuan" class="quanxuan" />
					</div>
					<div class="sub_content fl"><img style="width: 100%; height: 100%;" src='{{ URL("$v->pic") }}'></div>
					<div class="sub_content fl ft20">{{ $v->goodsname }}</div>
					<div class="sub_content fl ">{{ $v->price }}元</div>
					<div class="sub_content fl">
						<input class="shuliang" type="text" value="{{ $v->num }}" disabled >
					</div>
					<div class="sub_content fl">{{ $v->price * $v->num}}元</div>
					<div class="sub_content fl"><a onclick="cartDel({{ $v->id }})">×</a></div>
					<div class="clear"></div>
				</div>
				@endforeach
			</div>
			<div class="jiesuandan mt20 center">
				<div class="tishi fl ml20">
					<ul>
						<li><a href="/front/list">继续购物</a></li>
						<li>|</li>
						<li>共<span>2</span>件商品，已选择<span>1</span>件</li>
						<div class="clear"></div>
					</ul>
				</div>
				<div class="jiesuan fr">
					<div class="jiesuanjiage fl">合计（不含运费）：<span>{{ $totalPrice }}</span></div>
					<div class="jsanniu fr">
							<input class="jsan" onclick="conform()" type="submit" name="jiesuan"  value="去结算"/></div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			
		</div>
		@else
			请先去登录
		@endif
		
		<script>
			//结算
			function conform(){
				//获取 所有的购物车信息的状态，判断是否至少有一个是true
				var checkes = $(".checkbox"); //true
				for(var i = 0; i<checkes.length; i++){
					if(checkes[i].checked){
						window.location.href= "/front/conform";
						return;
					}
				}
			}
			//更改购物车信息的状态
			function changeChecked(e,id){
				var checked = e.checked ? 1 : 0;
				$.ajax({
					url:"/front/cartUpdate",
					type:"post",
					data:{
						_token:"{{ csrf_token() }}",
						checked,
						id,
					},
					success(res){
						res = JSON.parse(res);
						if(res){
							//删除成功
							//重新加载页面
							location.reload();
						}else{
							//删除失败
							
						}
					}
				})
			}
			//执行购物车删除
			function cartDel(id){
				$.ajax({
					url:"/front/cartDel",
					type:"post",
					data:{
						_token:"{{ csrf_token() }}",
						id
					},
					success(res){
						res = JSON.parse(res);
						if(res){
							//删除成功
							//重新加载页面
							alert("删除成功");
							location.reload();
						}else{
							//删除失败
							
						}
					}
				})
			}
		</script>
	<!-- footer -->
	<footer class="center">
			
			<div class="mt20">小米商城|MIUI|米聊|多看书城|小米路由器|视频电话|小米天猫店|小米淘宝直营店|小米网盟|小米移动|隐私政策|Select Region</div>
			<div>©mi.com 京ICP证110507号 京ICP备10046444号 京公网安备11010802020134号 京网文[2014]0059-0009号</div> 
			<div>违法和不良信息举报电话：185-0130-1238，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试</div>
		</footer>

	</body>
</html>

