<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"D:\phpStudy\PHPTutorial\WWW\yzcd\public/../application/admin\view\index\console.html";i:1571881502;s:72:"D:\phpStudy\PHPTutorial\WWW\yzcd\application\admin\view\common\meta.html";i:1552356108;}*/ ?>
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
    



<body>

  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
         <!--销售统计开始-->
         <form action="" method="post">
         <div class="layui-col-sm12" style="background: #e2e2e2">
                <div class="layui-card">
                  <div class="layui-card-header">
                    订单统计
                    <!-- <div class="layui-btn-group layuiadmin-btn-group" style="display: flex;justify-content: center;align-items: center;top: 0;height: 100%">
                     <input type="text" name="time" value="<?php echo \think\Request::instance()->param('time'); ?>"  placeholder="请选择时间" autocomplete="off" class="layui-input" style="margin-right: 10px" id="test1">
                      <button type="submit" class="layui-btn layui-btn-primary layui-btn-xs" style="border-left: 1px solid #C9C9C9 !important;">查询</button>
                    </div> -->
                  </div>

                  <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px 7.5px 7.5px 0">
                         <div class="layui-card">
                           <div class="layui-card-header">
                             月订单总量
                             <span class="layui-badge layui-bg-blue layuiadmin-badge">月</span>
                           </div>
                           <div class="layui-card-body layuiadmin-card-list">

                             <p class="layuiadmin-big-font"> <?php echo $order['month_ordernum']; ?> </p>
                             <p>
                               月订单总量
                               <span class="layuiadmin-span-color"> <?php echo $order['month_ordernum']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                             </p>
                           </div>
                         </div>
                    </div>
                     <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px">
                        <div class="layui-card">
                          <div class="layui-card-header">
                            月订单总销售额
                            <span class="layui-badge layui-bg-orange layuiadmin-badge">月</span>
                          </div>
                          <div class="layui-card-body layuiadmin-card-list">

                            <p class="layuiadmin-big-font"> <?php echo $order['month_money']; ?> </p>
                            <p>
                              月订单总销售额
                              <span class="layuiadmin-span-color"> <?php echo $order['month_money']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px;">
                           <div class="layui-card">
                             <div class="layui-card-header">
                               年订单总量
                              <span class="layui-badge layui-bg-blue layuiadmin-badge">年</span>
                             </div>
                             <div class="layui-card-body layuiadmin-card-list">

                               <p class="layuiadmin-big-font"> <?php echo $order['year_ordernum']; ?> </p>
                               <p>
                                 年订单总量
                                 <span class="layuiadmin-span-color"> <?php echo $order['year_ordernum']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                               </p>
                             </div>
                           </div>
                         </div>
                         <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px;">
                              <div class="layui-card">
                                <div class="layui-card-header">
                                  年订单总销售额
                                  <span class="layui-badge layui-bg-orange layuiadmin-badge">年</span>
                                </div>
                                <div class="layui-card-body layuiadmin-card-list">

                                  <p class="layuiadmin-big-font"> <?php echo $order['year_money']; ?> </p>
                                  <p>
                                    年订单总销售额
                                    <span class="layuiadmin-span-color"> <?php echo $order['year_money']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                                  </p>
                                </div>
                              </div>
                            </div>

                 </div>
              </div>
              </form>
            <!--销售统计结束-->

             <!--会员统计开始-->
              <form action="" method="post">
                     <div class="layui-col-sm12" style="background: #e2e2e2">
                            <div class="layui-card">
                              <div class="layui-card-header">
                                会员统计
                                <!-- <div class="layui-btn-group layuiadmin-btn-group" style="display: flex;justify-content: center;align-items: center;top: 0;height: 100%">
                                        <input type="text" name="user_time"  placeholder="请选择时间" autocomplete="off" class="layui-input" style="margin-right: 10px" id="test2">
                                        <p href="javascript:;" class="layui-btn layui-btn-primary layui-btn-xs" style="border-left: 1px solid #C9C9C9 !important;">查询</p>
                                </div> -->
                              </div>

                              <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px 7.5px 7.5px 0">
                                     <div class="layui-card">
                                       <div class="layui-card-header">
                                         日增长用户
                                         <span class="layui-badge layui-bg-blue layuiadmin-badge">日</span>
                                       </div>
                                       <div class="layui-card-body layuiadmin-card-list">

                                         <p class="layuiadmin-big-font"> <?php echo $user['day_user']; ?> </p>
                                         <p>
                                           总用户数量
                                           <span class="layuiadmin-span-color"> <?php echo $user['all_user']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                                         </p>
                                       </div>
                                     </div>
                                </div>
                                  <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px;">
                                       <div class="layui-card">
                                         <div class="layui-card-header">
                                           周增长用户
                                          <span class="layui-badge layui-bg-blue layuiadmin-badge">周</span>
                                         </div>
                                         <div class="layui-card-body layuiadmin-card-list">

                                           <p class="layuiadmin-big-font"> <?php echo $user['week_user']; ?> </p>
                                           <p>
                                             总用户数量
                                             <span class="layuiadmin-span-color"> <?php echo $user['all_user']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                                           </p>
                                         </div>
                                       </div>
                                     </div>
                                 <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px">
                                    <div class="layui-card">
                                      <div class="layui-card-header">
                                        月增长用户
                                        <span class="layui-badge layui-bg-orange layuiadmin-badge">月</span>
                                      </div>
                                      <div class="layui-card-body layuiadmin-card-list">

                                        <p class="layuiadmin-big-font"> <?php echo $user['month_user']; ?> </p>
                                        <p>
                                          总用户数量
                                          <span class="layuiadmin-span-color"> <?php echo $user['all_user']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                                        </p>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px;">
                                      <div class="layui-card">
                                        <div class="layui-card-header">
                                          年增长用户
                                          <span class="layui-badge layui-bg-orange layuiadmin-badge">年</span>
                                        </div>
                                        <div class="layui-card-body layuiadmin-card-list">

                                          <p class="layuiadmin-big-font"> <?php echo $user['year_user']; ?> </p>
                                          <p>
                                            总用户数量
                                            <span class="layuiadmin-span-color"> <?php echo $user['all_user']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                                          </p>
                                        </div>
                                      </div>
                                    </div>


                             </div>
                          </div>
                          </form>
                   <!--会员统计结束-->



             <!--商家统计开始-->
              <form action="" method="post">
                     <div class="layui-col-sm12" style="background: #e2e2e2">
                            <div class="layui-card">
                              <div class="layui-card-header">
                                商家统计
                                <!-- <div class="layui-btn-group layuiadmin-btn-group" style="display: flex;justify-content: center;align-items: center;top: 0;height: 100%">
                                        <input type="text" name="user_time"  placeholder="请选择时间" autocomplete="off" class="layui-input" style="margin-right: 10px" id="test2">
                                        <p href="javascript:;" class="layui-btn layui-btn-primary layui-btn-xs" style="border-left: 1px solid #C9C9C9 !important;">查询</p>
                                </div> -->
                              </div>

                              <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px 7.5px 7.5px 0">
                                     <div class="layui-card">
                                       <div class="layui-card-header">
                                         日增长商家
                                         <span class="layui-badge layui-bg-blue layuiadmin-badge">日</span>
                                       </div>
                                       <div class="layui-card-body layuiadmin-card-list">

                                         <p class="layuiadmin-big-font"> <?php echo $shop['day_shop']; ?> </p>
                                         <p>
                                           总商家数量
                                           <span class="layuiadmin-span-color"> <?php echo $shop['all_shop']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                                         </p>
                                       </div>
                                     </div>
                                </div>
                                  <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px;">
                                       <div class="layui-card">
                                         <div class="layui-card-header">
                                           周增长商家
                                          <span class="layui-badge layui-bg-blue layuiadmin-badge">周</span>
                                         </div>
                                         <div class="layui-card-body layuiadmin-card-list">

                                           <p class="layuiadmin-big-font"> <?php echo $shop['week_shop']; ?> </p>
                                           <p>
                                             总商家数量
                                             <span class="layuiadmin-span-color"> <?php echo $shop['all_shop']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                                           </p>
                                         </div>
                                       </div>
                                     </div>
                                 <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px">
                                    <div class="layui-card">
                                      <div class="layui-card-header">
                                        月增长商家
                                        <span class="layui-badge layui-bg-orange layuiadmin-badge">月</span>
                                      </div>
                                      <div class="layui-card-body layuiadmin-card-list">

                                        <p class="layuiadmin-big-font"> <?php echo $shop['month_shop']; ?> </p>
                                        <p>
                                          总商家数量
                                          <span class="layuiadmin-span-color"> <?php echo $shop['all_shop']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                                        </p>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px;">
                                      <div class="layui-card">
                                        <div class="layui-card-header">
                                          年增长商家
                                          <span class="layui-badge layui-bg-orange layuiadmin-badge">年</span>
                                        </div>
                                        <div class="layui-card-body layuiadmin-card-list">

                                          <p class="layuiadmin-big-font"> <?php echo $shop['year_shop']; ?> </p>
                                          <p>
                                            总商家数量
                                            <span class="layuiadmin-span-color"> <?php echo $shop['all_shop']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                                          </p>
                                        </div>
                                      </div>
                                    </div>


                             </div>
                          </div>
                          </form>
                   <!--商家统计结束-->



             <!--预约统计开始-->
              <form action="" method="post">
                     <div class="layui-col-sm12" style="background: #e2e2e2">
                            <div class="layui-card">
                              <div class="layui-card-header">
                                预约统计
                                <!-- <div class="layui-btn-group layuiadmin-btn-group" style="display: flex;justify-content: center;align-items: center;top: 0;height: 100%">
                                        <input type="text" name="user_time"  placeholder="请选择时间" autocomplete="off" class="layui-input" style="margin-right: 10px" id="test2">
                                        <p href="javascript:;" class="layui-btn layui-btn-primary layui-btn-xs" style="border-left: 1px solid #C9C9C9 !important;">查询</p>
                                </div> -->
                              </div>

                              <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px 7.5px 7.5px 0">
                                     <div class="layui-card">
                                       <div class="layui-card-header">
                                         日预约数量
                                         <span class="layui-badge layui-bg-blue layuiadmin-badge">日</span>
                                       </div>
                                       <div class="layui-card-body layuiadmin-card-list">

                                         <p class="layuiadmin-big-font"> <?php echo $reserve['day_reserve']; ?> </p>
                                         <p>
                                           日预约数量
                                           <span class="layuiadmin-span-color"> <?php echo $reserve['day_reserve']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                                         </p>
                                       </div>
                                     </div>
                                </div>
                                  <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px;">
                                       <div class="layui-card">
                                         <div class="layui-card-header">
                                           周预约数量
                                          <span class="layui-badge layui-bg-blue layuiadmin-badge">周</span>
                                         </div>
                                         <div class="layui-card-body layuiadmin-card-list">

                                           <p class="layuiadmin-big-font"> <?php echo $reserve['week_reserve']; ?> </p>
                                           <p>
                                             周预约数量
                                             <span class="layuiadmin-span-color"> <?php echo $reserve['week_reserve']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                                           </p>
                                         </div>
                                       </div>
                                     </div>
                                 <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px">
                                    <div class="layui-card">
                                      <div class="layui-card-header">
                                        月预约数量
                                        <span class="layui-badge layui-bg-orange layuiadmin-badge">月</span>
                                      </div>
                                      <div class="layui-card-body layuiadmin-card-list">

                                        <p class="layuiadmin-big-font"> <?php echo $reserve['month_reserve']; ?> </p>
                                        <p>
                                          月预约数量
                                          <span class="layuiadmin-span-color"> <?php echo $reserve['month_reserve']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                                        </p>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="layui-col-sm6 layui-col-md3" style="padding: 7.5px;">
                                      <div class="layui-card">
                                        <div class="layui-card-header">
                                          年预约数量
                                          <span class="layui-badge layui-bg-orange layuiadmin-badge">年</span>
                                        </div>
                                        <div class="layui-card-body layuiadmin-card-list">

                                          <p class="layuiadmin-big-font"> <?php echo $reserve['year_reserve']; ?> </p>
                                          <p>
                                            年预约数量
                                            <span class="layuiadmin-span-color"> <?php echo $reserve['year_reserve']; ?> <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                                          </p>
                                        </div>
                                      </div>
                                    </div>

                             </div>
                          </div>
                          </form>
                   <!--预约统计结束-->



    </div>
  </div>


