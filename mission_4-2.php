<?php

  try{
    //データベースへ接続
    $link = mysqli_connect('******', '******', '******', '******');

    //接続チェック
    if(mysqli_connect_errno()){
      die("データベースに接続できません:".mysqli_connect_error().PHP_EOL);
    }

    echo "データベースの接続に成功しました。".PHP_EOL;

    //テーブルを作成
    $c_table = 'CREATE TABLE user (
      id INT(11) AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(20),
      age INT(11),
      registry_datetime DATETIME
    ) engine=innodb default charset=utf8';

    //実行
    $res = $link->query($c_table);

  //エラーがあったらエラー情報を受け取る
  }catch(PDOException $e){

    echo $e->getMessage();
    die();
  }

  //接続を閉じる
  $link = null;
?>
