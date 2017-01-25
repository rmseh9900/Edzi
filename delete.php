<?php
	require_once("dbconfig.php");

	//$_GET['bno']이 있어야만 글삭제가 가능함.
	if(isset($_GET['bno'])) {
		$bNo = $_GET['bno'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>후기게시판 | The Edzi</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/delete.css">
	<link href="css/Header.css" rel="stylesheet">
    <link href="css/Footer.css" rel="stylesheet">
    <link href="css/TheEdzi.css" rel="stylesheet">
	<script src="js/jquery-2.1.3.min.js"></script>
</head>
<body>
    <header>
        <div id="logobar">
            <a id="logo" href="#">The Edzi</a>
            <div id="monotext">본 페이지는 포트폴리오용으로 제작한 사이트입니다</div>
        </div>
    </header>
    
	<article class="boardArticle">
		<h3>후기게시판</h3>
		<?php
			if(isset($bNo)) {
				$sql = 'select count(b_no) as cnt from board_free where b_no = ' . $bNo;
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
				if(empty($row['cnt'])) {
		?>
		<script>
			alert('글이 존재하지 않습니다.');
			history.back();
		</script>
		<?php
			exit;
				}
				$sql = 'select b_title from board_free where b_no = ' . $bNo;
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
		?>
		<div id="boardDelete">
			<form action="./delete_update.php" method="post">
				<input type="hidden" name="bno" value="<?php echo $bNo?>">
				<table>
					<thead>
						<tr>
							<th scope="col" colspan="2">글삭제</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">글 제목</th>
							<td><?php echo $row['b_title']?></td>
						</tr>
						<tr>
							<th scope="row"><label for="bPassword">비밀번호</label></th>
							<td><input type="password" name="bPassword" id="bPassword"></td>
						</tr>
					</tbody>
				</table>

				<div class="btnSet">
					<button type="submit" class="btnSubmit btn">삭제</button>
					<a href="index.php" class="btnList btn">목록</a>
				</div>
			</form>
		</div>
	<?php
		//$bno이 없다면 삭제 실패
		} else {
	?>
		<script>
			alert('정상적인 경로를 이용해주세요.');
			history.back();
		</script>
	<?php
			exit;
		}
	?>
	</article>
	
	<footer>
        <span>
            <hr>
            <h1>INFORMATION</h1>
        </span>
        <address>
            본 페이지는 포트폴리오용으로 제작된 페이지입니다.<br>
            제작자 e-mail<br>
            김진형 : dmdnt11@naver.com<br>
            송근도 : rmseh9900@naver.com
        </address>
    </footer>
</body>
</html>