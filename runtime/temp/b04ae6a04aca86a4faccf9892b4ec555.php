<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\rgoods\save.html";i:1568692048;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\edit.html";i:1546750684;}*/ ?>
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
    .layui-upload-img{width: 92px; height: 92px; margin: 0 10px 10px 0;border:1px solid #eee;}
    .spec{float:right;width:80%;margin: 0 5px 10px 3px}
    .remove{width:4% !important;margin:10px 0 0 0;color:#FF5722;cursor:pointer;}
    .removes{color:#FF5722;cursor:pointer;}
    .layui-input-inline{margin-right:2px !important;}
    .layui-unselect{float:left;}
    .pane{width:13% !important;}
</style>
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-form" lay-filter="layuiadmin-form-admin" style="padding: 20px 30px 1px 0;">
            <form action="" class="layui-form">
                <input type="hidden" name="id" value="<?php echo input('id'); ?>">

                <div class="layui-form-item">
                    <label class="layui-form-label">商品名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" value="<?php echo $list['title']; ?>" lay-verify="required" autocomplete="off" placeholder="请输入商品名称" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">预付款</label>
                    <div class="layui-input-block">
                        <input type="text" name="front_money" value="<?php echo $list['front_money']; ?>" lay-verify="required" autocomplete="off" placeholder="请输入预付款" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">市场价</label>
                    <div class="layui-input-block">
                        <input type="text" name="money" value="<?php echo $list['money']; ?>" lay-verify="required" autocomplete="off" placeholder="请输入市场价" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">可得积分</label>
                    <div class="layui-input-block">
                        <input type="text" name="point" value="<?php echo $list['point']; ?>" lay-verify="required" autocomplete="off" placeholder="请输入可得积分" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">联保时长/年</label>
                    <div class="layui-input-block">
                        <input type="text" name="repair_time" value="<?php echo $list['repair_time']; ?>" lay-verify="required" autocomplete="off" placeholder="请输入联保时长" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">标签</label>
                    <div class="layui-input-block">
                        <select name="label_id" id="" lay-verify="required" lay-search>
                            <option value="">请选择标签</option>
                            <?php if(is_array($label) || $label instanceof \think\Collection || $label instanceof \think\Paginator): if( count($label)==0 ) : echo "" ;else: foreach($label as $key=>$vo): ?>
                                <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $list['label_id']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">封面图</label>
                    <div class="layui-input-block layui-upload">
                        <button type="button" class="layui-btn layui-btn-normal file" id="test1"><i class="layui-icon"></i>上传封面图</button>
                        <input class="layui-upload-file" type="file" accept="undefined" name="file" id="test1s">
                        <span class="layui-inline layui-upload-choose">支持 png、jpg、jpeg 格式文件</span>
                    </div>
                     <label class="layui-form-label"></label>
                    <div style="margin-top:10px" id="video_val">
                        <img src="<?php echo $list['img']; ?>" style="width:200px" id="img" />
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">视频</label>
                    <div class="layui-input-block layui-upload">
                        <button type="button" class="layui-btn layui-btn-normal file" id="test2"><i class="layui-icon"></i>上传视频</button>
                        <input class="layui-upload-file" type="file" accept="undefined" name="files" id="test2s">
                        <!-- <span class="layui-inline layui-upload-choose">支持 png、jpg、jpeg 格式文件</span> -->
                    </div>
                     <label class="layui-form-label"></label>
                    <div style="margin-top:10px" id="video_val">
                        <video controls="controls" src="<?php echo $list['video']; ?>"></video>
                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">商品详情</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入商品详情" lay-verify="required" name="content" class="layui-textarea edit"><?php echo $list['content']; ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-inline">
                        <input type="button" lay-submit id="transmit" lay-filter="LAY-user-back-submit" value="确认" class="layui-btn">
                        <button type="reset" class="layui-btn layui-btn-primary" onclick="javascript:history.go(-1)">返回</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- 编辑器文件库 -->
<link rel="stylesheet" href="/static/Edit/css/froala_editor.min.css">
<link rel="stylesheet" href="/static/Edit/css/font-awesome.min.css">
<script src="/static/Edit/js/froala_editor.min.js"></script>
  <!--[if lt IE 9]>
    <script src="/static/Edit/js/froala_editor_ie8.min.js"></script>
  <![endif]-->

<script src="/static/Edit/js/plugins/tables.min.js"></script>  			<!--表格-->
<script src="/static/Edit/js/plugins/lists.min.js"></script> 			<!--编号-->
<script src="/static/Edit/js/plugins/colors.min.js"></script> 			<!--颜色-->
<script src="/static/Edit/js/plugins/media_manager.min.js"></script>	<!--未知-->
<script src="/static/Edit/js/plugins/font_family.min.js"></script>		<!--字体-->
<script src="/static/Edit/js/plugins/font_size.min.js"></script>		<!--大小-->
<script src="/static/Edit/js/plugins/block_styles.min.js"></script>		<!--样式-->
<!-- <script src="/static/Edit/js/plugins/video.min.js"></script> -->			<!--视频-->
<script src="/static/Edit/js/langs/zh_cn.js"></script>					<!--语言-->

 <!-- 
 用法
 $('#edit').editable({inlineMode: false, alwaysBlank: true}) 
 language: "zh_cn", 声明中文菜单
 imageUploadURL:xxxx  图片上传地址  返回样式为  link:xxx图片地址
 -->
<script>
    layui.use(['upload','laydate','form'],function(){
        var upload = layui.upload;
        var form = layui.form;

        //封面上传
        upload.render({
            elem: '#test1',
            auto: false,
            field:'img',
            //,multiple: true
            bindAction: '#test1s',
            done: function(res){
              console.log(res)
            }
        });

        //视频上传
        upload.render({
            elem: '#test2',
            auto: false,
            field:'video',
            accept:'file',
            //,multiple: true
            bindAction: '#test2s',
            done: function(res){
              console.log(res)
            }
        });
    });

    //表单上传
    fromUpload('form',"<?php echo url('Rgoods/save'); ?>");

    $('.edit').editable({
        inlineMode: false,
        alwaysBlank: true,
        language: "zh_cn",
        imageUploadURL:"<?php echo url('common/fileUpload'); ?>"
    }) 
</script>