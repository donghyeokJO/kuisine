.<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$menu_name = $_POST['menu_name'];
$user_no = $_POST['user_no'];
$res_no = $_POST['res_no'];
$type = $_POST['type'];
$price = $_POST['price'];
$eval = $_POST['eval'];

$ret = mysqli_query($conn, "update menu set menu_name = '$menu_name', res_no = '$res_no', user_no = '$user_no', type = '$type', price = '$price', eval = '$eval' where res_no = $res_no");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=menu_list.php'>";
}

?>
