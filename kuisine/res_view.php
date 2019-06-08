<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("res_no", $_GET)) {
    $res_no = $_GET["res_no"];
    $query = "select * from (res natural join location) natural join var where res_no = $res_no";
    $rest = mysqli_query($conn, $query);
    $res = mysqli_fetch_assoc($rest);
    if (!$res) {
        msg("식당이 존재하지 않습니다. 미국에 갔어요.");
    }
}
?>
    <div class="container fullwidth">

        <h3>식당의 정보 상세 보기</h3>

		<p>
            <label for="res_no">식당 고유번호</label>
            <input readonly type="text" id="res_no" name="res_no" value="<?= $res['res_no'] ?>"/>
        </p>
        <p>
            <label for="res_name">식당 이름</label>
            <input readonly type="text" id="res_name" name="res_name" value="<?= $res['res_name'] ?>"/>
        </p>

        <p>
            <label for="lo_name">식당의 위치</label>
            <input readonly type="text" id="lo_name" name="lo_name" value="<?= $res['lo_name'] ?>"/>
        </p>
        
        <p>
            <label for="type_name">식당 분류</label>
            <input readonly type="text" id="type_name" name="type_name" value="<?= $res['type_name2'] ?>"/>
        </p>
        
        <p>
            <label for="alone">혼밥 가능 여부</label>
            <input readonly type="text" id="alone" name="alone" value="<?= $res['alone'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>