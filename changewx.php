<?php
/**
 * Created by PhpStorm.
 * User: 67554
 * Date: 2019/8/31
 * Time: 23:37
 */

header('Access-Control-Allow-Origin:*');
header('Content-Type:text/json; charset=UTF-8');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$uphone = $request->uphone;
$wx = $request->wx;

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

$sql = "UPDATE `user` SET `uwx` ='".$wx."' WHERE `uphone` ='".$uphone."' ";

if($conn->query($sql))
{
    $result=array(
        "verify"=>true,
    );
    echo json_encode($result);
}
else {
    $result = array(
        "verify" => false,
    );
    echo json_encode($result);
}