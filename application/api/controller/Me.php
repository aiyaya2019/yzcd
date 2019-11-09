<?php
namespace app\api\controller;
use app\common\model\Address;
use app\common\model\User;
use app\common\model\UserCoupon;
use app\common\model\PointChange;
use app\common\model\Reserve;
use app\common\model\Feedback;
use app\common\model\Activities;
use app\common\model\CarLamp;
use app\common\model\RedPack;
use app\common\model\Coupon;
use app\common\model\Config;
use app\common\model\Shop;
use \think\Db;
use \think\Session;
use \think\Cache;


/**
 * 会员中心
 */
class Me extends Common{	

	/**
     * 注册会员
     */
    public function register(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }
            if(empty($post['name'])){ return_ajax(400,'缺少name'); }
            if(empty($post['phone'])){ return_ajax(400,'缺少phone'); }
            if(empty($post['car_type'])){ return_ajax(400,'缺少car_type'); }
            if(empty($post['license_plate'])){ return_ajax(400,'缺少license_plate'); }
            if(empty($post['code'])){ return_ajax(400,'缺少code'); }//验证码

            $cache = Cache::get('code' .$post['uid']);
            // if ($cache['msgcode'] != $post['code']) { return_ajax(400, '验证码错误'); }

            $id = $post['uid'];
            unset($post['uid']);
            unset($post['code']);

