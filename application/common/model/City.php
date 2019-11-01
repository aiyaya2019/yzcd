<?php
namespace app\common\model;
use \think\Model;
use app\common\model\CityCate;

Class City extends Model{	
    protected $append = ['cate_name'];
	//时间自动写入
	protected $autoWriteTimestamp = true;
	//更改添加时间字段
	protected $createTime = 'add_time';

	public function getCateNameAttr($val, $data){
		if(!empty($data['cate_id'])){
			
			$cate = CityCate::get($data['cate_id']);

			return $cate['name'];
		}	
	}
}