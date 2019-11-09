<?php
namespace app\api\controller;
use app\common\model\Shop;
use app\common\model\ShopGoods;
use app\common\model\Reserve;
use app\common\model\UserCoupon;
use app\common\model\Label;
use app\common\model\User;
use app\common\model\ReserveGoods;
use app\common\model\Attr;
use app\common\model\Order;
use app\common\model\OrderList;
use app\common\model\ShopGoodsAttr;
use app\common\model\ShopSerialNum;
use app\common\model\MoneyChange;
use app\common\model\Config;
use app\common\model\City as CityModel;
use app\common\model\ShopRegisterPay;

use \think\Db;
use \think\Cache;
use \think\Session;

/**
 * 商家中心
 */
class Shopcenter extends Common{

    /**
     * 申请入住
     */
    public function applyShop(){
        if(request()->isPost()){
            $post = input('post.');
            if(empty($post['uid'])){ return_ajax(400, '缺少会员uid'); }
            if(empty($post['shop_name'])){ return_ajax(400, '缺少shop_name'); }//门店名称
            if(empty($post['city_id'])){ return_ajax(400, '缺少city_id'); }
            // if(empty($post['province'])){ return_ajax(400, '缺少province'); }
            // if(empty($post['city'])){ return_ajax(400, '缺少city'); }
            // if(empty($post['area'])){ return_ajax(400, '缺少area'); }
            if(empty($post['address'])){ return_ajax(400, '缺少address'); }
            // if(empty($post['lng'])){ return_ajax(400,'缺少lng'); }//经度
            // if(empty($post['lat'])){ return_ajax(400,'缺少lat'); }//纬度
            if(empty($post['name'])){ return_ajax(400, '缺少name'); }//负责人姓名
            if(empty($post['phone'])){ return_ajax(400, '缺少phone'); }//负责人电话
            if(empty($post['tel'])){ return_ajax(400, '缺少tel'); }//其他电话
            if(empty($post['project'])){ return_ajax(400, '缺少project'); }//本店经营项目
            if(empty($post['other_project'])){ return_ajax(400, '缺少other_project'); }//其他经营项目
            if(empty($post['pwd'])){ return_ajax(400, '缺少pwd'); }
            if(empty($post['license'])){ return_ajax(400, '缺少license'); }//营业执照
            if(empty($post['top_code'])){ return_ajax(400, '缺少invite_code'); }//邀请码
            if(empty($post['idcard_img'])){ return_ajax(400, '缺少idcard_img'); }//身份证
            if(empty($post['other_project_img'])){ return_ajax(400, '缺少other_project_img'); }//其他项目图片
            if(empty($post['img'])){ return_ajax(400, '缺少img'); }//门店照片
            if(empty($post['contract'])){ return_ajax(400, '请选择阅读并同意电子合同'); }//电子合同:0选择；1已选择
            if(empty($post['code'])){ return_ajax(400, '缺少code'); }//验证码

            $cache = Cache::get('code' .$post['uid']);
            if ($cache['msgcode'] != $post['code']) { return_ajax(400, '验证码错误'); }
            
            // 判断是否已申请商家
            $check = Shop::where('uid', $post['uid'])->find();
            if($check){ return_ajax(400, '您已经是商家'); }

            // 判断是否存在该邀请码
            $check_code = Shop::where('invite_code', $post['top_code'])->find();
            if (!$check_code) { return_ajax(400, '邀请码不存在'); }

            $city = CityModel::where('id', $post['city_id'])->find();
            if (!$city) { return_ajax(400, '区域不存在'); }

            $shop_num = Shop::where('examine', 'in', '0,1')->where('city_id', $post['city_id'])->count('id');
            if ($shop_num >= $city['num']) { return_ajax(300, '城市商家入驻已满'); }

            $res = $this->getLnglatByAddr($city['province'].$city['city'].$post['address']);

            $post['lng']         = $res['result']['location']['lng'];
            $post['lat']         = $res['result']['location']['lat'];
            $post['invite_code'] = $this->inviteCode();
            $post['province']    = $city['province'];
            $post['city']        = $city['city'];

            // 营业执照
            if (!empty($post['license'])) {
                $post['license'] = implode(',', $post['license']);
            }
            // 店铺相册
            if (!empty($post['img'])) {
                $post['img'] = implode(',', $post['img']);
            }
            // 身份证
            if (!empty($post['idcard_img'])) {
                $post['idcard_img'] = implode(',', $post['idcard_img']);
            }
            // 其他项目图片
            if (!empty($post['other_project_img'])) {
                $post['other_project_img'] = implode(',', $post['other_project_img']);
            }
            
            unset($post['code']);
            unset($post['contract']);

            $post['pwd'] = md5($post['pwd']);
            $post['add_time']    = time();
            $post['update_time'] = time();

            $data = Shop::insert($post);

            if ($data){
                return_ajax(200, '申请成功', $data);
            }else{
                return_ajax(400, '申请失败');
            }
        }
    }

