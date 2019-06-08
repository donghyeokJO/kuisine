<?

include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수


$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "user_insert.php";
if (array_key_exists("user_no", $_GET)) {
    $user_no = $_GET["user_no"];
    $query =  "select * from user where user_no = $user_no";
    $res = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($res);
    if(!$user) {
        msg("사용자가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "user_modify.php";
}

?>

    <div class="container">
        <form name="user_form" action="<?=$action?>" method="post" class="fullwidth">
        	<input type = "hidden" id = "user_no" name = "user_no" value="<?=$user['user_no']?>"/>
        	<p align = "center">중복된 이름은 가질 수 없습니다. </p>
        	<br>
        	<h3>사용자 정보 <?=$mode?></h3>
            <p>
                <label for="user_name">사용자 이름(최대 20글자 입니다)</label>
                <input type="text" id="user_name" name="user_name" value="<?=$user['user_name']?>"/>
            </p>
            <p>
                <label for="user_text">사용자 소개</label>
                <textarea placeholder="자신을 소개해주세요. 빈칸으로 남겨두셔도 괜찮아요:)" id="user_text" name="user_text" rows="10"><?=$user['user_text']?></textarea>
            </p>
           

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("user_name").value == "") {
                        alert ("사용자 이름을 입력해 주세요"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>