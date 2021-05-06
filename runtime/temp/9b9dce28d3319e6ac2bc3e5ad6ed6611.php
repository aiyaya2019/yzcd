<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\point\index.html";i:1568626624;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;}*/ ?>
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
                <div class="layui-card-header">商品列表</div>

                <div class="layui-form layui-card-header layuiadmin-card-header-auto" lay-filter="app-content-list">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">商品名称</label>
                            <div class="layui-input-inline">
                                <input type="text" name="name" placeholder="请输入商品名称" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">商品分类</label>
                            <div class="layui-input-inline">
                                <select name="cate_id" id="" lay-search>
                                    <option value="">--全部--</option>
                                    <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): if( count($cate)==0 ) : echo "" ;else: foreach($cate as $key=>$vo): ?>
                                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['title']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">商品品牌</label>
                            <div class="layui-input-inline">
                                <select name="brand_id" id="" lay-search>
                                    <option value="">--全部--</option>
                                    <?php if(is_array($brand) || $brand instanceof \think\Collection || $brand instanceof \think\Paginator): if( count($brand)==0 ) : echo "" ;else: foreach($brand as $key=>$vo): ?>
                                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['title']; ?></option>
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
        var url = "<?php echo url('Point/index'); ?>";

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
                {field:'title',title:'名称'},
                {field:'name',title:'品名'},
                {field:'cate_name',title:'分类'},
                {field:'brand_name',title:'品牌'},

                {title:'封面',align:'封面',templet:function(d){
                    return '<div><img src="'+d.img+'" style="width:50px" alt="" /></div>';
                }},
                {field:'point',title:'需要积分'},
                {field:'price',title:'价格'},
                {field:'type',title:'型号'},
                {title:'运费',align:'运费',templet:function(d){
                    if (d.freight == '0') {
                        return '包邮';
                    }else{
                        return d.freight;
                    }
                    
                }},

                {field:'status',title:'状态',width:"5%",templet:function(d){
                    if(d.status == 1){
                        return '<button class="layui-btn layui-btn-sm layui-btn-danger" onclick="update('+d.id+',2)">显示</button>';
                    } else {
                        return '<button class="layui-btn layui-btn-sm" onclick="update('+d.id+',1)">隐藏</button>';
                    }
                }},
                {field:'add_time',title:'添加时间', width:'10%'},
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
  <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit" href="<?php echo url('Point/attr'); ?>?id={{d.id}}">商品规格</a>
  <a class="layui-btn layui-btn-xs" lay-event="edit" href="<?php echo url('Point/save'); ?>?id={{d.id}}">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs delete" data-table="point_goods" data-id="{{d.id}}" lay-event="del">删除</a>
</script>

<script type="text/html" id="add">
  <a class="layui-btn layui-btn-xs" lay-event="edit" href="<?php echo url('Point/save'); ?>">发布商品</a>
</script>

<script>
    function update(id,type){
        var data = {
            id:id,
            status:type
        };
        get_request("<?php echo url('Point/changeStatus'); ?>",data);
    }
</script>