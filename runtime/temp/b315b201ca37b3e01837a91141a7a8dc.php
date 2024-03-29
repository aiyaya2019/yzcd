<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:88:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\admins\add_method.html";i:1546355852;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;}*/ ?>
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
			<form action="">
			    <input type="hidden"  name="id" value="<?php echo input('id'); ?>" />
                <input type="hidden"  name="pid" value="<?php echo input('pid'); ?>" />
                <input type="hidden"  name="type" value="<?php echo input('type'); ?>" />
			    <div class="layui-form-item">
			        <label class="layui-form-label">*名称</label>
			        <div class="layui-input-block">
			            <input type="text" name="title" value="<?php echo $node['title']; ?>" lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input"> 
			        </div>
			    </div>
			    <div class="layui-form-item">
			        <label class="layui-form-label">*方法名</label>
			        <div class="layui-input-block">
			            <input type="text" name="url" value="<?php echo $node['url']; ?>" lay-verify="required" placeholder="请输入方法名" autocomplete="off" class="layui-input"> 
			        </div>
			    </div>
			    <div class="layui-form-item">
			        <label class="layui-form-label">*参数</label>
			        <div class="layui-input-block">
			            <input type="text" name="parameter" value="<?php echo $node['parameter']; ?>" placeholder="请输入参数，示例： id=1&type=2" autocomplete="off" class="layui-input"> 
			        </div>
			    </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">*排序</label>
                    <div class="layui-input-block">
                        <input type="text" name="sort" value="<?php echo $node['sort']; ?>" lay-verify="required|number" placeholder="排序 越大越靠前" autocomplete="off" class="layui-input"> 
                    </div>
                </div>
			    <div class="layui-form-item">
		            <label class="layui-form-label">加入菜单</label>
                    <div class="layui-input-block">
                        <input type="checkbox" <?php if($node['is_nav'] == 1): ?>checked<?php endif; ?> name="is_nav" lay-skin="switch" lay-filter="component-form-switchTest" lay-text="ON|OFF">
                        <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>ON</em><i></i></div>
                    </div>
		        </div>
		    </form>
			    <div class="layui-form-item">
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
		//序列化表单
		var d = {};
		 var t = $('form').serializeArray();
		 $.each(t, function(){
		   d[this.name] = this.value;
		 });
		 console.log(JSON.stringify(d));
		$.ajax({
            url:"<?php echo url('Admins/addMethod'); ?>",
            type:'post',
            data:{ 
            	data:JSON.stringify(d)
            },
            dataType:'json',
            success:function(data){
                if(data.code == 200){
                    layer.msg(data.msg, {icon: 1, time: 1000},function(){
                    	window.history.go(-1);
                    });
                } else {
                	layer.msg(data.msg, {icon: 2, time: 3000});
                }
                
            },
            error:function(){
                layer.msg('网络错误，请稍后再试', {icon: 2, time: 2000});
            }
        })
	});
});
</script>

