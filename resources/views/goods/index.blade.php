@extends('common.common')
@section('title','商品管理列表')
<style>
	img{
		width: 40px;
		height: 40px;
		/* 圆角 */
		border-radius: 40px;
	}
</style>
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
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="开始日" name="start" id="start">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="截止日" name="end" id="end">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="text" name="username"  placeholder="请输入商品名称" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-header">
                            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
							<button class="layui-btn" onclick="xadmin.open('添加商品','{{ URL('/goods/create') }}',600,400)"><i class="layui-icon"></i>增加</button>
                        </div>
                        <div class="layui-card-body ">
							<table class="layui-table layui-form">
							  <thead>
								<tr>
								  <th>
									<input type="checkbox" name="" lay-skin="primary">
								  </th>
								  <th>编号</th>
								  <th>商品名称</th>
								  <th>商品描述</th>
								  <th>商品价格</th>
								  <th>商品图片</th>
								  <th>商品数量</th>
								  <th>商品状态</th>
								  <th>类别</th>
								  <th>添加时间</th>
								  <th>操作</th>
							  </thead>
							  <tbody class="x-cate">
								  @foreach( $goods as $k=>$v )
								<tr id='id{{ $v->id }}' >
								  <td>
									<input type="checkbox" name="" lay-skin="primary">
								  </td>
								  <td>{{ $v->id }}</td>
								  <td>{{ $v->goodsname }}</td>
								  <td>{{ $v->desc }}</td>
								  <td>{{ $v->price }}</td>
								  <td>
									  <img src='{{ asset("{$v->pic}") }}' alt="">
								  </td>
								  <td>{{ $v->num }}</td>
								  <td>
									  @if($v->status == 1)
										新品
									  @elseif($v->status == 2)
										热卖
									  @elseif($v->status == 0)
										下架
									  @else
										商品状态出现错误，请联系客服！
									  @endif
								  </td>
								  <td>{{ $v->typename }}</td>
								  <td>{{ date('Y-m-d H:i:s',$v->ctime) }}</td>
								  <td class="td-manage">
									<button class="layui-btn layui-btn layui-btn-xs"  onclick="xadmin.open('编辑','{{ URL("/goods/{$v->id}/edit") }}')" >
										<i class="layui-icon">&#xe642;</i>编辑
										</button>
									<button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,{{ $v->id }},'{{ $v->pic }}')" href="javascript:;" >
										<i class="layui-icon">&#xe640;</i>删除
									</button>
								  </td>
								</tr>
								@endforeach
							  </tbody>
							</table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page">
                                <div>
									{{ $goods->links() }}
								</div>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
          layui.use(['laydate','form'], function(){
                  var laydate = layui.laydate;
                  var  form = layui.form;
          
          
                  // 监听全选
                  form.on('checkbox(checkall)', function(data){
          
                    if(data.elem.checked){
                      $('tbody input').prop('checked',true);
                    }else{
                      $('tbody input').prop('checked',false);
                    }
                    form.render('checkbox');
                  }); 
                  
                  //执行一个laydate实例
                  laydate.render({
                    elem: '#start' //指定元素
                  });
          
                  //执行一个laydate实例
                  laydate.render({
                    elem: '#end' //指定元素
                  });
                });
        
				  function member_del(obj,id,oldpic){
					  layer.confirm('确认要删除吗？',function(index){
						  $.ajax({
							//反隐  ` `   url:`{{URL('/type')}}/${id}`    419错误是令牌没传
							url:"/goods/"+id,//服务器地址
							type:"post",//请求方式
							data:{//传递的参数
								_token:"{{ csrf_token() }}",
								_method:"delete",
								oldpic,
							},
							success(res){
								// console.log(res);
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
				   function delAll (argument) {
						  var ids = [];
				  
						  // 获取选中的id 
						  $('tbody input').each(function(index, el) {
							  if($(this).prop('checked')){
								 ids.push($(this).val())
							  }
						  });
					
						  layer.confirm('确认要删除吗？'+ids.toString(),function(index){
							  //捉到所有被选中的，发异步进行删除
							  layer.msg('删除成功', {icon: 1});
							  $(".layui-form-checked").not('.header').parents('tr').remove();
						  });
						}
        </script>
           
		  <script>
          var cateIds = [];
          function getCateId(cateId) {
              $("tbody tr[fid="+cateId+"]").each(function(index, el) {
                  id = $(el).attr('cate-id');
                  cateIds.push(id);
                  getCateId(id);
              });
          }
   
        </script>
@endsection
