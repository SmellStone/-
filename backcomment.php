<?php
/**
 * Created by PhpStorm.
 * User: 67554
 * Date: 2019/9/3
 * Time: 21:17
 */


header('Access-Control-Allow-Origin:*');
header('Content-Type:text/json; charset=UTF-8');


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$ckind = $request->kind;
$ccomment = $request->comment;
$cphone = $request->uphone;
$ctitle = $request->title;
$cemail = $request->email;

//$ckind = '课程学习';
//$ccomment = '课有点少';
//$cphone = '15954698669';
//$ctitle = '课少';
//$cemail = '675548733@qq.com';
//$cimg = '123456';



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

$sql1 = "SELECT MAX(cid) FROM `back` WHERE `cphone` = '".$cphone."'";
$result = $conn->query($sql1);
$rows = $result->fetch_assoc();

//echo $rows['MAX(cid)'];


$sql = "UPDATE `back` SET `comment` = '".$ccomment."'WHERE `cid` = '".$rows['MAX(cid)']."'";
$sql2 = "UPDATE `back` SET `ctitle` = '".$ctitle."'WHERE `cid` = '".$rows['MAX(cid)']."'";
$sql3 = "UPDATE `back` SET `ckind` = '".$ckind."'WHERE `cid` = '".$rows['MAX(cid)']."'";
$sql4 = "UPDATE `back` SET `cemail` = '".$cemail."'WHERE `cid` = '".$rows['MAX(cid)']."'";
if($conn->query($sql) && $conn->query($sql2) && $conn->query($sql3) && $conn->query($sql4))
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
