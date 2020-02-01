<!DOCTYPE=html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>mission_2-3</title>
</head>
<body>
<h1>フォーム</h1>
<form action="mission_2-3.php" method="post">
<input type="text" name="comment" value="コメント">
<input type="submit" value="投稿">
<hr/>
</form>
</body>
</html>

<?php

	//データがない場合は処理をしないようにする
	if ( isset($_POST['comment']) === true) {
		
		//データが空白の場合も処理をしないようにする
		if( !empty($_POST['comment'])){
			
			//POST送信の場合は$_POST["name属性の値]で、GET送信の場合は$_GET[]で
			$comment = $_POST['comment'];
	
			//データを書き出すファイルを設定
			$filename = "mission_2-3.txt";
	
			//書き出しの設定
			$fp = fopen($filename, "a");
	
			//書き出す
			fwrite($fp, $comment."\r\n");
			fclose($fp);
	
			//表示
			$out = file_get_contents($filename);
			echo $out."<br/>";
		}
	}
?>