    /**
     * 商家登录 手机号绑定微信号
     */
    // public function login(){
    //     if(request()->isPost()){
    //         $post = input('post.');

    //         if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }
    //         if(empty($post['phone'])){ return_ajax(400,'缺少phone'); }
    //         if(empty($post['pwd'])){ return_ajax(400,'缺少pwd'); }

    //         $data = Shop::where('uid', $post['uid'])->find();
    //         if ($data['phone'] != $post['phone']) {
    //             return_ajax(400,'手机号码错误');
    //         }
    //         if ($data['pwd'] != md5($post['pwd'])) {
    //             return_ajax(400,'密码错误');
    //         }

    //         if ($data){
    //             Session::set('shop' .$data['id'], $data);
    //             return_ajax(200, '登录成功', $data);
    //         }else{
    //             return_ajax(400, '登录失败');
    //         }
    //     }
    // }
    public function login(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['phone'])){ return_ajax(400,'缺少phone'); }
            if(empty($post['pwd'])){ return_ajax(400,'缺少pwd'); }

            $data = Shop::where('phone', $post['phone'])->find();
            if(empty($data)){ return_ajax(400, '手机号不存在'); }

            if ($data['pwd'] != md5($post['pwd'])) {
                return_ajax(400,'密码错误');
            }

            if ($data){
                Session::set('shop' .$data['id'], $data);
                return_ajax(200, '登录成功', $data);
            }else{
                return_ajax(400, '登录失败');
            }
        }
    }

   /**
     * 退出登陆
     */
    public function loginout(){
        $post = input('post.');
        if(empty($post['uid'])){ return_ajax(400,'缺少uid'); }

        Session::delete('shop' .$post['uid']);
        return_ajax(200, '退出成功');
    }

    /**
     * 获取商家信息
     */
    public function getShopInfo(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少id'); }

            $data = Shop::where('id', $post['id'])->find();

            if ($data){
                if ($data['img']) {
                    $data['img'] = explode(',', $data['img']);
                }

                // flag 0不可使用需支付；1可以使用；2不可使用(申请中)；3不可使用(审核未通过)
                // 审核通过 且未付款或已过期，提醒用户付款或续费
                if ($data['examine'] == '1' && $data['state'] == '1') {
                    $data['flag'] = '0';
                    $data['msg'] = '您还没付款，请付款后使用';
                }elseif ($data['examine'] == '1' && $data['state'] == '3') {
                    $data['flag'] = '0';
                    $data['msg'] = '已过期，请续费后使用';
                }elseif ($data['examine'] == '1' && $data['state'] == '2') {
                    $data['flag'] = '1';
                    $data['msg'] = '可以使用';
                }elseif ($data['examine'] == '0') {
                    $data['flag'] = '2';
                    $data['msg'] = '待审核';
                }elseif ($data['examine'] == '2') {
                    $data['flag'] = '3';
                    $data['msg'] = '未通过';
                }

                $w['is_look'] = '1';
                $w['shop_id'] = $post['id'];

                $count = Reserve::where($w)->count('id');

                return_ajax(200, '获取成功', $data, $count);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 编辑商家资料
     */
    public function editShop(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少id'); }
            if(empty($post['shop_name'])){ return_ajax(400,'缺少shop_name'); }//门店名称
            if(empty($post['pic'])){ return_ajax(400,'缺少pic'); }//店铺图片
            if(empty($post['telephone'])){ return_ajax(400,'缺少telephone'); }//服务电话
            if(empty($post['job_time'])){ return_ajax(400,'缺少job_time'); }//营业时间
            if(empty($post['province'])){ return_ajax(400,'缺少province'); }
            if(empty($post['city'])){ return_ajax(400,'缺少city'); }
            // if(empty($post['area'])){ return_ajax(400,'缺少area'); }
            if(empty($post['address'])){ return_ajax(400,'缺少address'); }
            if(empty($post['project'])){ return_ajax(400,'缺少project'); }//本店经营项目

            $post['update_time'] = time();

            $id = $post['id'];
            unset($post['id']);

            $data = Shop::where('id', $id)->update($post);

            if ($data){
                return_ajax(200, '修改成功', $data);
            }else{
                return_ajax(400, '修改失败');
            }
        }
    }


    /**
     * 门店端商城 商品列表
     */
    public function getRgoodsList(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            $where['status'] = '1';

            $data = ReserveGoods::where($where)->order('id desc')->page($page, '10')->select();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
        }
    }

    /**
     * 获取商品规格
     */
    public function getAttr(){
        if(request()->isPost()){
            $post = input('post.');
            if(empty($post['goods_id'])){ return_ajax(400,'缺少goods_id'); }
            if(empty($post['shop_id'])){ return_ajax(400,'缺少shop_id'); }

            $data = Attr::where('goods_id', $post['goods_id'])->order('id desc')->select();

            if ($data){
                $shop = Shop::where('id', $post['shop_id'])->find();
                // type 1城市合伙人；2门店合伙人
                foreach ($data as $key => &$value) {
                    if ($shop['type'] == '1') {
                        $data[$key]['money'] = $value['city_money'];
                    }else{
                        $data[$key]['money'] = $value['shop_money'];
                    }
                }
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
        }
    }

    /**
     * 商家向平台购买产品
     */
    public function addOrder(){
        if(request()->isPost()){
            $post = input('post.');
            if(empty($post['shop_id'])){ return_ajax(400, '缺少shop_id'); }//商家id
            if(empty($post['goods'])){ return_ajax(400, '缺少goods'); }//购买的产品信息

            $order           = [];//入库订单表
            $order_list      = [];//入库订单商品表
            $shop_goods      = [];//入库shop_goods表
            $shop_goods_attr = [];//入库shop_goods_attr
            $buy_num         = '0';//购买总数
            $all_money       = '0';//订单总价
            $pay_money       = '0';//实际支付金额

            foreach ($post['goods'] as $key => $value) {
                if(empty($value['goods_id'])){ return_ajax(400, '缺少goods_id'); }//产品id
                if(empty($value['buy_num'])){ return_ajax(400, '缺少buy_num'); }//购买数量
                if(empty($value['goods_attr_id'])){ return_ajax(400, '缺少goods_attr_id'); }//规格id
                if(empty($value['label_id'])){ return_ajax(400, '缺少label_id'); }//标签id

                $order_sn    = $this->order_sn($post['shop_id'], 'order');
                $shop        = Shop::where('id', $post['shop_id'])->find();
                $label_name  = Label::where('id', $value['label_id'])->value('name');
                $goods       = ReserveGoods::where('id', $value['goods_id'])->find();
                $goods_attr  = Db::name('attr')->field('id, goods_id, title, shop_money, city_money, number, city_percent_one, city_percent_second, shop_percent_one')->where('id', $value['goods_attr_id'])->find();
                $goods_attrs = json_encode($goods_attr);

                $order = [
                    'order_sn'    => $order_sn,//'订单号'
                    'shop_id'     => $post['shop_id'],//商家id
                    'name'        => $shop['name'],//联系人
                    'phone'       => $shop['phone'],//联系电话
                    'province'    => $shop['province'],//
                    'city'        => $shop['city'],//
                    'area'        => $shop['area'],//
                    'address'     => $shop['address'],//详细地址
                    'add_time'    => time(),
                    'update_time' => time(),
                ];

                $order_list[$key] = [
                    'order_sn'      => $order_sn,//'订单号'
                    'shop_id'       => $post['shop_id'],//商家id
                    'buy_num'       => $value['buy_num'],//购买数量
                    'goods_id'      => $value['goods_id'],//商品id
                    'label_id'      => $value['label_id'],//标签id
                    'label_name'    => $label_name,//标签名称
                    'title'         => $goods['title'],//商品名称
                    'img'           => $goods['img'],//商品id
                    'front_money'   => $goods['front_money'],//预付款
                    'money'         => $goods['money'],//商品价格
                    'goods_attr_id' => $value['goods_attr_id'],//商品规格id
                    'goods_attr'    => $goods_attrs,//商品价格
                    'repair_time'   => $goods['repair_time'],//联保时长/年
                    'add_time'      => time(),
                    'update_time'   => time(),

                    'city_money'    => $goods_attr['city_money'],
                    'shop_money'    => $goods_attr['shop_money'],
                ];

                $shop_goods[$key] = [
                    'order_sn'      => $order_sn,//'订单号'
                    'shop_id'       => $post['shop_id'],//商家id
                    'stock'         => $value['buy_num'],//购买数量
                    'goods_id'      => $value['goods_id'],//商品id
                    'label_id'      => $value['label_id'],//标签id
                    'title'         => $goods['title'],//商品名称
                    'img'           => $goods['img'],//商品id
                    'front_money'   => $goods['front_money'],//预付款
                    'money'         => $goods['money'],//市场价
                    'point'         => $goods['point'],//可得积分
                    'repair_time'   => $goods['repair_time'],//联保时长/年
                    'content'       => $goods['content'],//详情
                    'video'         => $goods['video'],//详情
                    'add_time'      => time(),
                    'update_time'   => time(),
                ];

                $attr_id = $goods_attr['id'];
                unset($goods_attr['id']);
                $shop_goods_attr[$key] = $goods_attr;
                $shop_goods_attr[$key]['order_sn']    = $order_sn;
                $shop_goods_attr[$key]['attr_id']     = $attr_id;
                $shop_goods_attr[$key]['shop_id']     = $post['shop_id'];
                $shop_goods_attr[$key]['add_time']    = time();
                $shop_goods_attr[$key]['update_time'] = time();

                $buy_num   = $buy_num + $value['buy_num'];

                // type 1城市合伙人；2门店合伙人
                if ($shop['type'] == '1') {
                    $all_money = $all_money + $value['buy_num'] * $goods_attr['city_money'];//订单总价
                    $pay_money = $pay_money + $value['buy_num'] * $goods_attr['city_money'];//实际支付金额
                }else{
                    $all_money = $all_money + $value['buy_num'] * $goods_attr['shop_money'];//订单总价
                    $pay_money = $pay_money + $value['buy_num'] * $goods_attr['shop_money'];//实际支付金额
                }
            }
            $order['buy_num']   = $buy_num;
            $order['all_money'] = $all_money;
            $order['pay_money'] = $pay_money;

            Db::startTrans();// 启动事务

            $shop_goods_attrs = array_column($shop_goods_attr, null, 'goods_id');

            $rs_order      = Order::insert($order);
            $rs_order_list = OrderList::insertAll($order_list);

            foreach ($shop_goods as $key => $value) {

                $where['shop_id']  = $post['shop_id'];
                $where['goods_id'] = $value['goods_id'];

                $shop_goods_attrs[$value['goods_id']]['number'] = $value['stock'];

                // 检查该商家是否买过该商品
                $check_goods = ShopGoods::where($where)->find();
                if ($check_goods) {
                    $where['attr_id'] = $shop_goods_attrs[$value['goods_id']]['attr_id'];
                    // 检查该商家是否买过该商品商品规格
                    $check_attr = ShopGoodsAttr::where($where)->find();
                    // print_r($check_attr);exit;
                    if ($check_attr) {
                        // print_r($where);exit;
                        $rs_shop_goods_attrs = ShopGoodsAttr::where($where)->setInc('number', $value['stock']);//商家产品库加库存
                        unset($where['attr_id']);
                    }else{
                        $shop_goods_attrs[$value['goods_id']]['shop_goods_id'] = $check_goods['id'];
                        $rs_shop_goods_attrs = ShopGoodsAttr::insert($shop_goods_attrs[$value['goods_id']]);
                    }
                    $rs_shop_goods = true;
                }else{
                    $rs_shop_goods = ShopGoods::insertGetId($value);
                    $shop_goods_attrs[$value['goods_id']]['shop_goods_id'] = $rs_shop_goods;
                    $rs_shop_goods_attrs = ShopGoodsAttr::insert($shop_goods_attrs[$value['goods_id']]);
                }
                $rs_stock = Attr::where('id', $shop_goods_attrs[$value['goods_id']]['attr_id'])->setDec('number', $value['stock']);//减库存

                if (!$rs_shop_goods || !$rs_shop_goods_attrs || !$rs_stock) {
                    Db::rollback();// 回滚事务
                    return_ajax(400, '操作失败');
                }
            }

            if (($rs_order && $rs_order_list) && ($rs_shop_goods && $rs_shop_goods_attrs)) {
                Db::commit();// 提交事务

                $data = ['order_sn' => $order_sn, 'type' => '1'];

                return_ajax(200, '操作成功', $data);
            }else{
                Db::rollback();// 回滚事务
                return_ajax(400, '操作失败');
            }
        }
    }

    /**
     * 获取商家订单列表
     */
    public function getShopOrderList(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['shop_id'])){ return_ajax(400,'缺少shop_id'); }

            $data = Order::with('goods')->where('shop_id', $post['shop_id'])->order('id desc')->page($page, '10')->select();
            $data = collection($data)->toArray();//转数组
            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 获取商家订单详情
     */
    public function getShopOrderDetail(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少id'); }

            $data = Order::with('goods')->where('id', $post['id'])->find();
            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 预约列表
     */
    public function getShopReserveList(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['shop_id'])){ return_ajax(400,'缺少shop_id'); }

            $data = Reserve::where('shop_id', $post['shop_id'])->order('id desc')->page($page, '10')->select();

            if ($data){
                foreach ($data as $key => $value) {
                    $data[$key]['pay_time'] = date('Y-m-d', $value['pay_time']);
                    $data[$key]['end_time'] = date('Y-m-d', $value['end_time']);
                }
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }
    

    /**
     * 预约详情
     */
    public function getShopReserveDetail(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少id'); }//预约信息id

            $data = Reserve::with('shop')->where('id', $post['id'])->find();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 预约订单确认  线下付款之后再操作
     */
    public function sureReserve(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少id'); }//预约信息id
            if(empty($post['serial_num'])){ return_ajax(400,'缺少serial_num'); }//使用的序列号

            $reserve = Reserve::where('id', $post['id'])->find();
            $point   = Reserve::where('id', $post['id'])->value('point');
            
            $check = ShopSerialNum::where('number', $post['serial_num'])->find();
            if (!$check) { return_ajax(400, '序列号不存在'); }
            if ($check['state'] == '2') { return_ajax(400, '序列号已使用'); }

            Db::startTrans();// 启动事务

            $arr = [
                'status'      => '3',
                'serial_num'  => $post['serial_num'],
                'update_time' => time(),
            ];

            $rs_reserve = Reserve::where('id', $post['id'])->update($arr);//更新预约信息表

            $rs_serial_num = ShopSerialNum::where('number', $post['serial_num'])->update(['state' => '2', 'update_time' => time()]);//更改序列号使用状态

            $rs_stock = ShopGoodsAttr::where('id', $check['shop_attr_id'])->setDec('number', $reserve['buy_num']);//扣库存

            $user = User::where('id', $reserve['uid'])->find();
            // 有推荐人 发放分销积分
            if ($user['pid']) {
                $config = Config::where('id', '1')->find();
                if ($config['p_point']) {
                    $p_point_change = [
                        'uid'      => $user['pid'],
                        'shop_id'  => $reserve['shop_id'],
                        'order_sn' => $reserve['order_sn'],
                        'point'    => '+' .$config['p_point'],
                        'type'     => '3',
                        'msg'      => '分销获得积分',
                    ];
                    $rs_p_point = $this->grantPoint($p_point_change);
                    $rs_p_user  = User::where('id', $user['pid'])->setInc('point', $config['p_point']);


                    if ($reserve['point']) {
                        $point_change = [
                            'uid'      => $reserve['uid'],
                            'shop_id'  => $reserve['shop_id'],
                            'order_sn' => $reserve['order_sn'],
                            'point'    => '+' .$point,
                            'type'     => '2',
                            'msg'      => '消费获得积分',
                        ];
                        $rs_piont = $this->grantPoint($point_change);
                        $rs_user  = User::where('id', $reserve['uid'])->setInc('point', $point);

                        if (($rs_reserve && $rs_serial_num) && ($rs_stock && $rs_piont) && ($rs_user && $rs_p_point) && $rs_p_user) {
                            Db::commit();// 提交事务
                            return_ajax(200, '操作成功');
                        }else{
                            Db::rollback();// 回滚事务
                            return_ajax(400, '操作失败');
                        }

                    }else{
                        if (($rs_reserve && $rs_serial_num) && ($rs_stock && $rs_p_point) && $rs_p_user) {
                            Db::commit();// 提交事务
                            return_ajax(200, '操作成功');
                        }else{
                            Db::rollback();// 回滚事务
                            return_ajax(400, '操作失败');
                        }
                    }

                    # code...
                }else{

                    if ($reserve['point']) {
                        $point_change = [
                            'uid'      => $reserve['uid'],
                            'shop_id'  => $reserve['shop_id'],
                            'order_sn' => $reserve['order_sn'],
                            'point'    => '+' .$point,
                            'type'     => '2',
                            'msg'      => '消费获得积分',
                        ];
                        $rs_piont = $this->grantPoint($point_change);
                        $rs_user  = User::where('id', $reserve['uid'])->setInc('point', $point);

                        if (($rs_reserve && $rs_serial_num) && ($rs_stock && $rs_piont) && $rs_user) {
                            Db::commit();// 提交事务
                            return_ajax(200, '操作成功');
                        }else{
                            Db::rollback();// 回滚事务
                            return_ajax(400, '操作失败');
                        }

                    }else{
                        if (($rs_reserve && $rs_serial_num) && $rs_stock) {
                            Db::commit();// 提交事务
                            return_ajax(200, '操作成功');
                        }else{
                            Db::rollback();// 回滚事务
                            return_ajax(400, '操作失败');
                        }
                    }
                }

            }else{

                if ($reserve['point']) {
                    $point_change = [
                        'uid'      => $reserve['uid'],
                        'shop_id'  => $reserve['shop_id'],
                        'order_sn' => $reserve['order_sn'],
                        'point'    => '+' .$point,
                        'type'     => '2',
                        'msg'      => '消费获得积分',
                    ];
                    $rs_piont = $this->grantPoint($point_change);
                    $rs_user  = User::where('id', $reserve['uid'])->setInc('point', $point);

                    if (($rs_reserve && $rs_serial_num) && ($rs_stock && $rs_piont) && $rs_user) {
                        Db::commit();// 提交事务
                        return_ajax(200, '操作成功');
                    }else{
                        Db::rollback();// 回滚事务
                        return_ajax(400, '操作失败');
                    }

                }else{
                    if (($rs_reserve && $rs_serial_num) && $rs_stock) {
                        Db::commit();// 提交事务
                        return_ajax(200, '操作成功');
                    }else{
                        Db::rollback();// 回滚事务
                        return_ajax(400, '操作失败');
                    }
                }

            }



        }
    }

    /**
     * 确认取消预约 退款(预付款)
     */
    public function sureCancelReserve(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少id'); }//预约信息id
            // 状态：1待支付；2未服务(已支付定金)；3已服务(已支付总金)；4取消中(申请退款)；5已取消(已退款)；6申请失败(退款失败)
            if(empty($post['status'])){ return_ajax(400,'缺少status'); }

            $arr = [
                'status'      => $post['status'],
                'update_time' => time(),
            ];

            if ($post['status'] == '6') {
                if(empty($post['fail_reason'])){ return_ajax(400,'缺少fail_reason'); }//退款失败原因

                $arr['fail_reason'] = $post['fail_reason'];
                $rs_reserve = Reserve::where('id', $post['id'])->update($arr);//更新预约信息表
                if ($rs_reserve) {
                    return_ajax(200, '操作成功');
                }else{
                    return_ajax(400, '操作失败');
                }

            }else{//同意退款 更新订单状态 金额原路返回
                Db::startTrans();// 启动事务
                $rs_reserve = Reserve::where('id', $post['id'])->update($arr);//更新预约信息表

                // $rs_refund;
                
                if ($rs_reserve) {
                    Db::commit();// 提交事务
                    return_ajax(200, '操作成功');
                }else{
                    Db::rollback();// 回滚事务
                    return_ajax(400, '操作失败');
                }

            }

        }
    }

    /**
     * 我的钱包
     */
    public function myWallet(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['shop_id'])){ return_ajax(400,'缺少shop_id'); }

            $where['shop_id'] = $post['shop_id'];
            $where['type'] = ['in', '2,3,4,5,7'];

            $data  = MoneyChange::where($where)->order('id desc')->page($page, '10')->select();
            $money = Shop::where('id', $post['shop_id'])->value('money');

            if ($data){

                return_ajax(200, '获取成功', $data, $money);
            }else{
                return_ajax(400, '获取失败', [], $money);
            }
        }
    }

    /**
     * 产品库列表
     */
    public function getProductList(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['shop_id'])){ return_ajax(400,'缺少shop_id'); }

            $data = ShopGoods::with('attr')->where('shop_id', $post['shop_id'])->order('id desc')->page($page, '10')->select();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }
    
    
    /**
     * 产品库详情
     */
    public function getProductDetail(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少id'); }

            $data = ShopGoods::where('id', $post['id'])->find();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }


    /**
     * 产品序列号
     */
    public function getProductSerialNum(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['shop_id'])){ return_ajax(400,'缺少shop_id'); }

            $where['shop_id'] = $post['shop_id'];
            $where['state']   = ['in', [1,2]];
            $where['status']  = '1';
            $where['phone']   = ['=', ''];

            $data = ShopSerialNum::with('attr')->where($where)->select();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 使用序列号
     */
    public function useSerialNum(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少id'); }//序列号id
            if(empty($post['phone'])){ return_ajax(400,'缺少phone'); }//会员手机号

            $id                  = $post['id'];
            $post['state']       = '2';
            $post['update_time'] = time();
            unset($post['id']);

            $data = ShopSerialNum::where('id', $id)->update($post);

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 我的人脉
     */
    public function getPartner(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['invite_code'])){ return_ajax(400,'缺少invite_code'); }

            $data = Shop::where('top_code', $post['invite_code'])->page($page, '20')->order('id desc')->select();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 我的分红
     */
    public function getBonus(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['shop_id'])){ return_ajax(400,'缺少shop_id'); }

            $data = MoneyChange::where('shop_id', $post['shop_id'])->where('type', '7')->where('status', '2')->page($page, '20')->order('id desc')->select();

            if ($data){
                $count = Shop::where('id', $post['shop_id'])->value('money');
                return_ajax(200, '获取成功', $data, $count);
            }else{
                return_ajax(400, '暂无分红');
            }
        }
    }

    /**
     * 商家付款
     */
    public function shopPayInfo(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['shop_id'])){ return_ajax(400,'缺少shop_id'); }//商家id

            $shop = Shop::where('id', $post['shop_id'])->find();
            if (empty($shop)) { return_ajax(400, 'shop_id有误'); }

            if ($shop['examine'] != '1') { return_ajax(400, '请等待审核通过再付款'); }
            if ($shop['state'] == '2') { return_ajax(400, '还没到期'); }


            $config = Config::where('id', '1')->find();

            $order_sn = $this->order_sn($post['shop_id'], 'shop_register_pay');

            $arr = [
                'order_sn'    => $order_sn,
                'shop_id'     => $post['shop_id'],
                'type'        => $shop['type'],//注册类型：1城市合伙人；2门店合伙人
                'add_time'    => time(),
                'update_time' => time(),
            ];

            if ($shop['type'] == '1') {
                $arr['pay_money'] = $config['city_money'];
                $arr['term']      = $config['city_time'];
                $arr['end_time']  = time() + $config['city_time'] * '365' * '24' * '60' * '60';

            }else{
                $arr['pay_money'] = $config['shop_money'];
                $arr['term']      = $config['shop_time'];
                $arr['end_time']  = time() + $config['shop_time'] * '365' * '24' * '60' * '60';
            }

            $data = ShopRegisterPay::insert($arr);

            if ($data){
                return_ajax(200, '获取成功', $arr);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 扫码 优惠券二维码
     * $id 优惠券id
     */
    public function sweepCode(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少id'); }

            $data = UserCoupon::where('id', $post['id'])->setField('status', '2');

            if ($data){
                return_ajax(200, '操作成功', $data);
            }else{
                return_ajax(400, '操作失败');
            }
        }
    }






}
