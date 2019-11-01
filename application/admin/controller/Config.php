<?php
namespace app\admin\controller;
use app\common\model\Config as ConfigModel;
use app\common\model\Abouts;

Class Config extends Common{

	/**
	 * [index 基础配置]
	 * @Author   PengJun
	 * @DateTime 2019-02-28
	 * @return   [type]     [description]
	 */
	public function index()
	{
        if(request()->isPost()){
        	$post = input('post.');
        	$config = new ConfigModel;

        	if(request()->file('file')){
        		$file = imgUpdate('file');
        		if($file['code'] == 400){ return_ajax(400,$file['msg']); }
        		$post['logo'] = $file['data'];
        	}
          if(request()->file('files')){
            $file = imgUpdate('files');
            if($file['code'] == 400){ return_ajax(400,$file['msg']); }
            $post['back_img'] = $file['data'];
          }

          $post['red_start_time'] = strtotime($post['red_start_time']);
          $post['red_end_time']   = strtotime($post['red_end_time']);

        	$post['update_time'] = time();
        	if($config->allowField(true)->save($post,['id'=>1])){
        		return_ajax(200,'修改成功');
        	} else {
        		return_ajax(400,'修改失败！请稍后重试');
        	}
        }

        $config = ConfigModel::get(1);
        if ($config) {
          $config['red_start_time'] = date('Y-m-d H:i:s', $config['red_start_time']);
          $config['red_end_time'] = date('Y-m-d H:i:s', $config['red_end_time']);
        }

		return $this->fetch('',[
			'config' => $config,
		]);
	}


  public function about(){
    if(request()->isPost()){
      $post = input('post.');

      if(request()->file('video')){
        $file = imgUpdate('video');
        if($file['code'] == 400){ return_ajax(400,$file['msg']); }
        $post['video'] = $file['data'];
      }
      $post['update_time'] = time();
      $rs = Abouts::where('id', '1')->update($post);
      if($rs){
        return_ajax(200,'修改成功');
      } else {
        return_ajax(400,'修改失败！请稍后重试');
      }
    }

    $about = Abouts::where('id', '1')->find();

    return $this->fetch('',[
      'about' => $about,
    ]);
  }


}