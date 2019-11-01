<?php
namespace app\api\controller;
use \think\Controller;
use \think\Db;

use app\common\model\Banner;
use app\common\model\Config;
use app\common\model\Order;
use app\common\model\User;
use app\common\model\Attr;
use app\common\model\Shop;
use app\common\model\Reserve;
use app\common\model\Cash;
use app\common\model\MoneyChange;
use app\common\model\RedPack;
use app\common\model\Bank;
use app\common\model\Coupon;
use app\common\model\UserCoupon;
use app\common\model\Abouts;
use app\common\model\PointChange;
use app\common\model\City;
use app\common\model\ShopRegisterPay;
use app\common\model\Notice;
use app\common\model\Other;
use think\Cache;

class Common extends Controller{
	
    public function _initialize(){
        $this->changeCouponStatus();
        $this->grantBonus();
         //获取方法名称
        // $action = strtolower(request()->action());
        // $token = input('token');
        // //$token = '9672320aa911e0fd972e5401a494cbcb';
        // if(empty($token) && $action != 'getopenid' && $action != 'update_user'){
        //     return_ajax(400,'缺少接口权限token');
        // }
        // $user = User::where(['token'=>$token])->find();
        // if(empty($user) && $action != 'getopenid' && $action != 'update_user'){ return_ajax(400,'token 错误！'); }
        // if($user['status'] == 2){ return_ajax(400,'您的账号已被冻结，请联系客服'); }
        // $this->uid = $user['id'];
    }

    public function changeCouponStatus(){
        $data = UserCoupon::where('status', '1')->select();
        if ($data) {
            foreach ($data as $key => $value) {
                if (time() > $value['day_time']) {
                    UserCoupon::where('id', $value['id'])->update(['status' => '3']);
                }
            }
        }
    }

    /**
     * [getOpenid 获取用户openid和session_key]
     * @Author   PengJun
     * @DateTime 2019-03-23
     * @return   [type]     [description]
     */
    public function getOpenid(){
        if(request()->isPost()){
            $post = input('post.');
            $config = Config::get(1);

            if(empty($post['code'])){ return_ajax(400,'缺少code参数'); }

            $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$config['appid'].'&secret='.$config['appsecret'].'&js_code='.$post['code'].'&grant_type=authorization_code';
            $info = json_decode(curl_get_contents($url),true);

            return_ajax(200,'获取成功',$info);
        }
    }

    /**
     * [update_user 添加、更新用户信息]
     * @Author   PengJun
     * @DateTime 2019-03-23
     * @return   [type]     [description]
     */
    public function update_user(){
        if(request()->isPost()){
            $post = input('post.');
            $user_model = new User;

            if(empty($post['openid'])){ return_ajax(400,'缺少用户openid'); }

            $user = User::where('openid',$post['openid'])->find();

            $post['token'] = $this->GetToken($user['openid']);
            $post['nickname'] = emojiEncode($post['nickname']);
            $post['head_img'] = $post['headimgurl'];

            $post['update_time'] = time();
            if($user){
                //更新
                if($user_model->allowField(true)->save($post,['id'=>$user['id']])){
                    //查询用户享受的折扣
                    $UserGrade = UserGrade::get($user['grade_id']);
                    $post['identity'] = $UserGrade['title'];
                    $post['discount'] = $UserGrade['discount'];
                    $post['nickname'] = emojiDecode($post['nickname']);
                    return_ajax(200,'登录成功',$post);
                } else {
                    return_ajax(400,'登录失败，请稍后重试！');
                }
            } else {
                //添加
                $post['add_time'] = time();
                $post['identity'] = '普通会员';
                $post['discount'] = 0;
                if($user_model->allowField(true)->save($post)){
                    $post['nickname'] = emojiDecode($post['nickname']);
                    return_ajax(200,'登录成功',$post);
                } else {
                    return_ajax(400,'登录失败，请稍后重试！');
                }
            }
        }
    }

