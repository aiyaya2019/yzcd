<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\rgoods\order.html";i:1572492843;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config['title']; ?>-后台管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/admin/style/admin.css" media="all">
    <!-- 引入阿里巴巴矢量图标库 -->
    <link title="" href="//at.alicdn.com/t/font_728609_yqh8bmk6kj.css" rel="stylesheet" type="text/css"  />
</head>
<body>
<script src='/static/admin/jquery.js'></script>
<script src="/static/admin/layui/layui.js"></script>
<script src='/static/admin/common.js'></script>

<script>
    var layer;
    layui.use('layer',function(){
        layer = layui.layer;
    })
</script>
    


<style>
    .layui-table-cell{
       height: 100%;
        max-width: 100%;
    }
</style>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <form action="<?php echo url('Rgoods/order_excel'); ?>" method="post">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">订单列表</div>

                <div class="layui-form layui-card-header layuiadmin-card-header-auto" lay-filter="app-content-list">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <!-- <label class="layui-form-label">商品名称</label> -->
                            <div class="layui-input-inline">
                                <input type="text" name="keywords" placeholder="请输入订单号/手机号" autocomplete="off" class="layui-input">
                            </div>
                        </div>

                        <div class="layui-inline">

                            <label class="layui-form-label">订单状态</label>

                            <div class="layui-input-inline">
                                <select name="status">
                                    <option value="">全部状态</option>

                                    <option value="1">待付款</option>

                                    <option value="2">未发货</option>

                                    <option value="3">已发货</option>

                                    <option value="4">已完成</option>
                                </select>
                            </div>

                        </div>

                        <div class="layui-inline">
                            <button class="layui-btn layuiadmin-btn-list" lay-submit="" lay-filter="LAY-app-contlist-search">
                                <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                            </button>
                        </div>
                       <div class="layui-inline">
                         <button class="layui-btn layui-btn-normal">导出数据</button>
                     </div>
                    </div>
                </div>

                <div class="layui-card-body">
                    <table class="layui-hide" id="test-table-autowidth"></table>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<script>
    layui.use(['table','form'],function(){
        var table = layui.table;
        var form = layui.form;
        var url = "<?php echo url('Rgoods/order'); ?>";

        //监听搜索
        form.on('submit(LAY-app-contlist-search)', function(data){
            var field = data.field;
            field.page = 1;
            //执行重载
            table.reload('test-table-autowidth', {
                where: field
            });
        });

        table.render({
            elem: '#test-table-autowidth',
            url:url,
            method:'post',
            response:{
                statusCode:200
            },
            skin:'line',
            page:{
                layout:['prev','page','next','skip','count']
            },
            where:{type:"<?php echo input('type'); ?>"},
            limit:20,
            toolbar:'#add',
            defaultToolbar:false,
            cols:[[
                {field:'id',title:'编号',width:'4%',align:'center'},
                {field:'order_sn',title:'订单号'},
                {field:'name',title:'联系人'},
                {field:'phone',title:'手机号'},

                {title:'地址',align:'地址',templet:function(d){
                    return d.province + d.city + d.area;
                }},
                {field:'buy_num',title:'购买总数'},
                {field:'all_money',title:'订单总价'},
                {field:'pay_money',title:'实际支付金额'},
                {field:'remarks',title:'订单备注'},

                // 状态：1待付款；2未发货；3已发货；4已完成
                {field:'status_name',title:'订单状态'},
                {title:'订单状态',align:'订单状态',templet:function(d){
                    if (d.status_name == '未发货') {
                        return '<div style="text-align:center; background-color:red; color:#fff; border-radius:5px;">' + d.status_name + '</div>';
                    }else if(d.status_name == '已发货'){
                        return '<div style="text-align:center; background-color:green; color:#fff; border-radius:5px;">' + d.status_name + '</div>';
                    }else{
                        return '<div>' + d.status_name + '</div>';
                    }
                    
                }},

                // {title:'封面',align:'封面',templet:function(d){
                //     return '<div><img src="'+d.img+'" style="width:50px" alt="" /></div>';
                // }},

                // {field:'status',title:'状态',width:"5%",templet:function(d){
                //     if(d.status == 1){
                //         return '<button class="layui-btn layui-btn-sm layui-btn-danger" onclick="update('+d.id+',2)">显示</button>';
                //     } else {
                //         return '<button class="layui-btn layui-btn-sm" onclick="update('+d.id+',1)">隐藏</button>';
                //     }
                // }},
                {field:'add_time',title:'下单时间', width:'10%'},
                {
                    title:'操作',
                    width:'20%',
                    toolbar:'#barDemo'
                }
            ]]
        })
    })
</script>

<script type="text/html" id="barDemo">
  <a class="layui-btn layui-btn-xs" lay-event="edit" href="<?php echo url('Rgoods/info'); ?>?id={{d.id}}">查看</a>

  {{# if(d.status == 2){ }}
  <a class="layui-btn layui-btn-xs open" width="35%" height="50%" data-title="发货" url="<?php echo url('Rgoods/delivery'); ?>?id={{d.id}}">发货</a>
  {{# } }}

  <!-- <a class="layui-btn layui-btn-xs" lay-event="edit" href="<?php echo url('Rgoods/save'); ?>?id={{d.id}}">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs delete" data-table="reserve_goods" data-id="{{d.id}}" lay-event="del">删除</a> -->
</script>

<!-- <script type="text/html" id="add">
  <a class="layui-btn layui-btn-xs" lay-event="edit" href="<?php echo url('Rgoods/save'); ?>">发布商品</a>
</script> -->

<script>
    function update(id,type){
        var data = {
            id:id,
            status:type
        };
        get_request("<?php echo url('Rgoods/changeStatus'); ?>",data);
    }
</script>