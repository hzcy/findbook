<?php
header("Content-Type: text/html;charset=utf-8");
$page = $_GET['page'];

switch($page)
{
  case '下载三':
      echo "/page3.php";
      break;
  case '下载四':
      echo "/page4.php";
      break;
      case '下载五':
      echo "/page5.php";
      break;
    default:
    break;
}
