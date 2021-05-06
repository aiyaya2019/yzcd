<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\icon\icon.html";i:1546522148;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图标库</title>
    <!-- 引入css和js文件 需要在底部引入 否则可能导致某些功能无法正常使用-->
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
    


</head>
<style>
/* 这段样式只是用于演示 */
#LAY-component-grid-list .demo-list .layui-card{height: auto;}
.icon{display: flex;flex-wrap:wrap;}
.icon li{ width:20%;}
.icon li:hover{background:#ccc;cursor:pointer;}
#LAY_app_body{ left:0; }
</style>
<body>
    <div class="layui-body" id="LAY_app_body">
        <div class="layadmin-tabsbody-item layui-show">
            <div class="layui-card layadmin-header">
                <div class="layui-breadcrumb" lay-filter="breadcrumb" style="visibility: visible;">
                    <a lay-href="">主页</a>
                    <span lay-separator="">/</span>
                    <a><cite>图标库</cite></a>
                    <span lay-separator="">/</span>
                    <a><cite>图标列表</cite></a>
                </div>
            </div>

            <div class="layui-fluid" id="LAY-component-grid-list">
                <div class="layui-row layui-col-space10 demo-list">
                    <div class="layui-col-sm4 layui-col-md3 layui-col-lg12">
                        <div class="layui-card" style="text-align: center;">
                            <!-- 填充内容 -->
                            <ul class="icon">
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>
<script type="text/javascript" src="/static/admin/icon.json"></script>
<script type="text/javascript">
    var str = '';
    $(icon).each(function(key,val){
        str += '<li>';
         str += '<i style="font-size:4rem;display:block;padding: 10px 0" class="iconfont '+val.class+'"></i>';
        str += '<p style="padding:0 0 10px 0">'+val.title+'</p>';
        str += '<p style="padding:0 0 10px 0">'+val.class+'</p>';
        str += '</li>';
    });

    $('.icon').html(str);
</script>
<script>
layui.use('layer', function(){
  var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
  
  $('.icon li').click(function(){
    //传值到父页面的ic方法
    parent.ic($(this).find('p:eq(1)').html());
    parent.layer.close(index);
  })
})
</script>