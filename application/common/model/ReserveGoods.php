<?php
namespace app\common\model;
use \think\Model;

Class ReserveGoods extends Model{	
    protected $append = [];
	//时间自动写入
	protected $autoWriteTimestamp = true;
	//更改添加时间字段
	protected $createTime = 'add_time';


   public function label(){
       return $this->hasOne('Label','id','label_id')->field('id,name');
   }


}