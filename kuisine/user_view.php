<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("user_no", $_GET)) {
    $user_no = $_GET["user_no"];
    $query = "select * from user where user_no = $user_no";
    $res = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($res);
    if (!$user) {
        msg("사용자가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>사용자 정보 상세 보기</h3>
		 <p>
            <label for="user_no">사용자 고유번호</label>
            <input readonly type="text" id="user_no" name="user_no" value="<?= $user['user_no'] ?>"/>
        </p>
        <p>
            <label for="user_name">사용자 이름</label>
            <input readonly type="text" id="user_name" name="user_name" value="<?= $user['user_name'] ?>"/>
        </p>

        <p>
            <label for="user_text">사용자 소개</label>
            <input readonly type="text" id="user_text" name="user_text" value="<?= $user['user_text'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>