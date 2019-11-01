<?php
namespace app\common\model;
use \think\Model;

Class PointOrder extends Model{	
    protected $append = ['status_name'];
	//时间自动写入
	protected $autoWriteTimestamp = true;
	//更改添加时间字段
	protected $createTime = 'add_time';


    // 订单状态
    public function getStatusNameAttr($val, $data){
        // 状态：状态：1待兑换；2未发货；3已发货；4已完成
        switch ($data['status']) {
            case 1:
                return '待兑换';
                break;
            case 2:
                return '未发货';
                break;
            case 3:
                return '已发货';
                break;
            case 4:
                return '已完成';
                break;
        }
    }

    /**
     * 订单商品
     */
    public function PointOrderList(){
        return $this->hasMany('PointOrderList','order_sn', 'order_sn');
    }



}