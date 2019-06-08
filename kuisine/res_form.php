<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "res_insert.php";

if (array_key_exists("res_no", $_GET)) {
    $res_no = $_GET["res_no"];
    $query =  "select * from res where res_no = $res_no " ;
    $ans = mysqli_query($conn, $query);
    $res = mysqli_fetch_array($ans);
    if(!$res) {
        msg("식당이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "res_modify.php";
    
 
}

$lo_type = array();
$res_type = array();

$query = "select * from location";    



$res1 = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res1)) {
    $lo_type[$row['lo_type']] = $row['lo_name'];
}

$query2 = "select * from var";

$res2 = mysqli_query($conn, $query2);
while($row = mysqli_fetch_array($res2)) {
    $res_type[$row['res_type']] = $row['type_name2'];
}


$alone = array("가능","불가능");

?>
    <div class="container">
        <form name="res_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" id = "res_no" name="res_no" value="<?=$res['res_no']?>"/>
            <p align = "center">중복된 이름은 가질 수 없습니다. 입력해도 db에 영향을 미치지 않아요 :)</p>
        	<br>
            <h3>식당 정보 <?=$mode?></h3>
      
            <p>
                <label for="res_name">식당 이름</label>
                <input type="text" 식당명 입력 id="res_name" name="res_name" value="<?=$res['res_name']?>"/>
            </p>
            <p>
                <label for="lo_type">식당 위치</label>
                <select name="lo_type" id="lo_type">
                    <option value="-1">선택해주세요</option>
                    <?
                        foreach($lo_type as $id => $name) {
                            if($id == $res['lo_type']){
                                echo "<option value='{$id}'>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="res_type">식당 타입</label>
                <select name="res_type" id="res_type">
                    <option value="-1" selected>선택해주세요.</option>
                    <?
                        foreach($res_type as $id => $name) {
                            if($id == $res['res_type']){
                               echo "<option value='{$id}'>{$name}</option>";
                            } else {
                               echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
            	<label for="alone">혼밥 가능 여부</label>
                <select name="alone" id="alone">
                    <option value="-1">선택해주세요.</option>
                    <?
                        foreach($alone as $id => $name) {
                            if($id == $res['alone']){
                               echo "<option value='{$alone[$id]}'>{$name}</option>";
                            } else {
                               echo "<option value='{$alone[$id]}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
                
            </p>
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("lo_type").value == "-1") {
                        alert ("식당 위치를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("res_name").value == "") {
                        alert ("식당 이름을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("res_type").value == "-1") {
                        alert ("식당 타입을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("res_type").value == "-1") {
                        alert ("혼밥 가능 여부를 선택해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>