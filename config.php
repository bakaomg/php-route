<?php
/**
 * Route Config
 * User: ohmyga
 * Time: 23:18:19
 * Date: 2019/07/27
 **/
 
 /**
  * 重写规则
  **/
 $route = array(
  
  //首页
  '/' => __DIR__ .'/pages/home.php',
  
  //测试 引用/pages/test.php 文件
  '/test' => __DIR__ .'/./pages/test.php',
  
  //当访问 domain.com/hentai 时，显示的内容也如上面的一样都是test.php这个文件
  '/hentai' => __DIR__ .'/pages/test.php'
 );
 
/**
 * 将重写规则发送给route类处理
 **/
 route::start($route);