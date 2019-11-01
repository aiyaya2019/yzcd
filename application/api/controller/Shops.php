<?php
namespace app\api\controller;
use app\common\model\Shop;
use app\common\model\ShopGoods;
use app\common\model\Reserve;
use app\common\model\UserCoupon;
use app\common\model\Label;
use app\common\model\User;

use \think\Db;


class Shops extends Common{

	/**
     * 门店列表
     */
    public function getShopList(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['province'])){ return_ajax(400,'缺少province'); }
            if(empty($post['city'])){ return_ajax(400,'缺少city'); }
            if(empty($post['lng'])){ return_ajax(400,'缺少经度'); }
            if(empty($post['lat'])){ return_ajax(400,'缺少纬度'); }

            if ($post['keywords']) {
                $where['shop_name'] = ['like', '%' .$post['keywords'] .'%'];
            }

            $where['province'] = $post['province'];
            $where['city']     = $post['city'];
            $where['status']   = '1';
            $where['examine']  = '1';

            $field = 'id, shop_name, province, city, area, address, lng, lat, pic, type';

            $data = Shop::where($where)->field($field)->page($page, '10')->order('id desc')->select();

            if ($data){
                foreach ($data as $k=>$v){
                    $data[$k]['distance'] = $this->getDistance($post['lat'], $post['lng'], $data[$k]['lat'], $data[$k]['lng']);
                    $data[$k]['make'] = 10;
                }
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
            
        }
    }

    /**
     * 门店详情
     */
    public function getShopDetail(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少门店id'); }

            $where['id'] = $post['id'];

            $field = 'id, uid, shop_name, province, city, area, address, lng, lat, pic, name, phone, tel, telephone, job_time, project, other_project, license, img';

            $data = Shop::where($where)->field($field)->find();

            if ($data){
                if ($data['img']) {
                    $data['img'] = explode(',', $data['img']);
                }
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 本店服务列表
     */
    public function getGoodsList(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['shop_id'])){ return_ajax(400,'缺少门店shop_id'); }

            $where['shop_id'] = $post['shop_id'];
            $where['status']   = '1';

            $field = 'id, shop_id, goods_id, label_id, title, img, money';

            $data = ShopGoods::where($where)->field($field)->order('id desc')->page($page, '20')->select();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 本店服务详情
     */
    public function getGoodsDetail(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少服务id'); }

            $where['id'] = $post['id'];

            $field = 'id, shop_id, goods_id, label_id, title, img, video, front_money, money, point, repair_time, content';

            $data = ShopGoods::where($where)->field($field)->find();

            if ($data){
                $data['content'] = preg_replace('/style=""/','',$data['content']);
                $data['content'] = preg_replace('/src="(.*?)"/','src="'.$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER['SERVER_NAME'].'$1" style="width:100%;"',$data['content']);
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 获取要预约的服务信息
     */
    public function getGoodsReserve(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少服务id'); }
            if(empty($post['uid'])){ return_ajax(400,'缺少服务uid'); }

            $where['id'] = $post['id'];

            $field = 'id, shop_id, goods_id, label_id, title, img, video, front_money, money, point, repair_time, content';

            $data = ShopGoods::with('Shop')->where($where)->field($field)->find();

            if ($data){
                $w_cou['uid']      = $post['uid'];
                $w_cou['shop_id']  = $data['shop_id'];
                $w_cou['status']   = '1';
                $w_cou['day_time'] = ['>=', time()];
                $w_cou['full_price'] = ['<=', $data['front_money']];
                
                $coupon = UserCoupon::where($w_cou)->select();
                if ($coupon) {
                    $data['use_coupon'] = count($coupon);//可用优惠券数量
                }else{
                    $data['use_coupon'] = '0';//不可用优惠券
                }

                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 获取可用优惠券
     */
    public function getCanUseCoupon(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少服务id'); }
            if(empty($post['uid'])){ return_ajax(400,'缺少服务uid'); }
            if(empty($post['shop_id'])){ return_ajax(400,'缺少服务shop_id'); }

            if (array_key_exists('front_money', $post)) {
                $where['full_price'] = ['<=', $post['front_money']];
            }

            $where['uid']      = $post['uid'];
            $where['status']   = '1';
            $where['day_time'] = ['>=', time()];

            $sql = "select  id from z_user_coupon where find_in_set('" .$post['shop_id'] ."',shop_id)";
            $ids = Db::query($sql);
            $ids = array_column($ids, 'id', 'id');

            $where['id'] = ['in', $ids];

            $data = UserCoupon::where($where)->order('id asc')->select();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }


    /**
     * 立即预约 预付款
     */
    public function addReserve(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少服务id'); }
            if(empty($post['uid'])){ return_ajax(400,'缺少会员uid'); }
            if(empty($post['shop_id'])){ return_ajax(400,'缺少shop_id'); }
            if(empty($post['label_id'])){ return_ajax(400,'缺少label_id'); }
            if(empty($post['buy_num'])){ return_ajax(400,'缺少buy_num'); }

            if(empty($post['reserve_time'])){ return_ajax(400,'缺少reserve_time'); }
            if(empty($post['name'])){ return_ajax(400,'缺少name'); }
            if(empty($post['phone'])){ return_ajax(400,'缺少phone'); }
            if(empty($post['car_number'])){ return_ajax(400,'缺少car_number'); }

            $goods      = ShopGoods::where('id', $post['id'])->find();
            $label_name = Label::where('id', $post['label_id'])->value('name');

            $front_money = $goods['front_money'] * $post['buy_num'];//预付款
            $all_money   = $goods['money'] * $post['buy_num'];//总价
            $wait_money  = $all_money - $front_money;//待付款

            if ($post['coupon_id']) {
                $coupon = UserCoupon::where('id', $post['coupon_id'])->find();
                if ($coupon) {
                    if ($front_money >= $coupon['full_price']) {
                        $coupon_money = $coupon['less_price'];
                    }else{
                        $coupon_money = '0';
                    }
                }else{
                    $coupon_money = '0';
                }
            }else{
                $coupon_money = '0';
            }

            $pay_money = $front_money - $coupon_money;//实际支付金额
            $order_sn  = $this->order_sn($post['uid'], 'reserve');

            $reserve = [
                'order_sn'     => $order_sn,//预约单号
                'shop_id'      => $post['shop_id'],//门店id
                'pid'          => User::where('id', $post['uid'])->value('pid'),
                'uid'          => $post['uid'],//会员id
                'buy_num'      => $post['buy_num'],//购买数量
                'label_id'     => $post['label_id'],//标签id
                'label_name'   => $label_name,//标签名称
                'shop_gid'     => $post['id'],//预约商品id
                'res_gid'      => $goods['id'],
                'title'        => $goods['title'],//名称
                'img'          => $goods['img'],//封面图片
                'front_money'  => $front_money,//预付款
                'wait_money'   => $wait_money,//待付款
                'money'        => $goods['money'],//市场价
                'all_money'    => $all_money,//总价
                'repair_time'  => $goods['repair_time'],//联保时长/年
                // 'end_time'     => $end_time,//联保到期时间
                'reserve_time' => strtotime($post['reserve_time']),//预约时间
                'pay_money'    => $pay_money,//实际支付金额
                'pay_allmoney' => $goods['front_money'],//实际支付总金额
                'coupon_id'    => $post['coupon_id'],//用户优惠券id
                'coupon_money' => $coupon_money,//优惠金额
                'name'         => $post['name'],//姓名
                'phone'        => $post['phone'],//手机号
                'car_number'   => $post['car_number'],//车牌号
                'add_time'     => time(),
                'update_time'  => time(),
                'point'        => $goods['point'],//可得积分
            ];

            Db::startTrans();// 启动事务

            $rs_reserve = Reserve::insert($reserve);
            // $rs_stock   = ShopGoods::where('id', $post['id'])->setDec('stock', $post['buy_num']);

            if ($rs_reserve){
                Db::commit();// 提交事务
                return_ajax(200, '预约成功', $order_sn);
            }else{
                Db::rollback();// 回滚事务
                return_ajax(400, '预约失败');
            }
        }
    }










}
