<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$user_no = $_GET['user_no'];

$ret = mysqli_query($conn, "delete from user where user_no = $user_no");

if(!$ret)
{
    msg('유저의 이름으로 등록된 메뉴가 있어 유저를 삭제할 수 없습니다') ;
}
else
{
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=user_list.php'>";
}

?>
