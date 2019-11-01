<?php
namespace app\common\model;
use \think\Model;

use \app\common\model\PointGoodsCate;
use \app\common\model\PointGoodsBrand;
use \app\common\model\PointGoodsAttr;

Class PointGoods extends Model{	
    protected $append = ['cate_name', 'brand_name'];
	//时间自动写入
	protected $autoWriteTimestamp = true;
	//更改添加时间字段
	protected $createTime = 'add_time';



	// public function cate(){
	// 	return $this->hasOne('PointGoodsCate','id','cate_id')->field('id,title');
	// }

	//商品分类
	public function getCateNameAttr($val, $data){
		if(!empty($data['cate_id'])){
			$cate = PointGoodsCate::get($data['cate_id']);

			return $cate['title'];
		}	
	}

	//商品品牌
	public function getBrandNameAttr($val, $data){
		if(!empty($data['brand_id'])){
			$brand = PointGoodsBrand::get($data['brand_id']);
			return $brand['title'];
		}	
	}

	/**
	 * 相册
	 */
	public function getImages($val){
		return empty($val) ? '' : explode(',', $val);
	}






}