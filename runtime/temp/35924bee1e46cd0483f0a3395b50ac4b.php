<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\shop\shop.html";i:1572417594;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;}*/ ?>
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
                <div class="layui-card-header">门店列表</div>

                <div class="layui-form layui-card-header layuiadmin-card-header-auto" lay-filter="app-content-list">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">关键词</label>
                            <div class="layui-input-inline">
                                <input type="text" name="keywords" placeholder="请输入门店名称/负责人" autocomplete="off" class="layui-input">
                            </div>
                        </div>

                        <div class="layui-inline">
                            <!-- 状态：0申请中；1审核通过；2未通过 -->
                            <label class="layui-form-label">审核状态</label>
                            <div class="layui-input-inline">
                                <select name="examine">
                                    <option value="">全部状态</option>
                                    <option value="0">申请中</option>
                                    <option value="1">审核通过</option>
                                    <option value="2">未通过</option>
                                </select>
                            </div>
                        </div>

                        <div class="layui-inline">
                            <!-- 1城市合伙人；2门店合伙人 -->
                            <label class="layui-form-label">合作类型</label>
                            <div class="layui-input-inline">
                                <select name="type">
                                    <option value="">全部状态</option>
                                    <option value="1">城市合伙人</option>
                                    <option value="2">门店合伙人</option>
                                </select>
                            </div>
                        </div>

                        <div class="layui-inline">
                            <label class="layui-form-label">城市</label>
                            <div class="layui-input-inline">
                                <select name="city_id" id="" lay-search>
                                    <option value="">--全部--</option>
                                    <?php if(is_array($city) || $city instanceof \think\Collection || $city instanceof \think\Paginator): if( count($city)==0 ) : echo "" ;else: foreach($city as $key=>$vo): ?>
                                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['city']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
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
        var url = "<?php echo url('Shop/shop'); ?>";

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
            where:{examine:""},
            limit:20,
            toolbar:'#add',
            defaultToolbar:false,
            cols:[[
                {field:'id',title:'编号',width:'4%',align:'center'},
                {field:'invite_code',title:'推荐码',width:'7%'},
                {field:'shop_name',title:'门店名称',width:'7%'},
                {field:'name',title:'负责人姓名',width:'7%'},
                {field:'phone',title:'负责人电话',width:'8%'},
                // {field:'tel',title:'其他电话',width:'8%'},
                {field:'telephone',title:'服务电话',width:'8%'},
                {field:'job_time',title:'营业时间'},
                {field:'project',title:'本店经营项目'},
                // {field:'other_project',title:'其他经营项目'},
                // {title:'营业执照',align:'营业执照',templet:function(d){
                //     return '<div><img src="'+d.license+'" style="width:50px" alt="" /></div>';
                // }},
                {field:'order_money',title:'下单金额'},
                {field:'reserve_moeny',title:'收款金额'},
                // {title:'店铺图片',align:'店铺图片',templet:function(d){
                //     var img = d.img;
                //     var str = '';
                //     var res;
                //     for (var k in img) {
                //         res   = img[k];
                //         str += '<img src="'+res+'" style="width:50px; margin-right:5px;" alt="" />';
                //     }
                //     return str;
                // }},
                {field:'examine',title:'审核状态',width:"10%",templet:function(d){
                    if(d.examine == 0){
                        return '<button class="layui-btn layui-btn-sm" onclick="update('+d.id+',1)">审核通过</button>'+'<button class="layui-btn layui-btn-sm" onclick="update('+d.id+',2)">未通过</button>'
                    } else if(d.examine == 1) {
                        return '<button class="layui-btn layui-btn-sm layui-btn-danger">已通过</button>';
                    }else{
                        return '<button class="layui-btn layui-btn-sm">已拒绝</button>';
                    }
                }},
                {field:'status',title:'状态',width:"5%",templet:function(d){
                    if(d.status == 1){
                        return '<button class="layui-btn layui-btn-sm layui-btn-danger" onclick="changeStatus('+d.id+',2)">显示</button>';
                    } else {
                        return '<button class="layui-btn layui-btn-sm" onclick="changeStatus('+d.id+',1)">隐藏</button>';
                    }
                }},
                // {field:'add_time',title:'注册时间'},
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
    <a class="layui-btn layui-btn-xs" lay-event="edit" href="<?php echo url('Shop/shop_save'); ?>?id={{d.id}}">查看</a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit" href="<?php echo url('Shop/reserves'); ?>?shop_id={{d.id}}">预约</a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit" href="<?php echo url('Shop/coupon'); ?>?shop_id={{d.id}}">优惠券</a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit" href="<?php echo url('Shop/product'); ?>?shop_id={{d.id}}">产品库</a>
    
  
  <!-- <a class="layui-btn layui-btn-danger layui-btn-xs delete" data-table="goods_table" data-id="{{d.id}}" lay-event="del">删除</a> -->
</script>

<!-- <script type="text/html" id="add">
  <a class="layui-btn layui-btn-xs" lay-event="edit" href="<?php echo url('Shop/shop_save'); ?>">发布广告</a>
</script> -->

<script>
    function update(id,type){
        var data = {
            id:id,
            examine:type
        };
        get_request("<?php echo url('Shop/shopExamine'); ?>",data);
    }
    function changeStatus(id,type){
        var data = {
            id:id,
            status:type
        };
        get_request("<?php echo url('Shop/shopExamine'); ?>",data);
    }
</script>