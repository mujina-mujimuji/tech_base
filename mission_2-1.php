<!DOCTYPE=html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>mission_2-1</title>
</head>
<body>
<h1>フォーム</h1>
<form action="mission_2-1.php" method="post">
<input type="text" name="comment" value="コメント">
<input type="submit" value="投稿">
<hr/>
</form>
</body>
</html>

<?php
	$comment = $_POST["comment"];
	echo "「".$comment."」(送信内容)を受け付けました";
	echo "<br>";
	?>
