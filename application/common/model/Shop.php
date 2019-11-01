<?php
namespace app\common\model;
use \think\Model;

Class Shop extends Model{	
    protected $append = ['type_name'];
	//时间自动写入
	protected $autoWriteTimestamp = true;
	//更改添加时间字段
	protected $createTime = 'add_time';

	// 合作类型：1城市合伙人；2门店合伙人
	public function getTypeNameAttr($val,$data){
		if(!empty($data['type'])){
			switch ($data['type']) {
				case '1':
					$type_name = '城市合伙人';
					break;
				
				default:
					$type_name = '门店合伙人';
					break;
			}
			return $type_name;
		}	
	}

	
}