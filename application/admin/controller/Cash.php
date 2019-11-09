<?php
namespace app\admin\controller;
use app\common\model\RedPack;
use app\common\model\MoneyChange;
use app\common\model\User;
use app\common\model\Shop;
use app\common\model\Config;

use think\Db;


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

    /**
     * 会员提现审核
     */
    public function userExamine(){
        $post = input('post.');

        $red_pack = RedPack::where('id', $post['id'])->find();
        $user     = User::where('id', $red_pack['uid'])->find();
        $base     = Config::where('id', '1')->find();

        $res = controller('Api/Weix')->cashWxpay($user, $base);
        if ($res['result_code'] != 'SUCCESS') {
            return_ajax(array(200, $res['err_code_des']));
        }else{
            $rs = RedPack::where('id', $post['id'])->update(['type' => '5', 'update_time' => time()]);
            $rs2 = User::where('id', $red_pack['uid'])->setDec('money', $red_pack['money']);
            return_ajax(200, '提现成功');

            // if ($rs) {
            //     return_ajax(200, '提现成功');
            // }else{
            //     return_ajax(400, '网络繁忙');
            // }
        }

    }


    /**
     * 商家提现审核
     */
    public function shopExamine(){
        $post = input('post.');

        $money_change = MoneyChange::where('id', $post['id'])->find();
        $shop         = Shop::where('id', $money_change['shop_id'])->find();
        $user         = User::where('id', $shop['uid'])->find();
        $base         = Config::where('id', '1')->find();

        $res = controller('Api/Weix')->cashWxpay($user, $base);
        if ($res['result_code'] != 'SUCCESS') {
            return_ajax(array(200, $res['err_code_des']));
        }else{
            // Db::startTrans();// 启动事务
            $rs  = MoneyChange::where('id', $post['id'])->update(['type' => '5', 'update_time' => time()]);
            $rs2 = Shop::where('id', $money_change['shop_id'])->setDec('money', $money_change['bonus_money']);
            return_ajax(200, '提现成功');
            // if ($rs && $rs2) {
            //     // Db::commit();// 提交事务
            //     return_ajax(200, '提现成功');
            // }else{
            //     // Db::rollback();// 回滚事务
            //     return_ajax(400, '网络繁忙');
            // }
        }
    }


}