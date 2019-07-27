<?php
/**
 * Route
 * User: ohmyga
 * Time: 23:18:19
 * Date: 2019/07/27
 **/
 
 //引入配置文件
 require_once __DIR__ .'/./config.php';
 
 class route {
  
  /**
   * 错误页面处理
   * @param $text
   * @param $header
   **/
  public static function errorPage($header, $text) {
   //定义header
   header('HTTP/1 '.$header);
   
   //输出提示文字
   echo $text;
  }
  
  /**
   * 处理请求
   * @param $config
   **/
  public static function handle($route) {
   //获取规则条数
   $count = count($route);
   
   //循环遍历匹配请求
   for($i=0; $i < $count; $i++) {
    //获取键名(重写规则名
	$requestUrl = key($route);
	
	//当前规则的值
	$routeUrl = current($route);
	
	//正则替换 /?xx=xx 以及 双斜杆 以免404
	$urls = preg_replace("(\?.*)","",$_SERVER['REQUEST_URI']);
	$urls = preg_replace("/\/\//","/",$urls);
	
	if ($requestUrl == $urls) {
     //如果匹配成功将直接 require 规则中的文件并跳出循环
	 require_once $routeUrl;
	 break;
	}else{
     //如果不匹配将进行二次循环
	 //二次循环代码基本一样 所以就不注解了
	 for($i=0; $i < $count; $i++) {
      $requestUrl = key($route);
	  $routeUrl = current($route);
	  $urls = preg_replace("(\?.*)","",$_SERVER['REQUEST_URI']);
	  $urls = preg_replace("/\/\//","/",$urls);
	  if ($requestUrl == $urls) {
       require_once $routeUrl;
	   break 2;
	  }
	  next($route);
     }
	 
	 //如果二次循环无法找到规则直接抛出 HTTP 404 状态码
	 self::errorPage('404 Not Found.', '<h1>Not Found!!</h1>');
	}
	//指针移动到下一组数
	next($route);
   }
  }
  
  /**
   * Start
   * @param $config
   **/
  public static function start($config) {
   self::handle($config);
  }
 }