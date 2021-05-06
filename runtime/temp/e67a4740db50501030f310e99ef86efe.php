<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:85:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\cash\user_cash.html";i:1572859378;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;}*/ ?>
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
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">提现列表</div>

                <div class="layui-form layui-card-header layuiadmin-card-header-auto" lay-filter="app-content-list">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <input type="text" name="keywords" placeholder="请输入姓名" autocomplete="off" class="layui-input">
                            </div>
                        </div>

                        <div class="layui-inline">

                            <label class="layui-form-label">订单状态</label>

                            <div class="layui-input-inline">
                                <select name="type">
                                    <option value="">全部状态</option>

                                    <option value="4">申请中</option>

                                    <option value="5">提现成功</option>

                                    <option value="6">提现失败</option>
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
        var url = "<?php echo url('Cash/user_cash'); ?>";

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
                {field:'title',title:'标题'},
                {field:'money',title:'提现金额'},

                {field:'name',title:'银行名称'},
                {field:'bank_code',title:'银行编号'},
                {field:'bank_num',title:'银行卡号',width:'15%'},
                {field:'username',title:'提现人姓名'},


                {field:'type_name',title:'提现状态'},

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
  <a class="layui-btn layui-btn-xs" lay-event="edit" href="<?php echo url('Point/info'); ?>?id={{d.id}}">查看</a>
  <!-- <a class="layui-btn layui-btn-xs" lay-event="edit" href="<?php echo url('Point/save'); ?>?id={{d.id}}">编辑</a>-->

{{# if (d.type === 4) { }}
    <div class="layui-btn layui-btn-xs" onclick="userExamine('{{d.id}}', 5)">同意</div>
    <div class="layui-btn layui-btn-xs" onclick="userExamine('{{d.id}}', 6)">拒绝</div>
{{# } }}


</script>

<!-- <script type="text/html" id="add">
  <a class="layui-btn layui-btn-xs" lay-event="edit" href="<?php echo url('Point/save'); ?>">发布商品</a>
</script> -->

<script>
    function userExamine(id, type){
        var data = {
            id:id,
            type:type
        };
        get_request("<?php echo url('Cash/userExamine'); ?>", data);
    }
</script>