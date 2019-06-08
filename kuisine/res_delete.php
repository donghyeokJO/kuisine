<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$res_no = $_GET['res_no'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "delete from res where res_no = $res_no");

if(!$ret)
{
    mysqli_query($conn, "rollback"); // 식당 삭제 query 수행 실패. 수행 전으로 rollback
    msg('식당의 메뉴로 등록되어 있는 음식이 있어서 식당을 삭제할 수 없습니다!');
}
else
{
	mysqli_query($conn,"commit"); //식당 삭제 query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=res_list.php'>";
}

?>
