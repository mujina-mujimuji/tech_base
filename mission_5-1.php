<?php
  //mission_5-1_db.phpを呼び出し、定義した関数を使えるようにする
  require "mission_5-1_db.php";

  //デバッグ用にテキストファイルを用意
  $filename = "mission_5-1_debug.txt";
 ?>

<!DOCTYPE=html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>mission_5-1</title>
</head>
<body>

<?php

  //タイムゾーン設定
  date_default_timezone_set("Asia/Tokyo");

  //投稿番号決定
  /*
  C.f. mission_5-1-1.php
  ... テーブル作成時にidをAUTO INCREMENTで作成したため投稿番号カウントは不要になった！

  $count = 0;
  try{
    $dbh = dbConnect();
    $lines = $dbh->query("SELECT id FROM keijiban;");
    foreach($lines as $line){
      if(intval($line) > $count){
        $count = $line;
      }
    }
    $postnumber = $count + 1;


  }catch(Exception $e){

    //デバッグ
    echo("エラー発生@投稿番号決定:".$e->getMessage());
  }
  */
  ?>


<?php  //編集機能フォーム
  if(!empty($_POST["edit"])){
    if(!empty($_POST["edit_pass"])){
      $edit_pass = $_POST["edit_pass"];
      $edit = $_POST["edit"];

      /*
      1.編集指定番号の投稿のpasswdを取り出す
      2. if文でedit_passと比較
      3. 一致すれば編集指定番号のid, name, commentを配列へ書き出す
      4. 配列の各要素を変数に取り出し
      3'. 一致しなければ不一致メッセージを出す
      */
      try{

        $dbh = dbConnect();
        $sql = 'SELECT * FROM keijiban WHERE id=:edit';
        $data = array(':edit' => $edit);
        $stmt = queryPost($dbh, $sql, $data);
        $edit_line = $stmt->fetch(PDO::FETCH_ASSOC);

        /*デバッグ用　完成したら消す
        echo "-----編集機能フォームデバッグ-----<br/>";
        var_dump($edit_line);
        echo "------------------------------<br/>";
        */

        if($edit_line['passwd'] == $edit_pass){ //パスワード確認
          $edit_num = $edit_line['id'];//番号を変数へ
          $edit_name = $edit_line['name'];//名前を変数へ
          $edit_com = $edit_line['comment'];//テキストを変数へ
        }else{
            echo "パスワードが一致しないため編集できません<br/>";
        }
      }catch(Exception $e){

        //デバッグ
        echo("エラー発生@編集機能フォーム:".$e->getMessage());
      }
    }else{
      echo "パスワードを入力してください<br/>";
    }
  }
?>

<h1>Leave Comments</h1>
<form action="mission_5-1.php" method="post">
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
    <label for="password">Password:</label>
    <input type="text" name="pass">
  </div>
  <div class="button">
    <button type="submit" name="submit">送信</button>
  </div>
</form>
<br/>
<form action="mission_5-1.php" method="post">
  <div>
    <label for="delete">削除対象番号:</label>
    <input type="text" name="delete">
  </div>
  <div>
    <label for="password">Password:</label>
    <input type="text" name="del_pass">
  </div>
  <div class="button">
    <button type="submit">削除</button>
  </div>
</form>
<br/>
<form action="mission_5-1.php" method="post">
  <div>
    <label for="edit">編集対象番号:</label>
    <input type="text" name="edit">
  </div>
  <div>
    <label for="password">Password:</label>
    <input type="text" name="edit_pass">
  </div>
  <div class="button">
    <button type="submit">編集</button>
  </div>
</form>
<br/>



<?php   //新規投稿処理
  if(isset($_POST["comment"]) && empty($_POST["e_judge"])){
    if(!empty($_POST["pass"])){

      $name = $_POST["name"];
      $comment = $_POST["comment"];
      $date = date('Y/m/d/ H:i:s');
      $pass = $_POST["pass"];

      try{
        $dbh = dbConnect();
        $sql = 'INSERT INTO keijiban(name, comment, post_time, passwd) VALUES(:name, :comment, :post_time, :passwd)';
        $data = array(':name' => $name, ':comment' => $comment, ':post_time' => $date, ':passwd' => $pass);
        $stmt = queryPost($dbh, $sql, $data);

        /*デバッグ用
        $fp = fopen($filename, "a");
        if($stmt){
          $success = "クエリ成功@新規投稿処理".PHP_EOL;
          fwrite($fp, $success);
        }else{
          $false = "クエリ失敗＠新規投稿処理".PHP_EOL;
          fwrite($fp, $false);
        }
        fclose($fp);
        */

      }catch(Exception $e){
        //デバッグ
        echo("エラー発生@新規投稿処理:".$e->getMessage());
      }

    }else{
      echo "パスワードを設定して投稿し直してください<br/>";
    }
  }
  ?>

