<?php
//测试的无用文件 可删 

/*
$config=array(
    "set" => 0, //自动更新开关(0开,1关)，关闭后如果要开启需重新访问update.php文件才能运行(不要等响应)
    "time" => "", //相隔几秒更新一次数据（建议不要太短）
    "echo" => 0, //输出信息(0开,1关)
    "error" => 1, //忽略错误(0开，1关)
    );
    
if($config["error"]!=0)
{
    if(!$config["set"]==1&&!$config["set"]==0) $error="set";
    else if(!is_numeric($config["time"])&&!$config["time"]>=0) $error="time";
    else if(!$config["echo"]==1&&!$config["echo"]==0)  $error="echo";
    else if(!$config["error"]==1&&!$config["error"]==0) $error="error";
    if($config["echo"]==1) exit;
    else exit('{"code":-1,"msg":"配置有误","data":{"array":"'.$error.'"}}');
}

if($config["set"]==1)
{
    $array=array("code"=>-2,
    "msg"=>"自动更新未启用",
    "data"=>null);
    if($config["echo"]==0) 
    {
        header('Content-Type: application/json');
        echo json_encode($array,JSON_UNESCAPED_UNICODE);
    }
}
else if($c==1)
{
    $array=array("code"=>1,
    "msg"=>"自动更新正在运行",
    "data"=>array("time" =>$config["time"]));
    if($config["echo"]==0) 
    {
        header('Content-Type: application/json');
        echo json_encode($array,JSON_UNESCAPED_UNICODE);
    }
}
else
{
}


/*
ignore_user_abort(true);
set_time_limit(0);
do{
if()
}while(true);*/