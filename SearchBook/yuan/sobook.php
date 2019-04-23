<?php

 header("Content-type: text/html; charset=utf-8");
require_once('ParserDom.php');

$content = $_GET['content'];
$query =  $_GET['query'];
$notes;
$url = "https://sobooks.cc/search/".$query;

   $html = getRequest($url);
  $html = mb_convert_encoding($html, 'gb2312', 'utf-8');
 $html = '<meta http-equiv="Content-Type" content="text/html;charset=gb2312">' . $html;

 $html_dom = new \HtmlParser\ParserDom($html);
     //$p_array = $html_dom->find('a[href]');
     //echo '<hr/>';

     $p_array = $html_dom->find('div[class="card-item"]'); 
     //echo $p->getPlainText();
      $note; $i=0;$b=0;//初始化变量
     foreach ($p_array as $p){
          
          $arr2 = $p->find('a');
         foreach($arr2 as $v){ 
             $b++; 
             //echo $content;
              if($content=="home")
              {
                 
                  if($b>3)
                  {
                     
                      break;
                  }
              }
            $link =  $v->getAttr("href");
            $title = $v->getAttr("title");
            if($title!=null&&strpos($title,$query) !== false)
            {
                $note["title"]=$title;
                $note["link"]=$link;
                $notes[$i++]=$note;
            }
         
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
function getRequest($url){
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.62 Safari/537.36");
  //重要！
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts  
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);  
  
  
    $src = curl_exec($curl);
    curl_close($curl);
  
    
    return $src; 
  }