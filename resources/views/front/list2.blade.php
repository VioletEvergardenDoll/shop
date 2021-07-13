@extends('common.front')
@section('title','二级商品列表')
@section('body')
			<div class="peijian w">
				@foreach( $allCates  as $k => $v)
				<!-- 当前一级分类名称 -->
					<div class="biaoti center">{{ $v->typename }}</div>
				<div class="main center">
					<div class="content">
						<!-- 循环商品信息 -->
						<!-- <div class="remen fl"><a href=""><img src="./image/peijian1.jpg"></a> </div>-->
						
								@foreach( $v->goods as $k1 => $v1 )
									<div class="remen fl">
										@if( $v1->status == 1 )
											<div class="xinpin"><span>新品</span></div>
										@else
											<div class="xinpin"><span>热卖</span></div>
										@endif
										<div class="tu"><a href='{{ URL("/front/detail/$v1->id") }}'><img style="width: 180px; height: 150px;" src='{{ asset("{$v1->pic}") }}'></a></div>
										<div class="miaoshu"><a href="">{{ $v1->goodsname }}</a></div>
										<div class="jiage">{{ $v1->price }}元</div>
										<div class="pingjia">372人评价</div>
										<div class="piao">
											<a href="">
												<span>发货速度很快！很配小米6！</span>
												<span>来至于mi狼牙的评价</span>
											</a>
										</div>
									</div>
						        @endforeach
						
						<div class="clear"></div>
					</div>				
				</div>
				@endforeach
			</div>
			<div class="clear"></div>
@endsection