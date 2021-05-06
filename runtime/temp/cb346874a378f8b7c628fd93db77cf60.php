<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\reserves\save.html";i:1572494400;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\edit.html";i:1546750684;}*/ ?>
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
    



<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-form" lay-filter="layuiadmin-form-admin" style="padding: 20px 30px 1px 0;">
            <form action="" class="layui-form">
                <input type="hidden" name="id" value="<?php echo input('id'); ?>">
                <input type="hidden" name="type" value="1">

                <div class="layui-form-item">
                    <label class="layui-form-label">预约单号</label>
                    <div class="layui-input-block">
                        <input type="text" name="order_sn" value="<?php echo $reserve['order_sn']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">门店</label>
                    <div class="layui-input-block">
                        <input type="text" name="shop_name" value="<?php echo $reserve['shop_name']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">封面图</label>
                     <label class="layui-form-label"></label>
                    <div style="margin-top:10px" id="video_val">
                        <img src="<?php echo $reserve['img']; ?>" style="width:200px" id="img" />
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" value="<?php echo $reserve['title']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">标签名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="label_name" value="<?php echo $reserve['label_name']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">购买数量</label>
                    <div class="layui-input-block">
                        <input type="text" name="buy_num" value="<?php echo $reserve['buy_num']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">预付款</label>
                    <div class="layui-input-block">
                        <input type="text" name="front_money" value="<?php echo $reserve['front_money']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">待付款</label>
                    <div class="layui-input-block">
                        <input type="text" name="wait_money" value="<?php echo $reserve['wait_money']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">市场价</label>
                    <div class="layui-input-block">
                        <input type="text" name="money" value="<?php echo $reserve['money']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">实际支付金额</label>
                    <div class="layui-input-block">
                        <input type="text" name="pay_money" value="<?php echo $reserve['pay_money']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <!-- <div class="layui-form-item">
                    <label class="layui-form-label">实际支付总金额</label>
                    <div class="layui-input-block">
                        <input type="text" name="pay_allmoney" value="<?php echo $reserve['pay_allmoney']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div> -->
                <div class="layui-form-item">
                    <label class="layui-form-label">优惠金额</label>
                    <div class="layui-input-block">
                        <input type="text" name="coupon_money" value="<?php echo $reserve['coupon_money']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">预约时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="reserve_time" value="<?php echo $reserve['reserve_time']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">联保到期时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="end_time" value="<?php echo $reserve['end_time']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">姓名</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" value="<?php echo $reserve['name']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">手机号</label>
                    <div class="layui-input-block">
                        <input type="text" name="phone" value="<?php echo $reserve['phone']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">车牌号</label>
                    <div class="layui-input-block">
                        <input type="text" name="car_number" value="<?php echo $reserve['car_number']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">产品序列号</label>
                    <div class="layui-input-block">
                        <input type="text" name="goods_num" value="<?php echo $reserve['goods_num']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">退款原因</label>
                    <div class="layui-input-block">
                        <input type="text" name="refund_reason" value="<?php echo $reserve['refund_reason']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" readonly="readonly">
                    </div>
                </div>
                <!-- <div class="layui-form-item">
                    <label class="layui-form-label">退款失败原因</label>
                    <div class="layui-input-block">
                        <input type="text" name="fail_reason" value="<?php echo $reserve['fail_reason']; ?>" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" />
                    </div>
                </div> -->
                <div class="layui-form-item">
                    <label class="layui-form-label">退款失败原因</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入" lay-verify="required" name="content" class="layui-textarea"><?php echo $reserve['fail_reason']; ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">状态</label>
                    <!-- 状态：1待支付；2未服务(已支付定金)；3已服务(已支付总金)；4取消中(申请退款)；5已取消(已退款)；6申请失败(退款失败) -->
                    <div class="layui-input-block">
                        <input type="radio" name="status" value="1" title='待支付' <?php if($reserve['status'] == 1 OR empty($reserve)): ?>checked<?php endif; ?>>
                        <input type="radio" name="status" value="2" title='未服务' <?php if($reserve['status'] == 2): ?>checked<?php endif; ?>>
                        <input type="radio" name="status" value="3" title='已服务' <?php if($reserve['status'] == 3): ?>checked<?php endif; ?>>
                        <input type="radio" name="status" value="4" title='申请退款' <?php if($reserve['status'] == 4): ?>checked<?php endif; ?>>
                        <input type="radio" name="status" value="5" title='已退款' <?php if($reserve['status'] == 5): ?>checked<?php endif; ?>>
                        <input type="radio" name="status" value="6" title='退款失败' <?php if($reserve['status'] == 6): ?>checked<?php endif; ?>>
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
    layui.use(['upload','laydate'],function(){
        var upload = layui.upload;

        //封面上传
        upload.render({
            elem: '#test1',
            auto: false,
            field:'pic',
            //,multiple: true
            bindAction: '#test1s',
            done: function(res){
              console.log(res)
            }
        });
    })
    //表单上传
    fromUpload('form',"<?php echo url('Reserves/save'); ?>");
</script>