<?php

/**
 * Progress bar for a lengthy PHP process
 * http://spidgorny.blogspot.com/2012/02/progress-bar-for-lengthy-php-process.html
 */

class ProgressBar
{
	var $percentDone = 0;
	var $pbid;
	var $pbarid;
	var $tbarid;
	var $textid;
	var $decimals = 1;

	function __construct($percentDone = 0)
	{
		$this->pbid = 'pb';
		$this->pbarid = 'progress-bar';
		$this->tbarid = 'transparent-bar';
		$this->textid = 'pb_text';
		$this->percentDone = $percentDone;
	}

	function render()
	{
		//print ($GLOBALS['CONTENT']);
		//$GLOBALS['CONTENT'] = '';
		print($this->getContent());
		$this->flush();
		//$this->setProgressBarProgress(0);
	}

	function getContent()
	{
		$this->percentDone = floatval($this->percentDone);
		$percentDone = number_format($this->percentDone, $this->decimals, '.', '') . '%';
		$content =  '<div id="' . $this->pbid . '" class="pb_container">
			<div id="' . $this->textid . '" class="' . $this->textid . '">' . $percentDone . '</div>
			<div class="pb_bar">
				<div id="' . $this->pbarid . '" class="pb_before"
				style="width: ' . $percentDone . ';"></div>
				<div id="' . $this->tbarid . '" class="pb_after"></div>
			</div>
			<br style="height: 1px; font-size: 1px;"/>
		</div>
		<style>
			.pb_container {
				position: relative;
			}
			.pb_bar {
				width: 100%;
				height: 1.3em;
				border: 1px solid silver;
				-moz-border-radius-topleft: 5px;
				-moz-border-radius-topright: 5px;
				-moz-border-radius-bottomleft: 5px;
				-moz-border-radius-bottomright: 5px;
				-webkit-border-top-left-radius: 5px;
				-webkit-border-top-right-radius: 5px;
				-webkit-border-bottom-left-radius: 5px;
				-webkit-border-bottom-right-radius: 5px;
			}
			.pb_before {
				float: left;
				height: 1.3em;
				background-color: #43b6df;
				-moz-border-radius-topleft: 5px;
				-moz-border-radius-bottomleft: 5px;
				-webkit-border-top-left-radius: 5px;
				-webkit-border-bottom-left-radius: 5px;
			}
			.pb_after {
				float: left;
				background-color: #FEFEFE;
				-moz-border-radius-topright: 5px;
				-moz-border-radius-bottomright: 5px;
				-webkit-border-top-right-radius: 5px;
				-webkit-border-bottom-right-radius: 5px;
			}
			.pb_text {
				padding-top: 0.1em;
				position: absolute;
				left: 48%;
			}
		</style>' . "\r\n";
		return $content;
	}

	function setProgressBarProgress($percentDone, $text = '')
	{
		$this->percentDone = $percentDone;
		$text = $text ? $text : number_format($this->percentDone, $this->decimals, '.', '') . '%';
		print('
		<script type="text/javascript">
		if (document.getElementById("' . $this->pbarid . '")) {
			document.getElementById("' . $this->pbarid . '").style.width = "' . $percentDone . '%";');
		if ($percentDone == 100) {
			print('document.getElementById("' . $this->pbid . '").style.display = "none";');
		} else {
			print('document.getElementById("' . $this->tbarid . '").style.width = "' . (100 - $percentDone) . '%";');
		}
		if ($text) {
			print('document.getElementById("' . $this->textid . '").innerHTML = "' . htmlspecialchars($text) . '";');
		}
		print('}</script>' . "\n");
		$this->flush();
	}

	function flush()
	{
		print str_pad('', intval(ini_get('output_buffering'))) . "\n";
		//ob_end_flush();
		flush();
	}
}
$content = "";
echo 'Avvio Conversione&hellip;<br />';

$p = new ProgressBar();
echo '<div style="width: 300px;">';
$p->render();
echo '</div>';
$mimmo = glob('C:\xampp\htdocs\copernico\*.xml');
$f=0;
foreach ($mimmo as $t) {
$f=$f+1;
	/*
	
	f sta a 100 come x sta a 1
	conta=100/f
	i=i+conta
	*/
}
$conta=100/$f;
for ($i = 0; $i < ($size = 100);$i=$i+$conta) {

	/*$i aumento del rapporto tra il totale dei files da elaborare e 100
es 10 file
a ogni file i fa +10
es 5 file
a ogni file i fa +20
es 2 
file i fa +50




	*/
/*	switch (true) {
		case $i==10:
			echo "10";
			break;
		case $i==20:
			echo "20";
			break;
		case $i==30:
			echo "30";
			break;
		case $i==40:
			echo "40";
			break;
		case $i== 50:
			echo "50";
			break;
		case $i== 60:
			echo "60";
			break;
		case $i== 70:
			echo "70";
			break;
	}*/
	echo round($i,2).'%<br>';


	$p->setProgressBarProgress($i * 100 / $size);
	usleep(1000000 * 0.1);
}
$p->setProgressBarProgress(100);

echo 'Terminato.<br />';
