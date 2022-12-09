<?php
$url=$_REQUEST["url"]; //获取传入的URL
header('Content-Type:text/html;charset=UTF-8'); //设置HTML响应

$z1=strpos($url, "/daxuexi/")+9; //截取id
$str=substr($url,$z1);
$id=explode('/',$str)[0];

$curl = curl_init(); //获取青年大学习网页源代码
curl_setopt($curl, CURLOPT_URL,"https://h5.cyol.com/special/daxuexi/$id/index.html");
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

$postb=strpos($html,'<h1>')+4; //H1标签内容
$poste=strpos($html,'</h1>');
$length=$poste-$postb;
$h1=substr($html,$postb,$length);

$postb=strpos($html,'<h6>')+4; //H6标签内容
$poste=strpos($html,'</h6>');
$length=$poste-$postb;
$h6=substr($html,$postb,$length);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="">
<title><?php echo $title; ?></title>
<link rel="stylesheet" href="https://h5.cyol.com/special/daxuexi/<?php echo $id; ?>/css/main.css">
<link rel="stylesheet" href="http://bdimg.share.baidu.com/static/api/css/share_style0_16.css?v=6aba13f0.css">
<link rel="stylesheet" href="http://bdimg.share.baidu.com/static/api/css/imgshare.css?v=a7830602.css"></head>
<body style="font-family:宋体">
<div class="header">
</div>
<div class="mianbody" style="width:1000px;margin:0 auto">
  <div class="secondB">
  <div class="leftB">
    <div class="lB1">
      <div class="cont_h">
          <h3></h3>
          <h1><?php echo $h1; ?></h1>
        </div>
        <h3></h3>
        <h6><?php echo $h6; ?></h6>
    </div>
    <div class="lB2"><iframe style="width: 448px;height: 700px;" src="qndxx.php?url=<?php echo $url; ?>"></iframe></div>
  </div>
  <div class="centerB">
    <div class="rTl">
        <div class="control">
        </div>
    </div>
  </div>
  <div class="rightB">
    <div class="rightTop">
      <div class="line1">扫描二维码预览并分享给朋友</div>
      <div class="line2"><img width="134" src="https://h5.cyol.com/special/daxuexi/<?php echo $id; ?>/images/erweima.png"></div>
      <div class="line3">你可以复制以下链接发送给朋友</div>
      <div class="line4">
        <input class="input1" type="text" value="https://h5.cyol.com/special/daxuexi/<?php echo $id; ?>/index.html" readonly="readonly"/>
      </div>
    </div>
  </div>
  </div>
</div>
<div class="clear"></div>
</body>
</html>