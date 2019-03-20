<?php

require_once('ParserDom.php');


class epubeeclass
{
     public function  getepubee($query,$content)
     {
     

    
      $query = urlencode($query);
      
      $url = "http://cn.epubee.com/books/?s=".$query;
      $url = urlencode($url);
      
      $hueyanurl = "http://hueyan.me:8000/?url=".$url."&selector=a";
       $html = $this->getRequest($hueyanurl);

       $html_dom = new \HtmlParser\ParserDom($html);
   $p_array = $html_dom->find('div[class="ebookitem"]'); 
  $notes; $note; $k=0;$b=0;//初始化变量
 foreach ($p_array as $p){
   //获取图片
    $title = $p->getAttr('title');
   
    $b++; 
    //echo $content;
     if($content=="home")
     {
        
         if($b>3)
         {
            
             break;
         }
     }

   $links = $p->find('div[class="list_title"]');
  
   foreach($links as $i)
   {
     $link2 = $i->find('a');
     foreach($link2 as $i)
   {
    $link = $i->getAttr('href');
    $link = "http://cn.epubee.com".$link;
   }
     
   }
   $note["title"]=$title; 
   $note["link"]=$link;  
   $notes[$k++]=$note;
  }
  return $notes;


 }


//      public static function post($url, $data = '', $timeout = 5){//curl
//       $ch = curl_init();

//       $header = array();
//       $header[] = 'Cookie: _ga=GA1.2.731454484.1531021409; _gid=GA1.2.1400836818.1531021409; _gat=1; Hm_lvt_c1d52ae305ab701945e4c416b6cad0d5=1531021409; Hm_lvt_0bd5902d44e80b78cb1cd01ca0e85f4a=1531021409; Hm_lpvt_c1d52ae305ab701945e4c416b6cad0d5=1531021417; Hm_lpvt_0bd5902d44e80b78cb1cd01ca0e85f4a=1531021418';
// $header[] = 'Host: cn.epubee.com';
// $header[] = 'Origin: http://cn.epubee.com';
// $header[] = 'Referer: http://cn.epubee.com/books/?s=%E4%BA%BA%E7%B1%BB%E7%AE%80%E5%8F%B2';
// $header[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36 ';  
//       curl_setopt ($ch, CURLOPT_URL, $url);
//           curl_setopt ($ch, CURLOPT_POST, 1);
//           if($data != ''){
//               curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//           }
//           curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 0); 
//           curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//          curl_setopt($ch, CURLOPT_HEADER, $header);
//           $file_contents = curl_exec($ch);
//           curl_close($ch);
//           return $file_contents;
//       }
  

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
  
}






       
     


 