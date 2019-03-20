<?php
header("Content-Type: text/html;charset=utf-8");
require_once('ParserDom.php');

$content = $_GET['content'];
$query =  $_GET['query'];

$url = "http://s.xiabook.com/cse/search?s=509453313742935952&entry=1&q=".$query."&x=0&y=0";

  $html = getRequest($url);
 $html_dom = new \HtmlParser\ParserDom($html);
     //$p_array = $html_dom->find('a[href]');
     //echo '<hr/>';

     $p_array = $html_dom->find('h3[class="result-item-title"]'); 
     //echo $p->getPlainText();
      $note; $i=0;//初始化变量
     foreach ($p_array as $p){
          
          $arr2 = $p->find('a');
         foreach($arr2 as $v){ 
             $b++; 
             //echo $content;
              if($content=="home")
              {
                 
                  if($b>3)
                  {
                     
                      break 2;
                  }
              }
             $link =  $v->getAttr("href");
             $title = $v->getAttr("title");
            
          }
          if($title==$query)
          {
            $note["title"]=$title;
              $note["downlink"]=$link;
        
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

 function getRequest($url){
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
    

    $src = curl_exec($curl);
    curl_close($curl);

    
    return $src; 
 }