<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$res_name = $_POST['res_name'];
$lo_type = $_POST['lo_type'];
$alone= $_POST['alone'];
$type_name =$_POST['type_name'];

$res_type = $_POST['res_type'];

$ret = mysqli_query($conn, "insert into res (res_name, res_type,lo_type,alone) values('$res_name', '$res_type','$lo_type','$alone')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=res_list.php'>";
}

?>

