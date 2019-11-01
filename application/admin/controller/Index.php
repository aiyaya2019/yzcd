<?php
namespace app\admin\controller;
use app\common\model\Order;
use app\common\model\User;
use app\common\model\Shop;
use app\common\model\Reserve;

Class Index extends Common{

	public function index(){

		return $this->fetch();
	}

	public function console(){
        // 当天开始结束时间戳
        $day_start = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $day_end   = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;

        // 本周开始结束时间戳
        $week_start = mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
        $week_end = mktime(23,59,59,date('m'),date('d')-date('w')+7,date('Y'));

        // 本月开始结束时间戳
        $month_start = mktime(0,0,0,date('m'),1,date('Y'));
        $month_end   = mktime(23,59,59,date('m'),date('t'),date('Y'));

		//php获取今年起始时间戳和结束时间戳
		$year_start = strtotime(date("Y",time())."-1"."-1");
		$year_end   = strtotime(date("Y",time())."-12"."-31");

		// 订单统计
		// status 状态：1待付款；2未发货；3已发货；4已完成
		
		// 月订单总量
		$month_ordernum = Order::where('status', 'in', ['3', '4'])->whereTime('add_time', 'between', [$month_start, $month_end])->count('id');

		// 月订单总销售额
		$month_money = Order::where('status', 'in', ['3', '4'])->whereTime('add_time', 'between', [$month_start, $month_end])->sum('pay_money');

		// 年订单总量
		$year_ordernum = Order::where('status', 'in', ['3', '4'])->whereTime('add_time', 'between', [$year_start, $year_end])->count('id');

		// 年订单总销售额
		$year_money = Order::where('status', 'in', ['3', '4'])->whereTime('add_time', 'between', [$year_start, $year_end])->sum('pay_money');

		$order = [
			'month_ordernum' => $month_ordernum ? $month_ordernum : '0',
			'month_money'    => $month_money ? $month_money : '0',
			'year_ordernum'  => $year_ordernum ? $year_ordernum : '0',
			'year_money'     => $year_money ? $year_money : '0',
		];

		// 会员统计
		// 日增长用户
		$day_user = User::whereTime('add_time', 'between', [$day_start, $day_end])->count('id');
		// 周增长用户
		$week_user = User::whereTime('add_time', 'between', [$week_start, $week_end])->count('id');
		// 月增长用户
		$month_user = User::whereTime('add_time', 'between', [$month_start, $month_end])->count('id');
		// 年增长用户
		$year_user = User::whereTime('add_time', 'between', [$year_start, $year_end])->count('id');
		// 总用户数
		$all_user  = User::count('id');

		$user = [
			'day_user'   => $day_user ? $day_user : '0',
			'week_user'  => $week_user ? $week_user : '0',
			'month_user' => $month_user ? $month_user : '0',
			'year_user'  => $year_user ? $year_user : '0',
			'all_user'   => $all_user ? $all_user : '0',
		];

		// 商家统计
		// 日增长商家
		$day_shop = Shop::whereTime('add_time', 'between', [$day_start, $day_end])->count('id');
		// 周增长商家
		$week_shop = Shop::whereTime('add_time', 'between', [$week_start, $week_end])->count('id');
		// 月增长商家
		$month_shop = Shop::whereTime('add_time', 'between', [$month_start, $month_end])->count('id');
		// 年增长商家
		$year_shop = Shop::whereTime('add_time', 'between', [$year_start, $year_end])->count('id');
		// 总商家数量
		$all_shop = Shop::count('id');

		$shop = [
			'day_shop'   => $day_shop ? $day_shop : '0',
			'week_shop'  => $week_shop ? $week_shop : '0',
			'month_shop' => $month_shop ? $month_shop : '0',
			'year_shop'  => $year_shop ? $year_shop : '0',
			'all_shop'   => $all_shop ? $all_shop : '0',
		];

		// 预约统计
		// 日预约总量
		$day_reserve = Reserve::whereTime('add_time', 'between', [$day_start, $day_end])->count('id');
		// 周预约总量
		$week_reserve = Reserve::whereTime('add_time', 'between', [$week_start, $week_end])->count('id');
		// 月预约总量
		$month_reserve = Reserve::whereTime('add_time', 'between', [$month_start, $month_end])->count('id');
		// 年预约总量
		$year_reserve = Reserve::whereTime('add_time', 'between', [$year_start, $year_end])->count('id');

		$reserve = [
			'day_reserve'   => $day_reserve ? $day_reserve : '0',
			'week_reserve'  => $week_reserve ? $week_reserve : '0',
			'month_reserve' => $month_reserve ? $month_reserve : '0',
			'year_reserve'  => $year_reserve ? $year_reserve : '0',
		];


		return $this->fetch('',[
			'order'   => $order,
			'user'    => $user,
			'shop'    => $shop,
			'reserve' => $reserve,
		]);
	}
}