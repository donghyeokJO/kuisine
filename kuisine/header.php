<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>KUISINE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="menu_list.php" method="post">
    <div class='navbar fixed'>
        <div class='container'>
        	<a class='pull-left title' href="index.php">KUISINE</a>
            <ul class='pull-right'>
            	<li>
                    <input type="text" name="search_keyword" placeholder="KUISINE 통합검색">
                </li>
            	<li><a href = 'intro.php'>서비스 소개</a> </li>
            	<li><a href='bob.php'>혼밥의 전당</a></li>
                <li><a href='user_list.php'>사용자 목록</a></li>
                <li><a href='user_form.php'>사용자 등록</a></li>
                <li><a href='res_list.php'>식당 목록</a></li>
                <li><a href='res_form.php'>식당 등록</a></li>
                <li><a href='menu_list.php'>메뉴 목록</a></li>
                <li><a href='menu_form.php'>메뉴 등록</a></li>
            </ul>
        </div>
    </div>
</form>
