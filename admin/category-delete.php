<?php
require_once '../function.php';


if(empty($_GET['id'])){
    exit('缺少必要参数');
}


$id=$_GET['id'];

xiu_exective('delete from categories where  id=' . $id);


header('location:/baixiu/admin/categories.php');



?>