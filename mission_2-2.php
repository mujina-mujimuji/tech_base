<!DOCTYPE=html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>mission_2-2</title>
</head>
<body>
<h1>フォーム</h1>
<form action="mission_2-2.php" method="post">
<input type="text" name="comment" value="コメント">
<input type="submit" value="投稿">
<hr/>
</form>


<?php
	//POST送信の場合は$_POST["name属性の値]で、GET送信の場合は$_GET[]で
	$comment = $_POST['comment'];
	
	//データを書き出すファイルを設定
	$filename = "mission_2-2.txt";
	
	//書き出しの設定
	$fp = fopen($filename, "w");
	
	//書き出す
	fwrite($fp, $comment);
	fclose($fp);
	
	//表示
	$out = file_get_contents($filename);
	echo $out;
	?>
</body>
</html>