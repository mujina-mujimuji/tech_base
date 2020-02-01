<?php
  define('DB_HOST', '******');
  define('DB_NAME', '******');
  define('DB_USER', '******');
  define('DB_PASSWORD', '******');

  //文字化け対策
  $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET CHARACTER SET 'utf8'");

  //phpのエラーを表示するように設定
  error_reporting(E_ALL & ~E_NOTICE);

  //データベースへの接続
  try{

    $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, $options);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //接続チェック
    if(mysqli_connect_errno()){
      die("データベースに接続できません:".mysqli_connect_error().PHP_EOL);
    }

    echo "データベースの接続に成功しました。".PHP_EOL;

    $stmt = $dbh->query('SHOW TABLES');
    while($re = $stmt->fetch(PDO::FETCH_ASSOC)){
      var_dump($re);
    }


  //エラーがあったらエラー情報を受け取る
  }catch(PDOException $e){

    echo $e->getMessage();
    exit;
  }

  //接続を閉じる
  $link = null;
?>
