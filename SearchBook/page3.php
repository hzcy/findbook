<?php
header("Content-Type: text/html;charset=utf-8");
//每页两到三个 增加页在load.php 和load2.php
echo '
{

"data":[

{"name":"kindleshare","link":"/yuan/kindleshare.php"},
{"name":"周读","link":"/yuan/ireadweek.php"},
{"name":"胖虎书屋","link":"/yuan/panghu.php"}
]
}
';