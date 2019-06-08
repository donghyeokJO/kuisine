<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$res_name = $_POST['res_name'];
$lo_type = $_POST['lo_type'];
$alone= $_POST['alone'];
$type_name =$_POST['type_name'];

$res_type = $_POST['res_type'];


mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "insert into res (res_name, res_type,lo_type,alone) values('$res_name', '$res_type','$lo_type','$alone')");

if(!$ret)
{
	mysqli_query($conn,"rollback"); //식당 등록 query 수행 실패, 수행전으로 rollback
	echo mysqli_error($conn);
    msg('잘못된 요정입니다.중복된 식당인지 확인해주세요');
}
else
{
	mysqli_query($conn,"commit"); //식당 등록 query 수행 성공, 수행 내역 commit
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=res_list.php'>";
}

?>

