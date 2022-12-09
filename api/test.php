<?php
//测试时使用的代码，无用可删
/*$str = "http://h5.cyol.com/special/daxuexi/9fudanhui11/images/pc.jpg";

echo str_replace('images/pc.jpg', '',$str) . '
';

$content=file_get_contents("http://h5.cyol.com/special/daxuexi/daxuexi5s12/m.php");
$pos = strpos($content,'utf-8');
if($pos===false){$content = iconv("gbk","utf-8",$content);}
$postb=strpos($content,'<title>')+7;
$poste=strpos($content,'</title>');
$length=$poste-$postb;
echo substr($content,$postb,$length);
*/