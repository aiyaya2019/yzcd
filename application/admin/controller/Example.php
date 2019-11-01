<?php
namespace app\admin\controller;
use app\common\model\Cases;
use app\common\model\Brand;
use app\common\model\Refit;

use think\Db;

Class Example extends Common{

    /**
     * 案例列表
     */
    public function index(){
        if(request()->isAjax()){
            $post = input('post.');
            $where = [];

            //案例名称搜索
            if(!empty($post['title'])){
                $where['title'] = ['like','%'.$post['title'].'%'];
            }

            //案例品牌搜索
            if(!empty($post['brand_id'])){
                $where['brand_id'] = $post['brand_id'];
            }

            // 改装类型搜索
            if(!empty($post['refit_id'])){
                $where['refit_id'] = $post['refit_id'];
            }

            $list = Db::name('cases')->where($where)->order('id desc')->page(input('page'),20)->select();
            if ($list) {
                foreach ($list as $key => $value) {
                    $list[$key]['brand_name'] = Brand::where('id', $value['brand_id'])->value('name');
                    $list[$key]['refit_name'] = Refit::where('id', $value['refit_id'])->value('name');
                }
            }
            $count = Cases::where($where)->count();
            return_ajax(200,'获取成功',$list,$count);
        }

        //获取品牌型号
        // $brand = Brand::where(['topid'=>0])->select();
        $brand = Brand::where('status', '1')->select();
        $refit = Refit::where('status', '1')->select();

        return $this->fetch('',[
            'brand' => $brand,
            'refit' => $refit,
        ]);
    }

    /**
     * 添加/编辑 案例
     */
    public function save(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $cases = new Cases;

            //服务前图片上传
            if(request()->file('old_img')){
                $file = imgUpdate('old_img');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['old_img'] = $file['data'];
            }
            //服务后图片上传
            if(request()->file('new_img')){
                $file = imgUpdate('new_img');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['new_img'] = $file['data'];
            }

            $post['update_time'] = time();
            if(empty($post['id'])){
                $post['add_time'] = time();
                $oper = $cases->allowField(true)->save($post);
            } else {
                $oper = $cases->allowField(true)->save($post,['id'=>$id]);
            }
            if($oper){
                return_ajax(200,'操作成功');
            } else {
                return_ajax(400,'操作失败，请稍后重试');
            }
        }

        $cases = Cases::get($id);
        $brand = Brand::select();
        $refit = Refit::select();
        return $this->fetch('',[
            'cases' => $cases,
            'brand' => $brand,
            'refit' => $refit,
        ]);
    }











    /**
     * 品牌型号
     */
    public function brand(){
        if(input('json') == 1){
            $where = [];
            $list = Brand::where($where)->order('sort desc')->select();
            return_ajax(200,'获取成功',$list);
        }
        return $this->fetch();
    }

    /**
     * 添加/编辑 品牌型号
     */
    public function brand_save(){   
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $brand = new Brand;

            //图片上传
            if(request()->file('pic')){
                $file = imgUpdate('pic');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['pic'] = $file['data'];
            }

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

        $data = Brand::get($id);
        return $this->fetch('',[
            'data' => $data
        ]);
    }


    /**
     * 删除 品牌型号
     */
    public function delete_brand(){
        $id = input('id');
        $check = Brand::where('topid', $id)->find();
        if ($check) {
            return_ajax(200, '有分类，不能删除');
        }

        $check_cases = Cases::where('brand_id', $id)->find();
        if ($check_cases) {
            return_ajax(200, '有案例，不能删除');
        }

        if(Brand::destroy($id)){
            Brand::destroy(['topid'=>$id]);
            return_ajax(200,'删除成功');
        } else {
            return_ajax(200,'删除失败,请稍后重试');
        }
    }

    /**
     * 改装类型列表
     */
    public function refit(){
        if(input('json') == 1){
            $where = [];
            $list = Refit::where($where)->order('sort desc')->select();
            return_ajax(200,'获取成功',$list);
        }
        return $this->fetch();
    }

    /**
     * 添加/编辑 改装类型
     */
    public function refit_save(){   
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $refit = new Refit;

            //图片上传
            if(request()->file('pic')){
                $file = imgUpdate('pic');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['pic'] = $file['data'];
            }

            $post['update_time'] = time();
            if(empty($post['id'])){
                $post['add_time'] = time();
                $oper = $refit->allowField(true)->save($post);
            } else {
                $oper = $refit->allowField(true)->save($post,['id'=>$id]);
            }
            if($oper){
                return_ajax(200,'操作成功');
            } else {
                return_ajax(400,'操作失败，请稍后重试');
            }
        }

        $data = Refit::get($id);
        return $this->fetch('',[
            'data' => $data
        ]);
    }


    /**
     * 删除 改装类型
     */
    public function delete_refit(){
        $id = input('id');
        // $check = Refit::where('topid', $id)->find();
        // if ($check) {
        //     return_ajax(200, '有子分类，不能删除');
        // }

        $check_cases = Cases::where('refit_id', $id)->find();
        if ($check_cases) {
            return_ajax(200, '有案例，不能删除');
        }

        if(Refit::destroy($id)){
            Refit::destroy(['topid'=>$id]);
            return_ajax(200,'删除成功');
        } else {
            return_ajax(200,'删除失败,请稍后重试');
        }
    }






}