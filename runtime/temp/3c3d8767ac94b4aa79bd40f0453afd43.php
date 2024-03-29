<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:89:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\shop\reserves_save.html";i:1572423445;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\edit.html";i:1546750684;}*/ ?>
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
    .hr-line-dashed{border-top:1px dashed #e7eaec;color:#fff;background-color:#fff;height:1px;margin:20px 0}
</style>
<div class="layui-fluid layadmin-homepage-fluid">
    <div class="layui-row layui-col-space8">
        <div class="layui-form" lay-filter="layuiadmin-form-admin">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-sm6 layui-col-md12">
                    <div class="layui-card-header" style="background-color: #f2f2f2;border: 1px solid #e6e6e6">
                        预约信息
                    </div>
                    <div class="layui-card layui-fluid">
                        <div class=" layui-fluid" style="display: flex;height: 100%">
                            <div class="layui-col-sm2">订单编号：<?php echo $data['order_sn']; ?></div>
                            <div class="layui-col-sm2">订单状态：<?php echo $data['status_name']; ?></div>
                            <div class="layui-col-sm2">下单时间：<?php echo $data['add_time']; ?></div>
                            <div class="layui-col-sm2">支付时间：<?php echo date('Y-m-d H:i:s',$data['pay_time']); ?></div>
                            <div class="layui-col-sm2">预付金额：&yen; <?php echo (isset($data['front_money']) && ($data['front_money'] !== '')?$data['front_money']:'0'); ?></div>
                            <div class="layui-col-sm2">待付金额：&yen; <?php echo (isset($data['wait_money']) && ($data['wait_money'] !== '')?$data['wait_money']:'0'); ?></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                    </div>
                </div>
            </div>
        </div>

        <div class="layui-form" lay-filter="layuiadmin-form-admin">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-sm6 layui-col-md12">
                    <div class="layui-card">
                        <table class="layui-table" lay-skin="line" style="margin:0">
                            <thead>
                            <tr>
                                <td>门店</td>
                                <td>商品</td>
                                <td>预付金额</td>
                                <td>待金额</td>
                                <td>总金额</td>
                                <td>数量</td>
                                <td>使用的序列号</td>
                                <!-- <td>操作</td> -->
                            </tr>
                            </thead>
                            <tbody>

                                <tr>
                                <td><?php echo $data['shop_name']; ?></td>
                                    <td style="display:flex;align-items: center;">
                                        <div>
                                            <img style="width:100px" src="<?php echo $data['img']; ?>" alt="">
                                        </div>
                                        <div>
                                            <span style="margin-left:1.5rem"><?php echo $data['title']; ?></span>
                                        </div>
                                    </td>
                                    <td>&yen; <?php echo $data['front_money']; ?></td>
                                    <td>&yen; <?php echo $data['wait_money']; ?></td>
                                    <td>&yen; <?php echo $data['all_money']; ?></td>
                                    <td><?php echo $data['buy_num']; ?></td>
                                    <td><?php echo $data['serial_num']; ?></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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