<?php
/**
 * Created by PhpStorm.
 * User: 67554
 * Date: 2019/9/5
 * Time: 21:39
 */


header('Access-Control-Allow-Origin:*');
header('Content-Type:text/json; charset=UTF-8');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$course = $request->course; //课程名

//$course = '数据结构';

$servername="localhost";
$username="root";
$password="root";
$database="hlw";

//创建连接
$conn=new mysqli($servername,$username,$password,$database);
$stmt = mysqli_stmt_init($conn);

$sql = "SELECT `cphone`,`cscore`,`cestimate`,`ctime`,`uphone`,`umname`,`uimg`,`uclass` FROM `coursetmt`,`user` WHERE `course` = '".$course."' AND `cphone` = `uphone`";

$result = $conn->query($sql);

$info = array();

while ($rows = $result->fetch_assoc()) {
    $info[] = $rows;
}

echo json_encode($info);