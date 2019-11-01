<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * [p 传递数据以易于阅读的样式格式化后输出]
 * @Author   PengJun
 * @DateTime 2018-06-09
 * @param    [type]     $data [description]
 * @return   [type]           [description]
 */
function p($data){
    // 定义样式
    $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
    // 如果是boolean或者null直接显示文字；否则print
    if (is_bool($data)) {
        $show_data=$data ? 'true' : 'false';
    }elseif (is_null($data)) {
        $show_data='null';
    }else{
        $show_data=print_r($data,true);
    }
    $str.=$show_data;
    $str.='</pre>';
    echo $str;die;
}

/**
 * [toArray 查询结果转换数组]
 * @Author   PengJun
 * @DateTime 2018-09-03
 */
function toArray($array){
    $data = [];
    if(is_array($array)){
        foreach($array as $vo){
            $data[] = $vo->toArray();
        }
    } else {
        $data = $array->toArray();
    }
    
    return $data;
}

/**
 * [return_ajax ajax返回信息]
 * @Author   HTL
 * @DateTime 2017-09-25T10:12:24+0800
 * @param    integer                  $code   [状态码 默认1]
 * @param    string                   $info   [提示信息]
 * @param    array                    $data   [返回的数据]
 */
function return_ajax($code=1,$info='请求成功',$data=array(),$count=0){
   exit(json_encode(array('code'=>$code,'msg'=>$info,'data'=>$data,'count'=>$count)));
}

/**
 * 打印输出数据到文件
 * @param mixed $data
 * @param bool $replace
 * @param string|null $pathname
 */
function files($data, $replace = false, $pathname = null)
{
    is_null($pathname) && $pathname = RUNTIME_PATH . date('Ymd') . '.txt';
    $str = (is_string($data) ? $data : (is_array($data) || is_object($data)) ? print_r($data, true) : var_export($data, true)) . "\n";
    $replace ? file_put_contents($pathname, $str) : file_put_contents($pathname, $str, FILE_APPEND);
}

/**
 * [imgUpdate TP5文件上传]
 * @Author   PengJun
 * @DateTime 2018-05-10
 * @param    [type]     $fileName [文件变量名]
 * @param    [type]     $fileUrl  [文件路径]
 * @return   [type]               [description]
 */
function imgUpdate($fileName,$fileUrl='')
{   
    $fileUrl?$fileUrl:date('Ymd',time());
    // 获取表单上传文件
    $files = request()->file($fileName);
    if(is_array($files)){ //多图上传
        foreach($files as $key=>$file){
            //进行大小，文件后缀验证，通过移动到public/uploads/pet 目录下
            $info = $file->validate(['size'=>31457280,'ext'=>'jpeg,jpg,png,gif,mp4,zip,rar'])->move(ROOT_PATH.'public'.DS.'uploads'.DS.$fileUrl);
            if($info){
                //获取文件名称 并将路径中的 \ 替换成 / 
                $data[$key] = '/uploads'.$fileUrl.'/'.str_replace("\\",'/',$info->getSaveName());
            }else{
                $str = '第'.($key+1).'个文件上传失败,失败原因:'.$file->getError();
                return ['code'=>400,'msg'=>$str];
            }
        }
    }else{ //单图上传
        //进行大小，文件后缀验证，通过移动到public/uploads/pet 目录下
        $info = $files->validate(['size'=>31457280,'ext'=>'jpeg,jpg,png,gif,mp4,zip,rar,xlsx,xls'])->move(ROOT_PATH.'public'.DS.'uploads'.DS.$fileUrl);
        if($info){
            //获取文件名称 并将路径中的 \ 替换成 /
            $data = '/uploads'.$fileUrl.'/'.str_replace("\\",'/',$info->getSaveName());
        }else{
            $str = '文件上传失败,失败原因:'.$files->getError();
            return ['code'=>400,'msg'=>$str];
        }
    }
    return ['code'=>200,'msg'=>'上传成功','data'=>$data];
}

/**
 * [str_cut 字符截取]
 * @Author   PengJun
 * @DateTime 2018-07-19
 * @param    [type]     &$string [字符串]
 * @param    [type]     $start   [开始下标]
 * @param    [type]     $length  [长度]
 * @param    string     $charset [编码]
 * @param    string     $dot     [后缀]
 */
