<!DOCTYPE=html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>mission_3-3-2</title>
</head>
<body>

<h1>Leave Comments</h1>
<form action="mission_3-3-2.php" method="post">
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
<br/>
</form>
<form action="mission_3-3-2.php" method="post">
  <div>
    <label for="delete">削除対象番号:</label>
    <input type="text" name="delete">
    <br/>
    <button type="submit">削除</button>
  </div>
</form>
<hr/>
</body>
</html>

<?php

//書き出し用ファイル
$filename = "mission_3-3-2.txt";

	//データがない場合は表示しないようにする
	if (isset($_POST['comment']) === true) {


		//名前受け取り用の変数を作成
		$name = $_POST['name'];

		//コメント受け取り用の変数を作成
		$comment = $_POST['comment'];

		//書き出し設定
		$fp = fopen($filename, "a");

		//読み出し設定
		$fr = fopen($filename, "r+");

		//投稿番号決定
	  $lines = file($filename);
	  $count = 0;

	  foreach($lines as $line){
	    $portion = explode("<>", $line);
	    if(intval($portion[0]) > $count){
	      $count = $portion[0];
	    }
	  }
	  $postnumber = $count + 1;

		//ファイルに書き込み
		date_default_timezone_set('Asia/Tokyo');
		$date = date('Y/m/d H:i:s');
		fwrite($fp, $postnumber."<>".$name."<>".$comment."<>".$date.PHP_EOL);
		fclose($fp);
	}

	//削除処理
	if(isset($_POST["delete"]) === true){

    //削除指定番号の受け取り
    $delete = $_POST["delete"];

    //ファイルを一行ずつ配列に書き出し
    $delCon = file($filename);

    //新たな書き出しの決定
    $fp = fopen($filename, "w");

    //ループ: 行数の数だけ繰り返す
    for($i = 0; $i < count($delCon); $i++){

      //一行の各要素を<>を区切りに配列に入れる
      $delDate = explode("<>", $delCon[$i]);

      //条件分岐: 削除指定番号と一致しなければ、その行を新たに書き出す
      if($delDate[0] != $delete){
        fwrite($fp, $delCon[$i]);
      }
    }
    fclose($fp);
  }

	//表示処理
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
		echo "<br/>";
	}
?>