<?php  //削除処理
  if(isset($_POST["delete"]) === true){
    if(!empty($_POST["del_pass"])){


      //パスワード受け取り
      $del_pass = $_POST["del_pass"];

      //削除指定番号の受け取り
      $delete = $_POST["delete"];
      try{

        //DBから指定投稿のパスワードを変数に書き出す
        $dbh = dbConnect();
        $sql = 'SELECT passwd FROM keijiban WHERE id=:del_id';
        $data = array(':del_id' => $delete);
        $stmt = queryPost($dbh, $sql, $data);
        $check_pass = $stmt->fetch(PDO::FETCH_ASSOC);

        /*デバッグ用 完成したら消す
        var_dump($check_pass);
        */

        //パスワードが一致すれば削除
        if($del_pass == $check_pass["passwd"]){
            $sql = 'DELETE FROM keijiban WHERE id=:del_id';
            $stmt = queryPost($dbh, $sql, $data);

            /*デバッグ用　完成したら消す
            $fp = fopen($filename, "a");
            if($stmt){
              $success = "クエリ成功@削除処理".PHP_EOL;
              fwrite($fp, $success);
            }else{
              $false = "クエリ失敗＠削除処理".PHP_EOL;
              fwrite($fp, $false);
            }
            fclose($fp);
            */

          }else{  //パスワード不一致の場合
            echo "パスワードが一致しないため削除できません<br/>";
          }
        }catch(Exception $e){
          //デバッグ
          echo "エラー発生@削除処理:".$e->getMessage();
        }
    }else{
      echo "パスワードを入力してください<br/>";
    }
  }

  //編集反映処理
  if(!empty($_POST["e_judge"])){  //編集の追記であることを判定し、ファイルに再書き込み
    $num = $_POST["e_judge"];
    $new_pass = $_POST["pass"];
    $new_name = $_POST["name"];
    $new_comment = $_POST["comment"];
    $date = date('Y/m/d/ H:i:s');

    try{
      $dbh = dbConnect();
      $sql = 'UPDATE keijiban
              SET name=:new_name, comment=:new_comment, post_time=:post_time, passwd=:new_pass
              WHERE id=:num';
      $data = array(':new_name' => $new_name, ':new_comment' => $new_comment, ':post_time' => $date, ':new_pass' => $new_pass, ':num' => $num);
      $stmt = queryPost($dbh, $sql, $data);

      /*デバッグ用　完成したら消す
      $fp = fopen($filename, "a");
      if($stmt){
        $success = "クエリ成功@編集反映処理".PHP_EOL;
        fwrite($fp, $success);
      }else{
        $false = "クエリ失敗＠編集反映処理".PHP_EOL;
        fwrite($fp, $false);
      }
      fclose($fp);
      */


    }catch(Exception $e){
      //デバッグ
      echo "エラー発生@編集反映処理:".$e->getMessage();
    }



 }

 //表示
 echo "<hr/>";
 try{
   $dbh = dbConnect();
   $sql = 'SELECT id, name, comment, post_time FROM keijiban';
   $data = null;
   $stmt = queryPost($dbh, $sql, $data);

   while($parts = $stmt->fetch(PDO::FETCH_ASSOC)){
     foreach($parts as $part){
       echo $part." ";
     }
     echo "<br/>";
   }
 }catch(Exception $e){
   //デバッグ
   echo "エラー発生@表示処理:".$e->getMessage();
 }



 /*
 $stmt = $dbh->query("SELECT * FROM keijiban;");

 while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
   foreach($result as $value){
     echo $value." ";
   }
   echo "<br/>";
 }
 */
?>
