<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$user_no = $_GET['user_no'];


mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "delete from user where user_no = $user_no");

if(!$ret)
{
	mysqli_query($conn,"rollback"); //유저 삭제 query수행 실패, 수행 전으로 rollback
    msg('유저의 이름으로 등록된 메뉴가 있어 유저를 삭제할 수 없습니다') ;
}
else
{
	mysqli_query($conn,"commit"); //유저 삭제 qeury수행 성공, 수행 내역 commit
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=user_list.php'>";
}

?>
