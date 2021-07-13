@extends('common.common')
@section('title','订单管理')
@section('body')
		<div class="x-nav">
			<span class="layui-breadcrumb">
				<a href="">首页</a>
				<a href="">演示</a>
				<a>
					<cite>导航元素</cite></a>
			</span>
			<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
				<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
			</a>
		</div>
		<div class="layui-fluid">
			<div class="layui-row layui-col-space15">
				<div class="layui-col-md12">
					<div class="layui-card">
						<div class="layui-card-body ">
							<form class="layui-form layui-col-space5">
								<div class="layui-input-inline layui-show-xs-block">
									<input class="layui-input" placeholder="开始日" name="start" id="start"></div>
								<div class="layui-input-inline layui-show-xs-block">
									<input class="layui-input" placeholder="截止日" name="end" id="end"></div>
								<div class="layui-input-inline layui-show-xs-block">
									<select name="contrller">
										<option>支付方式</option>
										<option>支付宝</option>
										<option>微信</option>
										<option>货到付款</option></select>
								</div>
								<div class="layui-input-inline layui-show-xs-block">
									<select name="contrller">
										<option value="">订单状态</option>
										<option value="0">待确认</option>
										<option value="1">已确认</option>
										<option value="2">已收货</option>
										<option value="3">已取消</option>
										<option value="4">已完成</option>
										<option value="5">已作废</option></select>
								</div>
								<div class="layui-input-inline layui-show-xs-block">
									<input type="text" name="username" placeholder="请输入订单号" autocomplete="off" class="layui-input"></div>
								<div class="layui-input-inline layui-show-xs-block">
									<button class="layui-btn" lay-submit="" lay-filter="sreach">
										<i class="layui-icon">&#xe615;</i></button>
								</div>
							</form>
						</div>
						<div class="layui-card-header">
							<button class="layui-btn layui-btn-danger" onclick="delAll()">
								<i class="layui-icon"></i>批量删除</button>
							<!-- <button class="layui-btn" onclick="xadmin.open('添加用户','./order-add.html',800,600)">
								<i class="layui-icon"></i>添加</button></div> -->
						<div class="layui-card-body ">
							<table class="layui-table layui-form">
								<thead>
									<tr>
										<th>
											<input type="checkbox" name="" lay-skin="primary">
										</th>
										<th>编号</th>
										<th>会员名称</th>
										<th>收件人</th>
										<th>收货地址</th>
										<th>联系方式</th>
										<th>总价</th>
										<th>总数量</th>
										<th>状态</th>
										<th>订单时间</th>
										<th>操作</th>
								</thead>
								<tbody>
									@foreach($orders as $k => $v)
									<tr id='id{{ $v->id }}' >
										<td>
											<input type="checkbox" name="" lay-skin="primary">
										</td>
										<td>{{ $v->id }}</td>
										<td>{{ $v->name }}</td>
										<td>{{ $v->username }}</td>
										<td>{{ $v->address }}</td>
										<td>{{ $v->phone }}</td>
										<td>{{ $v->totalPrice }}</td>
										<td>{{ $v->totalNum }}</td>
										<td>
											@if( $v->status == 1 )
												<a href="" class="btn btn-link">新订单</a>
											@elseif($v->status == 2)
												<a href="" class="btn btn-link">待收货</a>
											@else
												<a href="" class="btn btn-link">订单完成</a>
											@endif
										</td>
										<td>{{ date("Y-m-d H:i:s",$v->ctime ) }}</td>
										<td>
											@if($v->status == 3 )
												<a title="编辑" style="pointer-events: none;cursor: default;color:gray;" class="layui-btn layui-btn-warm"
												onclick="xadmin.open('编辑','/order/edit/{{ $v->id }}')" href="javascript:;">修改</a>
											@else
												<a title="编辑" class="layui-btn layui-btn-warm "
												onclick="xadmin.open('编辑','/order/edit/{{ $v->id }}')" >修改</a>
											 @endif
												<a href='{{ URL("/detail/$v->id") }}' class="layui-btn  layui-btn-normal">详情</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="layui-card-body ">
							<div class="page">
								<div>
									{{ $orders->links() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>layui.use(['laydate', 'form'],
		    function() {
		        var laydate = layui.laydate;
				
		        //执行一个laydate实例
		        laydate.render({
		            elem: '#start' //指定元素
		        });
				
		        //执行一个laydate实例
		        laydate.render({
		            elem: '#end' //指定元素
		        });
		    });
			
			 

			
			/*用户-删除*/
			function member_del(obj,id){
			    layer.confirm('确认要删除吗？',function(index){
			        //发异步删除数据
			        $.ajax({
			        	//反隐  ` `   url:`{{URL('/type')}}/${id}`    419错误是令牌没传
			        	url:"/trolley/"+id,//服务器地址
			        	type:"post",//请求方式
			        	data:{//传递的参数
			        		_token:"{{ csrf_token() }}",
			        		_method:"delete"
			        	},
			        	success(res){
			        		//将json串转换为json对象
			        		var obj = JSON.parse(res);
			        		if(obj.code == 1000){
			        			//删除成功
			        			layer.msg('已删除!',{icon:1,time:1000});
			        			$('#id'+id).remove();
			        			location.reload();
			        		}else{
			        			//删除失败
			        			layer.msg('删除失败!',{icon:1,time:1000});
			        		}
			        	}
			        })
			    });
			}
				
		    function delAll(argument) {
				
		        var data = tableCheck.getData();
				
		        layer.confirm('确认要删除吗？' + data,
		        function(index) {
		            //捉到所有被选中的，发异步进行删除
		            layer.msg('删除成功', {
		                icon: 1
		            });
		            $(".layui-form-checked").not('.header').parents('tr').remove();
		        });
		    }</script>
@endsection