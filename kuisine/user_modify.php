.<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$user_name = $_POST['user_name'];
$user_text = $_POST['user_text'];
$user_no = $_POST['user_no'];

$ret = mysqli_query($conn, "update user set user_name = '$user_name', user_text = '$user_text' where user_no = $user_no");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=user_list.php'>";
}

?>

