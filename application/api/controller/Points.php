<?php
namespace app\api\controller;
use app\common\model\PointGoods;
use app\common\model\PointGoodsCate;
use \app\common\model\PointGoodsAttr;
use \app\common\model\PointGoodsBrand;
use app\common\model\User;
use app\common\model\Point;
use app\common\model\PointOrder;
use app\common\model\Address;
use app\common\model\PointOrderList;
use app\common\model\PointChange;
use \think\Db;


class Points extends Common{

    /**
     * 获取积分商品分类
     */
    public function getPointGoodsCate(){
        $data = PointGoodsCate::where('status', '1')->order('id desc')->select();
        if ($data){
            return_ajax(200, '获取成功', $data);
        }else{
            return_ajax(400, '获取失败');
        }
    }

	/**
     * 获取积分商品列表
     */
    public function getPointGoodsList(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if ($post['cate_id']) {
                $where['cate_id'] = $post['cate_id'];
            }
            $where['status'] = '1';
            $field = 'id, cate_id, brand_id, title, img, point';

            $data = PointGoods::where($where)->field($field)->page($page, '10')->order('id desc')->select();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无信息');
            }
            
        }
    }

    /**
     * 获取积分商品详情
     */
    public function getPointGoodsDetail(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少商品id'); }

            $where['id'] = $post['id'];

            $data = PointGoods::where($where)->find();

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
     * 获取积分商品规格
     */
    public function getPointGoodsAttr(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少商品id'); }

            $where['point_goods_id'] = $post['id'];

            $field = 'id, point_goods_id, title, point, price, stock';

            $data = PointGoodsAttr::where($where)->field($field)->order('id desc')->select();

            if ($data){
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '获取失败');
            }
        }
    }

    /**
     * 获取下单商品信息
     */
    public function getGoodsToPay(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400, '缺少用户id'); }

            if(empty($post['point_goods_id'])){ return_ajax(400, '缺少point_goods_id'); }
            if(empty($post['cate_id'])){ return_ajax(400, '缺少cate_id'); }
            if(empty($post['brand_id'])){ return_ajax(400, '缺少brand_id'); }
            if(empty($post['goods_attr_id'])){ return_ajax(400, '缺少goods_attr_id'); }//商品规格id
            if(empty($post['buy_num'])){ return_ajax(400, '缺少buy_num'); }

            $goods = PointGoods::where('id', $post['point_goods_id'])->find();//商品
            $attr  = PointGoodsAttr::where('id', $post['goods_attr_id'])->find();//规格

            $use_point = $post['buy_num'] * $attr['point'];

            $point = User::where('id', $post['uid'])->value('point');
            if($use_point > $point){ return_ajax(400, '积分不足'); }

            // 下单信息
            $order['all_num']   = $post['buy_num'];
            $order['use_point'] = $use_point;
            $order['freight']   = $goods['freight'];

            // 订单明细
            $order_list = [
                'buy_num'        => $post['buy_num'],
                'point_goods_id' => $post['point_goods_id'],
                'cate_id'        => $post['cate_id'],
                'brand_id'       => $post['brand_id'],
                'title'          => $goods['title'],//
                'img'            => $goods['img'],//商品封面图
                'point'          => $goods['point'],//积分
                'freight'        => $goods['freight'],//运费
                'goods_attr_id'  => $post['goods_attr_id'],//商品规格id
                'goods_attr'     => $attr,
            ];

            if ($order && $order_list) {
                $data = ['order' => $order, 'order_list' => $order_list];
                return_ajax(200, '操作成功', $data);
            }else{
                return_ajax(400, '操作失败');
            }
        }

    }

    /**
     * 添加订单
     */
    public function addOrder(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['uid'])){ return_ajax(400, '缺少用户id'); }

            if(empty($post['point_goods_id'])){ return_ajax(400, '缺少point_goods_id'); }
            if(empty($post['cate_id'])){ return_ajax(400, '缺少cate_id'); }
            if(empty($post['brand_id'])){ return_ajax(400, '缺少brand_id'); }
            if(empty($post['goods_attr_id'])){ return_ajax(400, '缺少goods_attr_id'); }//商品规格id
            if(empty($post['buy_num'])){ return_ajax(400, '缺少buy_num'); }
            if(empty($post['addr_id'])){ return_ajax(400, '缺少addr_id'); }
            // if(empty($post['remarks'])){ return_ajax(400, '缺少remarks'); }

            $goods      = PointGoods::where('id', $post['point_goods_id'])->find();//商品
            $attr       = PointGoodsAttr::field('id, point_goods_id, title, point, price, stock')->where('id', $post['goods_attr_id'])->find();//规格
            $address    = Address::where('id', $post['addr_id'])->find();//地址
            $cate_name  = PointGoodsCate::where('id', $post['cate_id'])->value('title');//类型名称
            $brand_name = PointGoodsBrand::where('id', $post['brand_id'])->value('title');//品牌名称

            $order_sn  = $this->order_sn($post['uid'], 'point_order');

            $use_point = $post['buy_num'] * $attr['point'];

            $point = User::where('id', $post['uid'])->value('point');
            if($use_point > $point){ return_ajax(400, '积分不足'); }

            // 入库订单表
            $order['order_sn']  = $order_sn;
            $order['uid']       = $post['uid'];
            $order['all_num']   = $post['buy_num'];
            $order['use_point'] = $use_point;
            $order['all_money'] = $post['buy_num'] * $goods['price'];
            $order['freight']   = $goods['freight'];
            $order['remarks']   = $post['remarks'];
            $order['addr_id']   = $post['addr_id'];
            $order['name']      = $address['name'];
            $order['phone']     = $address['phone'];
            $order['province']  = $address['province'];
            $order['city']      = $address['city'];
            $order['area']      = $address['area'];
            $order['address']   = $address['address'];
            $order['status']    = '2';
            $order['pay_time']  = time();
            $order['add_time']  = time();
            $order['update_time'] = time();

            // 入库订单商品表
            $order_list = [
                'uid'            => $post['uid'],
                'order_sn'       => $order_sn,
                'buy_num'        => $post['buy_num'],
                'point_goods_id' => $post['point_goods_id'],
                'cate_id'        => $post['cate_id'],
                'brand_id'       => $post['brand_id'],
                'title'          => $goods['title'],
                'name'           => $goods['name'],
                'type'           => $goods['type'],
                'img'            => $goods['img'],//商品封面图
                'images'         => $goods['images'],//相册
                'point'          => $goods['point'],//积分
                'price'          => $goods['price'],//商品价格
                'freight'        => $goods['freight'],//运费
                'goods_attr_id'  => $post['goods_attr_id'],//商品规格id
                'goods_attr'     => json_encode($attr),
                'cate_name'      => $cate_name,
                'brand_name'     => $brand_name,
                'add_time'       => time(),
                'update_time'    => time(),
            ];

            // 入库积分变化表
            $point_change = [
                'uid'      => $post['uid'],
                'order_sn' => $order_sn,
                'point'    => '-' .$use_point,
                'type'     => '2',
                'msg'      => '积分兑换商品',
                'add_time' => time(),
                'update_time' => time(),
            ];

            Db::startTrans();// 启动事务

            $rs_add_order    = PointOrder::insert($order);//添加订单
            $rs_add_ord_lst  = PointOrderList::insert($order_list);//添加订单商品
            $rs_point_change = PointChange::insert($point_change);//添加积分变化
            $rs_stock        = PointGoodsAttr::where('id', $post['goods_attr_id'])->setDec('stock', $post['buy_num']);//扣库存
            $rs_user         = User::where('id', $post['uid'])->setDec('point', $use_point);//扣几分

            if (($rs_add_order && $rs_add_ord_lst) && ($rs_point_change && $rs_stock) && $rs_user) {
                Db::commit();// 提交事务
                return_ajax(200, '操作成功');
            }else{
                Db::rollback();// 回滚事务
                return_ajax(400, '操作失败');
            }
        }
    }

    /**
     * 获取订单列表
     */
    public function getOrderList(){
        if(request()->isPost()){
            $post = input('post.');
            $page = $post['page'] ? $post['page'] : '1';

            if(empty($post['uid'])){ return_ajax(400, '缺少用户id'); }

            $data = PointOrder::with('PointOrderList')->where('uid', $post['uid'])->order('id desc')->page($page, '10')->select();

            if ($data) {
                return_ajax(200, '操作成功', $data);
            }else{
                return_ajax(400, '操作失败');
            }
        }
    }

    /**
     * 获取订单详情
     */
    public function getOrderDetail(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400, '缺少订单id'); }

            $data = PointOrder::with('PointOrderList')->where('id', $post['id'])->find();

            if ($data) {
                return_ajax(200, '操作成功', $data);
            }else{
                return_ajax(400, '操作失败');
            }
        }
    }





}
