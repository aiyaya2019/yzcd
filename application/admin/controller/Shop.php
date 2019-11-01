<?php
namespace app\admin\controller;
use app\common\model\Shop as ShopModel;
use app\common\model\UserCoupon;
use app\common\model\User;
use app\common\model\Order;
use app\common\model\Reserve;
use app\common\model\City;
use think\Db;

/**
 * 商家
 */
Class Shop extends Common{

	/**
	 * [index 商家列表]
	 */
	public function shop(){
        if(request()->isAjax()){
            $post = input('post.');
            $where = [];
            if(!empty($post['keywords'])){
                $where['shop_name|name'] = ['like','%'.$post['keywords'].'%'];
            }
            if($post['examine'] != ''){
                $where['examine'] = $post['examine'];
            }
            if (array_key_exists('city_id', $post)) {
                if($post['city_id'] != ''){
                    $where['city_id'] = $post['city_id'];
                }
            }
            if (array_key_exists('type', $post)) {
                if($post['type'] != ''){
                    $where['type'] = $post['type'];
                }
            }
            $list = ShopModel::where($where)->order('id desc')->select();
            if ($list) {
                foreach ($list as $key => $value) {
                    $order_money = Order::where('shop_id', $value['id'])->where('status', '<>', '1')->sum('pay_money');
                    $order_money = $order_money ? $order_money : '0';

                    $reserve_moeny = Reserve::where('shop_id', $value['id'])->where('status', '3')->sum('pay_money');
                    $reserve_moeny = $reserve_moeny ? $reserve_moeny : '0';

                    $list[$key]['order_money']   = $order_money;
                    $list[$key]['reserve_moeny'] = $reserve_moeny;

                    $list[$key]['img'] = explode(',', $value['img']);
                }
            }
            $count = ShopModel::count();
            return_ajax(200, '获取成功', $list, $count);
        }
        $city = City::where('status', '1')->select();
        return $this->fetch('',[
            'city' => $city,
        ]);
	}


    /**
     * 商家修改
     */
	public function shop_save(){
		$id = input('id');
		if(request()->isPost()){
            $post = input('post.');
            $banner = new ShopModel;

            if(request()->file('pic')){
                $file = imgUpdate('pic');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['pic'] = $file['data'];
            }
            
            $post['update_time'] = time();
            if(empty($post['id'])){
                //新增
                if(empty(request()->file('pic'))){ return_ajax(400,'请上传广告图'); }

                if($banner->allowField(true)->save($post)){
                    return_ajax(200,'添加成功');
                } else {
                    return_ajax(400,'添加失败,请稍后重试');
                }
            } else {
                //编辑
                if($banner->allowField(true)->save($post,['id'=>$post['id']])){
                    return_ajax(200,'编辑成功');
                } else {
                    return_ajax(400,'编辑失败,请稍后重试');
                }
            }
        }

		$shop = ShopModel::get($id);
        $city = City::where('status', '1')->select();

		return $this->fetch('',[
			'shop'       => $shop,
            'city'       => $city,
            'img'        => explode(',', $shop['img']),
            'license'    => explode(',', $shop['license']),
            'idcard_img' => explode(',', $shop['idcard_img']),
            'other_project_img' => explode(',', $shop['other_project_img']),
		]);
	}


    /**
     * 审核审核
     */
    public function shopExamine(){
        if(request()->isPost()){
            $post  = input('post.');
            $shopModel = new ShopModel;
            if (array_key_exists('examine', $post)) {
                $post['examine_time'] = time();
            }

            if($shopModel->allowField(true)->save($post,['id'=>$post['id']])){
                return_ajax(200);
            } else {
                return_ajax(400,'操作失败');
            }
        }
    }

    /**
     * 商家优惠券 用户已领取
     */
    public function coupon(){
        $shop_id = input('shop_id');
        if(request()->isPost()){
            $post = input('post.');

            $page = $post['page'] * $post['limit'];

            $w = '';
            if (!empty($post['status'])) {
                $w = ' and status = ' .$post['status'];
            }

            $sql  = 'select * from z_user_coupon where find_in_set(' .$post['shop_id'] .', shop_id)' .$w;
            $sql2 = 'select count(id) as num from z_user_coupon where find_in_set(' .$post['shop_id'] .', shop_id)' .$w;

            $list  = Db::query($sql);
            if ($list) {
                foreach ($list as $key => $value) {
                    $list[$key]['start_time'] = date('Y-m-d', $value['start_time']);
                    $list[$key]['end_time']   = date('Y-m-d', $value['end_time']);
                    $list[$key]['add_time']   = date('Y-m-d', $value['add_time']);
                    $list[$key]['day_time']   = date('Y-m-d', $value['day_time']);

                    $nickname = User::where('id', $value['uid'])->value('nickname');
                    $list[$key]['nickname'] = $nickname;
                }
            }
            $count = Db::query($sql2);
            return_ajax(200,'获取成功', $list, $count['0']['num']);
        }
        return $this->fetch('');
    }

    /**
     * 商家预约信息
     */
    public function reserves(){
        $shop_id = input('shop_id');
        if(request()->isPost()){
            $post = input('post.');
            $post['where']['shop_id'] = $shop_id;
            if (!empty($post['status'])) {
                $post['where']['status'] = $post['status'];
            }
            $post['with'] = 'shop';
            $list = $this->selectAll('reserve', $post);
            if ($list) {
                foreach ($list['list'] as $key => &$value) {
                    $list['list'][$key]['shop_name'] = ShopModel::where('id', $value['shop_id'])->value('shop_name');
                }
            }
            return_ajax(200, '获取成功', $list['list'], $list['count']);
        }
        return $this->fetch('');
    }

    /**
     * 预约详情
     * 预约id
     */
    public function reserves_save(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $banner = new ShopModel;

            if(request()->file('pic')){
                $file = imgUpdate('pic');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['pic'] = $file['data'];
            }
            
            $post['update_time'] = time();
            if(empty($post['id'])){
                //新增

                if($banner->allowField(true)->save($post)){
                    return_ajax(200,'添加成功');
                } else {
                    return_ajax(400,'添加失败,请稍后重试');
                }
            } else {
                //编辑
                if($banner->allowField(true)->save($post,['id'=>$post['id']])){
                    return_ajax(200,'编辑成功');
                } else {
                    return_ajax(400,'编辑失败,请稍后重试');
                }
            }
        }

        $reserves = Reserve::where('id', $id)->find();
        if ($reserves) {
            $reserves['shop_name'] = ShopModel::where('id', $reserves['shop_id'])->value('shop_name');
        }

        return $this->fetch('', [
            'data' => $reserves,
        ]);
    }

    /**
     * 商家产品库
     */
    public function product(){
        $shop_id = input('shop_id');
        if(request()->isPost()){
            $post = input('post.');
            $post['where']['shop_id'] = $shop_id;
            // if (!empty($post['status'])) {
            //     $post['where']['status'] = $post['status'];
            // }
            $list = $this->selectAll('shop_goods', $post);
            if ($list) {
            }
            return_ajax(200, '获取成功', $list['list'], $list['count']);
        }
        return $this->fetch('');
    }


    /**
     * 商品规格列表
     */
    public function attr(){
        $shop_goods_id = input('shop_goods_id');
        if(request()->isPost()){
            $post = input('post.');
            $post['where']['shop_goods_id'] = $shop_goods_id;
            $list = $this->selectAll('shop_goods_attr', $post);
            return_ajax(200, '获取成功', $list['list'], $list['count']);
        }
        return $this->fetch('');
    }


    /**
     * 商品序列号
     */
    public function number(){
        if(request()->isAjax()){
            $post  = input('post.');
            if(!empty($post['name'])){
                $post['where']['number'] = $post['name'];
            }
            $post['where']['shop_attr_id'] = $post['shop_attr_id'];

            $list = $this->selectAll('shop_serial_num', $post);
            return_ajax(200,'获取成功', $list['list'], $list['count']);
        }
        return $this->fetch();
    }







}