function str_cut($string, $start, $length, $charset = "utf-8", $dot = '...') {
    if(function_exists('mb_substr')) {
        if(mb_strlen($string, $charset) > $length) {
            return mb_substr ($string, $start, $length, $charset) . $dot;
        }
        return mb_substr ($string, $start, $length, $charset);
        
    }else if(function_exists('iconv_substr')) {
        if(iconv_strlen($string, $charset) > $length) {
            return iconv_substr($string, $start, $length, $charset) . $dot;
        }
        return iconv_substr($string, $start, $length, $charset);
    }

    $charset = strtolower($charset);
    switch ($charset) {
        case "utf-8" :
            preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $ar);
            if(func_num_args() >= 3) {
                if (count($ar[0]) > $length) {
                    return join("", array_slice($ar[0], $start, $length)) . $dot;
                }
                return join("", array_slice($ar[0], $start, $length));
            } else {
                return join("", array_slice($ar[0], $start));
            }
            break;
        default:
            $start = $start * 2;
            $length   = $length * 2;
            $strlen = strlen($string);
            for ( $i = 0; $i < $strlen; $i++ ) {
                if ( $i >= $start && $i < ( $start + $length ) ) {
                    if ( ord(substr($string, $i, 1)) > 129 ) $tmpstr .= substr($string, $i, 2);
                    else $tmpstr .= substr($string, $i, 1);
                }
                if ( ord(substr($string, $i, 1)) > 129 ) $i++;
            }
            if ( strlen($tmpstr) < $strlen ) $tmpstr .= $dot;
            
            return $tmpstr;
    }
}

/**
 * 
 * 产生随机字符串，不长于32位
 * @param int $length
 * @return 产生的随机字符串
 */
function getNonceStr($length = 32) 
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
    $str ="";
    for ( $i = 0; $i < $length; $i++ )  {  
        $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
    } 
    return $str;
}

/**
 * 获取一定范围内的随机数字
 * 跟rand()函数的区别是 位数不足补零 例如
 * rand(1,9999)可能会得到 465
 * rand_number(1,9999)可能会得到 0465  保证是4位的
 * @param integer $min 最小值
 * @param integer $max 最大值
 * @return string
 */
function rand_number ($min=1, $max=999999) {
    return sprintf("%0".strlen($max)."d", mt_rand($min,$max));
}

/**
 * 传入时间戳,计算距离现在的时间
 * @param  number $time 时间戳
 * @return string       返回多少以前
 */
function word_time($time) {
    $time = (int) substr($time, 0, 10);
    $int = time() - $time;
    $str = '';
    if ($int <= 2){
        $str = sprintf('刚刚', $int);
    }elseif ($int < 60){
        $str = sprintf('%d秒前', $int);
    }elseif ($int < 3600){
        $str = sprintf('%d分钟前', floor($int / 60));
    }elseif ($int < 86400){
        $str = sprintf('%d小时前', floor($int / 3600));
    }else{
        $str = date('Y-m-d', $time);
    }
    return $str;
}

/**
 * 使用curl获取远程数据
 * @param  string $url url连接
 * @return string      获取到的数据
 */
function curl_get_contents($url){
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);                //设置访问的url地址
    // curl_setopt($ch,CURLOPT_HEADER,1);               //是否显示头部信息
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);               //设置超时
    // curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);   //用户访问代理 User-Agent
    curl_setopt($ch, CURLOPT_REFERER,$_SERVER['HTTP_HOST']);        //设置 referer
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);          //跟踪301
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
    $r=curl_exec($ch);
    curl_close($ch);
    return $r;
}




/**
 * 通过CURL发送HTTP请求
 * @param string $url  //请求URL
 * @param array $postFields //请求参数 
 * @return mixed
 */
 function curlPost($url,$postFields){
    //$postFields = http_build_query($postFields);
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_POST, 1 );
    curl_setopt ( $ch, CURLOPT_HEADER, 0 );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $postFields );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
    $result = curl_exec ( $ch );
    curl_close ( $ch );
    return $result;
}

/**
 * [isPhone 检测手机号格式]
 * @Author   PengJun
 * @DateTime 2018-06-22
 * @param    [type]     $data [description]
 * @return   boolean          [description]
 */
function isPhone($data) {
    $search ='/^1(3|4|5|6|7|8|9)\d{9}$/';
    if (preg_match($search, $data)) {
        return true;
    } else {
        return false;
    }
}

/**
 * [replaceSpecialChar 过滤特殊字符]
 * @Author   PengJun
 * @DateTime 2019-01-19
 * @param    [type]     $strParam [description]
 */
