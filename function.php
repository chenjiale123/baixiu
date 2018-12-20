<?php
require_once 'config.php';
/** 
 * 封装函数获取数据
 * 
 * 
*/


function baixiu_fetch($sql){
    $conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    // mysqli_query($conn,'set name utf-8');
    mysqli_set_charset($conn, 'utf8');
    if(!$conn){
        exit("连接失败");
    }
    
    $query=mysqli_query($conn,$sql);

    if(!$query){
        exit("查询失败");
    }

    while($row=mysqli_fetch_assoc($query)){
        $result[]=$row;
    }
    return $result;

}

/**
 * 增删改数据库
 * 
 * 
 */

 function xiu_exective($sql){
    $conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    // mysqli_query($conn,'set name utf-8');
    mysqli_set_charset($conn, 'utf8');
    if(!$conn){
        exit("连接失败");
    }
    
    $query=mysqli_query($conn,$sql);

    if(!$query){
        return false;
    }

    // while($row=mysqli_fetch_assoc($query)){
    //     $result[]=$row;
    // }
    $affected_rows=mysqli_affected_rows($conn);

    return $affected_rows;
 }

?>