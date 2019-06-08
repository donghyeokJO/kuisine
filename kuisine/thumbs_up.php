<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);


if (array_key_exists("menu_no", $_GET)) {
    $menu_no = $_GET["menu_no"];
    $query = "select * from menu where menu_no = $menu_no";
    $rest = mysqli_query($conn, $query);
    $menu = mysqli_fetch_assoc($rest);
    if (!$menu) {
        msg("메뉴가 존재하지 않습니다. 미국에 갔어요.");
    }
}

$num = $menu['thumbs']+1;
$menu_no = $menu['menu_no'];
$query ="update menu set thumbs = '$num' where menu_no = $menu_no";
$ret = mysqli_query($conn, $query);
if(!$ret)	
{
	msg('세상에 이건 무슨 오류인지 저도 모르겠네요');
}
else
{
	s_msg ('추천을 눌렀습니다!');
	echo "<meta http-equiv='refresh' content='0;url=menu_list.php'>";
}
	

?>