<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$user_name = $_POST['user_name'];
$user_text = $_POST['user_text'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "insert into user (user_name, user_text) values('$user_name', '$user_text')");
if(!$ret)
{
	mysqli_query($conn,"rollback"); //사용자 등록 query수행 실패, 수행 전으로 rollback
	echo mysqli_error($conn);
    msg('잘못된 요청입니다. 중복된 이름인지 확인해주세요'); //중복된 이름 등록할 수 없도록 user_name도 unique key로 변경해줌
}
else
{
	mysqli_query($conn,"commit"); //사용자 등록 query 수행 성공, 수행 내역 commit
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=user_list.php'>";
}

?>

