<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
	<?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from (((menu natural join res)natural join location) natural join user) natural join food order by thumbs desc limit 5";
    
    $ans = mysqli_query($conn, $query);
    if (!$ans) {
         die('Query Error : ' . mysqli_error());
    }
    
    ?>
	<span style="color=red"><p align = "center">추천 Top5! 꼭 한번 드셔보세요</p></span>
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
    <p align="center"><a href='menu_list.php'><button class='button primary small'>돌아가기!</button></a></p>
</div>
<? include("footer.php") ?>