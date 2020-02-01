<html>
	<head>
		<title>mission_1-6.php</title>
		<meta charset="utf-8">
	</head>


<?php
	$year = 2000;
	/*
	for(式１; 式２; 式3)
	式1: forループの開始時に実行 → iに1を代入
	式2: 各繰り返しの開始時に評価 Falseになるとループが終了 → iが20を超えたらお終い
	式3: 各繰り返しの後実行 → iを1増やす
	*/
	
	for ( $i = 0; $i <= 20; $i++ ) {
		$y_count = $year + $i;
		if ( $y_count % 4 == 0 ){
			echo $y_count."<br />";
		}
	}
?>
<hr />

<?php
//array()で配列を作成。[]でも可
	/*
	$Shiritori = array("りんご", "ごましお", "おしるこ", "こめ", "めろん");
	//var_dump($Shiritori); で配列の中身を確認できる
	
	echo $Shiritori[2];
	*/
	//[0],[1],[2]...と格納されていくので3番目は[2]	
	
	
	//自分でキーに名前をつけると引き出しが楽
$Shiritori = array(
		1 => "りんご",
		2 => "ごましお",
		3 => "おしるこ",
		4 => "こめ",
		5 => "めろん"
	);
	echo $Shiritori["3"]."<hr />";

	
	//3 foreach文で暗記しりとり
	// foreach(配列 as $value(または$key=>$value)
	$strings = "<br />";
	foreach($Shiritori as $value){
		$strings = $strings.$value;
		echo $strings;
		}
?>
<hr />




