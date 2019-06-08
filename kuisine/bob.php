<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<p align = "center">혼밥이 가능한 식당들이에요. 메뉴가 궁금하시다면 지금 식당이름으로 검색해보세요!</p>
<div class="container">
	<?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from res where alone = '가능'";
    $ans = mysqli_query($conn, $query);
    if (!$ans) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>식당 이름</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($ans)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='res_view.php?res_no={$row['res_no']}'>{$row['res_name']}</td>";
            echo "<td width='20%'>
                <a href='res_form.php?res_no={$row['res_no']}'><button class='button primary small'>수정</button></a>
                <button onclick = \"javascript:deleteConfirm('{$row['res_no']}')\" class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(res_no) {
            if (confirm("정말 삭제 하시겠습니까??") == true){    //확인
                window.location = "res_delete.php?res_no=" + res_no;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>