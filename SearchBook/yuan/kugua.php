<?php
 header("Content-type: text/html; charset=utf-8");
require_once('ParserDom.php');

$content = $_GET['content'];
$query =  $_GET['query'];
$notes = "";
//getRequest($query);
 //$url = "https://www.yunpanjingling.com/search/".$query."?filter_mode=ebook";

 $html =   request_post($query);
//echo $data;

 // $result = substr($html,strripos($html,"searchid")+1);
  //echo $result;
//  preg_match('/Set-Cookie:(.*);/iU',$html,$str); //正则匹配
// echo $cookie = $str[1]; //获得COOKIE（SESSIONID）
//   $html = mb_convert_encoding($html, 'gb2312', 'utf-8');
  //$html = '<meta http-equiv="Content-Type" content="text/html;charset=gb2312">' . $html;

 $html_dom = new \HtmlParser\ParserDom($html);
     //$p_array = $html_dom->find('a[href]');
   

     $p_array = $html_dom->find('div[id="slist"]'); 
     //echo $p->getPlainText();
      $note; $i=0;$b=0;//初始化变量
     foreach ($p_array as $p){
          
          $arr2 = $p->find('a');
         foreach($arr2 as $v){ 
             $b++; 
             //echo $content;
              
               $link =  $v->getAttr("href");
               if(strpos($link,'http') !== false){ 
                
               }else{
                $link  = "https://www.kgbook.com".$link;
               }
              
               $title = $v->getPlainText();
               $title = str_replace("\r\n","",$title);
            if($title!=null&&strpos($title,$query) !== false)
            {
            //     if($content=="home")
            //   {
                 
            //       if($b>3)
            //       {
                     
            //           break;
            //       }
            //   }
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
function getRequest($query){
   //初始化
   $curl = curl_init();
   //设置抓取的url
   curl_setopt($curl, CURLOPT_URL, 'https://www.kgbook.com/e/search/index.php');
 curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
   //设置post方式提交
   curl_setopt($curl, CURLOPT_POST, 1);
    //重要！
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts  
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);  
  
   //设置post数据
   $post_data = array(
       "keyboard" => $query,
       "show" => "title,booksay,bookwriter",
       "tbname" => "download",
       "tempid"=>"1",
       "submit"=>"搜索"
       );
   curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
   //执行命令
   $data = curl_exec($curl);
   curl_close($curl);
   return $data;
  }


  function request_post($query) {
   
//设置post数据
$param = array(
    "keyboard" => $query,
    "show" => "title,booksay,bookwriter",
    "tbname" => "download",
    "tempid"=>"1",
    "submit"=>"搜索"
    );

    
    $postUrl = 'https://www.kgbook.com/e/search/index.php';
    $curlPost = $param;
    $ch = curl_init();//初始化curl
    curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
     //重要！
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts  
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
  
    $data = curl_exec($ch);//运行curl
    curl_close($ch);
    
    return $data;
}