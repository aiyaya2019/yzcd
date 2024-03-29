<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\login\login.html";i:1552440089;}*/ ?>
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
    <link rel="stylesheet" href="/static/admin/style/login.css" media="all">
</head>
<body>
    <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">
        <div class="layadmin-user-login-main">
            <div class="layadmin-user-login-box layadmin-user-login-header">
                <h2><?php echo $config['title']; ?></h2>
                <p style="font-weight:400"><?php echo $config['title']; ?> 后台管理系统</p>
            </div>
            <form action="">
                <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                    <div class="layui-form-item">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
                        <input type="text" name="username" id="LAY-user-login-username" lay-verify="required" placeholder="用户名" class="layui-input">
                    </div>
                    <div class="layui-form-item">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                        <input type="password" name="password" id="LAY-user-login-password" lay-verify="required" placeholder="密码" class="layui-input">
                    </div>
                    <!-- <div class="layui-form-item">
                        <div class="layui-row">
                            <div class="layui-col-xs7">
                                <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-vercode"></label>
                                <input type="text" name="vercode" id="LAY-user-login-vercode" lay-verify="required" placeholder="图形验证码" class="layui-input">
                            </div>
                            <div class="layui-col-xs5">
                                <div style="margin-left: 10px;">
                                    <img src="https://www.oschina.net/action/user/captcha" class="layadmin-user-login-codeimg" id="LAY-user-get-vercode">
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="layui-form-item">
                        <div class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-back-submit">登 入</div>
                    </div>
                </div>
            </form>
        </div>

        <div class="layui-trans layadmin-user-login-footer">
            <p>© <?php echo date('Y',time()); ?> <a href="http://www.kailly.com/" target="_blank">技术支持：开利网络</a></p>
        </div>
    </div>
</body>
<script type="text/javascript" src="/static/admin/jquery.js"></script>
<script src="/static/admin/layui/layui.js"></script>
<script src="/static/admin/common.js"></script>

<script>
    fromUpload('form',"<?php echo url('Login/login'); ?>",function(data){
        if(data.code == 200){
            layer.msg('登录成功',{time:1500},function(){
                location.href = "<?php echo url('Index/index'); ?>";
            })
        } else {
            layer.msg(data.msg);
        }
    });
</script>

</html>
