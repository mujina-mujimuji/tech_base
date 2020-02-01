<!DOCTYPE=html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>mission_2-2-3</title>
</head>
<body>
<h1>フォーム</h1>
<form action="mission_2-2-3.php" method="post">
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
			$filename = "mission_2-2-3.txt";
	
			//書き出しの設定
			$fp = fopen($filename, "w");
	
			//書き出す
			fwrite($fp, $comment);
			fclose($fp);
	
			//表示
			$out = file_get_contents($filename);
			
			//内容によって反応を分岐する
			if($out == "ここがネットの海に隠されきた、例の「組織」の秘密のページか..."){
				echo "気づいてしまったか。悪いが貴様には消えてもらおう";
			}elseif($out == "山"){
				echo "川<br/>";
			}elseif($out == "誰が作ったの？"){
				echo "ノザキです";
			}else{
				echo $out."(送信内容)を受け取りました。<br/>";
			}
		}
	}
?>