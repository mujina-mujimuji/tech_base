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

    //テーブルを作成
    $c_table = 'CREATE TABLE keijiban(
      id INT(11) AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(20),
      comment VARCHAR(140),
      post_time DATETIME,
      passwd VARCHAR(20)
    ) engine=innodb default charset=utf8';

    //実行
    $res = $dbh->query($c_table);

  //エラーがあったらエラー情報を受け取る
  }catch(PDOException $e){

    echo $e->getMessage();
    exit;
  }


  $stmt = $dbh->query("SHOW TABLES");
  while($re = $stmt->fetch(PDO::FETCH_ASSOC)){
    var_dump($re);
  }

  //接続を閉じる
  $link = null;
?>
