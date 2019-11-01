<?php
namespace app\common\model;
use \think\Model;
use app\common\model\Label;
use app\common\model\ShopGoodsAttr;

Class ShopGoods extends Model{	
    protected $append = ['label_name'];
	//时间自动写入
	protected $autoWriteTimestamp = true;
	//更改添加时间字段
	protected $createTime = 'add_time';

	public function cate(){
		return $this->hasOne('PointGoodsCate','cate_id', 'id');
	}

	//商品标签
	public function label(){
		return $this->hasMany('Label', 'label_id', 'id');
	}

	//商品标签
	public function getLabelNameAttr($val, $data){
		$label = Label::field('id, name')->where('id', $data['label_id'])->select();
		return $label;
	}

    /**
     * 店铺
     */
    public function shop(){
        return $this->hasOne('Shop', 'id', 'shop_id');
    }


	public function attr(){
		return $this->hasOne('ShopGoodsAttr','shop_goods_id', 'id');
	}


}