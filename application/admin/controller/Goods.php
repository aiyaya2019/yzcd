<?php
namespace app\admin\controller;
use app\common\model\Goods as GoodsModel;
use app\common\model\GoodsAttr;
use app\common\model\GoodsSpec;
use app\common\model\GoodsVal;
use app\common\model\GoodsType;

Class Goods extends Common{

    /**
     * [index 商品列表]
     * @Author   PengJun
     * @DateTime 2019-01-24
     * @return   [type]     [description]
     */
    public function index()
    {   
        if(request()->isAjax()){
            $post = input('post.');
            $where = [];

            //商品名称搜索
            if(!empty($post['title'])){
                $where['title'] = ['like','%'.$post['title'].'%'];
            }

            //商品分类搜索
            if(!empty($post['type_id'])){
                $where['type_id'] = $post['type_id'];
            }

            $list = GoodsModel::where($where)->order('add_time desc')->page(input('page'),20)->select();
            $count = GoodsModel::where($where)->count();
            return_ajax(200,'获取成功',$list,$count);
        }

        //获取商品分类
        $type = GoodsType::where(['pid'=>0])->order('sort desc')->select();

        return $this->fetch('',[
            'type' => $type
        ]);
    }

    /**
     * [save 添加/编辑商品]
     * @Author   PengJun
     * @DateTime 2019-01-24
     * @return   [type]     [description]
     */
    public function save()
    {
        $id = input('id');

        if(request()->isPost()){
            $post = input('post.');
            $goods = new GoodsModel;

            //封面上传
            if(request()->file('pic')){
                $file = imgUpdate('pic');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['pic'] = $file['data'];
            }

            if(!empty($post['files'])){
                $post['images'] = implode(',',$post['files']);
            }

            $post['update_time'] = time();
            if(empty($post['id'])){
                //新增
                if($goods->allowField(true)->save($post)){
                    return_ajax(200,'添加成功',$goods->id);
                } else {
                    return_ajax(400,'添加失败,请稍后重试');
                }
            } else {
                //编辑
                if($goods->allowField(true)->save($post,['id'=>$post['id']])){
                    return_ajax(200,'编辑成功');
                } else {
                    return_ajax(400,'编辑失败,请稍后重试');
                }
            }
        }

        $goods = GoodsModel::get($id);
        //获取商品分类
        $type = GoodsType::where(['pid'=>0])->order('sort desc')->select();
        // p(toArray($type));
        return $this->fetch('',[
            'goods' => $goods,
            'type' => $type,
        ]);
    }

    /**
     * [attr_spec 设置商品规格]
     * @Author   PengJun
     * @DateTime 2019-03-19
     * @return   [type]     [description]
     */
    public function attr_spec()
    {
        $id = input('id');

        $goods = GoodsModel::get($id);

        if(request()->isPost()){
            $post = input('post.');

            // return_ajax(400,'配置失败，请重试',$post);
            //添加/修改商品规格属性
            $attr = $this->attr($post['attr'],$post['goods_id']);
            //添加/修改商品规格属性的值
            $spec = $this->spec($post['spec'],$post['goods_id']);

            if($attr && $spec){
                return_ajax(200,'配置成功');
            } else {
                return_ajax(400,'配置失败，请重试');
            }
        }


        //获取商品规格信息
        $attr = GoodsAttr::with('spec')->where('goods_id',$id)->field('id,title,ap_id')->select();
        //获取商品规格初始化显示信息
        $data = $this->data($id);
        //获取商品规格初始化值
        $item = $this->item($id);
        // p($data['info']);
        return $this->fetch('',[
            'goods'      => $goods,
            'item'       => $item,
            'data'       => $data['info']?$data['info']:json_encode([]),
            'default'    => $data['default']?$data['default']:'',
            'goods_spec' => $attr,
        ]);
    }

    /**
     * [attr 添加商品规格信息]
     * @Author   PengJun
     * @DateTime 2019-03-19
     * @return   [type]     [description]
     */
    public function attr($attr,$goods_id)
    {
        foreach($attr as $vo){
            //添加属性
            $attr = new GoodsAttr;
            //查询属性是否已经存在 存在就更新否则就添加
            $is_attr = GoodsAttr::get(['goods_id'=>$goods_id,'ap_id'=>$vo['id']]);
            if($is_attr){
                //更新
                $is_attr->title = $vo['name'];
                $is_attr->update_time = time();
                $is_attr->save();
                $attr_id = $is_attr['id'];
                $aid[] = $is_attr['id'];
            } else {
                //添加
                $attr_array = [
                    'title'       => $vo['name'],
                    'goods_id'    => $goods_id,
                    'ap_id'       => $vo['id'],
                    'add_time'    => time(),
                    'update_time' => time(),
                ];
                $attr->save($attr_array);
                $attr_id = $attr->id;
            }
            //添加规格信息
            foreach($vo['sub'] as $val){
                //查询规格信息是否已经存在
                $is_spec = GoodsSpec::get(['goods_id'=>$goods_id,'ap_id'=>$val['id']]);
                if($is_spec){
                    $info[] = [
                        'id'            => $is_spec['id'],
                        'title'         => $val['name'],
                        'update_time'   => time()
                    ];
                    $pid[] = $is_spec['id'];
                } else {
                    $info[] = [
                        'title'         => $val['name'],
                        'goods_id'      => $goods_id,
                        'goods_attr_id' => $attr_id,
                        'ap_id'         => $val['id'],
                        'add_time'      => time(),
                        'update_time'   => time()
                    ];
                }
            }
        }
        //删除数据
        if(!empty($aid)){
            GoodsAttr::destroy(['id'=>['not in',$aid],'goods_id'=>$goods_id]);
        }
        if(!empty($pid)){
            GoodsSpec::destroy(['id'=>['not in',$pid],'goods_id'=>$goods_id]);
        }
        
        $GoodsSpec = new GoodsSpec;
        if($GoodsSpec->saveAll($info)){
            return $info;
        } else {
            return false;
        }
    }

    /**
     * [spec 添加规格属性的值]
     * @Author   PengJun
     * @DateTime 2019-03-19
     * @param    [type]     $spec     [description]
     * @param    integer    $goods_id [description]
     * @return   [type]               [description]
     */
    public function spec($spec,$goods_id)
    {
        foreach($spec as $key=>$vo){
            $str = '';
            foreach($vo['ids'] as $k=>$v){
                foreach($v as $kk=>$i){
                    $attr_id = GoodsAttr::where(['ap_id'=>$kk,'goods_id'=>$goods_id])->value('id');
                    $spec_id = GoodsSpec::where(['ap_id'=>$i,'goods_id'=>$goods_id])->value('id');
                    $str .= $attr_id.':'.$spec_id;
                    if($kk != count($vo['ids'])){
                        $str .= ',';
                    }
                }
            }
            //查询属性值是否已经存在
            $isset = GoodsVal::get(['goods_id'=>$goods_id,'attr_spec'=>$str]);
            if($isset){
                $info[$key] = $vo;
                $info[$key]['id'] = $isset['id'];
                $info[$key]['update_time'] = time();
                $id[] = $isset['id'];
            } else {
                $info[$key] = $vo;
                $info[$key]['attr_spec'] = $str;
                $info[$key]['goods_id'] = $goods_id;
                $info[$key]['add_time'] = time();
                $info[$key]['update_time'] = time();
            }
        }

        //删除数据
        if(!empty($id)){
            GoodsVal::destroy(['id'=>['not in',$id],'goods_id'=>$goods_id]);
        }
        $goods_val = new GoodsVal;
        if($goods_val->allowField(true)->saveAll($info)){
            return true;
        } else {
            return false;
        }
    }


    /**
     * [item 商品规格初始化信息]
     * @Author   PengJun
     * @DateTime 2018-08-10
     * @return   [type]     [description]
     */
    public function item($id)
    {   
        //[{"id":1,"name":"颜色","sub":[{"id":1,"name":"黑"},{"id":2,"name":"白"},{"id":3,"name":"蓝"}]},{"id":2,"name":"尺寸","sub":[{"id":1,"name":"S"},{"id":2,"name":"M"},{"id":3,"name":"L"}]},{"id":3,"name":"测试","sub":[{"id":1,"name":"测试"}]}]
        $attr = GoodsAttr::with('spec')->where('goods_id',$id)->field('id,title,ap_id')->select();
        $info = [];
        foreach($attr as $vo){
            $sub = [];
            foreach($vo['spec'] as $val){
                $sub[] = ['id'=>$val['ap_id'],'name'=>$val['title']];
            }
            $info[] = [
                'id'   => $vo['ap_id'],
                'name' => $vo['title'],
                'sub'  => $sub
            ];
        }
        return json_encode($info);
    }

     /**
     * [data 商品规格初始化显示信息/以及默认选中值]
     * @Author   PengJun
     * @DateTime 2018-08-10
     * @return   [type]     [description]
     */
    public function data($id)
    {
        //[{"ids":[{"1":"1"},{"2":"4"}],"price":100,"stock":100,"sku":100,"vip":100,"cost":100,"purc":100},{"ids":[{"1":"2"},{"2":"5"}],"price":200,"stock":200,"sku":200,"vip":200,"cost":200,"purc":200}]
        $goods_val = GoodsVal::where('goods_id',$id)->select();
        if($goods_val){
            foreach($goods_val as $vo){
                $a = [];
                $attr_spec = explode(',',$vo['attr_spec']);
                foreach($attr_spec as $val){
                    $arr = explode(':',$val);
                    $key = GoodsAttr::where('id',$arr[0])->value('ap_id');
                    $value = GoodsSpec::where('id',$arr[1])->value('ap_id');
                    $a[] = [$key=>$value];
                    $default[] = $value;
                }
                $info[] = ['ids'=>$a,'price'=>$vo['price'],'old_price'=>$vo['old_price'],'stock'=>$vo['stock']];
            }

            $list['default'] = array_unique($default);
            $list['info'] = json_encode($info);
            return $list;
        }
    }

    /**
     * [type 商品分类]
     * @Author   PengJun
     * @DateTime 2019-03-20
     * @return   [type]     [description]
     */
    public function type()
    {
        if(input('json') == 1){

            $where = [];
            $list = GoodsType::where($where)->order('sort desc')->select();

            return_ajax(200,'获取成功',$list);
        }

        return $this->fetch();
    }

    public function type_save()
    {   
        $id = input('id');

        if(request()->isPost()){
            $post = input('post.');
            $type = new GoodsType;

            //图片上传
            if(request()->file('pic')){
                $file = imgUpdate('pic');
                if($file['code'] == 400){ return_ajax(400,$file['msg']); }
                $post['pic'] = $file['data'];
            }

            $post['update_time'] = time();
            if(empty($post['id'])){
                $post['add_time'] = time();
                $oper = $type->allowField(true)->save($post);
            } else {
                $oper = $type->allowField(true)->save($post,['id'=>$id]);
            }


            if($oper)
            {
                return_ajax(200,'操作成功');
            } else {
                return_ajax(400,'操作失败，请稍后重试');
            }
        }

        $type = GoodsType::get($id);

        return $this->fetch('',[
            'type' => $type
        ]);
    }
}