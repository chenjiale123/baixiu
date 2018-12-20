<?php

require_once '../../config.php';


if(empty($_GET["email"])){
    exit("缺少必要参数");
}

$email=$_GET["email"];



$conn=mysqli_connect("localhost","root","","baixiu");


if(!$conn){
    exit("连接失败");
}

 $res=mysqli_query($conn,"select avatar from users where email='{$email}'limit 1;");
 if(!$res){
     exit("查询失败");
 }
 $row=mysqli_fetch_assoc($res);
 echo $row['avatar'];

?>