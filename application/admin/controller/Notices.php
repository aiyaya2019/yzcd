<?php
namespace app\admin\controller;

use app\common\model\Notice;

Class Notices extends Common{

    /**
     * 通知列表
     */
    public function index(){
        if(request()->isPost()){
            $post = input('post.');
            $post['where']['type'] = '1';
            $list = $this->selectAll('notice', $post);

            return_ajax(200,'获取成功', $list['list'], $list['count']);
        }

        return $this->fetch();
    }

    /**
     * 添加/编辑通知
     */
    public function save(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $post['type'] = '1';
            $notice = new Notice;

            $post['update_time'] = time();
            if(empty($post['id'])){

                if($notice->allowField(true)->save($post)){
                    return_ajax(200,'添加成功');
                } else {
                    return_ajax(400,'添加失败,请稍后重试');
                }
            } else {
                //编辑
                if($notice->allowField(true)->save($post,['id'=>$post['id']])){
                    return_ajax(200,'编辑成功');
                } else {
                    return_ajax(400,'编辑失败,请稍后重试');
                }
            }
        }

        $list = Notice::get($id);

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
            $notice = new Notice;

            if($notice->allowField(true)->save($post, ['id'=>$post['id']])){
                return_ajax(200);
            } else {
                return_ajax(400,'操作失败');
            }
        }
    }



}