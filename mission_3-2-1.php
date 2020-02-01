<!DOCTYPE=html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>mission_3-2-1</title>
</head>
<body>

<h1>Leave Comments</h1>
<form action="mission_3-2-1.php" method="post">
	<div>
		<label for="name">Name:</label>
		<input type="text" name="name" value="名前">
	</div>
	<div>
		<label for="comment">Comment:</label>
		<input type="text" name="comment" value="コメント">
	</div>
	<div class="button">	
		<button type="submit">送信</button>
	</div>
<hr/>
</form>
</body>
</html>

<?php
	//データがない場合は表示しないようにする
	if ( isset($_POST['comment']) === true) {
					
		//データが空白の場合に表示しないようにする
		if( !empty($_POST['comment'])){	
		
			//名前受け取り用の変数を作成
			$name = $_POST['name'];
			
			//コメント受け取り用の変数を作成
			$comment = $_POST['comment'];		
				
			//書き出し用ファイル
			$filename = "mission_3-2-1.txt";
			
			//書き出し設定
			$fp = fopen($filename, "a");
			
			//読み出し設定
			$fr = fopen($filename, "r+");

			//投稿番号のカウント
			$count = 0;
			while (fgets($fr) !== false){
				$count++;
			}			
			
			//投稿番号を加算する	
			$postnumber = $count + 1;
			
			//ファイルに書き込み
			date_default_timezone_set('Asia/Tokyo');
			fwrite($fp, $postnumber . "<>");
			fwrite($fp, $_POST['name'] . "<>" );
			fwrite($fp, $_POST['comment'] . "<>" );
			fwrite($fp, date('Y/m/d/ H:i:s') . PHP_EOL);			
			fclose($fp);
			
			//テキストファイルを配列に出力
			$array = file($filename);			//file()で一行ずつ出力、配列(array)に入れる
			
			//ループ処理(mission_3-2-3 ~ 3-2-4)
			foreach($array as $value){
				
				//読み込んだ文字列を<>を境に分割し、配列(line)に入れる
				$line = explode("<>", $value);
				
				//配列に入れた各要素を出力
				foreach($line as $moji){
					echo $moji." ";
				}
				//次の行を出力する前に改行
				echo "<br>";
			}
		}
	}
?>