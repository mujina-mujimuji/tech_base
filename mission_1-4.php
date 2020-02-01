<?php
//1 減算: 西暦 - 生まれ年
	$year = 2020;
	$byear = 1998;
	
	$age = $year - $byear;
	//echo $age;
	// echo 2020-1998; でも同じだけど、これがハードコーディングだと思われる
?>

<p>私は今年<?php echo $age ?>歳になります。</ p>
<hr />

<?php
//2 加算: 干支が一回り上の年齢を求める
	$eto = 12;
	$older = $age + $eto;
	//echo $age + $eto;
?>

<p>私より干支が一回り上の人は、今年で<?php echo $older ?>歳になります。</ p>
<hr />

<?php
//3 乗算: 干支がふた回り上の年齢を求める
	$d_older = $age + $eto * 2;
?>

<p>私より干支が二回り上の人は、今年で<?php echo $d_older ?>歳になります。</ p>
<hr />

<?php
//4 除算と余り: 夏季オリンピックを何回経験したか

	$o_age = $age - $age % 4; //答えが小数になるのを避けるため、まず余りを求め、引く
	$olym = $o_age / 4;
?>

<p>私は生まれてから<?php echo $olym ?>回の夏季オリンピックを経験しています。</ p>
<hr />

	
	
	
	
	

