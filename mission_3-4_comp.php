<!DOCTYPE=html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>mission_3-4_comp</title>
</head>
<body>

<?php
  //書き出し用ファイル
  $filename = "mission_3-4_comp.txt";

  //タイムゾーン設定
  date_default_timezone_set("Asia/Tokyo");

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
  ?>

<?php
if(!empty($_POST["edit"])){
  $edit=$_POST["edit"]; //編集機能フォーム
  $contents_edit = file($filename);
  $fp2 = fopen($filename, "r"); //rでいいのか？
  foreach($contents_edit as $value){
   $edit_line = explode("<>",$value);
   if($edit_line[0]==$edit){//投稿番号と編集番号が一致
      $edit_num=$edit_line[0];//番号
      $edit_name=$edit_line[1];//名前
      $edit_com=$edit_line[2];//テキスト
    }
  }
}
?>

<h1>Leave Comments</h1>
<form action="mission_3-4_comp.php" method="post">
  <div>
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php if(!empty($edit_name)){echo $edit_name;}?>">
  </div>
  <div>
    <label for="comment">Comment:</label>
    <input type="text" name="comment" value="<?php if(!empty($edit_com)){echo $edit_com;}?>">
   <input type="hidden" name="e_judge" value="<?php if(!empty($edit)){echo $edit;}?>">
    </div>
  <div>
  <div class="button">
    <button type="submit" name="submit">送信</button>
  </div>
</form>
<br/>
<form action="mission_3-4_comp.php" method="post">
  <div>
    <label for="delete">削除対象番号:</label>
    <input type="text" name="delete">
  </div>
  <div class="button">
    <button type="submit">削除</button>
  </div>
</form>
<br/>
<form action="mission_3-4_comp.php" method="post">
  <div>
    <label for="edit">編集対象番号:</label>
    <input type="text" name="edit">
  </div>
  <div class="button">
    <button type="submit">編集</button>
  </div>
</form>
<br/>
</body>
</html>



<?php   //新規投稿処理
  if(isset($_POST["comment"]) && empty($_POST["e_judge"])){

    $fp1 = fopen($filename, "a");
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $date = date('Y/m/d/ H:i:s');
    fwrite($fp1, $postnumber."<>".$name."<>".$comment."<>".$date.PHP_EOL);
    fclose($fp1);
  }
  ?>

<?php  //削除処理
  if(isset($_POST["delete"]) === true){

    //削除指定番号の受け取り
    $delete = $_POST["delete"];

    //ファイルを一行ずつ配列に書き出し
    $del_contents = file($filename);

    //新たな書き出しの決定
    $fp3 = fopen($filename, "w");

  //ループ: 行数の数だけ繰り返す
  for($i = 0; $i < count($del_contents); $i++){

    //一行の各要素を<>を区切りに配列に入れる
    $del_line = explode("<>", $del_contents[$i]);

    //条件分岐: 削除指定番号と一致しなければ、その行を新たに書き出す
    if($del_line[0] != $delete){
      fwrite($fp3, $del_contents[$i]);
//    }else{
//      fwrite($fo, "消去しました".PHP_EOL);
      }
    }
  fclose($fp3);
}


if(!empty($_POST["e_judge"])){  //編集の追記であることを判定し、ファイルに再書き込み

  $contents = file($filename);
  $fp4 = fopen($filename, "w");
  $num = $_POST["e_judge"];

 foreach($contents as $content){
   $parts = explode("<>", $content);
   if($parts[0] == $num){
     $name = $_POST["name"];
     $comment = $_POST["comment"];
     $timestamp = date('Y/m/d/ H:i:s');
     fwrite($fp4, $num."<>".$name."<>".$comment."<>".$timestamp.PHP_EOL);
   }else{
      fwrite($fp4, $content);
     }
   }
  fclose($fp4);
  }

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
