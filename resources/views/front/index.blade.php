@extends('common.front')
@section('title','小米商城')
	<link rel="stylesheet" type="text/css" href="{{asset('css/cc.css')}}">
<style>
	#arr span{ width:40px; height:40px; position:absolute; left:5px; top:50%; margin-top:-20px; background:#000; cursor:pointer; line-height:40px; text-align:center; font-weight:bold; font-family:'黑体'; font-size:30px; color:#fff; opacity:0.3; border:1px solid #fff;}
	#arr #right{right:5px; left:auto;}
</style>
@section('body')

		

		<div class="banner_y center">
			<div class="cc ">
				<div class="right f2 ">
					<div class="all" id='all'>
						<div class="screen" id="screen">
							<ul id="ul">
			
								<li><img src="{{asset('images/1.jpg')}}" width="1000" height="460" /></li>
								<li><img src="{{asset('images/2.jpg')}} " width="1000" height="460" /></li>
								<li><img src="{{asset('images/4.jpg')}} " width="1000" height="460" /></li>
								<li><img src="{{asset('images/5.jpg')}} " width="1000" height="460" /></li>
							</ul>
							<ol>
			
							</ol>
							<div id="arr"><span id="left"><</span><span id="right">></span></div>
						</div>
					</div>
				</div>
			<div class="nav">				
				<ul>
					<!-- 所有分类遍历开始 -->
					@foreach( $allCates as $k => $v )
						<li>
							<!-- 一级分类名称 -->
							<a href="/front/list1/{{$v->id}}">{{ $v->typename }}</a>
							<div class="pop">
								<div class="left fl">
									<!-- 二级分类列表 -->
									@foreach( $v->children as $k1 => $v1 )
										<div>
											<div class="xuangou_left fl">
												<a href='{{ URL("/front/list2/$v1->id") }}'>
													<div class="img fl"><img src='' alt=""></div>
													<span class="fl">{{ $v1->typename }}</span>
													<div class="clear"></div>
												</a>
											</div>
											<div class="xuangou_right fr"><a href='{{ URL("/front/list2/$v1->id") }}' target="_blank">选购</a></div>
											<div class="clear"></div>
										</div>
									@endforeach
										<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
		</div>	

	<!-- end banner -->

	<!-- start danpin -->
		<div class="danpin center">
			
			<div class="biaoti center">热卖商品</div>
			<div class="main center">
				@foreach($best as $k => $v)
				<div class="mingxing fl">
					<div class="sub_mingxing"><a href='{{URL("/front/detail/$v->id")}}'><img src="{{ asset($v->pic) }}" alt=""></a></div>
					<div class="pinpai"><a href='{{URL("/front/detail/$v->id")}}'>{{$v->goodsname}}</a></div>
					<div class="youhui">5月9日-21日享花呗12期分期免息</div>
					<div class="jiage">{{$v->price}}元起</div>
				</div>
				@endforeach
				<div class="clear"></div>
			</div>
		</div>
		<div class="peijian w">
			 <!-- 当前一级分类名称 -->
				<div class="biaoti center">{{ $cates->typename }}</div>
			<div class="main center">
				<div class="content">
					<!-- 循环商品信息 -->
					<!-- <!-- <div class="remen fl"><a href=""><img src="./image/peijian1.jpg"></a> </div> -->
					
					@foreach( $cates->children as $k => $v)
						@foreach( $v->children as $k1 => $v1)
							@foreach( $v1->goods as $k2 => $v2 )
								<div class="remen fl">
									@if( $v2->status == 1 )
										<div class="xinpin"><span>新品</span></div>
									@else
										<div class="xinpin"><span>热卖</span></div>
									@endif
									<div class="tu"><a href='{{ URL("/front/detail/$v2->id") }}'><img style="width: 180px; height: 150px;" src='{{ asset("{$v2->pic}") }}'></a></div>
									<div class="miaoshu"><a href="">{{ $v2->goodsname }}</a></div>
									<div class="jiage">{{ $v2->price }}元</div>
									<div class="pingjia">372人评价</div>
									<div class="piao">
										<a href="">
											<span>发货速度很快！很配小米6！</span>
											<span>来至于mi狼牙的评价</span>
										</a>
									</div>
								</div>
					        @endforeach
						@endforeach
					@endforeach
					<div class="clear"></div>
				</div>				
			</div>
		</div>
		<script src="{{ asset('js/script.js' )}}" type="text/javascript" charset="utf-8"></script>
@endsection