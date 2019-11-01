<?php
namespace app\api\controller;
use \think\Controller;
use \think\Db;
use app\api\model\Order;
use app\api\model\OrderList;
use app\api\model\OrderGoods;
use app\common\model\User;
use app\common\model\Goods;
use app\common\model\Config;
use app\common\model\Shop;
use app\common\model\MoneyChange;
use app\common\model\Reserve;
use app\common\model\ShopGoods;
use app\common\model\ShopGoodsAttr;
use app\common\model\ShopRegisterPay;
use app\common\model\UserCoupon;

class Weix extends Controller
{	
	/* 微信信息控制器 */

    /**
     * [getOpenid 获取用户openid和session_key]
     * @Author   PengJun
     * @DateTime 2019-03-23
     * @return   [type]     [description]
     */
    public function getOpenid()
    {
        if(request()->isPost()){
            $post = input('post.');
            $config = Config::get(1);

            if(empty($post['code'])){ return_ajax(400,'缺少code参数'); }

            $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$config['appid'].'&secret='.$config['appsecret'].'&js_code='.$post['code'].'&grant_type=authorization_code';
            $info = json_decode(curl_get_contents($url),true);

            return_ajax(200, '获取成功', $info);
        }
    }

    /**
     * [update_user 添加、更新用户信息]
     * @Author   PengJun
     * @DateTime 2019-03-23
     * @return   [type]     [description]
     */
    public function update_user()
    {
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
                $post['is_new']   = '2';//老用户
                if($user_model->allowField(true)->save($post,['id'=>$user['id']])){
                    $post['nickname'] = emojiDecode($post['nickname']);
                    $post['id']       = $user['id'];
                    $post['is_new']   = '2';
                    return_ajax(200,'登录成功',$post);
                } else {
                    return_ajax(400,'登录失败，请稍后重试！');
                }
            } else {
                //添加
                $post['add_time'] = time();
                if($user_model->allowField(true)->save($post)){
                    $post['nickname'] = emojiDecode($post['nickname']);
                    $post['id']       = User::where('token', $post['token'])->value('id');
                    $post['is_new']   = '1';//新用户
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
    public function GetToken($openid)
    {
        // $key = 'jigujigu';
        $key = 'yzcd';
        $token = md5(md5($openid).md5($key).time());

        $isset = User::get(['token'=>$token]);
        if($isset){
            $this->GetToken($openid);
        } else {
            return $token;
        }
    }

    /**
     * [pay 获取支付信息]
     * @Author   PengJun
     * @DateTime 2019-04-03
     * @return   [type]     [description]
     */
    public function pay()
    {
        if(request()->isPost()){
            $post = input('post.');
            if(empty($post['token'])){ return_ajax(400,'缺少token'); }
            
            $user = User::get(['token'=>$post['token']]);

            if(empty($user)){ return_ajax(400,'token错误！'); }
            if(empty($post['order_id'])){ return_ajax(400,'缺少订单ID'); }
            //查询订单
            $order = Order::get(['id'=>$post['order_id']]);
            if(empty($order)){ return_ajax(400,'订单不存在'); }
            if($order['status'] != 1){ return_ajax(400,'订单状态异常，无法支付'); }
            // p(toArray($order));
            //回调地址
            $backurl = 'http://'.$_SERVER['SERVER_NAME'].'/api/Weix/wxPayCallback';

            $result = $this->wxpay('商品订单支付',$order['order_sn'],$order['pay_money'],$user['openid'],$backurl,'order');
            $result['order_sn'] = $order['order_sn'];  // 订单号
            $result['money'] = $order['pay_money'];  // 实际支付金额

            return_ajax(200,'获取成功',$result);
        }
    }

    //支付回调
    public function wxPayCallback()
    { 
        $xml = file_get_contents("php://input");
        if (!$xml) {
            echo "非法操作"; return;
        }
        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)),true);
        
