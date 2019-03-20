<?php
header("Content-Type: text/html;charset=utf-8");
require_once('ParserDom.php');

$content = $_GET['content'];
$query =  $_GET['query'];

$url = "https://sk.kindleshare.cn/?submit=Search&name=".$query;
$link;
  $html = getRequest($url);
 $html_dom = new \HtmlParser\ParserDom($html);
     //$p_array = $html_dom->find('a[href]');
     //echo '<hr/>';

     $p_array = $html_dom->find('table tr'); 
     //echo $p->getPlainText();
     $notes; $note; $i=0;$b=0;//初始化变量
     for($j=1;$j<count($p_array);$j++){

             
          
          $title = $p_array[$j]->getPlainText();
         $arr3 =  $p_array[$j]->find('a');
      
         foreach($arr3 as $v){ 
               $link =  $v->getAttr('href');
               if($link!=""){
                $note["link"]=$link;
               }
               
         }
         
             //echo $content;
              if($content=="home")
              {
                 
                  if($j>3)
                  {
                     
                      break;
                  }
              }
             
            $title = str_replace("点击下载","",$title);
            $title = str_replace("\n","",$title);
         $note["title"]=$title;
         
         $notes[$i++]=$note;
        
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