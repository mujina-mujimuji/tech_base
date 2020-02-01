<?php
  date_default_timezone_set("Asia/Tokyo");
  $date = date("Y/m/d H:i:s");

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

    echo "データベースの接続に成功しました。<hr/>".PHP_EOL;



  //エラーがあったらエラー情報を受け取る
  }catch(PDOException $e){

    echo $e->getMessage();
    exit;
  }

  /*
  $insert = $dbh->query("INSERT INTO user(
    id, name, age, registry_datetime)
    VALUES('9', 'nozaki', '21', '2020-01-10 10:10:10'),
      ('10', 'ahaha', '12', '2020-01-10 10:10:10'),
      ('11', 'akakak', '13', '2020-01-10 10:10:10');
  ");
  */

  $update_date = $dbh->query("UPDATE user
    SET registry_datetime='2019-10-10 23:34:45'
    WHERE id<=8;
    ");


  /*
  $update = $dbh->query("UPDATE user
    SET name='newnozaki', age='100000' WHERE id='5';
    ");
  */


  $stmt = $dbh->query("SELECT * FROM user;");

  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    foreach($result as $value){
      echo $value." ";
    }
    echo "<br/>";
  }
?>
