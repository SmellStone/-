<?php
/**
 * Created by PhpStorm.
 * User: 67554
 * Date: 2019/8/31
 * Time: 23:24
 */


header('Access-Control-Allow-Origin:*');
header('Content-Type:text/json; charset=UTF-8');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$ouphone = $request->ouphone;
$nuphone = $request->nuphone;

$servername="localhost";
$username="root";
$password="root";
$database="hlw";

$conn=new mysqli($servername,$username,$password,$database);

//检测连接
if($conn->connect_error){
    die("连接失败:".$conn->connect_error);
}

$stmt = mysqli_stmt_init($conn);

$sql = "UPDATE `user` SET `uphone` ='".$nuphone."' WHERE `uphone` ='".$ouphone."' ";

if($conn->query($sql))
{
    $result=array(
        "verify"=>true,
    );
    echo json_encode($result);
}
else
{
    $result=array(
        "verify"=>false,
    );
    echo json_encode($result);
}