            $pid = User::where('id', $id)->value('pid');
            if ($pid) {
                $config = Config::where('id', '1')->find();
                if ($config['point']) {
                    $point_change = [
                        'uid'      => $pid,
                        'point'    => '+' .$config['point'],
                        'type'     => '1',
                        'msg'      => '邀请获得积分',
                    ];
                    Db::startTrans();
                    $rs_user       = User::where('id', $id)->update($post);
                    $rs_piont      = $this->grantPoint($point_change);
                    $rs_user_point = User::where('id', $pid)->setInc('point', $config['point']);
                    if (($rs_user && $rs_piont) && $rs_user_point) {
                        Db::commit();// 提交事务
                        return_ajax(200, '注册成功');
                    }else{
                        Db::rollback();// 回滚事务
                        return_ajax(400, '操作失败');
                    }
                }else{

                    $rs = User::where('id', $id)->update($post);

                    if ($rs){
                        return_ajax(200, '注册成功', $rs);
                    }else{
                        return_ajax(400, '注册失败');
                    }

                }
                # code...
            }else{

                $rs = User::where('id', $id)->update($post);

                if ($rs){
                    return_ajax(200, '注册成功', $rs);
                }else{
                    return_ajax(400, '注册失败');
                }
            }

        }
    }

    /**
     * 获取用户信息
     */
    public function getUserInfo(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }

            $data = User::where('id', $post['uid'])->find();

            if ($data){
                $data['is_register'] = $data['car_type'] ? '1' : '2';//1已注册；0未注册
                $data['is_new']      = '2';//老用户
                $is_shop             = Shop::where('uid', $post['uid'])->find();

                if ($is_shop) {
                    $data['is_shop'] = '1';
                    $data['msg']     = '您已经申请入驻，请登录';
                }else {
                    $data['is_shop'] = '0';
                    $data['msg']     = '还没申请过商家，可以申请';
                }
                
                $data['coupon_num'] = UserCoupon::where('uid', $post['uid'])->count('id');
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 我的积分
     */
    public function getPoint(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }

            $data = PointChange::where('uid', $post['uid'])->order('id desc')->page($page, '10')->select();

            if ($data){
                $count = User::where('id', $post['uid'])->value('point');
                return_ajax(200, '获取成功', $data, $count);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 领取优惠券
     */
    public function addCoupon(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }
            if(empty($post['coupon_id'])){ return_ajax(400,'缺少coupon_id'); }

            $w['uid']       = $post['uid'];
            $w['coupon_id'] = $post['coupon_id'];

            $check = UserCoupon::where($w)->find();
            if($check){ return_ajax(400, '你已经领取该优惠券'); }

            $coupon = Coupon::where('id', $post['coupon_id'])->find();

            $time     = time();
            $day_time = $time + $coupon['day'] * '24' * '60' * '60';

            $array = [
                'uid'         => $post['uid'],//用户id
                'shop_id'     => $coupon['shop_id'],//商家id
                'coupon_id'   => $coupon['id'],//优惠券id
                'coupon_code' => $coupon['coupon_code'],//券码
                'title'       => $coupon['title'],//标题
                'full_price'  => $coupon['full_price'],//条件金额
                'less_price'  => $coupon['less_price'],//折扣金额
                'day'         => $coupon['day'],//领取后的有效天数
                'start_time'  => strtotime($coupon['start_time']),//领取开始时间
                'end_time'    => strtotime($coupon['end_time']),//领取结束时间
                'add_time'    => $time,//领取时间
                'day_time'    => $day_time,//优惠券到期时间
            ];

            $rs = UserCoupon::insert($array);


            if ($rs){
                return_ajax(200, '领取成功', $rs);
            }else{
                return_ajax(400, '领取失败');
            }
        }

    }

    /**
     * 我的优惠券
     */
    public function getCoupon(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }
            if(empty($post['status'])){ return_ajax(400,'缺少status'); }

            $where['uid']    = $post['uid'];
            if ($post['status'] == '1') {
                $where['status'] = $post['status'];
            }else{
                $where['status'] = ['in', [2,3]];
            }

            $data = UserCoupon::where($where)->order('id desc')->page($page, '10')->select();

            if ($data){
                foreach ($data as $key => &$value) {
                    $data[$key]['day_time'] = date('Y-m-d', $value['day_time']);
                }
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
        }
    }

    /**
     * 获取优惠券详情
     */
    public function getCouponDetail(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少id'); }

            $data = UserCoupon::where('id', $post['id'])->find();

            if ($data){

                //生成二维码
                $Weix = controller('Weix');
                $data['code'] = $Weix->erm($data['id'], '3');
                
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }



    /**
     * 我的订单(我的预约)
     */
    public function getOrderList(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }
            
            if ($post['status']) {
                $where['status'] = $post['status'];
            }

            $where['uid'] = $post['uid'];
            
            $data = Reserve::with('Shop')->where($where)->order('id desc')->page($page, '10')->select();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
        }
    }

    /**
     * 获取我的订单(我的预约)详情
     */
    public function getOrderDetail(){
        if(request()->isPost()){
            $post = input('post.');
            if(empty($post['id'])){ return_ajax(400,'缺少id'); }

            $where['id'] = $post['id'];
            
            $data = Reserve::with('Shop')->where($where)->find();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
        }
    }

    /**
     * 取消预约
     */
    public function cancelOrder(){
        if(request()->isPost()){
            $post = input('post.');
            if(empty($post['id'])){ return_ajax(400,'缺少id'); }
            if(empty($post['refund_reason'])){ return_ajax(400,'缺少refund_reason'); }

            $where['id'] = $post['id'];

            $arr = [
                'status'        => '4',
                'refund_reason' => $post['refund_reason'],
                'update_time'   => time(),
            ];
            
            $data = Reserve::where($where)->update($arr);

            if ($data){
                return_ajax(200, '申请成功', $data);
            }else{
                return_ajax(400, '申请失败');
            }
        }
    }

    /**
     * 我的联保
     */
    public function getMyRepair(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }
            
            $where['status'] = '3';
            $where['uid']    = $post['uid'];
            
            $data = Reserve::with('Shop')->where($where)->order('id desc')->page($page, '10')->select();

            if ($data){
                foreach ($data as $key => &$value) {
                    if ($value['end_time'] > time()) {
                        $data[$key]['state'] = '保障中';
                    }else{
                        $data[$key]['state'] = '已过期';
                    }
                    $data[$key]['pay_time'] = date('Y-m-d', $value['pay_time']);
                    $data[$key]['end_time'] = date('Y-m-d', $value['end_time']);
                }
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
        }
    }


    /**
     * 我的团队
     */
    public function getMyTeam(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }
            
            $where['pid'] = $post['uid'];

            $field = 'id, nickname, head_img, name, phone, add_time, sex';
            
            $data = User::where($where)->field($field)->order('id desc')->page($page, '10')->select();

            if ($data){
                foreach ($data as $key => &$value) {
                    $data[$key]['nickname'] = emojiDecode($value['nickname']);
                }
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
        }
    }

    /**
     * 分销订单
     */
    public function getChildOrder(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }
            
            $where['pid'] = $post['uid'];
            
            $data = Reserve::with('User')->where($where)->order('id desc')->page($page, '10')->select();

            if ($data){
                foreach ($data as $key => $value) {
                    $data[$key]['pay_time'] = date('Y-m-d H:i:s', $value['pay_time']);
                }
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
        }
    }

    /**
     * 我的邀请码
     */
    public function getInviteErm(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }
            
            //生成二维码
            $Weix = controller('Weix');
            $code = $Weix->erm($post['uid'], '1');

            if ($code){
                return_ajax(200, '获取成功', $code);
            }else{
                return_ajax(400, '暂无信息');
            }
        }
    }

    /**
     * 建议反馈
     */
    public function addFeedback(){

                // $access_token = $Weix->getAccessToken();

                // $url = 'https://api.weixin.qq.com/cgi-bin/wxaapp/createwxaqrcode?access_token=' .$access_token;
                // $res = array('path'=>'pages/index/index?uid=' .$post['uid'], 'width'=>430);

                // $result = api_notice_increment($url, json_encode($res));
                // $code = 'share/' .$post['uid'] .'.jpg';
                // file_put_contents($code, $result);


        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }
            if(empty($post['content'])){ return_ajax(400,'缺少content'); }
            if(empty($post['contact'])){ return_ajax(400,'缺少contact'); }
            if(empty($post['img'])){ return_ajax(400,'缺少img'); }

            $post['add_time'] = time();
            $post['update_time'] = time();

            $data = Feedback::insert($post);

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
        }
    }


    /**
     * 活动通知列表
     */
    public function getActivityList(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            $where['status'] = '1';

            $data = Activities::where($where)->order('id desc')->page($page, '10')->select();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
        }
    }

    /**
     * 活动通知详情
     */
    public function getActivityDetail(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少id'); }

            $where['id'] = $post['id'];

            $data = Activities::where($where)->find();

            if ($data){
                $data['content'] = str_replace('src="/uploads/', 'src="'.$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER['HTTP_HOST'].'/uploads/', $data['content']);
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 我的车灯
     */
    public function getCarLamp(){
        if(request()->isPost()){
            $post = input('post.');

            $where['status'] = '1';

            // $field = ("id, add_time, FROM_UNIXTIME(add_time,'%Y%m') months, group_concat(img) as img");
            $field = ("FROM_UNIXTIME(add_time,'%Y%m') months, group_concat(id) as ids, add_time");

            $ids = Db::name('car_lamp')->field($field)->where($where)->order('months desc')->group('months')->select();
            // print_r($ids);exit;

            // $data = Db::name('car_lamp')->field($field)->where($where)->order('months desc')->group('months')->select();

            if ($ids){
                $data = [];
                foreach ($ids as $key => $value) {
                    $data[$key]['add_time'] = date('Y年m月', $value['add_time']);
                    $data[$key]['months'] = $value['months'];
                    $data[$key]['img'] = Db::name('car_lamp')->field('id, img')->where('id', 'in', $value['ids'])->order('id desc')->select();
                }

                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
        }
    }

    /**
     * 删除车灯
     */
    public function delCarLamp(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少id'); }

            $data = CarLamp::where('id', 'in', $post['id'])->delete();

            if ($data){
                return_ajax(200, '删除成功', $data);
            }else{
                return_ajax(400, '删除失败');
            }
        }
    }

    /**
     * 上传车灯
     */
    public function addCarLamp(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }
            if(empty($post['img'])){ return_ajax(400,'缺少img'); }

            $arr = [];
            foreach ($post['img'] as $key => $value) {
                $arr[$key] = [
                    'uid' => $post['uid'],
                    'img' => $value,
                    'add_time' => time(),
                    'update_time' => time(),
                ];
            }

            $data = CarLamp::insertAll($arr);

            if ($data){
                return_ajax(200, '上传成功', $data);
            }else{
                return_ajax(400, '上传失败');
            }
        }
    }


    /**
     * 收货地址列表
     */
    public function getAddressList(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400, '缺少用户id'); }

            $where['uid'] = $post['uid'];

            $data = Address::where($where)->order('id desc')->select();
            
            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 获取默认收货地址
     */
    public function getDefaultAddress(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400, '缺少用户id'); }

            $where['uid'] = $post['uid'];
            $where['default'] = '1';

            $data = Address::where($where)->find();
            
            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 添加、编辑 收货地址
     */
    public function addAddress(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400, '缺少用户id'); }
            if(empty($post['name'])){ return_ajax(400, '缺少name'); }
            if(empty($post['phone'])){ return_ajax(400, '缺少phone'); }
            if(empty($post['province'])){ return_ajax(400, '缺少province'); }
            if(empty($post['city'])){ return_ajax(400, '缺少city'); }
            if(empty($post['area'])){ return_ajax(400, '缺少area'); }
            if(empty($post['address'])){ return_ajax(400, '缺少address'); }
            if(empty($post['default'])){ return_ajax(400, '缺少default'); }

            $address = new Address;

            $where['uid']     = $post['uid'];
            $where['default'] = '1';
            // 检查是否有已默认的收货地址
            $check = Address::where($where)->find();
            if ($check) {
                if ($post['default'] == '1') {
                    $rs = Address::where('uid', $post['uid'])->update(['default' => '2', 'update_time' => time()]);
                    if (!$rs) {
                        return_ajax(400, '操作失败');
                    }
                }
            }

            if ($post['id']) {//编辑
                $id = $post['id'];
                unset($post['id']);
                $post['update_time'] = time();
                $res = Address::where('id', $id)->update($post);
            }else{
                $res = $address->allowField(true)->save($post);
            }
            
            if ($res){
                return_ajax(200, '操作成功', $res);
            }else{
                return_ajax(400, '操作失败');
            }
        }
    }

    /**
     * 设置默认收货地址
     */
    public function setDefalutAddress(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400, '缺少用户id'); }
            if(empty($post['id'])){ return_ajax(400, '缺少id'); }
            if(empty($post['default'])){ return_ajax(400, '缺少default'); }

            $address = new Address;

            $where['uid']     = $post['uid'];
            $where['default'] = '1';
            // 检查是否有已默认的收货地址
            $check = Address::where($where)->find();
            if ($check) {
                if ($post['default'] == '1') {
                    $rs = Address::where('uid', $post['uid'])->update(['default' => '2', 'update_time' => time()]);
                    if (!$rs) {
                        return_ajax(400, '操作失败');
                    }
                }
            }

            $id = $post['id'];
            unset($post['id']);
            $post['update_time'] = time();
            $res = Address::where('id', $id)->update(['default' => '1', 'update_time' => time()]);
            
            if ($res){
                return_ajax(200, '操作成功', $res);
            }else{
                return_ajax(400, '操作失败');
            }
        }
    }

    /**
     * 我的红包
     */
    public function getMyRedPack(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['uid'])){ return_ajax(400, '缺少用户id'); }

            $where['uid']  = $post['uid'];
            $where['type'] = ['in', '1,2,3,5'];

            $data = RedPack::where($where)->order('id desc')->page($page, '10')->select();
            $money = User::where('id', $post['uid'])->value('money');   
            
            if ($data){
                return_ajax(200, '操作成功', $data, $money);
            }else{
                return_ajax(400, '操作失败', [], $money);
            }
        }
    }

    /**
     * 领取红包
     */
    public function receiveRedPack(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400, '缺少用户id'); }
            if(empty($post['money'])){ return_ajax(400, '缺少money'); }
            if(empty($post['type'])){ return_ajax(400, '缺少type'); }//1注册领取；2预付款领取；3分享领取

            $post['type'] = time();

            $redpack = new RedPack;

            Db::startTrans();// 启动事务
            $rs_red  = $redpack->allowField(true)->save($post);
            $rs_user = User::where('id', $post['uid'])->setInc('money', $post['money']);
            
            if ($rs_red && $rs_user){
                Db::commit();// 提交事务
                return_ajax(200, '领取成功');
            }else{
                Db::rollback();// 回滚事务
                return_ajax(400, '领取失败');
            }
        }
    }

    /**
     * 分享
     */
    public function share(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400, '缺少用户id'); }


            $config = Config::field('min_red, max_red')->where('id', '1')->find();

            if ($config['min_red'] == '0' && $config['max_red'] == '0') {
                $money = '0';
            }

            $num   = $config['min_red'] + mt_rand() / mt_getrandmax() * ($config['max_red'] - $config['min_red']);
            $money = sprintf("%.2f", $num);
            echo $money;exit;


            
            if (1){
                Db::commit();// 提交事务
                return_ajax(200, '领取成功');
            }else{
                Db::rollback();// 回滚事务
                return_ajax(400, '领取失败');
            }
        }
    }











}
