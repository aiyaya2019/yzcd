<?php
namespace app\admin\controller;

use app\common\model\Coupon as Cp;
use app\common\model\Shop;
use app\common\model\Activities;

Class Activity extends Common{

    /**
     * 优惠劵列表
     */
    public function index(){
        if(request()->isPost()){
            $post = input('post.');
            $list = $this->selectAll('Coupon',$post);

            return_ajax(200,'获取成功', $list['list'], $list['count']);
        }

        return $this->fetch();
    }

    /**
     * 添加优惠劵
     */
    public function save(){
        $id = input('id');

        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['shop_id'])){
                return_ajax(400,'请选择指定门店');
            }else{
                $post['shop_id'] = implode(',', $post['shop_id']);
            }

            // if ($post['num'] == 0){
            //     return_ajax(400,'发放数量不能为0');
            // }
            
            $post['start_time'] = strtotime($post['start_time']);
            $post['end_time'] = strtotime($post['end_time']);
            
            // 生成对应的优惠券码
            $post['coupon_code'] = $this->coupon_code();

            $save = $this->saves('Coupon', $post, true);

            if($save){
                return_ajax(200,'操作成功');
            } else {
                return_ajax(400,'操作失败，请稍后重试');
            }
        }

        $list = Cp::get($id);
        $shop = Shop::select();

        return $this->fetch('',[
            'list' => $list,
            'shop' => $shop,
        ]);
    }

    /**
     * 红包活动通知
     */
    public function red_act(){
        if(request()->isPost()){
            $post = input('post.');
            $post['where']['type'] = '2';
            $list = $this->selectAll('activities', $post);

            return_ajax(200,'获取成功', $list['list'], $list['count']);
        }

        return $this->fetch();
    }

    /**
     * 添加/编辑红包活动
     */
    public function red_act_save(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $post['type'] = '2';
            $activity = new Activities;

            if(request()->file('pic')){
                $file = imgUpdate('pic');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['pic'] = $file['data'];
            }
            
            $post['update_time'] = time();
            if(empty($post['id'])){
                //新增
                if(empty(request()->file('pic'))){ return_ajax(400,'请上传广告图'); }

                if($activity->allowField(true)->save($post)){
                    return_ajax(200,'添加成功');
                } else {
                    return_ajax(400,'添加失败,请稍后重试');
                }
            } else {
                //编辑
                if($activity->allowField(true)->save($post,['id'=>$post['id']])){
                    return_ajax(200,'编辑成功');
                } else {
                    return_ajax(400,'编辑失败,请稍后重试');
                }
            }
        }

        $list = Activities::get($id);

        return $this->fetch('',[
            'list' => $list
        ]);
    }


    /**
     * 优惠券活动
     */
    public function coupon_act(){
        if(request()->isPost()){
            $post = input('post.');
            $post['where']['type'] = '1';
            $list = $this->selectAll('activities', $post);

            return_ajax(200,'获取成功', $list['list'], $list['count']);
        }

        return $this->fetch();
    }

    /**
     * 添加/编辑优惠券活动
     */
    public function coupon_act_save(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $post['type'] = '1';
            $activity = new Activities;

            if(request()->file('pic')){
                $file = imgUpdate('pic');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['pic'] = $file['data'];
            }
            
            $post['update_time'] = time();
            if(empty($post['id'])){
                //新增
                if(empty(request()->file('pic'))){ return_ajax(400,'请上传封面图'); }

                if($activity->allowField(true)->save($post)){
                    return_ajax(200,'添加成功');
                } else {
                    return_ajax(400,'添加失败,请稍后重试');
                }
            } else {
                //编辑
                if($activity->allowField(true)->save($post,['id'=>$post['id']])){
                    return_ajax(200,'编辑成功');
                } else {
                    return_ajax(400,'编辑失败,请稍后重试');
                }
            }
        }

        $list = Activities::get($id);

        return $this->fetch('',[
            'list' => $list
        ]);
    }



    /**
     * 更改状态
     */
    public function changeStatus(){
        if(request()->isPost()){
            $post  = input('post.');
            $activity = new Activities;

            if($activity->allowField(true)->save($post,['id'=>$post['id']])){
                return_ajax(200);
            } else {
                return_ajax(400,'操作失败');
            }
        }
    }

}