function replaceSpecialChar($strParam){
    $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\+|\{|\·|\}|\:|\<|\>|\?|\[|\]|\,|\s|\.|\/|\;|\'|\`|\=|\\\|\|/";
    return preg_replace($regex,"",$strParam);
}

// 过滤掉emoji表情
function filterEmoji($str)
{
  $str = preg_replace_callback( '/./u',
      function (array $match) {
        return strlen($match[0]) >= 4 ? '' : $match[0];
      },
      $str);
   return $str;
}

/**
 * [filterNickname 过滤表情符号]
 * @Author   PengJun
 * @DateTime 2019-01-19
 * @param    [type]     $nickname [description]
 * @return   [type]               [description]
 */
function filterNickname($nickname)
{
    $nickname = preg_replace('/[\x{1F600}-\x{1F64F}]/u', '', $nickname);
 
    $nickname = preg_replace('/[\x{1F300}-\x{1F5FF}]/u', '', $nickname);
 
    $nickname = preg_replace('/[\x{1F680}-\x{1F6FF}]/u', '', $nickname);
 
    $nickname = preg_replace('/[\x{2600}-\x{26FF}]/u', '', $nickname);
 
    $nickname = preg_replace('/[\x{2700}-\x{27BF}]/u', '', $nickname);
 
    $nickname = str_replace(array('"','\''), '', $nickname);
 
    return addslashes(trim($nickname));
}

/**
 * excel表格导出
 * @param string $fileName 文件名称
 * @param array $headArr 表头名称
 * @param array $data 要导出的数据
 * @author static7  
 * */
function excelExport($fileName = '', $headArr = [], $data = []) {
    import('PHPExcel.Classes.PHPExcel',EXTEND_PATH);

    $fileName .= "_".date("Ymdhis",time()).".xls";
    $objPHPExcel = new \PHPExcel();
    $objPHPExcel->getProperties();
    $key = ord("A"); // 设置表头

    foreach ($headArr as $v) {
        $colum = chr($key);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
        $key += 1;
    }

    $column = 2;
    $objActSheet = $objPHPExcel->getActiveSheet();

    foreach ($data as $key => $rows) { // 行写入
        $span = ord("A");
        foreach ($rows as $keyName => $value) { // 列写入
            $objActSheet->setCellValue(chr($span) . $column, $value);
            $span++;
        }
        $column++;
    }

    $fileName = iconv("utf-8", "gb2312", $fileName); // 重命名表
    $objPHPExcel->setActiveSheetIndex(0); // 设置活动单指数到第一个表,所以Excel打开这是第一个表
    ob_end_clean();
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename='$fileName'");
    header('Cache-Control: max-age=0');
    $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output'); // 文件通过浏览器下载
    exit();
}

/**
 * [insert_excel 读取Excel表格信息]
 * @Author   PengJun
 * @DateTime 2018-11-06
 * @param    [type]     $file [表格文件地址]
 */
function insert_excel($file)
{
    import('PHPExcel.Classes.PHPExcel',EXTEND_PATH);
    $PHPExcel = new \PHPExcel();
    
    if ($file) {
        //获取文件后缀
        $name = substr(strrchr($file,'.'),1);
        if($name == 'xlsx'){
            $objReader = PHPExcel_IOFactory::createReader('Excel2007'); 
        }else{
            $objReader = PHPExcel_IOFactory::createReader('Excel5'); 
        }
        $obj_PHPExcel =$objReader->load($file, $encode = 'utf-8');
          //加载文件内容,编码utf-8
        $excel_array=$obj_PHPExcel->getsheet(0)->toArray();
        // print_r($excel_array);die;
           //转换为数组格式
        array_shift($excel_array);
        return $excel_array;
         //批量插入数据
    }
}

/**
 * [wxqrcode 生成小程序二维码]
 * @Author   PengJun
 * @DateTime 2019-03-26
 * @return   [type]     [description]
 */
function wxqrcode($data)
{   
    $access_token = getAccessToken();
    $url = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token='.$access_token;
    $info = curlPost($url,$data);
    return $info;
}

/**
 * [getAccessToken 获取小程序access_token]
 * @Author   PengJun
 * @DateTime 2019-03-26
 * @return   [type]     [description]
 */
function getAccessToken()
{   
    $config = Config::get(1);
    $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$config['appid'].'&secret='.$config['appsecret'];
    $info = json_decode(curlPost($url),true);
    return $info['access_token'];
}

