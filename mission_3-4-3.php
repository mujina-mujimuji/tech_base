<!DOCTYPE=html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>mission_3-4-3</title>
</head>
<body>

<?php
  //書き出し用ファイル
  $filename = "mission_3-4-3.txt";

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

<?php   //新規投稿処理
  if(isset($_POST["comment"])){

    $fp = fopen($filename, "a");
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $date = date('Y/m/d/ H:i:s');
    fwrite($fp, $postnumber."<>".$name."<>".$comment."<>".$date.PHP_EOL);
    fclose($fp);
  }
 ?>

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


 <?php //編集処理
    if(isset($_POST["edit_btn"]) && ($_POST["name"])){

      $contents = file($filename);
      $fp = fopen($filename, "w");

      //編集番号の受け取り
      $edit_num = $_POST["edit_num"];

      foreach($contents as $content){
        $parts = explode("<>", $content);

        if($parts[0] == $edit_num){
          $name = $_POST["name"];
          $comment = $_POST["comment"];
          $date = date('Y/m/d/ H:i:s');

            }
          }
        }
  ?>

 <h1>Leave Comments</h1>
 <form action="mission_3-4-3.php" method="post">
   <div>
     <label for="name">Name:</label>
     <input type="text" name="name" value="<?= $name?>">
   </div>
   <div>
     <label for="comment">Comment:</label>
     <input type="text" name="comment" value="<?= $comment?>">
    <input type="text" name="e_judge" value="<?= $edit_num?>">
     </div>
   <div>
   <div class="button">
     <button type="submit" name="submit">送信</button>
   </div>
 </form>



 <form action="mission_3-4-3.php" method="post">
   <div>
     <label for="delete">削除対象番号:</label>
     <input type="text" name="delete">
   </div>
   <div class="button">
     <button type="submit">削除</button>
   </div>
 </form>

 <p>---------------------</p>
 <form action="mission_3-4-3.php" method="post">
   <div>
     <label for="edit">編集対象番号:</label>
     <input type="text" name="edit_num">
   </div>
   <div class="button">
     <button type="submit" name="edit_btn">編集</button>
     <input type="hidden" name="edit" value="hensyu">
   </div>
 </form>
 <br/>

 <?php  //編集の追記であることを判定し、ファイルに再書き込み
 if(isset($_POST["e_judge"])){

   $contents = file($filename);
   $fp = fopen($filename, "w");
   $edit_num = $_POST["e_judge"];

   foreach($contents as $content){
     $parts = explode("<>", $content);
     if($parts[0] == $edit_num){
       $name = $_POST["name"];
       $comment = $_POST["comment"];
       $timestamp = date('Y/m/d/ H:i:s');
       fwrite($fp, $edit_num."<>".$name."<>".$comment."<>".$timestamp.PHP_EOL);
     }else{
       fwrite($fp, $content);
     }
   }
   fclose($fp);
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
