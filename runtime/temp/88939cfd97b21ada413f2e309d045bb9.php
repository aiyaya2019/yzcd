<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\shop\shop_save.html";i:1572417479;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\edit.html";i:1546750684;}*/ ?>
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
                <input type="hidden" name="id" id="id" value="<?php echo input('id'); ?>">



                <div class="layui-form-item">
                    <label class="layui-form-label">城市</label>
                    <div class="layui-input-block">
                        <select name="city_id" id="" lay-verify="required" lay-search>
                            <option value="">请选择城市</option>
                            <?php if(is_array($city) || $city instanceof \think\Collection || $city instanceof \think\Paginator): if( count($city)==0 ) : echo "" ;else: foreach($city as $key=>$vo): ?>
                                <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $shop['city_id']): ?>selected<?php endif; ?>><?php echo $vo['province']; ?><?php echo $vo['city']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">邀请码</label>
                    <div class="layui-input-block">
                        <input type="text" name="invite_code" value="<?php echo $shop['invite_code']; ?>" lay-verify="required" autocomplete="off" placeholder="请输入内容" class="layui-input" onlyread="onlyread">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">门店名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="shop_name" value="<?php echo $shop['shop_name']; ?>"  autocomplete="off" placeholder="请输入内容" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">详细地址</label>
                    <div class="layui-input-block">
                        <input type="text" name="address" value="<?php echo $shop['address']; ?>"  autocomplete="off" placeholder="请输入内容" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">负责人姓名</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" value="<?php echo $shop['name']; ?>"  autocomplete="off" placeholder="请输入内容" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">负责人电话</label>
                    <div class="layui-input-block">
                        <input type="text" name="phone" value="<?php echo $shop['phone']; ?>"  autocomplete="off" placeholder="请输入内容" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">其他电话</label>
                    <div class="layui-input-block">
                        <input type="text" name="tel" value="<?php echo $shop['tel']; ?>"  autocomplete="off" placeholder="请输入内容" class="layui-input">
                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">服务电话</label>
                    <div class="layui-input-block">
                        <input type="text" name="telephone" value="<?php echo $shop['telephone']; ?>"  autocomplete="off" placeholder="请输入内容" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">营业时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="job_time" value="<?php echo $shop['job_time']; ?>"  autocomplete="off" placeholder="请输入内容" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">本店经营项目</label>
                    <div class="layui-input-block">
                        <input type="text" name="project" value="<?php echo $shop['project']; ?>"  autocomplete="off" placeholder="请输入内容" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">其他经营项目</label>
                    <div class="layui-input-block">
                        <input type="text" name="other_project" value="<?php echo $shop['other_project']; ?>"  autocomplete="off" placeholder="请输入内容" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">其他项目图片</label>
                    <div class="layui-input-block layui-upload">
                        <!-- <button type="button" class="layui-btn layui-btn-normal file" id="test1"><i class="layui-icon"></i>上传其他项目图片</button>
                        <input class="layui-upload-file" type="file" accept="undefined" name="file" id="test1s">
                        <span class="layui-inline layui-upload-choose">支持 png、jpg、jpeg 格式文件</span> -->
                        <?php if($other_project_img): if(is_array($other_project_img) || $other_project_img instanceof \think\Collection || $other_project_img instanceof \think\Paginator): if( count($other_project_img)==0 ) : echo "" ;else: foreach($other_project_img as $key=>$vo): ?>
                                <img style="width:70px" id="other_project_img" src="<?php echo $vo; ?>" alt="">
                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">营业执照</label>
                    <div class="layui-input-block layui-upload">
                        <!-- <button type="button" class="layui-btn layui-btn-normal file" id="test2"><i class="layui-icon"></i>上传营业执照</button>
                        <input class="layui-upload-file" type="file" accept="undefined" name="file1" id="test2s">
                        <span class="layui-inline layui-upload-choose">支持 png、jpg、jpeg 格式文件</span> -->
                        <?php if($license): if(is_array($license) || $license instanceof \think\Collection || $license instanceof \think\Paginator): if( count($license)==0 ) : echo "" ;else: foreach($license as $key=>$vo): ?>
                                <img style="width:70px" id="license" src="<?php echo $vo; ?>" alt="">
                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">身份证图片</label>
                    <div class="layui-input-block layui-upload">
                        <!-- <button type="button" class="layui-btn layui-btn-normal file" id="test3"><i class="layui-icon"></i>上传营业执照</button>
                        <input class="layui-upload-file" type="file" accept="undefined" name="file2" id="test3s">
                        <span class="layui-inline layui-upload-choose">支持 png、jpg、jpeg 格式文件</span> -->
                        <?php if($idcard_img): if(is_array($idcard_img) || $idcard_img instanceof \think\Collection || $idcard_img instanceof \think\Paginator): if( count($idcard_img)==0 ) : echo "" ;else: foreach($idcard_img as $key=>$vo): ?>
                                <img style="width:70px" id="idcard_img" src="<?php echo $vo; ?>" alt="">
                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">店铺相册</label>
                    <div class="layui-input-block layui-upload">
                        <!-- <button type="button" class="layui-btn layui-btn-normal file" id="test3"><i class="layui-icon"></i>上传营业执照</button>
                        <input class="layui-upload-file" type="file" accept="undefined" name="file2" id="test3s">
                        <span class="layui-inline layui-upload-choose">支持 png、jpg、jpeg 格式文件</span> -->
                        <?php if($img): if(is_array($img) || $img instanceof \think\Collection || $img instanceof \think\Paginator): if( count($img)==0 ) : echo "" ;else: foreach($img as $key=>$vo): ?>
                                <img style="width:70px" id="img" src="<?php echo $vo; ?>" alt="">
                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">合作类型</label>
                    <div class="layui-input-block">
                    <input type="radio" name="type" value="1" title="城市合伙人" <?php if($shop['type'] == 1): ?>checked<?php endif; ?> >
                    <input type="radio" name="type" value="2" title="门店合伙人" <?php if($shop['type'] == 2): ?>checked<?php endif; ?> >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">审核状态</label>
                    <div class="layui-input-block">
                    <input type="radio" name="examine" value="0" title="申请中" <?php if($shop['examine'] == 0): ?>checked<?php endif; ?> >
                    <input type="radio" name="examine" value="1" title="审核通过" <?php if($shop['examine'] == 1): ?>checked<?php endif; ?> >
                    <input type="radio" name="examine" value="2" title="未通过" <?php if($shop['examine'] == 2): ?>checked<?php endif; ?> >
                    </div>
                </div>
                <div class="layui-form-item">
                    <!-- 1未付款；2已付款；3已过期 -->
                    <label class="layui-form-label">分红状态</label>
                    <div class="layui-input-block">
                    <input type="radio" name="state" value="1" title="未付款" <?php if($shop['state'] == 1): ?>checked<?php endif; ?> >
                    <input type="radio" name="state" value="2" title="已付款" <?php if($shop['state'] == 2): ?>checked<?php endif; ?> >
                    <input type="radio" name="state" value="3" title="已过期" <?php if($shop['state'] == 3): ?>checked<?php endif; ?> >
                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">余额</label>
                    <div class="layui-input-block">
                        <input type="text" name="money" value="<?php echo $shop['money']; ?>"  autocomplete="off" placeholder="请输入内容" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">分红期限</label>
                    <div class="layui-input-block">
                        <input type="text" name="term" value="<?php echo $shop['term']; ?>"  autocomplete="off" placeholder="请输入内容" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">分红到期时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="end_time" value="<?php echo date('Y-m-d',$shop['end_time']); ?>"  autocomplete="off" placeholder="请输入内容" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-inline">
                        <!-- <input type="button" lay-submit id="transmit" lay-filter="LAY-user-back-submit" value="确认" class="layui-btn"> -->
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

        //服务前图片上传
        upload.render({
            elem: '#test1',
            auto: false,
            field:'old_img',
            //,multiple: true
            bindAction: '#test1s',
            done: function(res){
              console.log('======')
              console.log(res)
            }
        });
        //服务后图片上传
        upload.render({
            elem: '#test2',
            auto: false,
            field:'new_img',
            //,multiple: true
            bindAction: '#test2s',
            done: function(res){
              console.log(res)
            }
        });

    });

    //表单上传
    fromUpload('form',"<?php echo url('Example/save'); ?>",function(data){
        if(data.code == 200){
            if(data.data != ''){
                // layer.msg('案例保存成功，前往添加案例规格',{time:3000},function(){
                //     window.location.href = "<?php echo url('Example/attr_spec'); ?>?id="+data.data
                // });
            } else {
                layer.msg(data.msg,{time:1500},function(){
                    //返回上一页刷新
                    self.location=document.referrer;
                });
            }
        } else {
            layer.msg(data.msg,{time:3000});
        }
    });

    $('.edit').editable({
        inlineMode: false, 
        alwaysBlank: true,
        language: "zh_cn",
        imageUploadURL:"<?php echo url('common/fileUpload'); ?>"
    }) 
</script>