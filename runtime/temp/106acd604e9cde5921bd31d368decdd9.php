<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\activity\save.html";i:1568711777;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;}*/ ?>
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
                <!-- <input type="hidden" name="type" value="1"> -->

                <div class="layui-form-item">
                    <label class="layui-form-label">满</label>
                    <div class="layui-input-inline">
                        <input type="text" name="full_price" value="<?php echo $list['full_price']; ?>" lay-verify="required" autocomplete="off" placeholder="￥0.00" class="layui-input">
                    </div>
                    <div class="layui-form-mid" style="margin-left:10px">减</div>
                    <div class="layui-input-inline">
                        <input type="text" name="less_price" value="<?php echo $list['less_price']; ?>" lay-verify="required" autocomplete="off" placeholder="￥0.00" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">满多少减多少</div>
                </div>

                <!-- <div class="layui-form-item">
                    <label class="layui-form-label">选择商家</label>
                    <div class="layui-input-block">
                    <input type="radio" name="type" value="1" title="所有商家" lay-filter="goods" <?php if($list['type'] == 1 OR empty($list)): ?>checked<?php endif; ?> >
                    <input type="radio" name="type" value="2" title="指定商家" lay-filter="goods" <?php if($list['type'] == 2): ?>checked<?php endif; ?> >
                    </div>
                </div> -->

                  <div class="layui-form-item shop">
                    <label class="layui-form-label">请选择商家</label>
                    <div class="layui-input-block">
                     <?php if(empty($list)): if(is_array($shop) || $shop instanceof \think\Collection || $shop instanceof \think\Paginator): if( count($shop)==0 ) : echo "" ;else: foreach($shop as $key=>$v): ?>
                         <input type="checkbox" name="shop_id[]" title="<?php echo $v['shop_name']; ?>" value="<?php echo $v['id']; ?>">
                        <?php endforeach; endif; else: echo "" ;endif; else: if(is_array($shop) || $shop instanceof \think\Collection || $shop instanceof \think\Paginator): if( count($shop)==0 ) : echo "" ;else: foreach($shop as $key=>$v): ?>
                          <input type="checkbox" name="shop_id[]" title="<?php echo $v['shop_name']; ?>" value="<?php echo $v['id']; ?>" <?php if(in_array($v['id'],$list['shop_id'])): ?>checked<?php endif; ?>>
                         <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </div>
                  </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">有效天数</label>
                    <div class="layui-input-block">
                       <input type="text" name="day" value="<?php echo $list['day']; ?>" lay-verify="required" autocomplete="off" placeholder="请输入内容" class="layui-input">
                       <div class="layui-form-mid layui-word-aux">用户领取后，多少天内有效</div>
                    </div>
                </div>


                <div class="layui-form-item ">
                    <label class="layui-form-label">领取时间</label>
                    <div class="layui-input-inline">
                        <input type="text" name="start_time" value="<?php echo $list['start_time']; ?>" id="start" autocomplete="off" placeholder="领取优惠劵的开始时间" class="layui-input">
                    </div>
                    <div class="layui-form-mid" style="margin-left:10px">至</div>
                    <div class="layui-input-inline">
                        <input type="text" name="end_time" value="<?php echo $list['end_time']; ?>" id="end" autocomplete="off" placeholder="领取优惠劵的结束时间" class="layui-input">
                    </div>
                </div>

                <!-- <div class="layui-form-item">
                    <label class="layui-form-label">发放数量</label>
                    <div class="layui-input-block">
                       <input type="number" name="num" value="<?php echo $list['num']; ?>" lay-verify="required" autocomplete="off" placeholder="请输入内容" class="layui-input">
                    </div>
                </div> -->

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
<script>
    layui.use(['form','laydate'],function(){
        var form = layui.form;
        var laydate = layui.laydate;

        //开始时间
        laydate.render({
            elem: '#start', //指定元素
            type:'date',
            done:function(value,date){
                end.config.min = {
                    year:date.year,
                    month:date.month-1, 
                    date: date.date,
                };
                if(value > $('#end').val()){
                    $('#end').val('');
                }
            }
        });

        var end = laydate.render({
            elem: '#end', //指定元素
            type:'date',
        });
        
    })


    //表单上传
    fromUpload('form',"<?php echo url('Activity/save'); ?>");
</script>