
<title>商品列表</title>
   <table border="1">
       <tr>
           <td>ID</td>
           <td>分类</td>
           <td>编号</td>
           <td>商品名称</td>
           <td>计数</td>
           <td>商品数量</td>
           <td>商品价格</td>
           <td>关键词</td>
           <td>商品描述</td>
           <td>商品图片</td>
           <td>添加时间</td>
           <td>是否删除</td>
           <td>销售</td>

       </tr>
       @foreach($list as $k=>$v)
       <tr>
           <td>{{$v->goods_id}}</td>
           <td>{{$v->cat_id}}</td>
           <td>{{$v->goods_sn}}</td>
           <td>{{$v->goods_name}}</td>
           <td>{{$v->click_count}}</td>
           <td>{{$v->goods_number}}</td>
           <td>{{$v->shop_price}}</td>
           <td>{{$v->keywords}}</td>
           <td>{{$v->goods_desc}}</td>
           <td>{{$v->goods_img}}</td>
           <td>{{$v->add_time}}</td>
           <td>{{$v->is_delete}}</td>
           <td>{{$v->sale_num}}</td>
       </tr>
       @endforeach
   </table>

