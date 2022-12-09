<?php
$url=$_GET["url"]; //获取传入的URL

$z1=strpos($url, "/daxuexi/")+9; //截取id
$str=substr($url,$z1);
$id=explode('/',$str)[0];

$curl = curl_init(); //获取青年大学习网页源代码
curl_setopt($curl, CURLOPT_URL,$url);
curl_setopt($curl, CURLOPT_HEADER,0);
curl_setopt($curl, CURLOPT_COOKIE,'0');
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_NOBODY,0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
$html=curl_exec($curl);
curl_close($curl);

/*$z2= strpos($html, "<title>")+100;
$strhtml= substr($html,$z2);
$title=explode('</title>',$html)[0];*/

$postb=strpos($html,'<title>')+7; //获取网页标题
$poste=strpos($html,'</title>');
$length=$poste-$postb;
$title=substr($html,$postb,$length);

?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $title ?></title>
<meta charset="utf-8">
<style type="text/css">
/*清除边距*/
*{
    padding:0;
    margin:0;
}
html,body{
    height:100%;
}
/*设置宽高100%，放背景图，不重复，设置背景图的尺寸*/
.box{
    width:100%;
    height:100%;
    background-image: url("https://h5.cyol.com/special/daxuexi/<?php echo $id ?>/images/end.jpg");
    background-repeat: no-repeat;
    background-size: 100% 100%; /*宽高都100%*/
}
</style>
</head>
<body>
<div class="box">
</div>
</body>
</html>