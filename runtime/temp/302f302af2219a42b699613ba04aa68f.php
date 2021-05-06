<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\point\save.html";i:1568615451;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\edit.html";i:1546750684;}*/ ?>
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
                    <label class="layui-form-label">品名</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" value="<?php echo $list['name']; ?>" lay-verify="required" autocomplete="off" placeholder="请输入品名" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">分类</label>
                    <div class="layui-input-block">
                        <select name="cate_id" id="" lay-verify="required" lay-search>
                            <option value="">请选择分类</option>
                            <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): if( count($cate)==0 ) : echo "" ;else: foreach($cate as $key=>$vo): ?>
                                <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $list['cate_id']): ?>selected<?php endif; ?>><?php echo $vo['title']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">品牌</label>
                    <div class="layui-input-block">
                        <select name="brand_id" id="" lay-verify="required" lay-search>
                            <option value="">请选择品牌</option>
                            <?php if(is_array($brand) || $brand instanceof \think\Collection || $brand instanceof \think\Paginator): if( count($brand)==0 ) : echo "" ;else: foreach($brand as $key=>$vo): ?>
                                <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $list['brand_id']): ?>selected<?php endif; ?>><?php echo $vo['title']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">型号</label>
                    <div class="layui-input-block">
                        <input type="text" name="type" value="<?php echo $list['type']; ?>" lay-verify="required" autocomplete="off" placeholder="请输入型号" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">积分</label>
                    <div class="layui-input-block">
                        <input type="text" name="point" value="<?php echo $list['point']; ?>" lay-verify="required" autocomplete="off" placeholder="请输入积分" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">价格</label>
                    <div class="layui-input-block">
                        <input type="text" name="price" value="<?php echo $list['price']; ?>" lay-verify="required" autocomplete="off" placeholder="请输入价格" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">运费</label>
                    <div class="layui-input-block">
                        <input type="text" name="freight" value="<?php echo $list['freight']; ?>" lay-verify="required" autocomplete="off" placeholder="请输入运费" class="layui-input">
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
                    <label class="layui-form-label">商品相册</label>
                    <div class="layui-input-block layui-upload">
                        <div class="layui-upload">
                            <button type="button" class="layui-btn" id="test2"><i class="layui-icon"></i>上传相册</button><input class="layui-upload-file" type="file" accept="undefined" multiple="">
                             
                            <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                                预览图：
                                <div class="layui-upload-list">
                                    <div style="display: flex;" id="demo2">
                                    
                                        <?php if(is_array($list['images']) || $list['images'] instanceof \think\Collection || $list['images'] instanceof \think\Paginator): if( count($list['images'])==0 ) : echo "" ;else: foreach($list['images'] as $key=>$vo): ?>
                                            <div style="margin:0 10px" class="deledata">
                                                <img style="width:100px;margin:0 10px" src="<?php echo $vo; ?>" alt="" class="layui-upload-img">
                                                <div class="dele" style="text-align:center;border:1px solid #999;margin-top:5px;cursor:pointer">删除</div>
                                                <input type="hidden" name="images[]" value="<?php echo $vo; ?>"/>
                                            </div>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    
                                    </div>
                                </div>
                            </blockquote>
                        </div>
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

        //多图片上传
        upload.render({
            elem: '#test2',
            url:"/admin/common/fileupload.html",
            multiple:true,
            number:6,
            size:'3000',
            choose: function(obj){
                var files = obj.pushFile();
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    str = '<div style="margin:0 10px" class="deledata"><img style="width:100px;margin:0 10px" src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img"><div class="dele" style="text-align:center;border:1px solid #999;margin-top:5px;cursor:pointer">删除</div></div>';
                    $('#demo2').append(str);
                });
                $('.add_img').remove();
            },
            done:function(res, index, upload){
                console.log(res);
                $('#demo2').append('<input class="add_img" type="hidden" name="images[]" value="'+res.link+'"/>');
            }
        });
    });

    //表单上传
    fromUpload('form',"<?php echo url('Point/save'); ?>");

    $('.edit').editable({
        inlineMode: false,
        alwaysBlank: true,
        language: "zh_cn",
        imageUploadURL:"<?php echo url('common/fileUpload'); ?>"
    }) 
</script>