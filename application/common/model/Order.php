<?php
namespace app\common\model;
use \think\Model;

Class Order extends Model{	
    protected $append = ['status_name'];
	//时间自动写入
	protected $autoWriteTimestamp = true;
	//更改添加时间字段
	protected $createTime = 'add_time';



    // 订单状态
    public function getStatusNameAttr($val, $data){
        // 状态：1待付款；2未发货；3已发货；4已完成
        switch ($data['status']) {
            case 1:
                return '待付款';
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
     * @author vevay
     * @time: 2019/7/5 18:26
     */
    public function goods(){
        return $this->hasMany('OrderList','order_sn','order_sn');
    }



}