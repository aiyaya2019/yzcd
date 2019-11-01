<?php
namespace app\admin\controller;
use app\common\model\Shop as ShopModel;
use app\common\model\ReserveGoods;
use app\common\model\Label;
use app\common\model\SerialNum;
use app\common\model\Attr;
use app\common\model\Order;
use app\common\model\OrderList;
use app\common\model\ShopGoods;
use app\common\model\ShopGoodsAttr;
use app\common\model\ShopSerialNum;
use app\common\model\Logistics;


/**
 * 商家商城
 */
Class Rgoods extends Common{

	/**
	 * 商品列表
	 */
	public function index(){
        if(request()->isAjax()){
            $post  = input('post.');
            if(!empty($post['name'])){
                $post['where']['title'] = ['like', '%'.$post['name'].'%'];
            }

            $list = $this->selectAll('reserve_goods', $post);
            return_ajax(200,'获取成功', $list['list'], $list['count']);
        }
		return $this->fetch();
	}

    /**
     * 商品添加/修改
     */
	public function save(){
		$id = input('id');
		if(request()->isPost()){
            $post = input('post.');
            $rgoods = new ReserveGoods;

            if(request()->file('img')){
                $file = imgUpdate('img');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['img'] = $file['data'];
            }
            if(request()->file('video')){
                $file = imgUpdate('video');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['video'] = $file['data'];
            }
            
            $post['update_time'] = time();
            if(empty($post['id'])){
                //新增
                // if(empty(request()->file('img'))){ return_ajax(400,'请上传封面图'); }
                // if(empty(request()->file('video'))){ return_ajax(400,'请上传视频'); }

                if($rgoods->allowField(true)->save($post)){
                    return_ajax(200,'添加成功');
                } else {
                    return_ajax(400,'添加失败,请稍后重试');
                }
            } else {
                //编辑
                if($rgoods->allowField(true)->save($post,['id'=>$post['id']])){
                    return_ajax(200,'编辑成功');
                } else {
                    return_ajax(400,'编辑失败,请稍后重试');
                }
            }
        }

		$list  = ReserveGoods::get($id);
		$label = Label::where('status', '1')->order('id desc')->select();

		return $this->fetch('',[
			'list'  => $list,
			'label' => $label,
		]);
	}

	/**
	 * 更改状态
	 */
	public function changeStatus(){
        if(request()->isPost()){
            $post  = input('post.');
            $rgoods = new ReserveGoods;

            if($rgoods->allowField(true)->save($post,['id'=>$post['id']])){
                return_ajax(200);
            } else {
                return_ajax(400,'操作失败');
            }
        }
	}

    /**
     * 商品标签列表
     */
    public function label(){
        if(input('json') == 1){
            $where = [];
            $list = Label::order('id desc')->select();
            return_ajax(200, '获取成功', $list);
        }
        return $this->fetch();
    }

    /**
     * 添加/编辑 商品标签
     */
    public function label_save(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $label = new label;

            $post['update_time'] = time();
            if(empty($post['id'])){
                $post['add_time'] = time();
                $oper = $label->allowField(true)->save($post);
            } else {
                $oper = $label->allowField(true)->save($post,['id'=>$id]);
            }
            if($oper){
                return_ajax(200,'操作成功');
            } else {
                return_ajax(400,'操作失败，请稍后重试');
            }
        }

        $data = Label::get($id);
        return $this->fetch('',[
            'data' => $data
        ]);
    }


    /**
     * 删除 商品标签
     */
    public function delete_label(){
    	$id = input('id');
        $check_goods = ReserveGoods::where('label_id', $id)->find();
        if ($check_goods) {
            return_ajax(200, '有商品，不能删除');
        }

        if(Label::destroy($id)){
            Label::destroy(['topid'=>$id]);
            return_ajax(200,'删除成功');
        } else {
            return_ajax(200,'删除失败,请稍后重试');
        }
    }


    /**
     * 商品规格列表
     */
    public function attr(){
        $goods_id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $post['where']['goods_id'] = $goods_id;
            $list = $this->selectAll('attr', $post);
            return_ajax(200, '获取成功', $list['list'], $list['count']);
        }
        return $this->fetch('');
    }

    /**
     * 添加/编辑 商品规格
     */
    public function attr_save(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $attr = new Attr;

            $post['update_time'] = time();
            if(empty($post['id'])){
                $post['add_time'] = time();
                $oper = $attr->allowField(true)->save($post);
            } else {
                $oper = $attr->allowField(true)->save($post,['id'=>$id]);
            }
            if($oper){
                return_ajax(200,'操作成功');
            } else {
                return_ajax(400,'操作失败，请稍后重试');
            }
        }

        $data = Attr::get($id);
        return $this->fetch('',[
            'data' => $data
        ]);
    }

    /**
     * 删除 商品规格
     */
    // public function delete_attr(){
    //     $id = input('id');
    //     $check_goods = ReserveGoods::where('label_id', $id)->find();
    //     if ($check_goods) {
    //         return_ajax(200, '有商品，不能删除');
    //     }

    //     if(Attr::destroy($id)){
    //         Attr::destroy(['topid'=>$id]);
    //         return_ajax(200,'删除成功');
    //     } else {
    //         return_ajax(200,'删除失败,请稍后重试');
    //     }
    // }

    /**
     * 修改状态 商品规格
     */
    public function attrEdit(){
        if(request()->isPost()){
            $post  = input('post.');
            $attr = new Attr;

            if($attr->allowField(true)->save($post,['id'=>$post['id']])){
                return_ajax(200);
            } else {
                return_ajax(400,'操作失败');
            }
        }
    }



    /**
     * 商品序列号
     */
    public function number(){
        if(request()->isAjax()){
            $post  = input('post.');
            if(!empty($post['name'])){
                $post['where']['number'] = $post['name'];
            }
            $post['where']['attr_id'] = $post['id'];

            $list = $this->selectAll('serial_num', $post);
            return_ajax(200,'获取成功', $list['list'], $list['count']);
        }
        return $this->fetch();
    }

    /**
     * 编辑 商品序列号
     */
    public function number_save(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');
            $check = SerialNum::where('number', $post['number'])->find();
            if ($check) {
                return_ajax(400,'操作失败，该序列号已存在');
            }
            $id = $post['id'];
            unset($post['id']);
            $post['update_time'] = time();

            $rs = SerialNum::where('id', $id)->update($post);
            if($rs){
                return_ajax(200,'操作成功');
            } else {
                return_ajax(400,'操作失败，请稍后重试');
            }
        }

        $data = SerialNum::get($id);
        return $this->fetch('',[
            'data' => $data
        ]);
    }


    /**
     * 未售商品导入序列号
     */
    public function explode(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');

            if(request()->file('file')){
                $file = imgUpdate('file');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['file'] = $file['data'];
            }
            $data = insert_excel($_SERVER['DOCUMENT_ROOT'] .$post['file']);
            if (empty($data)) {
                return_ajax(400,'操作失败，导入数据为空');
            }
            $data = $this->arrToOne($data);
            if (count($data) != count(array_unique($data))) {
                return_ajax(400,'操作失败，序列号不能重复！！！');
            }
            $chunk_arr = array_chunk($data, '1000');
            foreach ($chunk_arr as $key => $value) {
                $where['number'] = ['in', $value];
                $check_unique[]  = SerialNum::where($where)->select();
            }
            $check_unique = $this->arrToOne($check_unique);
            if (!empty($check_unique)) {
                $str = '已存在重复的序列号：';
                foreach ($check_unique as $key => $value) {
                    $str = $str .$value['number'] .'、';
                }
                return_ajax(400,'操作失败，请检查是否有已存在的序列号');
            }
            foreach ($data as $key => $value) {
                $array[$key]['attr_id']  = $post['id'];
                $array[$key]['number']   = $value;
                $array[$key]['add_time'] = time();
                $array[$key]['update_time'] = time();
            }

            $rs = SerialNum::insertAll($array);

            if($rs){
                return_ajax(200,'导入成功');
            } else {
                return_ajax(400,'导入失败，请稍后重试');
            }
        }
        return $this->fetch();
    }

    /**
     * 订单列表
     */
    public function order(){
        if(request()->isAjax()){
            $post  = input('post.');
            if(!empty($post['keywords'])){
                $post['where']['order_sn|phone'] = ['like', '%'.$post['keywords'].'%'];
            }
            // 订单状态筛选
            if(!empty($post['status'])){
                $post['where']['status'] = $post['status'];
            }
            $post['with'] = 'goods';

            $list = $this->selectAll('order', $post);
            return_ajax(200, '获取成功', $list['list'], $list['count']);
        }
        return $this->fetch();
    }

    /**
     * 订单详情
     * @author vevay
     * @time: 2019/7/5 10:12
     */
    public function info(){
        $id = input('id');
        $data = Order::with('goods')->where('id',$id)->find();
        return $this->fetch('',['data'=>$data]);
    }


    /**
     * 已售商品导入序列号
     */
    public function explodeNum(){
        $id = input('id');
        if(request()->isPost()){
            $post = input('post.');

            if(request()->file('file')){
                $file = imgUpdate('file');
                if($file['code'] == 400){ return_ajax(400, $file['msg']); }
                $post['file'] = $file['data'];
            }
            $data = insert_excel($_SERVER['DOCUMENT_ROOT'] .$post['file']);
            if (empty($data)) {
                return_ajax(400, '操作失败，导入数据为空');
            }
            $data = $this->arrToOne($data);
            if (count($data) != count(array_unique($data))) {
                return_ajax(400, '操作失败，序列号不能重复！！！');
            }

            $order_goods = OrderList::where('id', $post['id'])->find();
            if (empty($order_goods)) {
                return_ajax(400, '操作失败！！！');
            }
            // print_r($order_goods);exit;

            $w_goods['goods_id'] = $order_goods['goods_id'];
            $w_goods['order_sn'] = $order_goods['order_sn'];
            $check_goods = ShopGoods::where($w_goods)->find();
            if (empty($check_goods)) {
                return_ajax(400, '操作失败，门店没有该商品！！！');
            }

            $w_attr['attr_id']  = $order_goods['goods_attr_id'];
            $w_attr['order_sn'] = $order_goods['order_sn'];
            $check_attr = ShopGoodsAttr::where($w_attr)->find();
            if (empty($check_attr)) {
                return_ajax(400, '操作失败，门店没有该商品规格！！！');
            }

            $chunk_arr = array_chunk($data, '1000');
            foreach ($chunk_arr as $key => $value) {
                $where['number'] = ['in', $value];
                $check_unique[]  = ShopSerialNum::where($where)->select();
            }
            $check_unique = $this->arrToOne($check_unique);
            if (!empty($check_unique)) {
                $str = '已存在重复的序列号：';
                foreach ($check_unique as $key => $value) {
                    $str = $str .$value['number'] .'、';
                }
                return_ajax(400,'操作失败，请检查是否有已存在的序列号');
            }

            $serial_num = SerialNum::field('number')->where('number', 'in', $data)->select();
            $serial_num = array_column($serial_num, 'number', 'number');
            foreach ($data as $key => $value) {
                if (!in_array($value, $serial_num)) {
                    return_ajax(400,'操作失败，序列号不存在');
                }
            }

            foreach ($data as $key => $value) {
                $array[$key]['order_sn']     = $order_goods['order_sn'];
                $array[$key]['shop_id']      = $order_goods['shop_id'];
                $array[$key]['shop_attr_id'] = $check_attr['id'];
                $array[$key]['number']       = $value;
                $array[$key]['add_time']     = time();
                $array[$key]['update_time']  = time();
            }

            $rs = ShopSerialNum::insertAll($array);

            if($rs){
                return_ajax(200,'导入成功');
            } else {
                return_ajax(400,'导入失败，请稍后重试');
            }
        }
        return $this->fetch();
    }



    /**
     * 导出订单
     */
    public function order_excel(){
        ini_set('memory_limit','3072M');
        set_time_limit(0);

        $post = input('post.');
        $where = '';

        if (!empty($post['start_time']) && !empty($post['end_time'])){
            $start_time = strtotime($post['start_time']);
            $end_time = strtotime($post['end_time']);
            $where = 'add_time >= '.$start_time.' and add_time <= '.$end_time.'';
        }

        $order = Order::order('id desc')->where($where)->select();

        $head = ['编号','订单编号','联系人','手机号','购买总数','应付','实付','订单状态','下单时间', '地址'];
        $data = [];
        foreach($order as $key=>$vo){
            $data[] = [
                $vo['id'],
                "\t" .$vo['order_sn'],
                $vo['name'],
                $vo['phone'],
                $vo['buy_num'],
                $vo['all_money'],
                $vo['pay_money'],
                $vo['status_name'],
                $vo['add_time'],
                $vo['address'],
            ];
        }

        excelExport('订单信息',$head,$data);

    }

    /**
     * 发货
     */
    public function delivery(){
        if($this->request->isPost()){
            $post = $this->request->post();
            $id   = $post['id'];
            unset($post['id']);
            // 查询物流信息
            $logistics = Logistics::get($post['logistics_id']);
            // 更新订单信息
            $post['logistics_state'] = 1;
            $post['logistics_name']  = $logistics['name'];
            $post['logistics_code']  = $logistics['code'];
            $post['logistics_time']  = time();
            $post['update_time']     = time();
            $post['status']          = 3;
            $rs = Order::where('id', $id)->update($post);
            if ($rs) {
                return_ajax(200, '发货成功');
            }else{
                return_ajax(400, '发货失败，请稍后重试');
            }

            // if ($rs) {
            //     $order = Order::where('id', $post['id'])->find();
            //     $rs_send = controller('Weix')->send($order['order_no'], '1', '2');
            // }
        }
        $logistics = Logistics::where(['is_deleted'=>0,'status'=>1])->select();
        return $this->fetch('',['logistics'=>$logistics]);
    }



}