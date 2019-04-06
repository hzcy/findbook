<?php
 header("Content-type: text/html; charset=utf-8");
$url = "https://hueyan.herokuapp.com/users/1/web_requests/57/a-secret-key.json";
  $html = getRequest($url);
  $data = json_decode($html,ture);
$data = $data['items'];
echo $data = json_encode($data);

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