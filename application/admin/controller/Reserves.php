<?php
namespace app\admin\controller;
use app\common\model\Reserve;
use app\common\model\Shop;
use app\api\controller\Weix;

/**
 * 服务预约
 */
Class Reserves extends Common{

	/**
	 * [index 商家列表]
	 */
	public function index(){
        if(request()->isAjax()){
            $post = input('post.');
            $where = [];
            if(!empty($post['keywords'])){
                $where['order_no|name|phone'] = ['like','%'.$post['keywords'].'%'];
            }
            if($post['status'] != ''){
                $where['status'] = $post['status'];
            }
            $list = Reserve::where($where)->order('id desc')->select();
            if ($list) {
                foreach ($list as $key => &$value) {
                    $list[$key]['shop_name'] = Shop::where('id', $value['shop_id'])->value('shop_name');
                }
            }
            $count = Reserve::count();
            return_ajax(200, '获取成功', $list, $count);
        }
		return $this->fetch();
	}


    /**
     * 商家修改
     */
	public function save(){
		$id = input('id');
		if(request()->isPost()){
            $post = input('post.');
            $reserve = new Reserve;

            if(request()->file('pic')){
                $file = imgUpdate('pic');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['pic'] = $file['data'];
            }
            
            $post['update_time'] = time();
            if(empty($post['id'])){
                //新增
                if(empty(request()->file('pic'))){ return_ajax(400,'请上传广告图'); }

                if($reserve->allowField(true)->save($post)){
                    return_ajax(200,'添加成功');
                } else {
                    return_ajax(400,'添加失败,请稍后重试');
                }
            } else {
                //编辑
                if($reserve->allowField(true)->save($post,['id'=>$post['id']])){
                    return_ajax(200,'编辑成功');
                } else {
                    return_ajax(400,'编辑失败,请稍后重试');
                }
            }
        }

		$reserve = Reserve::get($id);
        if ($reserve) {
            $reserve['shop_name'] = Shop::where('id', $reserve['shop_id'])->value('shop_name');
        }

		return $this->fetch('',[
			'reserve' => $reserve
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
     * 退款审核
     */
    public function refund(){
        if(request()->isPost()){
            $post  = input('post.');

            // 退款失败(拒绝退款)
            if ($post['status'] == '6') {
                $id = $post['id'];
                unset($post['id']);
                $post['update_time'] = time();
                $rs = Reserve::where('id', $id)->update($post);
                if($rs){
                    return_ajax(200, '操作成功');
                } else {
                    return_ajax(400, '操作失败');
                }
                # code...
            }else{
                // 同意退款
                $reserve = Reserve::where('id', $post['id'])->find();
                $weix    = new Weix;
                $res     =  $weix->refund($reserve['order_sn'], $reserve['pay_money']);
                print_r($res);exit;
                if ($res['return_code'] == 'SUCCESS'){
                    Reserve::where('id', $post['id'])->setField('status', $post['status']);
                    return_ajax(200,'退款成功');
                }else{
                    return_ajax(400,'系统繁忙');
                }
            }

            
        }
        return $this->fetch();
    }









}