<?php
namespace app\admin\controller;
use app\common\model\Shop as ShopModel;
use app\common\model\ReserveGoods;
use app\common\model\Label;
use app\common\model\SerialNum;
use app\common\model\Attr;
use app\common\model\Order;
use app\common\model\OrderList;
use app\common\model\ShopGoods;
use app\common\model\ShopGoodsAttr;
use app\common\model\ShopSerialNum;


/**
 * 联保管理
 */
Class Repair extends Common{

	/**
	 * 商品列表
	 */
	public function index(){
        if(request()->isAjax()){
            $post  = input('post.');
            if(!empty($post['name'])){
                $post['where']['title'] = ['like', '%'.$post['name'].'%'];
            }

            $list = $this->selectAll('reserve_goods', $post);
            return_ajax(200,'获取成功', $list['list'], $list['count']);
        }
		return $this->fetch();
	}

    /**
     * 商品添加/修改
     */
	public function save(){
		$id = input('id');
		if(request()->isPost()){
            $post = input('post.');
            $rgoods = new ReserveGoods;

            if(request()->file('img')){
                $file = imgUpdate('img');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['img'] = $file['data'];
            }
            if(request()->file('video')){
                $file = imgUpdate('video');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['video'] = $file['data'];
            }
            
            $post['update_time'] = time();
            if(empty($post['id'])){
                //新增
                if(empty(request()->file('img'))){ return_ajax(400,'请上传封面图'); }
                if(empty(request()->file('video'))){ return_ajax(400,'请上传视频'); }

                if($rgoods->allowField(true)->save($post)){
                    return_ajax(200,'添加成功');
                } else {
                    return_ajax(400,'添加失败,请稍后重试');
                }
            } else {
                //编辑
                if($rgoods->allowField(true)->save($post,['id'=>$post['id']])){
                    return_ajax(200,'编辑成功');
                } else {
                    return_ajax(400,'编辑失败,请稍后重试');
                }
            }
        }

		$list  = ReserveGoods::get($id);
		$label = Label::where('status', '1')->order('id desc')->select();

		return $this->fetch('',[
			'list'  => $list,
			'label' => $label,
		]);
	}





















}