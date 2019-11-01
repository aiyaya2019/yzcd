<?php
namespace app\common\model;
use \think\Model;

Class MoneyChange extends Model{	
    protected $append = ['type_name'];
	//时间自动写入
	protected $autoWriteTimestamp = true;
	//更改添加时间字段
	protected $createTime = 'add_time';


    public function getTypeNameAttr($val, $data){
        switch ($data['type']) {
            case 1:
                return '申请中';
                break;
            case 5:
                return '提现成功';
                break;
            case 6:
                return '提现失败';
                break;
        }
    }
}