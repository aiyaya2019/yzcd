<?php
namespace app\common\model;
use \think\Model;

use app\common\model\Shop;
use app\common\model\User;
use app\common\model\PointChange;

Class Reserve extends Model{	
    protected $append = ['status_name', 'point'];
	//时间自动写入
	protected $autoWriteTimestamp = true;
	//更改添加时间字段
	protected $createTime = 'add_time';

    public function getReserveTimeAttr($val){
        return date('Y-m-d', $val);
    }
    // public function getEndTimeAttr($val){
    //     return date('Y-m-d', $val);
    // }
    // public function getPayTimeAttr($val){
    //     return date('Y-m-d', $val);
    // }
    
    // 订单状态
    public function getStatusNameAttr($val, $data){
        // 状态：1待支付；2未服务(已支付定金)；3已服务(已支付总金)；4取消中(申请退款)；5已取消(已退款)；6申请失败(退款失败)
        switch ($data['status']) {
            case 1:
                return '待支付';
                break;
            case 2:
                return '未服务';
                break;
            case 3:
                return '已服务';
                break;
            case 4:
                return '申请退款';
                break;
            case 5:
                return '已退款';
                break;
            case 6:
                return '申请失败';
                break;
        }
    }

    /**
     * 店铺
     */
    public function shop(){
        return $this->hasOne('Shop', 'id', 'shop_id');
    }

    /**
     * 用户信息
     */
    public function user(){
        return $this->hasOne('User', 'id', 'uid');
    }

    /**
     * 积分
     */
    public function getPointAttr($val, $data){
        $point = PointChange::where('order_sn', $data['order_sn'])->value('point');
        $point = $point ? $point : '0';
        return $point;
    }




}