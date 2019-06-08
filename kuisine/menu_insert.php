<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$menu_name = $_POST['menu_name'];
$price = $_POST['price'];
$eval = $_POST['eval'];
$type =$_POST['type'];

$res_no = $_POST['res_no'];
$user_no = $_POST['user_no'];



$ret = mysqli_query($conn, "insert into menu (menu_name, res_no, user_no, type, price, eval) values('$menu_name', '$res_no', '$user_no','$type','$price','$eval')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=menu_list.php'>";
}

?>