    /**
     * [GetToken 获取用户token]
     * @Author   PengJun
     * @DateTime 2019-03-23
     */
    public function GetToken($openid){
        $key = 'zhizhunbaopishawaimai';
        $token = md5(md5($openid).md5($key).time());

        $isset = User::get(['token'=>$token]);
        if($isset){
            $this->GetToken($openid);
        } else {
            return $token;
        }
    }

	/**
     * [selectAll 公共查询方法]
     * @Author   PengJun
     * @DateTime 2019-03-22
     * @return   [type]     [description]
     */
    public function selectAll($model,$data=[]){
        $table = model($model);
        $where = [];
        $order = 'add_time desc';
        $field = '*';
        $page = empty($data['page'])?1:$data['page'];
        $with = empty($data['with'])?[]:$data['with'];
        $ispage = empty($data['ispage'])?true:$data['ispage'];

        if(!empty($data['where'])){
            $where = $data['where'];
        }

        if(!empty($data['order'])){
            $order = $data['order'];
        }

        if(!empty($data['field'])){
            $field = $data['field'];
        }

        if($ispage == true){
            $info = $table->with($with)->where($where)->order($order)->field($field)->page($page,20)->select();
        } else {
            $info = $table->with($with)->where($where)->order($order)->field($field)->select();
        }

        return $info;
    }

    /**
     * [getFind 查询单条数据]
     * @Author   PengJun
     * @DateTime 2019-04-24
     * @return   [type]     [description]
     */
    public function getFind($model,$data=[]){
        $table = model($model);
        $where = [];
        $order = 'add_time desc';
        $field = '*';
        $with = [];

        if(!empty($data['where'])){
            $where = $data['where'];
        }

        if(!empty($data['order'])){
            $order = $data['order'];
        }

        if(!empty($data['field'])){
            $field = $data['field'];
        }

        if(!empty($data['with'])){
            $with = $data['with'];
        }

        if(!is_array($data)){
            $where['id'] = $data;
        }

        $list = $table->with($with)->where($where)->order($order)->field($field)->find();

        return $list;
    }

    /**
     * [getUser 获取用户信息]
     * @Author   PengJun
     * @DateTime 2019-03-28
     * @return   [type]     [description]
     */
    public function getUser($field){
        $user = User::where('id',$this->uid)->field('id')->field($field)->find();

        return $user;
    }

    /*
    * 1.纬度1，经度1，纬度2，经度2
    * 2.返回结果是单位是KM。
    * 3.保留一位小数
    */
    public function getDistance($lat1, $lng1, $lat2, $lng2){
        //将角度转为狐度
        $radLat1 = deg2rad($lat1);//deg2rad()函数将角度转换为弧度
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6371;
        return round($s, 1);
    }


    /**
     * 轮播图
     */
    public function getBanner(){
        $post = input('post.');
        if (!$post['type']) {
            return_ajax(200, '缺少type');
        }
        $where['type']     = $post['type'];
        $where['url_type'] = '2';

        $data = Banner::field('id, title, pic, url')->where($where)->order('sort desc')->limit('6')->select();
        if ($data) {
            return_ajax(200, '获取成功', $data);
        }else{
            return_ajax(200, '暂无数据');
        }
        
    }



    /**
     * 生成订单号
     */
    public function order_sn($uid, $table){
        $date = date('YmdHis', time());
        $str  = $date .$uid;
        $check = Db::name($table)->where('order_sn', $str)->find();
        if ($check) {
            $this->order_sn();
        }else{
            return $str;
        }
    }

   /**
     * [fileUp 文件上传]
     * @Author   PengJun
     * @DateTime 2019-04-12
     * @return   [type]     [description]
     */
    public function fileUp(){
        if(request()->file('file')){
            $file = imgUpdate('file');
            if($file['code'] == 400){ return_ajax(400, $file['msg']); }

            return_ajax(200,'上传成功',$file['data']);
        }
    }

