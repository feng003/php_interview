<?php
	//TODO ip2long() 将一个IPV4的字符串互联网协议转换成数字格式  header_sent() 检查 HTTP 标头是否已被发送以及在哪里被发送。

	// $ip = gethostbyname('www.baidu.com');
	// $long = ip2long($ip);
	// echo $ip."<br>";
	// echo $long."<br>";
	// printf("%u\n", ip2long($ip)); // 3026264428

	//TOOD call_user_func_array($callback,array $param_arr) 调用回调函数，并把一个数组参数作为回调函数的参数
	//TODO func_get_args(void) — 返回一个包含函数参数列表的数组
	//TODO func_num_args(void) — Returns the number of arguments passed to the function

    /**
     *PHP获取手机号码归属地
     * @param $mobile
     * @return mixed
     */
    function getMobileInfo($mobile)
    {
        header("Content-type:text/html;charset=utf-8");
        $response = file_get_contents('http://tcc.taobao.com/cc/json/mobile_tel_segment.htm?tel='.$mobile);
//        $result = json_decode($response,true);
//        return $result;
        return $response;
    }
    $res = getMobileInfo('18669934780');
    print_r($res);

/**
 * 生成接口数据格式
 */
class Response{
    /**
     * [show 按综合方式输出数据]
     * @param  [int]    $code    [状态码]
     * @param  [string] $message [提示信息]
     * @param  array    $data    [数据]
     * @param  [string] $type    [类型]
     * @return [string]          [返回值]
     */
    public static function show($code, $message, $data = array(),$type = ''){
        if(!is_numeric($code)){
            return '';
        }
        $result = array(
            'code'    => $code,
            'message' => $message,
            'data'    => $data
        );
        if($type == 'json'){
            return self::json($code, $message, $data);
        }elseif($type == 'xml'){
            return self::xml($code, $message, $data);
        }else{
            //TODO
        }
    }
    /**
     * [json 按json方式输出数据]
     * @param  [int] $code       [状态码]
     * @param  [string] $message [提示信息]
     * @param  [array]  $data    [数据]
     * @return [string]          [返回值]
     */
    public static function json($code, $message, $data = array()){
        if(!is_numeric($code)){
            return '';
        }
        $result = array(
            'code'    => $code,
            'message' => $message,
            'data'    => $data
        );
        $result = json_encode($result);
        return $result;
    }
 
    /**
     * [xml 按xml格式生成数据]
     * @param  [int] $code       [状态码]
     * @param  [string] $message [提示信息]
     * @param  array  $data      [数据]
     * @return [string]          [返回值]
     */
    public static function xml($code, $message, $data = array()){
        if(!is_numeric($code)){
            return '';
        }
        $result = array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );
        header("Content-Type:text/xml");
        $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .= "<root>\n";
        $xml .= self::xmlToEncode($data);
        $xml .= "</root>";
        print_r($xml);die;
        return $xml;
    }
 
    public static function xmlToEncode($data){
        $xml = '';$attr='';
        foreach($data as $key => $value){
            if(is_numeric($key)){
                $attr = "id='{$key}'";
                $key = "item";
            }
            $xml .= "<{$key} {$attr}>\n";
            $xml .= is_array($value) ?  self::xmlToEncode($value) : "{$value}\n";
            $xml .= "</{$key}>\n";
        }
        return $xml;
    }
}
 
//测试
$grade = array("score" => array(70, 95, 70.0, 60, "70"), "name" => array("Zhang San", "Li Si", "Wang Wu", "Zhao Liu", "TianQi"));
$response = new Response();
$result = $response :: show(200,'success',$grade,'json');
print_r($result);
