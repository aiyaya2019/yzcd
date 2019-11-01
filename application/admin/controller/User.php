<?php
namespace app\admin\controller;
use app\common\model\User as UserModel;
use app\common\model\Goods;
use app\common\model\PointGoods;
use app\common\model\PointOrder;
use app\common\model\Reserve;

Class User extends Common{

    public function index()
    {
        if(request()->isAjax()){
            $post = input('post.');

            $where = [];
            if(!empty($post['id'])){ $where['id'] = $post['id']; }
            if(!empty($post['nickname'])){ $where['nickname'] = ['like','%'.urlencode($post['nickname']).'%']; }

            $user = UserModel::where($where)->page(input('page'),20)->select();
            $count = UserModel::where($where)->count();

            return_ajax(200,'获取成功',$user,$count);
        }
        return $this->fetch();
    }

    /**
     * [edit 修改会员状态]
     * @Author   PengJun
     * @DateTime 2019-02-01
     * @return   [type]     [description]
     */
    public function edit()
    {
        if(request()->isPost()){
            $post = input('post.');
            $user = new UserModel;

            if($user->allowField(true)->save($post,['id'=>$post['uid']])){
                return_ajax(200);
            } else {
                return_ajax(400,'操作失败');
            }
        }
    }

    /**
     * [user_excel 导出所有用户]
     * @Author   PengJun
     * @DateTime 2019-01-29
     * @return   [type]     [description]
     */
    public function user_excel()
    {   
        ini_set('memory_limit','3072M');
        set_time_limit(0);

        $user = UserModel::all();

        $head = ['昵称','省份','城市','openid','性别'];
        $data = [];
        foreach($user as $key=>$vo){
            $data[] = [
                filterEmoji($vo['nickname']),
                $vo['province'],
                $vo['city'],
                $vo['openid'],
                $vo['sex_name'],
            ];
        }
        excelExport('用户信息',$head,$data);
    }



    /**
     * 会员预约信息
     */
    public function reserves(){
        $uid = input('uid');
        if(request()->isPost()){
            $post = input('post.');
            $post['where']['uid'] = $uid;
            if (!empty($post['status'])) {
                $post['where']['status'] = $post['status'];
            }
            $list = $this->selectAll('reserve', $post);
            if ($list) {
            }
            return_ajax(200, '获取成功', $list['list'], $list['count']);
        }
        return $this->fetch('');
    }

    public function reservesSave(){
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

        return $this->fetch('',[
            'reserve' => $reserve
        ]);
    }


    /**
     * 积分订单
     */
    public function pointOrder(){
        $uid = input('uid');
        if(request()->isPost()){
            $post = input('post.');
            $post['where']['uid'] = $uid;
            if (!empty($post['status'])) {
                $post['where']['status'] = $post['status'];
            }
            $list = $this->selectAll('point_order', $post);
            if ($list) {
            }
            return_ajax(200, '获取成功', $list['list'], $list['count']);
        }
        return $this->fetch('');
    }

    /**
     * 积分订单详情
     */
    public function info(){
        $id = input('id');
        $data = PointOrder::with('PointOrderList')->where('id', $id)->find();
        return $this->fetch('',['data'=>$data]);
    }


    /**
     * 优惠劵列表
     */
    public function userCoupon(){
        $uid = input('uid');
        if(request()->isPost()){
            $post = input('post.');
            $post['where']['uid'] = $uid;
            $list = $this->selectAll('user_coupon', $post);

            return_ajax(200,'获取成功', $list['list'], $list['count']);
        }

        return $this->fetch();
    }

    /**
     * 积分明细列表
     */
    public function point(){
        $uid = input('uid');
        if(request()->isPost()){
            $post = input('post.');
            $post['where']['uid'] = $uid;
            $list = $this->selectAll('point_change', $post);

            return_ajax(200,'获取成功', $list['list'], $list['count']);
        }

        return $this->fetch();
    }

    /**
     * 分销下家
     */
    public function child(){
        if(request()->isAjax()){
            $post = input('post.');

            $where = [];
            if(empty($post['pid'])){ return_ajax(400,'缺少pid'); }
            if(!empty($post['nickname'])){ $where['nickname'] = ['like','%'.urlencode($post['nickname']).'%']; }
            $where['pid'] = $post['pid'];

            $user  = UserModel::where($where)->page(input('page'),20)->select();
            $count = UserModel::where($where)->count();

            return_ajax(200,'获取成功',$user,$count);
        }
        return $this->fetch();
    }






}