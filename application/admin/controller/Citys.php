<?php
namespace app\admin\controller;
use app\common\model\City;
use app\common\model\CityCate;
use app\common\model\Shop;

use think\Db;

Class Citys extends Common{

    /**
     * 城市列表
     */
    public function index(){
        if(request()->isAjax()){
            $post = input('post.');
            $where = [];

            //城市名称搜索
            if(!empty($post['city'])){
                $where['city'] = ['like','%'.$post['city'].'%'];
            }

            //城市类型搜索
            if(!empty($post['cate_id'])){
                $where['cate_id'] = $post['cate_id'];
            }

            $list  = City::where($where)->order('id desc')->page(input('page'),20)->select();
            $count = City::where($where)->count();
            return_ajax(200,'获取成功',$list,$count);
        }

        //获取城市类型
        $cate = CityCate::where('status', '1')->select();

        return $this->fetch('',[
            'cate' => $cate,
        ]);
    }

    /**
     * 添加/编辑 城市
     */
    public function save(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $city = new City;


            if(empty($post['id'])){
                $rs = $city->allowField(true)->save($post);
            } else {
                $shop_num = Shop::where('examine', 'in', '0,1')->where('city_id', $post['id'])->count('id');
                if ($shop_num > $post['num']) { return_ajax(400, '该区域已入驻门店' .$shop_num .',入驻数量不能少于' .$shop_num); }

                $rs = $city->allowField(true)->save($post,['id'=>$id]);
            }
            if($rs){
                return_ajax(200,'操作成功');
            } else {
                return_ajax(400,'操作失败，请稍后重试');
            }
        }

        $province = $this->getProvince();

        $city = City::get($id);
        $cate = CityCate::select();
        return $this->fetch('', [
            'province' => $province,
            'city'     => $city,
            'cate'     => $cate,
        ]);
    }


    /**
     * 删除
     */
    public function delete_city(){
        $id = input('id');
        $check = Shop::where('city_id', $id)->find();
        if ($check) {
            return_ajax(200, '该地区已经有门店入驻，不能删除');
        }

        if(City::destroy($id)){
            City::destroy(['id'=>$id]);
            return_ajax(200,'删除成功');
        } else {
            return_ajax(200,'删除失败,请稍后重试');
        }
    }






}