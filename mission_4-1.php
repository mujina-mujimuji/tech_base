<?php
  $link = mysqli_connect('*****', '*****', '*****', '*****');

  //接続チェック
  if(mysqli_connect_errno()){
    die("データベースに接続できません:".mysqli_connect_error().PHP_EOL);
  }else{
  echo "データベースの接続に成功しました。".PHP_EOL;
  }
?>
