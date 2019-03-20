<?php
 header("Content-type: text/html; charset=utf-8");
 $query =  $_GET['query'];
 $content =  $_GET['content'];
require_once "epubeeclass.php"; //引用那个被调用的类，注意双引号中应当为这个php文件的路径
$epubee = new epubeeclass(); //实例化这个类
$data = $epubee->getepubee($query,$content);

echo json_encode($data);