</body>
<script>

layui.use('laydate', function(){
  var laydate = layui.laydate;

  //执行一个laydate实例
  laydate.render({
    elem: '#test1' //指定元素
  });
   laydate.render({
      elem: '#test2' //指定元素
    });
    laydate.render({
         elem: '#test3' //指定元素
       });
});
</script>

<script type="text/javascript">
    layui.config({
        base: "/static/admin/" //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'sample']);
</script>

<script>
    layui.use(['table','form'],function(){
        var table = layui.table;
        var form = layui.form;
        var url = "<?php echo url('Index/console'); ?>";

        //监听搜索
        form.on('submit(LAY-app-contlist-search)', function(data){
            var field = data.field;
            field.page = 1;
            //执行重载
            table.reload('test-table-autowidth', {
                where: field
            });
        });

        table.render({
            elem: '#test-table-autowidth',
            url:url,
            method:'post',
            response:{
                statusCode:200
            },
            page:{
                layout:['prev','page','next','skip','count']
            },
            limit:20,
            toolbar:'#add',
            defaultToolbar:false,
            cols:[[
                {field:'id',title:'编号',width:'4%'},
                {title:'商品信息',width:'26%',templet:function(d){
                    var str = '';
                        str += '<div style="float:left"><img src="'+d.pic+'" style="width:50px;margin-right:5px" alt="" /></div>';
                        str+= '<div style="float:left"><p style="line-height:27px">'+d.title+'</p><p style="font-size:12px;line-height:18px">'+d.old_title+'</p></div>';
                        return str;
                }},
                {field:'visit',title:'访问次数',width:'10%',align:'center'},
                {field:'number',title:'访问人数',width:'10%',align:'center'},
                {field:'add_number',title:'加购人数',width:'10%',align:'center'},
                {field:'buy',title:'购买人数',width:'10%',align:'center'},
                {field:'add_count',title:'加购总人数',width:'10%',align:'center'},
                {field:'add_num',title:'加购总件数',width:'10%',align:'center'},
                {field:'add_money',title:'加购总金额',width:'10%',align:'center'},
            ]]
        })
    })
</script>