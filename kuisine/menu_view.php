<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);



if (array_key_exists("menu_no", $_GET)) {
    $menu_no = $_GET["menu_no"];
    $query = "select * from (((menu natural join res)natural join location) natural join user) natural join food where menu_no = $menu_no";
    $rest = mysqli_query($conn, $query);
    $menu = mysqli_fetch_assoc($rest);
    if (!$menu) {
        msg("메뉴가 존재하지 않습니다. 미국에 갔어요.");
    }
}
?>

    <div class="container fullwidth">
    	

        <h3>메뉴의 정보 상세 보기</h3>
		
        <p>
            <label for="menu_name">메뉴 이름</label>
            <input readonly type="text" id="menu_name" name="menu_name" value="<?= $menu['menu_name'] ?>"/>
        </p>
		<p>
            <label for="res_name">식당의 이름</label>
            <input readonly type="text" id="res_name" name="res_name" value="<?= $menu['res_name'] ?>"/>
        </p>
        <p>
            <label for="lo_name">식당의 위치</label>
            <input readonly type="text" id="lo_name" name="lo_name" value="<?= $menu['lo_name'] ?>"/>
        </p>
        
        <p>
            <label for="user_name">사용자 이름</label>
            <input readonly type="text" id="user_name" name="user_name" value="<?= $menu['user_name'] ?>"/>
        </p>
        <p>
            <label for="type_name">음식 종류</label>
            <input readonly type="text" id="type_name" name="type_name" value="<?= $menu['type_name'] ?>"/>
        </p>
        <p>
            <label for="price">음식 가격</label>
            <input readonly type="number" id="price" name="price" value="<?= $menu['price'] ?>"/>
        </p>
        <p>
            <label for="thumbs">추천 수</label>
            <input readonly type="number" id="thumbs" name="thumbs" value="<?= $menu['thumbs'] ?>"/>
        </p>
         <p>
            <label for="eval">메뉴 평가</label>
            <input readonly type="text" id="eval" name="eval" value="<?= $menu['eval'] ?>"/>
        </p>
    </div>
    <p align="center">
    	<a href = "thumbs_up.php?menu_no=<?=$menu['menu_no']?>"/>
	    	<button class="button danger small">
	    		<?="추천하기!"?>
	    	</button>
	</p>
    <p align="center"><a href='menu_list.php'><button class='button primary small'>돌아가기!</button></a></p>
<? include("footer.php") ?>