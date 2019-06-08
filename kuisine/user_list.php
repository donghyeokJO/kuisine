<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
	<?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from user group by user_name";
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>사용자 이름</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='user_view.php?user_no={$row['user_no']}'>{$row['user_name']}</td>";
            echo "<td width='20%'>
                <a href='user_form.php?user_no={$row['user_no']}'><button class='button primary small'>수정</button></a>
                <button onclick = \"javascript:deleteConfirm('{$row['user_no']}')\" class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(user_no) {
            if (confirm("정말 삭제 하시겠습니까??") == true){    //확인
                window.location = "user_delete.php?user_no=" + user_no;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>