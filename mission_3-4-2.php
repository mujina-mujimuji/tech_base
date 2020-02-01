<!DOCTYPE=html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>mission_3-4-2</title>
</head>
<body>

<?php
  //書き出し用ファイル
  $filename = "mission_3-4-2.txt";
?>


<h1>Leave Comments</h1>
<form action="mission_3-4-2.php" method="post">
	<div>
		<label for="name">Name:</label>
		<input type="text" name="name" value="名前">
	</div>
	<div>
		<label for="comment">Comment:</label>
		<input type="text" name="comment" value="コメント">
	</div>
  <div>
	<div class="button">
		<button type="submit" name="submit">送信</button>
	</div>
</form>

<?php   //新規投稿
	//データがない場合は表示しないようにする
  if (isset($_POST['comment']) === true){


		//名前受け取り用の変数を作成
		$name = $_POST['name'];

		//コメント受け取り用の変数を作成
		$comment = $_POST['comment'];

		//書き出し設定
		$fp = fopen($filename, "a");

		//読み出し設定
		$fr = fopen($filename, "r+");


    $lines = file($filename);

    $count = 0;

    //行数カウント、投稿番号決定
    foreach($lines as $gyo){
      $portion = explode("<>", $gyo);
      if(intval($portion[0]) > $count){
        $count = $portion[0];
      }
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
		}
  ?>

<form action="mission_3-4-2.php" method="post">
  <div>
    <label for="delete">削除対象番号:</label>
    <input type="text" name="delete">
  </div>
  <div class="button">
    <button type="submit">削除</button>
  </div>
</form>

<?php   //削除処理
  if(isset($_POST["delete"]) === true){

    //削除指定番号の受け取り
    $delete = $_POST["delete"];

    //ファイルを一行ずつ配列に書き出し
    $del_para = file($filename);

    //新たな書き出しの決定
    $fp = fopen($filename, "w");

    //ループ: 行数の数だけ繰り返す
    for($i = 0; $i < count($del_para); $i++){

      //一行の各要素を<>を区切りに配列に入れる
      $del_line = explode("<>", $del_para[$i]);

      //条件分岐: 削除指定番号と一致しなければ、その行を新たに書き出す
      if($del_line[0] != $delete){
        fwrite($fp, $del_para[$i]);
  //    }else{
  //      fwrite($fo, "消去しました".PHP_EOL);
      }
    }
    fclose($fp);
  }
?>

<?php
  if(isset($_POST["submit"]) && isset($_POST["id"])){
    //編集処理

    $contents = file($filename);
    $fp1 = fopen($filename, "w");

    //編集番号の受け取り
    $edit_num = $_POST["id"];

    foreach($contents as $content){
      $parts = explode("<>", $content);
      if($parts[0] == $edit_num){
        $name = $_POST["name"];
        $comment = $_POST["comment"];
        $timestamp = date('Y/m/d/ H:i:s');
        fwrite($fp1, $edit_num."<>".$name."<>".$comment."<>".$timestamp.PHP_EOL);
      }else{
        fwrite($fp1, $content);
      }
    }
    fclose($fp1);
  }
?>
<?php
 //表示
  $contents = file($filename);
  foreach($contents as $content){
    $parts = explode("<>",$content);
    foreach($parts as $part){
      echo $part." ";
    }
    echo "<br/>";
  }
 ?>

<p>---------------------</p>
<form action="mission_3-4-2.php" method="post">
  <div>
    <label for="edit">編集対象番号:</label>
    <input type="text" name="edit_num">
  </div>
  <div class="button">
    <button type="submit" name="edit_btn">編集</button>
    <input type="hidden" name="edit" value="hensyu">
  </div>
</form>

<?php
  if(isset($_POST["edit_btn"])){ //編集ボタンが押されたら
    if($_POST["edit_num"]){
      $edit_num = $_POST["edit_num"];
      foreach($contents as $content){
        $parts = explode("<>", $content);
        if($parts[0] == $edit_num){
?>

<form action="mission_3-4-2.php" method="post">
  <input type="hidden" name="id" value="<? =$parts[0] ?>">
  <div>
    <label for="name">Name:</label>
    <input type="text" name="name" value="<? =$parts[1] ?>">
  </div>
  <div>
    <label for="comment">Comment:</label>
    <input type="text" name="comment" value="<? =$parts[2] ?>">
  </div>
  <div class="button">
    <button type="submit" name="submit">送信</button>
  </div>
  </form>

<?php
      }
    }
  } else {
    echo "編集番号を入力してください!";
  }
}
?>


</body>
</html>
