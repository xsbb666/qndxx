<?php
$url2=$_REQUEST["url"];
$url=explode("?",explode("/bg2.php",$_SERVER['REQUEST_URI'])[1])[0];
header('Content-Type:text/html;charset=UTF-8'); //设置HTML响应

$z1=strpos($url2, "/daxuexi/")+9; //截取id
$str=substr($url2,$z1);
$id=explode('/',$str)[0];
if(!$url2)
header("Location: https://h5.cyol.com/special/daxuexi/$url");
else if(!$url&&$url2)
header("Location: bg2.php/$id/?url=$url2");
else
{
    $str2=curl("https://h5.cyol.com/special/daxuexi/$id/");
    $posta=explode('<iframe style="width: 448px;height: 700px;" src="',$str2)[1];
    $html=explode('"',$posta)[0];
    if($html)
    echo str_ireplace($html,"../../qndxx.php?url=$url2" , $str2);
}

//CURL模块
function curl($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_HEADER,0);
    curl_setopt($curl, CURLOPT_COOKIE,'0');
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_NOBODY,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    return curl_exec($curl);
    curl_close($curl);
}