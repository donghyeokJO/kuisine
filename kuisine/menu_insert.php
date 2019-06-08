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

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$query = "insert into menu (menu_name, res_no, user_no, type, price, eval) values('$menu_name', '$res_no', '$user_no','$type','$price','$eval')"; 

$ret = mysqli_query($conn, $query);
if(!$ret)
{
	mysqli_query($conn, "rollback"); // 메뉴 등록 query 수행 실패. 수행 전으로 rollback
    alert_msg('Query Error : '.mysqli_error($conn));
}
else
{
	$menu_no = mysqli_insert_id($conn);
	mysqli_query($conn, "commit"); // 메뉴 등록 query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=menu_list.php'>";
}

?>

