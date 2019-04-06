<?php

 header("Content-type: text/html; charset=utf-8");
require_once('ParserDom.php');

$content = $_GET['content'];
$query =  $_GET['query'];
$notes;
$note; $i=0;$b=0;//初始化变量
$url = "http://panghubook.cn/api/books/?key=".$query."&p=1";

  $html = getRequest($url);
 $data = json_decode($html,true);
 
 $data = $data['data']['results'];
 //print_r($data);
 $note;
 foreach($data as $a)
 {
   //echo $a['title'];
  if($a['title']!=null&&strpos($a['title'],$query) !== false)
  {
    $note["title"]=$a['title'];
    $note["link"]='http://www.panghubook.cn/book/'.$a['id'];
    $notes[$i++]=$note;
  }
 }
 if($notes!=null){
  echo '
{
"data":';
echo json_encode($notes);
echo '
}
';
}
  $html = mb_convert_encoding($html, 'gb2312', 'utf-8');
 $html = '<meta http-equiv="Content-Type" content="text/html;charset=gb2312">' . $html;

 
function getRequest($url){
    // $headers = array(
    //    'Host'=> 'panghubook.cn',
    //     'User-Agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9) Gecko/2008052906 Firefox/3.0',
    //     'Cookie'=>' Hm_lvt_5211d8d5080814faa7d698f6dc89db90=1554210078,1554535850,1554547004,1554547014; Hm_lpvt_5211d8d5080814faa7d698f6dc89db90=1554547176'
    // );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
    //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36");
  //重要！
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts  
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);  
  
  
    $src = curl_exec($curl);
    curl_close($curl);
  
    
    return $src; 
  }