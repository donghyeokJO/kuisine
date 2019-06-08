<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "menu_insert.php";

if (array_key_exists("menu_no", $_GET)) {
    $menu_no = $_GET["menu_no"];
    $query =  "select * from menu where menu_no = $menu_no";
    $ans = mysqli_query($conn, $query);
    $menu = mysqli_fetch_array($ans);
    if(!$menu) {
        msg("세상에나 메뉴가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "menu_modify.php";
    
 
}

$type = array();

$query = "select * from food";    

$user = array();
$query2 = "select * from user group by user_name";

$restau = array();
$query3 = "select * from res group by res_name";

$res1 = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res1)) {
    $type[$row['type']] = $row['type_name'];
}

$res2 = mysqli_query($conn, $query2);
while($row = mysqli_fetch_array($res2)) {
    $user[$row['user_no']] = $row['user_name'];
}

$res3 = mysqli_query($conn, $query3);
while($row = mysqli_fetch_array($res3)) {
    $restau[$row['res_no']] = $row['res_name'];
}

?>
    <div class="container">
        <form name="menu_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" id = "menu_no" name="menu_no" value="<?=$menu['menu_no']?>"/>
            <h3>메뉴 정보 <?=$mode?></h3>
      
            <p>
                <label for="menu_name">메뉴 이름</label>
                <input type="text" 메뉴 이름 입력 id="menu_name" name="menu_name" value="<?=$menu['menu_name']?>"/>
            </p>
             <p>
                <label for="user_no">이름이 무엇인가요?</label>
                <select name="user_no" id="user_no">
                    <option value="-1">선택해주세요. 본인의 이름이 없다면 먼저 등록해주세요:)</option>
                    <?
                        foreach($user as $id => $name) {
                            if($id == $menu['user_no']){
                                echo "<option value='{$id}'>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="res_no">어디 식당 음식인가요?</label>
                <select name="res_no" id="res_no">
                    <option value="-1">선택해주세요. 원하는 식당이 없다면 먼저 등록해주세요:)</option>
                    <?
                        foreach($restau as $id => $name) {
                            if($id == $menu['res_no']){
                                echo "<option value='{$id}'>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
             <p>
                <label for="type">어느나라 음식인가요?</label>
                <select name="type" id="type">
                    <option value="-1">선택해주세요</option>
                    <?
                        foreach($type as $id => $name) {
                            if($id == $menu['type']){
                                echo "<option value='{$id}'>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
             <p>
                <label for="price">가격(원은 빼고 입력해주세요!) </label>
                <input type="number" 가격 입력 id="price" name="price" value="<?=$menu['price']?>"/>
            </p>
			 <p>
                <label for="eval">메뉴 평가</label>
                <textarea placeholder="메뉴를 평가해 주세요! 한 글자라도 적어주세요. 빈칸은 안돼요 :)" id="eval" name="eval" rows="10"><?=$menu['eval']?></textarea>
            </p>
            
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("menu_name").value == "") {
                        alert ("메뉴 이름을 입력해 주세요"); return false;
                    }
                     else if(document.getElementById("user_no").value == "-1" ) {
                        alert ("누구신지 선택해 주세요!"); return false;
                    }
                     else if(document.getElementById("res_no").value == "-1" ) {
                        alert ("어느 식당 음식인지 선택해 주세요!"); return false;
                    }
                    else if(document.getElementById("type").value == "-1") {
                        alert ("어느 나라 음식인지 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("price").value == "" ) {
                        alert ("메뉴의 가격을 입력해 주세요!"); return false;
                    }
                    else if(document.getElementById("eval").value == "-1") {
                        alert ("메뉴를 평가해 주세요!"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>