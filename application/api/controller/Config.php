<?php
namespace app\api\controller;
use app\api\model\Config as ConfigModel;
use app\api\model\Banner;

class Config extends Common
{	
	/**
	 * [index 获取配置信息]
	 * @Author   PengJun
	 * @DateTime 2019-03-30
	 * @return   [type]     [description]
	 */
	public function index()
	{
		$config = ConfigModel::field('title,logo,work_time,cust_tel,desc,long,lat')->find();

		return_ajax(200,'获取成功',$config);
	}

	/**
	 * [banner 广告图]
	 * @Author   PengJun
	 * @DateTime 2019-03-30
	 * @return   [type]     [description]
	 */
	public function banner()
	{	
		$type = input('type');

		$list = Banner::where('type',$type)->order('sort desc')->field('id,title,pic')->select();

		return_ajax(200,'获取成功',$list);
	}
}
