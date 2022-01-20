<?php session_start();
require_once __DIR__ . '/inc/flash.php';
include('.\include\ls.php');
include('.\include\pb.php');
$ls= new ls();

?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>


<table style="height: 94px; margin-left: auto; margin-right: auto;" 
border="1" width="311" cellspacing="10" cellpadding="10">
<tbody>
<tr style="height: 116.188px;">
<td style="width: 301px; height: 116.188;">
<p style="text-align: center;"><img src="./img/logo.png" alt="logo" width="110%" height="110%" /></p>
</td>
<td style="width: 301px; height: 116.188px;" rowspan="6">File da elaborare <br>
<?php $ls->elefile(1);?>

</td>
</tr>
<tr style="height: 116.188px;">

<td style="width: 301px; height: 116.188px;">Seleziona file da caricare   
  <form enctype="multipart/form-data" action="upload.php" method="post">
        <div>
           
            <input type="file" id="file" name="file"/>
        </div>
        <div>
            <button type="submit">Upload</button>
        </div>
    </form>
 
</tr>
<tr style="height: 18px;">
<td style="width: 301px; height: 18px;">&nbsp;</td>
</tr>
<tr style="height: 21px;">
<td style="width: 301px; height: 21px;"><input name="submit" type="submit" value="scarica da SFTP" /></td>
</tr>
<tr style="height: 18px;">
<td style="width: 301px; height: 18px;">&nbsp;</td>
</tr>
<tr style="height: 39px;">
<td style="width: 301px; height: 39px;"><br />
<form enctype="multipart/form-data" action="elab.php" method="post">
<input name="submit" type="submit" value="Elaborazione Locale" 
/>
</form></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<!--?php 
include('.\include\ls.php');
include('.\include\pb.php');

?-->
<p><br /><br /></p>
</body>
</html>