/**
 * Emoji原形转换为String
 * @param string $content
 * @return string
 */
function emojiEncode($content)
{
    return json_decode(preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i", function ($str) {
        return addslashes($str[0]);
    }, json_encode($content)));
}

/**
 * Emoji字符串转换为原形
 * @param string $content
 * @return string
 */
function emojiDecode($content)
{
    return json_decode(preg_replace_callback('/\\\\\\\\/i', function () {
        return '\\';
    }, json_encode($content)));
}

/**
 * CURL请求
 * @param $url 请求url地址
 * @param $method 请求方法 get post
 * @param null $postfields post数据数组
 * @param array $headers 请求header信息
 * @param bool|false $debug 调试开启 默认false
 * @return mixed
 */
function http_request($url, $method, $postfields = null, $headers = array(), $debug = false){
    $method = strtoupper($method);
    $ci = curl_init();
    /* Curl settings */
    curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ci, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0");
    curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 60); /* 在发起连接前等待的时间，如果设置为0，则无限等待 */
    curl_setopt($ci, CURLOPT_TIMEOUT, 7); /* 设置cURL允许执行的最长秒数 */
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
    switch ($method) {
        case "POST":
            curl_setopt($ci, CURLOPT_POST, true);
            if (!empty($postfields)) {
                $tmpdatastr = is_array($postfields) ? http_build_query($postfields) : $postfields;
                curl_setopt($ci, CURLOPT_POSTFIELDS, $tmpdatastr);
            }
            break;
        default:
            curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method); /* //设置请求方式 */
            break;
    }
    $ssl = preg_match('/^https:\/\//i', $url) ? TRUE : FALSE;
    curl_setopt($ci, CURLOPT_URL, $url);
    if ($ssl) {
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, FALSE); // 不从证书中检查SSL加密算法是否存在
    }
    //curl_setopt($ci, CURLOPT_HEADER, true); /*启用时会将头文件的信息作为数据流输出*/
    curl_setopt($ci, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ci, CURLOPT_MAXREDIRS, 2);/*指定最多的HTTP重定向的数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的*/
    curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ci, CURLINFO_HEADER_OUT, true);
    /*curl_setopt($ci, CURLOPT_COOKIE, $Cookiestr); * *COOKIE带过去** */
    $response = curl_exec($ci);
    $requestinfo = curl_getinfo($ci);
    $http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
    if ($debug) {
        echo "=====post data======\r\n";
        var_dump($postfields);
        echo "=====info===== \r\n";
        print_r($requestinfo);
        echo "=====response=====\r\n";
        print_r($response);
    }
    curl_close($ci);
    return $response;
    //return array($http_code, $response,$requestinfo);
}



//把请求发送到微信服务器换取二维码
  function httpRequest($url, $data='', $method='POST'){
    $curl = curl_init();  
    curl_setopt($curl, CURLOPT_URL, $url);  
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);  
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);  
    // curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);  
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);  
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);  
    if($method=='POST')
    {
        curl_setopt($curl, CURLOPT_POST, 1); 
        if ($data != '')
        {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);  
        }
    }

    curl_setopt($curl, CURLOPT_TIMEOUT, 30);  
    curl_setopt($curl, CURLOPT_HEADER, 0);  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
    $result = curl_exec($curl);  
    curl_close($curl);  
    return $result;
  } 

  /**
 * 获取全部行政区域 腾讯地图
 */
function getAddressByTencent(){
    $url    = 'https://apis.map.qq.com/ws/district/v1/list?key=' .'FNZBZ-RDHWS-TYSOP-6GTGS-RTYYH-GNFUG';
    $result = http_request($url, 'get');
    $result = json_decode($result, true);
    return $result;
}

/**
 * 获取子行政区域
 */
function getChildrenByTencent($id = ''){
    $url    = 'https://apis.map.qq.com/ws/district/v1/getchildren?id=' .$id .'&key=' .'FNZBZ-RDHWS-TYSOP-6GTGS-RTYYH-GNFUG';
    $result = http_request($url, 'get');
    $result = json_decode($result, true);
    return $result;
}

    function api_notice_increment($url, $data){
        $ch = curl_init();
        // $header = "Accept-Charset: utf-8";
        $header = ['Accept-Charset' => 'utf-8'];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
           //  var_dump($tmpInfo);
           // exit;
        if (curl_errno($ch)) {
          return false;
        }else{
          // var_dump($tmpInfo);
          return $tmpInfo;
        }
     }