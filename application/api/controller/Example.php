<?php
namespace app\api\controller;
use app\common\model\Cases;
use app\common\model\Brand;
use app\common\model\Refit;

/**
 * 案例控制器
 */
Class Example extends Common{

    /**
     * 弹出
     */
    public function getNewCases(){
        if(request()->isPost()){
            $data = Cases::where('status', '1')->order('id desc')->limit('1')->find();
            if ($data) {
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无数据');
            }
        }
    }

    /**
     * 案例列表
     */
    public function getCases(){
        $post = input('post.');

        if ($post['brand_id']) {
            $where['brand_id'] = $post['brand_id'];
        }
        if ($post['refit_id']) {
            $where['refit_id'] = $post['refit_id'];
        }

        $where['status'] = '1';
        $data = Cases::where($where)->order('id desc')->select();
        if ($data) {
            return_ajax(200, '获取成功', $data);
        }else{
            return_ajax(400, '暂无数据');
        }
    }

    /**
     * 案例详情
     */
    public function getCaseDetails(){
        $post = input('post.');
        if (!$post['id']) {
            return_ajax(200, '缺少案例id');
        }
        $data = Cases::where('id', $post['id'])->find();
        if ($data) {
            $data['content'] = preg_replace('/style=""/','',$data['content']);
            $data['content'] = preg_replace('/src="(.*?)"/','src="'.$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER['SERVER_NAME'].'$1" style="width:100%;"',$data['content']);
            $data['brand_name'] = Brand::where('id', $data['brand_id'])->value('name');
            return_ajax(200, '获取成功', $data);
        }else{
            return_ajax(400, '暂无数据');
        }

    }


    /**
     * 品牌型号
     */
    public function getBrand(){
        $where['status'] = '1';
        $where['topid']  = '0';
        $data = Brand::where($where)->order('sort desc')->select();
        if ($data) {
            return_ajax(200, '获取成功', $data);
        }else{
            return_ajax(400, '暂无数据');
        }
    }

    public function getBrandChild(){
        if(request()->isPost()){
            $post = input('post.');

            if(empty($post['id'])){ return_ajax(400,'缺少id'); }

            $data = Brand::where('topid', $post['id'])->order('sort desc')->select();
            if ($data) {
                return_ajax(200, '获取成功', $data);
            }else{
                return_ajax(400, '暂无数据');
            }
        }
    }

    /**
     * 改装类型列表
     */
    public function getRefit(){
        $data = Refit::where('status', '1')->order('sort desc')->select();
        if ($data) {
            return_ajax(200, '获取成功', $data);
        }else{
            return_ajax(400, '暂无数据');
        }
    }





}