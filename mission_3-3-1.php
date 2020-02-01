<!DOCTYPE=html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>mission_3-3-1</title>
</head>
<body>

<h1>Leave Comments</h1>
<form action="mission_3-3-1.php" method="post">
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
</form>
<br/>

<h2>削除番号指定用フォーム</h2>
<form action="mission_3-3-1.php" method="post">
	<div>
		<label for="title">削除対象番号:</label>
		<input type="text" name="number">
	</div>
	<div class="button">
		<button type="submit">削除</button>
	</div>
</form>
<hr/>

</body>
</html>

<?php				
	//書き出し用ファイル
	$filename = "mission_3-3-1.txt";
			
	//書き出し設定
	$fp = fopen($filename, "a");
			
	//読み出し設定
	$fr = fopen($filename, "r+");

	//上書き設定
	$ow = fopen($filename, "w");

	//データがない場合は表示しないようにする
	if ( isset($_POST['comment']) === true) {
					
		//データが空白の場合に表示しないようにする
		if( !empty($_POST['comment'])){	
		
			//投稿番号のカウント
			$count = 0;
			while (fgets($fr) !== false){
				$count++;
			}	
			
			//投稿番号を加算する	
			$postnumber = $count + 1;		
			
			//名前受け取り用の変数を作成
			$name = $_POST['name'];
			
			//コメント受け取り用の変数を作成
			$comment = $_POST['comment'];		
			
			//ファイルに書き込み
			date_default_timezone_set('Asia/Tokyo');
			fwrite($fp, $postnumber . "<>");
			fwrite($fp, $name. "<>" );
			fwrite($fp, $comment. "<>" );
			fwrite($fp, date('Y/m/d/ H:i:s') . PHP_EOL);			
			fclose($fp);
			
			//テキストファイルを配列に出力
			$array = file($filename);			//file()で一行ずつ出力
			
			//ループ処理(mission_3-2-3 ~ 3-2-4)
			foreach($array as $value){
				
				//読み込んだ文字列を<>を境に分割し、配列に入れる
				$line = explode("<>", $value);
				
				//配列に入れた各要素を出力
				foreach($line as $moji){
					echo $moji." ";
				}
				//次の行を出力する前に改行(書き込み時のPHP_EOLがまだ有効なら不要)
				echo "<br>";
			}
		}
		
	//削除指定フォームの処理
	}elseif(isset($_POST['number']) === true) {		//データがなければ処理しない
					
		//データが空白の場合に表示しないようにする
		if( !empty($_POST['number'])){
			
			//削除対象番号を受信
			$number = $_POST['number'];
			
			//テキストファイルを配列に出力
			$array = file($filename);			//file()で一行ずつ出力
			
			//ループ処理(mission_3-3-4)
			foreach($array as $value){
				
				//読み込んだ文字列を<>を境に分割し、配列に入れる
				$line = explode("<>", $value);		
				
				//条件分岐: 削除指定番号が一致しない場合のみ書き込み
				if($number != $line[0]){
					
					//投稿番号のカウント
					$count = 0;
					while (fgets($fr) !== false){
					$count++;
					}	
			
					//投稿番号を加算する	
					$postnumber = $count + 1;					
					$name = $line[1];
					$comment = $line[2];
								
					//ファイルに上書き
					fwrite($ow,"");
					date_default_timezone_set('Asia/Tokyo');
					fwrite($fp, $postnumber . "<>");
					fwrite($fp, $name. "<>" );
					fwrite($fp, $comment. "<>" );
					fwrite($fp, date('Y/m/d/ H:i:s') . PHP_EOL);			
					fclose($fp);
					}
					
					//テキストファイルを配列に出力
					$array = file($filename);			//file()で一行ずつ出力
			
					//ループ処理(mission_3-2-3 ~ 3-2-4)
					foreach($array as $value){
				
						//読み込んだ文字列を<>を境に分割し、配列に入れる
						$line = explode("<>", $value);
				
						//配列に入れた各要素を出力
						foreach($line as $moji){
							echo $moji." ";
						}
					}
				}
			}	
		}
	?>