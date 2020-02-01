<?php
//ミッション1-2-2
  $hensu = "hello, world!";
  $filename = "mission_1-2.txt";
  //$fp = fopen($filename, "w");
  // ↑ wをaに変えてみる
  $fp = fopen($filename, "a");
  fwrite($fp, $hensu);
  fclose($fp);
 ?>