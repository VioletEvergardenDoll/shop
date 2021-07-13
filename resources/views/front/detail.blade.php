@extends('common.front')
@section('title','小米商城')
@section('body')
	<!-- xiangqing -->
	<form action="post" method="">
	<div class="xiangqing">
		<div class="neirong w">
			<div class="xiaomi6 fl">{{ $goods->goodsname }}</div>
			<nav class="fr">
				<li><a href="">概述</a></li>
				<li>|</li>
				<li><a href="">变焦双摄</a></li>
				<li>|</li>
				<li><a href="">设计</a></li>
				<li>|</li>
				<li><a href="">参数</a></li>
				<li>|</li>
				<li><a href="">F码通道</a></li>
				<li>|</li>
				<li><a href="">用户评价</a></li>
				<div class="clear"></div>
			</nav>
			<div class="clear"></div>
		</div>	
	</div>
	
	<div class="jieshao mt20 w">
		<div class="left fl"><img  style="width: 100%; height: 100%;" src='{{ URL("$goods->pic") }}'></div>
		<div class="right fr">
			<div class="h3 ml20 mt20">{{ $goods->goodsname }}</div>
			<div class="jianjie mr40 ml20 mt10">变焦双摄，4 轴防抖 / 骁龙835 旗舰处理器，6GB 大内存，最大可选128GB 闪存 / 5.15" 护眼屏 / 四曲面玻璃/陶瓷机身</div>
			<div class="jiage ml20 mt10">2499.00元</div>
			<div class="ft20 ml20 mt20">选择版本</div>
			<div class="xzbb ml20 mt10">
				<div class="banben fl">
					<a>
						<span>全网通版 6GB+64GB </span>
						<span>2499元</span>
					</a>
				</div>
				<div class="banben fr">
					<a>
						<span>全网通版 6GB+128GB</span>
						<span>2899元</span>
					</a>
				</div>
				<div class="clear"></div>
			</div>
			<div class="ft20 ml20 mt20">选择颜色</div>
			<div class="xzbb ml20 mt10">
				<div class="banben">
					<a>
						<span class="yuandian"></span>
						<span class="yanse">亮黑色</span>
					</a>
				</div>
				
			</div>
			<div class="xqxq mt20 ml20">
				<div class="top1 mt10">
					<div class="left1 fl">小米6 全网通版 6GB内存 64GB 亮黑色</div>
					<div class="right1 fr">2499.00元</div>
					<div class="clear"></div>
				</div>
				<div class="bot mt20 ft20 ftbc">总计：{{ $goods->price }}</div>
			</div>
			<div class="xiadan ml20 mt20">
					<input class="jrgwc"  type="button" name="jrgwc" value="立即选购" onclick="addOrder( {{ $goods->id }} )"/>
					<input class="jrgwc" onclick="addCart( {{ $goods->id }} )" type="button" name="jrgwc" value="加入购物车" />
				
			</div>
		</div>
		<div class="clear"></div>
	</div>
	</form>
	<script>
		function addCart(goodsid){
			//1.判断当前是否登录
			var username = "{{ session('frontuser') }}" || null;
			if(username == null){
				//说明为登录
				alert("请您先进行登录");
				return;
			}
			$.ajax({
				url:"/front/addCart",//服务器地址
				type:"post",
				data:{
					_token:"{{ csrf_token() }}",
					goodsid,
					username
				},
				success(res){
					var obj = JSON.parse(res);
					if(obj){
						alert("加入购物车成功！");
						window.location.href="/front/cart";
					}
					else{
						alert("加入购物车失败！");
					}
					// console.log(res);
				}
			})
		}
	
	</script>
@endsection