        if($data['result_code'] == 'SUCCESS' && $data['return_code'] == 'SUCCESS'){
            //查询订单信息
            $order = Order::get(['order_sn'=>$data['out_trade_no']]);
            files(print_r($order,true));
            if($order['status'] == 1){
                //修改订单状态 给商品加销量
                $order->status = 2;
                $order->pay_time = time();
                if($order->save()){
                    //查询订单商品
                    $order_goods = OrderGoods::get(['order_id'=>$order['id']]);
                    foreach($order_goods as $vo){
                        Goods::where('id',$vo['goods_id'])->setInc('pay_num',$vo['num']);
                    }
                }
            }
        }
        echo "SUCCESS";
    }


    // 接口微信支付
    public function wxpay($body, $order_sn, $money, $openid, $backurl){
        $money = 0.01;    // 上线需删除
        $url   = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $base  = Config::field('id,appid,mchid,key')->where('id', 1)->find();
        // $uid   = $model::where('order_sn', $order_sn)->value('uid');
        // 接口所需参数(数组形式)
        $parameter = [
            'appid'            => $base['appid'],//小程序ID
            'mch_id'           => $base['mchid'],//商户号
            'nonce_str'        => getNonceStr(),//随机字符串
            'body'             => $body,//商品描述
            'out_trade_no'     => $order_sn,//商户订单号
            'total_fee'        => $money * 100,//总金额
            'spbill_create_ip' => $_SERVER['REMOTE_ADDR'],//终端IP
            'notify_url'       => $backurl,//通知地址
            'trade_type'       => 'JSAPI',//交易类型
            'openid'           => $openid, //用户标识
        ];

        $parameter['sign'] = $this->getSign($parameter, $base['key']);
        // p($parameter);exit;
        //接口所需参数(数组转XML格式)
        $xmldata = $this->arrayToXml($parameter);
        //初始一个curl会话
        $return = curlPost($url, $xmldata);
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        //先把xml转换为simplexml对象，再把simplexml对象转换成 json，再将 json 转换成数组。
        $return = json_decode(json_encode(simplexml_load_string($return, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        // return $return;
        if ($return['return_code'] != 'SUCCESS' || $return['result_code'] != 'SUCCESS') {
            return_ajax(400,$return['return_msg']);
        }

        //生成小程序支付签名所需参数
        $parameters = [
            'appId'     => $base['appid'],//小程序ID
            'timeStamp' => '' . time() . '',//时间戳
            'nonceStr'  => getNonceStr(),//随机串
            'package'   => 'prepay_id=' . $return['prepay_id'],//数据包
            'signType'  => 'MD5',//签名方式
        ];
        $parameters['paySign'] = $this->getSign($parameters, $base['key']);
        return $parameters;
    }


    /**
     * 商家注册续费支付回调
     */
    public function register_callback(){
        $xml = file_get_contents("php://input");
        if (!$xml) { echo "非法操作"; return; }

        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)),true);

        // $data['result_code'] = 'SUCCESS';
        // $data['return_code'] = 'SUCCESS';
        // $data['out_trade_no']= '201910241159058';
        
        if($data['result_code'] == 'SUCCESS' && $data['return_code'] == 'SUCCESS'){
            //查询订单信息
            $register = Db::name('shop_register_pay')->where('order_sn', $data['out_trade_no'])->find();
            files(print_r($register, true));
            if($register['status'] == 1){
                // 支付表支付状态 商家支付状态
                
                $arr_reg = [
                    'status'      => '2',//已支付
                    'pay_time'    => time(),
                    'end_time'    => time() + $register['term'] * '365' * '24' * '60' * '60',
                    'update_time' => time()
                ];
                $arr_shop = [
                    'type'        => $register['type'],
                    'term'        => $register['term'],
                    'state'       => '2',//已付款
                    'end_time'    => time() + $register['term'] * '365' * '24' * '60' * '60',
                    'update_time' => time()
                ];

                Db::startTrans();// 启动事务

                $rs_register = ShopRegisterPay::where('id', $register['id'])->update($arr_reg);
                $rs_shop     = Shop::where('id', $register['shop_id'])->update($arr_shop);

                if ($rs_shop && $rs_register) {
                    Db::commit();// 提交事务
                }else{
                    Db::rollback();// 回滚事务
                }
            }
        }
        echo "SUCCESS";
    }


    /**
     * 商家下单支付回调
     */
    public function shop_callback(){
        $xml = file_get_contents("php://input");
        if (!$xml) { echo "非法操作"; return; }

        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)),true);

        // $data['result_code'] = 'SUCCESS';
        // $data['return_code'] = 'SUCCESS';
        // $data['out_trade_no']= '201910222140309';
        
        if($data['result_code'] == 'SUCCESS' && $data['return_code'] == 'SUCCESS'){
            //查询订单信息
            // $order = Order::get(['order_sn'=>$data['out_trade_no']]);
            $order = Db::name('order')->where('order_sn', $data['out_trade_no'])->find();
            files(print_r($order, true));
            if($order['status'] == 1){
                // 更新商家余额、余额变化表
                
                $uid = Shop::where('id', $order['shop_id'])->value('uid');


                Db::startTrans();// 启动事务

                $rs_shop  = Shop::where('id', $order['shop_id'])->setInc('money', $order['pay_money']);

                $rs_order = Db::name('order')->where('id', $order['id'])->update(['status' => '2', 'pay_time' => time(), 'update_time' => time()]);

                $where['shop_id'] = $order['shop_id'];
                $order_list = Db::name('order_list')->where('order_sn', $data['out_trade_no'])->select();
                foreach ($order_list as $key => $value) {
                    $where['goods_id'] = $value['goods_id'];
                    $check_goods = ShopGoods::where($where)->find();
                    if (!$check_goods) {
                        $rs_shop_goods = ShopGoods::where($where)->update(['status' => '1', 'update_time' => time()]);
                        $order_sn = $data['out_trade_no'];
                    }else{
                        $rs_shop_goods = ShopGoods::where($where)->update(['status' => '1', 'update_time' => time()]);
                        $order_sn = $check_goods['order_sn'];
                    }
                }
                
                $rs_bonus = $this->bonus($order_sn, $order['shop_id']);


                // $str = 'rs_shop:' .$rs_shop . ';' .'rs_money_change:' .$rs_money_change .';' .'rs_order:' .$rs_order .';' .'rs_shop_goods:' .$rs_shop_goods .';' .'rs_bonus:' .$rs_bonus;
                // file_put_contents('callback.txt', $str);

                if (($rs_order && $rs_shop_goods) && ($rs_bonus && $rs_shop)) {
                    Db::commit();// 提交事务
                }else{
                    Db::rollback();// 回滚事务
                }
            }
        }
        echo "SUCCESS";
    }

    /**
     * 分红
     */
    public function bonus($order_sn = '', $shop_id = ''){
        if (!$order_sn) { return false; }//订单号
        if (!$shop_id) { return false; }//商家id
        $money1 = '0';//一级总分红
        $money2 = '0';//二级总分红
        $shop_goods_attr = ShopGoodsAttr::where('order_sn', $order_sn)->select();
        if (empty($shop_goods_attr)) { return false; }

        $shop = Shop::where('id', $shop_id)->find();
        if (empty($shop)) { return false; }
        // if (time() > $shop['end_time']) { return true; }//分红期限已过

        // type 合作类型：1城市合伙人；2门店合伙人
        if ($shop['type'] == '1') {
            // 城市合伙人 有二级分红(上两级推荐人都获得)
            if (!$shop['top_code']) { return true; }//没有上级推荐人，无分红发放

            // 上级推荐人
            $top_shop = Shop::where('invite_code', $shop['top_code'])->find();
            if ($top_shop['top_code']) {
                // 有二级推荐人 2人获得分红
                
                // 二级推荐人
                $top_shop2 = Shop::where('invite_code', $top_shop['top_code'])->find();

                foreach ($shop_goods_attr as $key => $value) {
                    $money1 = $money1 + $value['city_percent_one'] * $value['city_money'];//一级分红
                    $money2 = $money1 + $value['city_percent_second'] * $value['city_money'];//二级分红
                }
                if (time() <= $top_shop['end_time'] && time() <= $top_shop2['end_time']) {
                    // 一级&二级推荐人分红期限有效
                    $arr = [
                        [
                            'shop_id'     => $top_shop['id'],
                            'order_sn'    => $order_sn,
                            'money'       => '+' .$money1,
                            'bonus_money' => $money1,
                            'type'        => '7',
                            'msg'         => '分红收入',
                            'add_time'    => time(),
                            'update_time' => time(),
                        ],//一级分红明细
                        [
                            'shop_id'     => $top_shop2['id'],
                            'order_sn'    => $order_sn,
                            'money'       => '+' .$money2,
                            'bonus_money' => $money2,
                            'type'        => '7',
                            'msg'         => '分红收入',
                            'add_time'    => time(),
                            'update_time' => time(),
                        ],//二级分红明细
                    ];

                    $up_shop = [
                        [
                            'id'          => $top_shop['id'],
                            'money'       => $top_shop['money'] + $money1,
                            'update_time' => time(),
                        ],
                        [
                            'id'          => $top_shop2['id'],
                            'money'       => $top_shop2['money'] + $money2,
                            'update_time' => time(),
                        ],
                        
                    ];

                    // $shopModel = new Shop;

                    $rs_bonus = MoneyChange::insertAll($arr);
                    // $rs_shop_money = $shopModel->save($up_shop);
                
                }elseif (time() <= $top_shop['end_time'] && time() > $top_shop2['end_time']) {
                    // 一级推荐人分红期限有效，二级分红期已过期
                    $arr = [
                        'shop_id'     => $top_shop['id'],
                        'order_sn'    => $order_sn,
                        'money'       => '+' .$money1,
                        'bonus_money' => $money1,
                        'type'        => '7',
                        'msg'         => '分红收入',
                        'add_time'    => time(),
                        'update_time' => time(),
                    ];
                    $rs_bonus = MoneyChange::insert($arr);
                    # code...
                }elseif (time() > $top_shop['end_time'] && time() <= $top_shop2['end_time']) {
                    // 二级推荐人分红期限有效，一级分红期已过期
                    $arr = [
                        'shop_id'     => $top_shop2['id'],
                        'order_sn'    => $order_sn,
                        'money'       => '+' .$money2,
                        'bonus_money' => $money2,
                        'type'        => '7',
                        'msg'         => '分红收入',
                        'add_time'    => time(),
                        'update_time' => time(),
                    ];
                    $rs_bonus = MoneyChange::insert($arr);
                    # code...
                }else{
                    return ture;
                }

                if ($rs_bonus) {
                    return true;
                }else{
                    return false;
                }

                # code...
            }else{
                // 没有二级推荐人 1人获得分红
                
                if (time() > $top_shop['end_time']) { return true; }//分红期限已过 分红不发放

                foreach ($shop_goods_attr as $key => $value) {
                    $money1 = $money1 + $value['city_percent_one'] * $value['city_money'];
                }
                $arr = [
                    'shop_id'     => $top_shop['id'],
                    'order_sn'    => $order_sn,
                    'money'       => '+' .$money1,
                    'bonus_money' => $money1,
                    'type'        => '7',
                    'msg'         => '分红收入',
                    'add_time'    => time(),
                    'update_time' => time(),
                ];
                $rs_bonus      = MoneyChange::insert($arr);
                // $rs_shop_money = Shop::where('id', $top_shop['id'])->setInc('money', $money1);
                if ($rs_bonus) {
                    return true;
                }else{
                    return false;
                }
            }

            # code...
        }else{
            // 门店合伙人 只有一级分红(该商家的推荐人获得)
            if (!$shop['top_code']) { return true; }//没有上级推荐人，无分红发放

            // 上级推荐人
            $top_shop = Shop::where('invite_code', $shop['top_code'])->find();
            if (time() > $top_shop['end_time']) { return true; }//分红期限已过

            foreach ($shop_goods_attr as $key => $value) {
                $money1 = $money1 + $value['shop_percent_one'] * $value['shop_money'];
            }
            $arr = [
                'shop_id'     => $top_shop['id'],
                'order_sn'    => $order_sn,
                'money'       => '+' .$money1,
                'bonus_money' => $money1,
                'type'        => '7',
                'msg'         => '分红收入',
                'add_time'    => time(),
                'update_time' => time(),
            ];
            $rs_bonus      = MoneyChange::insert($arr);
            // $rs_shop_money = Shop::where('id', $top_shop['id'])->setInc('money', $money1);
            if ($rs_bonus) {
                return true;
            }else{
                return false;
            }
        }


    }


    /**
     * 用户 支付回调
     */
    public function user_callback(){
        $xml = file_get_contents("php://input");
        if (!$xml) { echo "非法操作"; return; }

        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)),true);

        // $data['out_trade_no'] = '2019102417304915';
        // $data['result_code'] = 'SUCCESS';
        // $data['return_code'] = 'SUCCESS';
        
        if($data['result_code'] == 'SUCCESS' && $data['return_code'] == 'SUCCESS'){
            //查询订单信息
            $reserve = Reserve::get(['order_sn'=>$data['out_trade_no']]);
            files(print_r($reserve, true));
            if($reserve['status'] == 1){
                // 更新商家余额、余额变化表
                
                $uid = Shop::where('id', $reserve['shop_id'])->value('uid');

                $arr = [
                    'uid'         => $uid,
                    'shop_id'     => $reserve['shop_id'],
                    'order_sn'    => $reserve['order_sn'],
                    'money'       => '+' .$reserve['pay_money'],
                    'type'        => '2',
                    'msg'         => $reserve['title'] .'预付款',
                    'add_time'    => time(),
                    'update_time' => time(),
                ];

                $time     = time();
                $date     = date('Y',$time) + 1 . '-' . date('m-d 23:59:59');//一年后日期
                $end_time = strtotime($date);//联保到期时间

                $up_reserve = [
                    'status'      => '2',
                    'end_time'    => $end_time,
                    'pay_time'    => $time,
                    'update_time' => $time,
                ];

                Db::startTrans();// 启动事务

                $rs_shop         = Shop::where('id', $reserve['shop_id'])->setInc('money', $reserve['pay_money']);
                $rs_money_change = MoneyChange::insert($arr);
                $rs_reserve      = Reserve::where('id', $reserve['id'])->update($up_reserve);
                if (($rs_shop && $rs_money_change) && $rs_reserve) {
                    if ($reserve['coupon_id']) {
                        $rs_coupon = UserCoupon::where('id', $reserve['coupon_id'])->update(['status' => '2', 'update_time' => time()]);
                        if ($rs_coupon) {
                            Db::commit();// 提交事务
                        }else{
                            Db::rollback();// 回滚事务
                        }
                    }else{
                        Db::commit();// 提交事务
                    }
                    
                }else{
                    Db::rollback();// 回滚事务
                }
            }
        }
        echo "SUCCESS";
    }






    //作用：生成签名
    private function getSign($Obj, $key)
    {
        foreach ($Obj as $k => $v) {
            $Parameters[$k] = $v;
        }
        // 签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = $this->formatBizQueryParaMap($Parameters, false);
        // 签名步骤二：在string后加入KEY
        $String = $String . "&key=" . $key;

        // 签名步骤三：MD5加密
        $String = md5($String);
        // 签名步骤四：所有字符转为大写
        $result = strtoupper($String);
        return $result;
    }

    /* 以下为微信支付所需要的 */
    private function formatBizQueryParaMap($paraMap, $urlencode)
    {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if ($urlencode) {
                $v = urlencode($v);
            }
            $buff .= $k . "=" . $v . "&";
        }
        $reqPar = '';
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;
    }

    //数组转XML格式
    public function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $xml .= "<" . $key . ">" . $this->arrayToXml($val) . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }


    /**
     * 微信支付
     */
    public function wxpaywxpay($body, $order_no, $money, $openid, $backurl,$table){
        $money = 0.01;    // 上线需删除
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $base = Db::name('config')->field('id,appid,mchid,key')->where('id', 1)->find();
        $member_id = Db::name($table)->where('order_sn',$order_no)->value('uid');
        // 接口所需参数(数组形式)
        $parameter = [
            'appid'            => $base['appid'],//小程序ID
            'mch_id'           => $base['mchid'],//商户号
            'nonce_str'        => getNonceStr(),//随机字符串
            'body'             => $body,//商品描述
            'out_trade_no'     => $order_no,//商户订单号
            'total_fee'        => $money * 100,//总金额
            'spbill_create_ip' => $_SERVER['REMOTE_ADDR'],//终端IP
            'notify_url'       => $backurl,//通知地址
            'trade_type'       => 'JSAPI',//交易类型
            'openid'           => $openid, //用户标识
        ];

        $parameter['sign'] = $this->getSign($parameter, $base['key']);
        // p($parameter);
        //接口所需参数(数组转XML格式)
        $xmldata = $this->arrayToXml($parameter);
        //初始一个curl会话
        $return = curlPost($url, $xmldata);
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        //先把xml转换为simplexml对象，再把simplexml对象转换成 json，再将 json 转换成数组。
        $return = json_decode(json_encode(simplexml_load_string($return, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        // return $return;
        if ($return['return_code'] != 'SUCCESS' || $return['result_code'] != 'SUCCESS') {
            return_ajax(400,$return['return_msg']);
        }

        //生成小程序支付签名所需参数
        $parameters = [
            'appId'     => $base['appid'],//小程序ID
            'timeStamp' => '' . time() . '',//时间戳
            'nonceStr'  => getNonceStr(),//随机串
            'package'   => 'prepay_id=' . $return['prepay_id'],//数据包
            'signType'  => 'MD5',//签名方式
        ];
        $parameters['paySign'] = $this->getSign($parameters, $base['key']);
        return $parameters;
    }


    //退款
    public function refund($ordercode){
        $url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
        $base = Db::name('config')->field('id,appid,mchid,key')->where('id', 1)->find();
        // 接口所需参数(数组形式)
        $parameter = array(
            'appid'             =>  $base['appid'],//微信分配的小程序ID
            'mch_id'                    =>  $base['mchid'],//微信支付分配的商户号
            'nonce_str'             =>  randomCode(),//随机字符串
            'out_trade_no'      =>  $ordercode,//商户订单号
            'out_refund_no'             =>  randomCode(),//退款单号
            'total_fee'         =>  1,//订单总金额
            'refund_fee'                =>  1,//退款总金额
        );

        $parameter['sign'] = $this->getSign($parameter,$base['key']);
        //接口所需参数(数组转XML格式)
        $xmldata = $this->arrayToXml($parameter);
        //初始一个curl会话
        $return = $this->refund_curlPostXml($url,$xmldata);

        return $return;
    }

    //引入退款证书
    public function refund_curlPostXml($url, $xmldata){
        $ch = curl_init();
        $header = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
//        curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLCERT, '/klwl_web/klwl_pj/hzdy.kailly.com/vendor/cert/apiclient_cert.pem');
        curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLKEY, '/klwl_web/klwl_pj/hzdy.kailly.com/vendor/cert/apiclient_key.pem');
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmldata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        curl_close($ch);
        //关闭cURL资源，并且释放系统资源
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        //先把xml转换为simplexml对象，再把simplexml对象转换成 json，再将 json 转换成数组。
        $value_array = json_decode(json_encode(simplexml_load_string($tmpInfo, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $value_array;

    }





/**
     * [wxqrcode 生成小程序二维码]
     * @Author   谜一样得男人
     * @DateTime 2019-07-26
     * @return   [type]     [description]
     */
    public function wxqrcode()
    {
        // echo '非法操作';exit;
        $access_token = $this->getAccessToken();
        $url = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token='.$access_token;
        $data = array("page"=>"/pages/index/index","scene"=>"2","width"=>430);
        $data = json_encode($data);
        $info = httpRequest($url,$data);
        p($info);exit;
        $cardcode = "uploads/code/2.jpg";
        file_put_contents($cardcode,$info);

    }

    /**
     * [getAccessToken 获取小程序access_token]
     * @Author   谜一样得男人
     * @DateTime 2019-07-26
     * @return   [type]     [description]
     */
    public function getAccessToken()
    {
        $config = Config::get(1);
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$config['appid'].'&secret='.$config['appsecret'];
        $info = json_decode(curl_get_contents($url),true);
        return $info['access_token'];
    }


    /**
     * 生成二维码
     * $id 1会员id；2商家邀请码；3优惠券id
     */
    public function erm($id = '', $type = ''){
        $access_token = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/wxaapp/createwxaqrcode?access_token=".$access_token;
        if ($type == '1') {
            $res = array("path"=>"pages/index/index?top_id=".$id,"width"=>430);
            $result = api_notice_increment($url,json_encode($res));
            $erm = "uploads/code/". $id .".jpg";
        }elseif ($type == '2') {
            $res = array("path"=>"pages/index/index?invite_code=".$id,"width"=>430);
            $result = api_notice_increment($url,json_encode($res));
            $erm = "uploads/shop/". $id .".jpg";
            # code...
        }elseif ($type == '3') {
            $res = array("path"=>"pages/index/index?id=".$id,"width"=>430);
            $result = api_notice_increment($url,json_encode($res));
            $erm = "uploads/coupon/". $id .".jpg";
            # code...
        }else{
            return false;
        }
        file_put_contents($erm,$result);
        return '/' .$erm;
    }







}
