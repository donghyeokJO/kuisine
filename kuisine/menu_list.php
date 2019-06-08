<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
	<?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from (((menu natural join res)natural join location) natural join user) natural join food natural join var";
    
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where menu_name like '%$search_keyword%' or res_name like '%$search_keyword%' or lo_name like '%$search_keyword%' or type_name like '%$search_keyword%' or type_name2 like '%$search_keyword%' or user_name like '%$search_keyword%'";
    
    }
    $ans = mysqli_query($conn, $query);
    if (!$ans) {
         die('Query Error : ' . mysqli_error());
    }
    
    ?>
	<h3><p align = "center"><a href = 'most.php'>****추천 top 5보기****</a></p></h3>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>메뉴 이름</th>
            <th>식당 이름</th>
            <th>추천 수</th>
            <th>등록한 사람</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($ans)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='menu_view.php?menu_no={$row['menu_no']}'>{$row['menu_name']}</td>";
            echo "<td>{$row['res_name']}</td>";
            echo "<td>{$row['thumbs']}</td>";
            echo "<td>{$row['user_name']}</td>";
            echo "<td width='20%'>
                <a href='menu_form.php?menu_no={$row['menu_no']}'><button class='button primary small'>수정</button></a>
                <button onclick = \"javascript:deleteConfirm('{$row['menu_no']}')\" class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(menu_no) {
            if (confirm("정말 삭제 하시겠습니까??") == true){    //확인
                window.location = "menu_delete.php?menu_no=" + menu_no;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>