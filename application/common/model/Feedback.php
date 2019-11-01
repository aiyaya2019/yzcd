<?php
namespace app\common\model;
use \think\Model;

use app\common\model\User;

Class Feedback extends Model{	
    protected $append = [];
	//时间自动写入
	protected $autoWriteTimestamp = true;
	//更改添加时间字段
	protected $createTime = 'add_time';

    /**
     * 用户信息
     */
    public function user(){
        return $this->hasOne('User', 'id', 'uid');
    }



}