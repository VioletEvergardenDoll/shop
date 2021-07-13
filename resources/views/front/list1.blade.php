@extends('common.front')
@section('title','一级商品列表')
@section('body')
			<div class="peijian w">
				<!-- 当前一级分类名称 -->
					<div class="biaoti center"></div>
				<div class="main center">
					<div class="content">
						<!-- 循环商品信息 -->
						<!-- <div class="remen fl"><a href=""><img src="./image/peijian1.jpg"></a> </div>-->
						
						@foreach( $allCates as $k1 => $v1)
							@foreach( $v1->children as $k2 => $v2)
								@foreach( $v2->goods as $k3 => $v3 )
									<div class="remen fl">
										@if( $v3->status == 1 )
											<div class="xinpin"><span>新品</span></div>
										@else
											<div class="xinpin"><span>热卖</span></div>
										@endif
										<div class="tu"><a href='{{ URL("/front/detail/$v3->id") }}'><img style="width: 180px; height: 150px;" src='{{ asset("{$v3->pic}") }}'></a></div>
										<div class="miaoshu"><a href="">{{ $v3->goodsname }}</a></div>
										<div class="jiage">{{ $v3->price }}元</div>
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
			<div class="clear"></div>
@endsection