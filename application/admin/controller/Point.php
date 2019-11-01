<?php
namespace app\admin\controller;
use app\common\model\PointGoods;
use app\common\model\PointGoodsAttr;
use app\common\model\PointGoodsBrand;
use app\common\model\PointGoodsCate;
use app\common\model\PointOrder;
use app\common\model\Logistics;


/**
 * 积分商城
 */
Class Point extends Common{

	/**
	 * 商品列表
	 */
	public function index(){
        if(request()->isAjax()){
            $post  = input('post.');
            if(!empty($post['name'])){
                $post['where']['title'] = ['like', '%'.$post['name'].'%'];
            }
            // 分类筛选
            if(!empty($post['cate_id'])){
                $post['where']['cate_id'] = $post['cate_id'];
            }
            // 品牌筛选
            if(!empty($post['brand_id'])){
                $post['where']['brand_id'] = $post['brand_id'];
            }

            $list = $this->selectAll('point_goods', $post);
            return_ajax(200,'获取成功', $list['list'], $list['count']);
        }
        //获取商品分类
        $cate = PointGoodsCate::where('status', '1')->order('id desc')->select();
        //获取商品品牌
        $brand = PointGoodsBrand::where('status', '1')->order('id desc')->select();

        return $this->fetch('',[
            'cate' => $cate,
            'brand' => $brand,
        ]);
	}

    /**
     * 商品添加/修改
     */
	public function save(){
		$id = input('id');
		if(request()->isPost()){
            $post = input('post.');
            $point_goods = new PointGoods;
            if(request()->file('img')){
                $file = imgUpdate('img');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['img'] = $file['data'];
            }

            if(!empty($post['images'])){
                $post['images'] = implode(',', $post['images']);
            }

            $post['update_time'] = time();
            if(empty($post['id'])){
                //新增

                if($point_goods->allowField(true)->save($post)){
                    return_ajax(200,'添加成功');
                } else {
                    return_ajax(400,'添加失败,请稍后重试');
                }
            } else {
                //编辑
                if($point_goods->allowField(true)->save($post,['id'=>$post['id']])){
                    return_ajax(200,'编辑成功');
                } else {
                    return_ajax(400,'编辑失败,请稍后重试');
                }
            }
        }

		$list  = PointGoods::get($id);
		$cate  = PointGoodsCate::where('status', '1')->order('id desc')->select();
        $brand = PointGoodsBrand::where('status', '1')->order('id desc')->select();

		return $this->fetch('',[
			'list'  => $list,
			'cate'  => $cate,
            'brand' => $brand,
		]);
	}

	/**
	 * 更改状态
	 */
	public function changeStatus(){
        if(request()->isPost()){
            $post  = input('post.');
            $point_goods = new PointGoods;

            if($point_goods->allowField(true)->save($post,['id'=>$post['id']])){
                return_ajax(200);
            } else {
                return_ajax(400,'操作失败');
            }
        }
	}

    /**
     * 商品分类列表
     */
    public function cate(){
        if(input('json') == 1){
            $where = [];
            $list = PointGoodsCate::order('id desc')->select();
            return_ajax(200, '获取成功', $list);
        }
        return $this->fetch();
    }

    /**
     * 添加/编辑 商品分类
     */
    public function cate_save(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $cate = new PointGoodsCate;

            $post['update_time'] = time();
            if(empty($post['id'])){
                $post['add_time'] = time();
                $oper = $cate->allowField(true)->save($post);
            } else {
                $oper = $cate->allowField(true)->save($post,['id'=>$id]);
            }
            if($oper){
                return_ajax(200,'操作成功');
            } else {
                return_ajax(400,'操作失败，请稍后重试');
            }
        }

        $data = PointGoodsCate::get($id);
        return $this->fetch('',[
            'data' => $data
        ]);
    }

    /**
     * 删除 商品分类
     */
    public function delete_cate(){
    	$id = input('id');
        $check_goods = PointGoods::where('cate_id', $id)->find();
        if ($check_goods) {
            return_ajax(200, '有商品，不能删除');
        }
        if(PointGoodsCate::destroy($id)){
            PointGoodsCate::destroy(['topid'=>$id]);
            return_ajax(200,'删除成功');
        } else {
            return_ajax(200,'删除失败,请稍后重试');
        }
    }





    /**
     * 商品品牌列表
     */
    public function brand(){
        if(input('json') == 1){
            $where = [];
            $list = PointGoodsBrand::order('id desc')->select();
            return_ajax(200, '获取成功', $list);
        }
        return $this->fetch();
    }

    /**
     * 添加/编辑 商品品牌
     */
    public function brand_save(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $brand = new PointGoodsBrand;

            $post['update_time'] = time();
            if(empty($post['id'])){
                $post['add_time'] = time();
                $oper = $brand->allowField(true)->save($post);
            } else {
                $oper = $brand->allowField(true)->save($post,['id'=>$id]);
            }
            if($oper){
                return_ajax(200,'操作成功');
            } else {
                return_ajax(400,'操作失败，请稍后重试');
            }
        }

        $data = PointGoodsBrand::get($id);
        return $this->fetch('',[
            'data' => $data
        ]);
    }

    /**
     * 删除 商品品牌
     */
    public function delete_brand(){
        $id = input('id');
        $check_goods = PointGoods::where('brand_id', $id)->find();
        if ($check_goods) {
            return_ajax(200, '有商品，不能删除');
        }
        if(PointGoodsBrand::destroy($id)){
            PointGoodsBrand::destroy(['topid'=>$id]);
            return_ajax(200,'删除成功');
        } else {
            return_ajax(200,'删除失败,请稍后重试');
        }
    }



    /**
     * 商品规格列表
     */
    public function attr(){
        $point_goods_id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $post['where']['point_goods_id'] = $point_goods_id;
            $list = $this->selectAll('point_goods_attr', $post);
            return_ajax(200, '获取成功', $list['list'], $list['count']);
        }
        return $this->fetch('');
    }

    /**
     * 添加/编辑 商品规格
     */
    public function attr_save(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $attr = new PointGoodsAttr;

            $post['update_time'] = time();
            if(empty($post['id'])){
                $post['add_time'] = time();
                $oper = $attr->allowField(true)->save($post);
            } else {
                $oper = $attr->allowField(true)->save($post,['id'=>$id]);
            }
            if($oper){
                return_ajax(200,'操作成功');
            } else {
                return_ajax(400,'操作失败，请稍后重试');
            }
        }

        $data = PointGoodsAttr::get($id);
        return $this->fetch('',[
            'data' => $data
        ]);
    }

    /**
     * 修改状态 商品规格
     */
    public function attrEdit(){
        if(request()->isPost()){
            $post  = input('post.');
            $attr = new PointGoodsAttr;
            if($attr->allowField(true)->save($post,['id'=>$post['id']])){
                return_ajax(200);
            } else {
                return_ajax(400,'操作失败');
            }
        }
    }

    /**
     * 订单列表
     */
    public function order(){
        if(request()->isAjax()){
            $post  = input('post.');
            if(!empty($post['keywords'])){
                $post['where']['order_sn|phone'] = ['like', '%'.$post['keywords'].'%'];
            }
            // 订单状态筛选
            if(!empty($post['status'])){
                $post['where']['status'] = $post['status'];
            }
            $post['with'] = 'PointOrderList';

            $list = $this->selectAll('point_order', $post);
            return_ajax(200, '获取成功', $list['list'], $list['count']);
        }
        return $this->fetch();
    }

    /**
     * 订单详情
     */
    public function info(){
        $id = input('id');
        $data = PointOrder::with('PointOrderList')->where('id', $id)->find();
        return $this->fetch('',['data'=>$data]);
    }

  /**
     * 订单发货
     */
    public function delivery(){
        if($this->request->isPost()){
            $post = $this->request->post();
            // 查询物流信息
            $logistics = Logistics::get($post['logistics_id']);
            // 更新订单信息
            $post['logistics_state'] = 1;
            $post['logistics_name']  = $logistics['name'];
            $post['logistics_code']  = $logistics['code'];
            $post['logistics_time']  = time();
            $post['update_time']     = time();
            $post['status'] = 3;

            // print_r($post);exit;

            $id = $post['id'];
            unset($post['id']);

            $rs = PointOrder::where('id', $id)->update($post);
            if ($rs) {
                return_ajax(200, '发货成功');
            }else{
                return_ajax(400,'发货失败');
            }
        }
        $logistics = Logistics::where(['is_deleted'=>0,'status'=>1])->select();
        return $this->fetch('',['logistics'=>$logistics]);
    }



}