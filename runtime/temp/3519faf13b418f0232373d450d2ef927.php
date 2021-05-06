<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:86:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\admins\add_node.html";i:1546355838;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;}*/ ?>
<!-- 引入头部 -->
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
    .icon{background:#1E9FFF;float:left;}
    .upform{margin:2rem 0 2rem 0;}
</style>

<div class="layadmin-tabsbody-item layui-show">
	<div class="layui-card layadmin-header">
	 	<div class="layui-breadcrumb" lay-filter="breadcrumb">
	    	<a lay-href="">主页</a>
	    	<a><cite>用户</cite></a>
	    	<a><cite>角色管理</cite></a>
	  	</div>
	</div>
	<div class="layui-fluid">
		<div class="layui-card">
			<div class="layui-form" lay-filter="layuiadmin-form-admin" style="padding: 20px 30px 1px 0;">
			    <input type="hidden" name="id" class="id" value="<?php echo input('id'); ?>" />
			    <div class="layui-form-item">
			        <label class="layui-form-label">*名称</label>
			        <div class="layui-input-block">
			            <input type="text" name="title" value="<?php echo $node['title']; ?>" lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input title"> 
			        </div>
			    </div>
			    <div class="layui-form-item">
			        <label class="layui-form-label">*控制器</label>
			        <div class="layui-input-block">
			            <input type="text" name="url" value="<?php echo $node['url']; ?>" lay-verify="required" placeholder="请输入控制器" autocomplete="off" class="layui-input url"> 
			        </div>
			    </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">*排序</label>
                    <div class="layui-input-block">
                        <input type="text" name="sort" value="<?php echo (isset($node['sort']) && ($node['sort'] !== '')?$node['sort']:0); ?>" lay-verify="required" placeholder="排序 越大越靠前" autocomplete="off" class="layui-input sort"> 
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图标</label>
                    <div class="layui-input-block">
                        <button class="layui-btn icon" onclick="icons()"><i class="layui-icon"></i> 点击选择</button>
                        <i class="iconfont <?php echo $node['icon']; ?>" id="icon" style="font-size:35px;float:left;margin-left:10px"></i>
                        <input type="hidden" name="icon" value="">
                    </div>
                </div>
			    <div class="layui-form-item upform">
			        <label class="layui-form-label"></label>
			        <div class="layui-input-inline">
			            <input type="button" lay-submit id="transmit" lay-filter="LAY-user-back-submit" value="确认" class="layui-btn">
			            <button type="reset" class="layui-btn layui-btn-primary" onclick="javascript:history.go(-1)">返回</button>
			        </div>
			  	</div>
			</div>
		</div>
	</div>
</div>

<script>
    layui.use('form', function(){
        var form = layui.form;
    	form.on('submit(LAY-user-back-submit)', function(data){
    		$.ajax({
                url:"<?php echo url('Admins/addNode'); ?>",
                type:'post',
                data:{
                    id:$('.id').val(),
                    title:$('.title').val(),
                    url:$('.url').val(),
                    sort:$('.sort').val(),
                    icon:$("input[name='icon']").val(),
                },
                dataType:'json',
                success:function(data){
                    if(data.code == 200 ){
                    	layer.msg(data.msg, { icon:1,time:1000 },function(){
                            window.history.go(-1);
                        });
                    } else {
                    	layer.msg(data.msg, { icon:2,time:3000 });
                    }
                },
                error:function(){
                    layer.msg('网络错误，请稍后再试');
                }
            });
    	});
    });

    //选择图标
    function icons(){
        layer.open({
            type: 2,
            title: '选择图标',
            shadeClose: true,
            shade: false,
            maxmin: true, //开启最大化最小化按钮
            area: ['700px', '600px'],
            content: "<?php echo url('icon/icon'); ?>"
        });
    }

    //选择图标回调
    function ic(txt)
    {   
        $('#icon').removeClass();
        $('#icon').addClass('iconfont '+txt);
        $('input[name="icon"]').val(txt);
    }
</script>

