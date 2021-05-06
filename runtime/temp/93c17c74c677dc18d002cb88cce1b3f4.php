<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\shop\reserves.html";i:1572422545;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;}*/ ?>
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
    .layui-table-cell{  /*最后的pic为字段的field*/
      height: 100%;
      max-width: 100%;
    } 
</style>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">预约订单</div>

                <div class="layui-form layui-card-header layuiadmin-card-header-auto" lay-filter="app-content-list">
                    <div class="layui-form-item">
                        <!-- <div class="layui-inline">
                            <label class="layui-form-label">理疗师名称</label>
                            <div class="layui-input-inline">
                                <input type="text" name="name" placeholder="请输入理疗师名称" autocomplete="off" class="layui-input">
                            </div>
                        </div> -->

                        <div class="layui-inline">
                            <!-- 状态：状态：1待支付；2未服务(已支付定金)；3已服务(已支付总金)；4取消中(申请退款)；5已取消(已退款)；6申请失败(退款失败) -->
                            <label class="layui-form-label">状态</label>
                            <div class="layui-input-inline">
                                <select name="status">
                                    <option value="">全部状态</option>
                                    <option value="1">待支付</option>
                                    <option value="2">未服务</option>
                                    <option value="3">已服务</option>
                                    <option value="4">申请退款</option>
                                    <option value="5">已退款</option>
                                    <option value="6">退款失败</option>
                                </select>
                            </div>
                        </div>

                        <div class="layui-inline">
                            <button class="layui-btn layuiadmin-btn-list" lay-submit="" lay-filter="LAY-app-contlist-search">
                                <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="layui-card-body">
                    <table class="layui-hide" id="test-table-autowidth"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    layui.use(['table','form'],function(){
        var table = layui.table;
        var form = layui.form;
        var url = "<?php echo url('Shop/reserves'); ?>";

        //监听搜索
        form.on('submit(LAY-app-contlist-search)', function(data){
            var field  = data.field;
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
            where:{
                shop_id:"<?php echo input('shop_id'); ?>",
            },
            limit:20,
            toolbar:'#add',
            defaultToolbar:false,
            cols:[[
                {field:'id',title:'编号',width:'4%',align:'center'},
                {field:'shop_name',title:'门店'},
                {field:'order_sn',title:'预约单号'},
                {field:'uid',title:'用户'},
                {field:'name',title:'姓名'},
                {field:'phone',title:'手机号'},
                {field:'title',title:'名称'},
                {title:'图片',align:'图片',templet:function(d){
                    return '<div><img src="'+d.img+'" style="width:50px" alt="" /></div>';
                }},
                // {field:'label_name',title:'标签名称'},
                {field:'buy_num',title:'数量'},
                // {field:'front_money',title:'预付款'},
                // {field:'wait_money',title:'待付款'},
                // {field:'money',title:'市场价'},
                {field:'pay_money',title:'支付金额'},
                {field:'reserve_time',title:'预约时间'},
                {field:'end_time',title:'联保到期时间'},
                {field:'car_number',title:'车牌号'},
                {field:'goods_num',title:'产品序列号'},
                // {field:'refund_reason',title:'退款原因'},
                {field:'status_name',title:'预约状态'},

                {
                    title:'操作',
                    width:'7%',
                    toolbar:'#barDemo'
                }
            ]]
        })
    })
</script>

<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit" href="<?php echo url('Shop/reserves_save'); ?>?id={{d.id}}">详情</a>
    <!-- <a class="layui-btn layui-btn-danger layui-btn-xs delete" data-table="doctor" data-id="{{d.id}}" lay-event="del">删除</a> -->
</script>