    /**
     * 基础配置
     */
    public function getConfig(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['flg'])){ return_ajax(400,'缺少flg'); }

            $data = Config::where('id', '1')->value($post['flg']);

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
        }
    }


    /**
     * 获取支付信息
     */
    public function getPayInfo(){
        if(request()->isPost()){
            $post = input('post.');
            if (empty($post['order_sn'])) { return_ajax(400,'缺少必传参数order_sn'); }//订单号
            if (empty($post['type'])) { return_ajax(400,'缺少必传参数type'); }//1商家订单；2客户预约订单

            if ($post['type'] == '1') {
                $order     = Order::where('order_sn', $post['order_sn'])->find();
                $shop      = Shop::where('id', $order['shop_id'])->find();
                $openid    = User::where('id', $shop['uid'])->value('openid');
                $url       = 'https://' .$_SERVER['SERVER_NAME'] .'/api/Weix/shop_callback';
                $pay_money = $order['pay_money'];
                $model     = 'Order';
                $name      = '订单支付';
            }elseif($post['type'] == '2'){
                // 付款成功更新商家余额、余额变化表、更新订单状态  回调中处理

                $reserve   = Reserve::where('order_sn', $post['order_sn'])->find();
                $openid    = User::where('id', $reserve['uid'])->value('openid');
                $url       = 'https://' .$_SERVER['SERVER_NAME'] .'/api/Weix/user_callback';
                $pay_money = $reserve['pay_money'];
                $model     = 'Reserve';
                $name      = '订单支付';
            }else{
                // 商家注册/续费 支付
                $register_pay = ShopRegisterPay::where('order_sn', $post['order_sn'])->find();
                $shop         = Shop::where('id', $register_pay['shop_id'])->find();
                $openid       = User::where('id', $shop['uid'])->value('openid');
                $url          = 'https://' .$_SERVER['SERVER_NAME'] .'/api/Weix/register_callback';
                $pay_money    = $register_pay['pay_money'];
                $model        = 'shop_register_pay';
                $name         = '注册续费支付';
            }

            $wexxin = controller('Weix');
            $res = $wexxin->wxpay($name, $post['order_sn'], $pay_money, $openid, $url);
            return_ajax(200,'获取成功', $res);
        }
    }


    /**
     * 随机红包
     */
    public function getRandomMoney(){
        if(request()->isPost()){
            $config = Config::field('min_red, max_red, red_start_time, red_end_time')->where('id', '1')->find();

            if ($config['min_red'] == '0' && $config['max_red'] == '0') {
                return_ajax(400,'红包还没开放');
            }

            if (time() < $config['red_start_time'] || time() > $config['red_end_time']) {
                return_ajax(400,'红包还没开放');
            }

            $num   = $config['min_red'] + mt_rand() / mt_getrandmax() * ($config['max_red'] - $config['min_red']);
            $money = sprintf("%.2f", $num);

            return_ajax(200,'获取成功', $money);
        }
    }

    /**
     * 获取银行
     */
    public function getBank(){
        if(request()->isPost()){
            $data = Bank::where('status', '1')->order('id desc')->select();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 申请提现
     */
    public function applyCash(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['money'])){ return_ajax(400,'缺少money参数'); }//提现金额
            if(empty($post['type'])){ return_ajax(400,'缺少type参数'); }//1用户；2商家
            if(empty($post['bank_id'])){ return_ajax(400,'缺少bank_id参数'); }//银行id
            if(empty($post['bank_num'])){ return_ajax(400,'缺少bank_num参数'); }//银行卡号
            if(empty($post['username'])){ return_ajax(400,'缺少username参数'); }//姓名
            if(empty($post['cash_type'])){ return_ajax(400,'缺少cash_type参数'); }//1提现到银行卡；2提现到微信

            $type  = $post['type'];
            $money = $post['money'];
            unset($post['type']);

            $post['bank_num'] = str_replace(' ', '', $post['bank_num']);

            // 银行信息
            $bank = Bank::where('id', $post['bank_id'])->find();
            $post['name']      = $bank['name'];
            $post['bank_code'] = $bank['bank_code'];

            if ($type == '1') {
                if(empty($post['uid'])){ return_ajax(400,'缺少uid参数'); }//用户id

                // 检查是否有提现申请中
                $w['uid']   = $post['uid'];
                $w['type']  = '4';
                $check_cash = RedPack::where($w)->find();
                if($check_cash){ return_ajax(400, '有提现申请中，不能提现'); }

                $user_money = User::where('id', $post['uid'])->value('money');
                if ($user_money < $post['money']) {
                    if(empty($check_cash)){ return_ajax(400, '红包余额不足'); }
                }

                $post['title'] = '提现';
                $post['money'] = '-' .$money;
                $post['type']  = '4';
                $post['add_time']     = time();
                $post['update_time']  = time();

                Db::startTrans();// 启动事务

                $rs_red  = RedPack::insert($post);
                $rs_user = User::where('id', $post['uid'])->setDec('money', $money);
                if ($rs_red && $rs_user) {
                    Db::commit();// 提交事务
                    return_ajax(200, '申请成功');
                }else{
                    Db::rollback();// 回滚事务
                    return_ajax(400, '申请失败');
                }
                # code...
            }else{
                if(empty($post['shop_id'])){ return_ajax(400,'缺少shop_id参数'); }//商家id

                // 检查是否有提现申请中
                $w['shop_id'] = $post['shop_id'];
                $w['type']    = '1';
                $check_cash   = MoneyChange::where($w)->find();
                if($check_cash){ return_ajax(400, '有提现申请中，不能提现'); }

                $shop = Shop::where('id', $post['shop_id'])->find();

                $post['uid']         = $shop['uid'];
                $post['msg']         = '提现';
                $post['money']       = '-' .$money;
                $post['type']        = '1';
                $post['add_time']    = time();
                $post['update_time'] = time();
                Db::startTrans();// 启动事务

                $rs_red  = MoneyChange::insert($post);
                $rs_shop = Shop::where('id', $post['shop_id'])->setDec('money', $money);
                if ($rs_red && $rs_shop) {
                    Db::commit();// 提交事务
                    return_ajax(200, '申请成功');
                }else{
                    Db::rollback();// 回滚事务
                    return_ajax(400, '申请失败');
                }
            }
        }
    }

    /**
     * 弹出优惠券
     */
    public function getCoupon(){
        if(request()->isPost()){

            $where['status']     = '1';
            $where['start_time'] = ['<=', time()];
            $where['end_time']   = ['>=', time()];

            $data = Coupon::where($where)->order('id desc')->limit('1')->find();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }


    /**
     * 根据地址获取坐标信息 腾讯地图
     * $addr 地址
     */
    public function getLnglatByAddr($addr = ''){
        $url = 'https://apis.map.qq.com/ws/geocoder/v1/?address=' .$addr .'&key=' .'FNZBZ-RDHWS-TYSOP-6GTGS-RTYYH-GNFUG';
        $result = http_request($url, 'get');
        $result = json_decode($result, true);
        return $result;
    }


    public function SendMsg($uid = '', $phone = ''){
        header('Content-type: text/html; charset=utf-8');
        $base = [
            'msg_account' => 'yuezhaocd',
            'msg_secret'  => 'wO5pI7eD',
            'msg_url'     => 'http://120.55.248.18/smsSend.do?',
            'msg_sign'    => '悦照车灯',
        ];
        $password = md5($base['msg_account'].md5($base['msg_secret']));
        $rand    =  rand(100000,900000);
        $msgcode = array("msgcode"=>$rand,'userphone'=>$phone);
        Cache::set('code' .$uid, $msgcode);
        
        $content = "尊敬的用户您好，您的验证码为：".$rand."，5分钟有效【".$base['msg_sign']."】";
        $data    = "username=".$base['msg_account']."&password=".$password."&mobile=".$phone."&content=".$content;
        $curl    = curl_init();
        curl_setopt($curl, CURLOPT_URL, $base['msg_url']);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        if(!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        if ($output) {
            $code = $rand;
            return_ajax(200, '发送成功', $code);
        }else{
            return_ajax(400, '发送失败');
        }
    }

    /**
     * 获取关于我们
     */
    public function getAbout(){
        if(request()->isPost()){
            $data = Abouts::where('id', '1')->find();

            if ($data){
                $data['content'] = str_replace('src="/uploads/', 'src="'.$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER['HTTP_HOST'].'/uploads/', $data['content']);
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 发放积分
     * type 1邀请获得；2消费获得；3分销获得；4使用
     */
    public function grantPoint($data = []){
        if (empty($data)) { return false; }

        $point_change = new PointChange;
        $res = $point_change->allowField(true)->save($data);
        return $res ? true : false;

    }

    /**
     * 生成邀请码
     */
    public function inviteCode($length = 6){
        $chars = "0123456789";  
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {  
            $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
        }
        $check = Shop::where('invite_code', $str)->find();
        if ($check) {
            $this->inviteCode();
        }else{
            return $str;
        }
    }

    /**
     * 获取门店入驻城市
     */
    public function getCity(){
        if(request()->isPost()){
            $data = City::where('status', '1')->order('id desc')->select();
            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无开放区域，请联系管理员');
            }
        }
    }


    /**
     * 发放分红
     */
    public function grantBonus(){
        $data = MoneyChange::field('id, shop_id, type, status, bonus_money, add_time')->where('type', '7')->where('status', '1')->select();
        // $data = collection($data)->toArray();//转数组  调试用
        if ($data) {
            $bonus_time = Config::where('id', '1')->value('bonus_time');
            $time       = $bonus_time * 24 * 60 *60;
            foreach ($data as $key => $value) {
                $time = $time + strtotime($value['add_time']);
                if (time() >= $time) {
                    Db::startTrans();// 启动事务
                    $rs_shop  = Shop::where('id', $value['shop_id'])->setInc('money', $value['bonus_money']);
                    $rs_bonus = MoneyChange::where('id', $value['id'])->update(['status' => '1', 'update_time' => time()]);
                    if ($rs_shop && $rs_bonus) {
                        Db::commit();// 提交事务
                    }else{
                        Db::rollback();// 回滚事务
                    }
                    # code...
                }
            }
            # code...
        }
        // print_r($data);exit;
    }


    /**
     * 站内通知列表
     */
    public function getNoticeList(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            $where = [
                'type'   => '1',
                'status' => '1'
            ];

            $data = Notice::where($where)->order('id desc')->page($page, '20')->select();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }
    /**
     * 站内通知详情
     */
    public function getNoticeDetail(){
        if(request()->isPost()){
            $post = input('post.');
            if(empty($post['id'])){ return_ajax(400,'缺少id'); }

            $where = [
                'id'   => $post['id'],
            ];

            $data = Notice::where($where)->find();

            if ($data){
                $data['content'] = str_replace('src="/uploads/', 'src="'.$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER['HTTP_HOST'].'/uploads/', $data['content']);
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 获取弹框通知
     */
    public function getFrameNotice(){
        if(request()->isPost()){
            $post = input('post.');
            if(!empty($post['id'])){
                $where['id'] = $post['id'];
            }

            $where['status'] = '1';

            $data = Other::where($where)->order('id desc')->find();

            if ($data){
                $data['content'] = str_replace('src="/uploads/', 'src="'.$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER['HTTP_HOST'].'/uploads/', $data['content']);
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }
    









}
