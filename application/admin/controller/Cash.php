<?php
namespace app\admin\controller;
use app\common\model\RedPack;
use app\common\model\MoneyChange;



/**
 * 提现管理
 */
Class Cash extends Common{

	/**
	 * 会员提现
	 */
	public function user_cash(){
        if(request()->isAjax()){
            $post  = input('post.');
            if(!empty($post['keywords'])){
                $where['username'] = ['like', '%'.$post['keywords'].'%'];
            }
            // 分类筛选
            if(!empty($post['type'])){
                $where['type'] = $post['type'];
            }else{
                $where['type'] = ['in', '4,5,6'];
            }

            $list['list'] = RedPack::where($where)->order('id desc')->select();
            $list['count'] = RedPack::where($where)->count();
            return_ajax(200,'获取成功', $list['list'], $list['count']);
        }
        return $this->fetch();
	}


    /**
     * 商家提现
     */
    public function shop_cash(){
        if(request()->isAjax()){
            $post  = input('post.');
            if(!empty($post['keywords'])){
                $where['username'] = ['like', '%'.$post['keywords'].'%'];
            }
            // 分类筛选
            if(!empty($post['type'])){
                $where['type'] = $post['type'];
            }else{
                $where['type'] = ['in', '1,5,6'];
            }

            $list['list'] = MoneyChange::where($where)->order('id desc')->select();
            $list['count'] = MoneyChange::where($where)->count();
            return_ajax(200,'获取成功', $list['list'], $list['count']);
        }
        return $this->fetch();
    }





}