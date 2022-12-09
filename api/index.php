<?php
/*
title qingniandaxuexi get data(青年大学习数据获取)
2022/10/27 By:wuzhidecuo
API用于获取青年大学习的（非所有）链接，非常耗流量，不过不用担心本程序会将数据存储到服务器做为缓存，当需要时可以使用（判断是否需要使用缓存，使用MD5效验）
*/

$config=array( 
    "api" => 0, //API开关(0为开，1为关)
    "temp" => 0, //缓存文件(0为开，1为关)
    "error" => 1, //忽略配置错误(0为开，1为关)
);

header('Content-Type: application/json');
error_reporting(0);
$page=$_REQUEST["page"];

if($config["error"]!=0)
{
    if($config["api"]!=0&&$config["api"]!=1)
    exit('{"code":-1,"msg":"配置错误","data":{"array":"api"}}');
    else if($config["temp"]!=0&&$config["temp"]!=1)
    exit('{"code":-1,"msg":"配置错误","data":{"array":"temp"}}');
    else if($config["error"]!=0&&$config["error"]!=1)
    exit('{"code":-1,"msg":"配置错误","data":{"array":"error"}}');
}
else if($config["api"]!=0)
exit('{"code":-3,"msg":"未开启","data":null}');

if(!$page||$page==1){
$data=curl("http://news.cyol.com/gb/channels/vrGlAKDl/index.html");
$page=1;
}else if(is_numeric($page))
$data=curl("http://news.cyol.com/gb/channels/vrGlAKDl/index_$page.html");
else
exit('{"code":-1,"msg":"参数错误","data":null}');

if($config["temp"]==0){
$fp = fopen("data.json","r");
$filetext=fread($fp, filesize("data.json"));
$data2=json_decode($filetext,true);
fclose($fp);
if($data2["page".$page]==md5($data))
{
    $fp = fopen("$page.json","r");
    $filetext2=fread($fp, filesize("$page.json"));
    fclose($fp);
    exit('{"code":1,"msg":"成功(来自缓存)","data":'.$filetext2.'}');
}}

$array["code"]=0;
$array["msg"]="成功";

//获取数据列表（截取字符串）
$postb=strpos($data,'<ul class="movie-list">') +23; 
$poste=strpos($data,'<div class="clear"></div>');
$length=$poste-$postb;
$list=substr($data,$postb,$length);

foreach(explode('<li>',$list) as $v)
{
    //获取URL
    $postb=strpos($v,'<a href="') +9; 
    $poste=strpos($v,'" class="transition" ');
    $length=$poste-$postb;
    $url=substr($v,$postb,$length);
    
    //获取标题2
    $postb=strpos($v,$url.'" target="_blank">')+strlen($url.'" target="_blank">'); 
    $poste=strpos($v,'</a></h3>');
    $length=$poste-$postb;
    $title2=substr($v,$postb,$length);
    
    //获取intro
    $postb=strpos($v,'<div class="movie-intro">') +25; 
    $poste=strpos($v,'<span class="shu">');
    $length=$poste-$postb;
    $intro=substr($v,$postb,$length);
    
    //获取时间
    $postb=strpos($v,'</span>') +7; 
    $poste=strpos($v,'</div>');
    $length=$poste-$postb;
    $time=substr($v,$postb,$length);
    
    //获取image
    $postb=strpos($v,'data-src="') +10; 
    $poste=strpos($v,'"></a>');
    $length=$poste-$postb;
    $image=substr($v,$postb,$length);
    
    if(strstr($url,"https://")||strstr($url,"http://")){
    $content=curl(str_replace('images/pc.jpg', '',$url));
    
    //获取标题
    $postb=strpos($content,'<title>')+7;
    $poste=strpos($content,'</title>');
    $length=$poste-$postb;
    $title=substr($content,$postb,$length);
    
    //获取editor
    $posta=explode('name="editor" content="',$content)[1];
    $editor=explode('"',$posta)[0];
    
    //获取author
    $posta=explode('name="author" content=“',$content)[1];
    $author=explode('” />',$posta)[0];
    if($author=="")
    {$posta=explode('name="author" content="',$content)[1];
    $author=explode('" />',$posta)[0];}
    
    //获取source
    $posta=explode('name="source" content=\'',$content)[1];
    $source=explode('\' />',$posta)[0];
    if($source=="")
    {$posta=explode('name="source" content="',$content)[1];
    $source=explode('" />',$posta)[0];}
    
    $array["data"][]=array(
        "title" => $title,
        "title2" => $title2,
        "intro" => $intro,
        "time" => $time,
        "image" => $image,
        "url" => str_replace('images/pc.jpg', '',$url),
        "editor" => $editor,
        "author" => $author,
        "source" => $source,
        );
    
    }
}

if(!$array["data"])
$array["data"]=[];
else if($config["temp"]==0){//缓存数据
$fp = fopen($page.'.json', 'w');
fwrite($fp, json_encode($array["data"],JSON_UNESCAPED_UNICODE));
fclose($fp);

$fp = fopen('data.json', 'w');
$data2["page".$page]=md5($data);
fwrite($fp, json_encode($data2,JSON_UNESCAPED_UNICODE));
fclose($fp);
}

echo json_encode($array,JSON_UNESCAPED_UNICODE);

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