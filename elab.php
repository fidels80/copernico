<?php
include('.\include\ls.php');
include('.\include\pb.php');
$ls= new ls();
$ls->localelab();




$content = "";
  
$p = new ProgressBar();


$mimmo = glob('C:\xampp\htdocs\copernico\*.xml');
$f=0;
$i=0;
$size = 100;
$conta=100/count($mimmo);
echo <<<EOT
<table style="height: 94px; margin-left: auto; margin-right: auto;" 
border="1" width="311" cellspacing="10" cellpadding="10">
<tbody>
<tr style="height: 116.188px;">
<td style="width: 301px; height: 116.188;">
Avvio Conversione&hellip;<br />
<img src="./img/logo.png" alt="logo" width="110%" height="110%" align="center"/>
EOT
;
echo '<div style="width: 300px;">';
$p->render();
echo '</div></tbody></table>';



foreach ($mimmo as $t) {

if (count($mimmo)==1)
{
$i=100;
}
//	echo basename($t).'<br>'.round($i,2).'%<br>';
	$p->setProgressBarProgress($i * 100 / $size);
	usleep(100000 * 0.1);
	$i=$i+$conta;
}
$p->setProgressBarProgress(100);

echo 
<<<EOT
<table style="height: 94px; margin-left: auto; margin-right: auto;" 
border="1" width="311" cellspacing="10" cellpadding="10">
<tbody><TD><BR><H1>
Terminato</h1><br/>
</td></tbody></table>
EOT;
 

$eleb=($ls->elefile(1));
$eleb2=($ls->elefile(2));
var_dump($eleb);
var_dump($eleb2);
var_dump(array_diff($eleb,$eleb2));
echo "bestia<br>";






?>