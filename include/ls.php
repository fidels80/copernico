
<?php
class ls {

function elefile($dir){

$oripath= glob('c:\youdox\ordininso\*.xml');

$directory = new DirectoryIterator(dirname(__FILE__));
$di =str_replace('include','',$directory->getPath());


    foreach ($oripath as $f){
    if(!file_exists($di =str_replace('include','',$directory->getPath())))
    {
        copy($f, $di.'toelab\\'.(basename($f)));
    } 
    }



    $res=[];
    if ($dir==1){
    $lpath = glob($di.'toelab\*.xml');

    foreach ($lpath as $f) {
     //   echo   (basename($f)) . '<br>';
      array_push($res,basename($f));
    }
}else {
    $lpath = glob($di.'procfiles\*.xml');

    foreach ($lpath as $f) {
   //    echo   ( ($f)) . '<br>';
   array_push($res,basename($f));
}
}


return $res;
}

 

function localelab(){
    $directory = new DirectoryIterator(dirname(__FILE__));
    $di =str_replace('include','',$directory->getPath());
    $lpath = glob($di.'toelab\*.xml');
    foreach ($lpath as $f) {
   // echo $f;
    
    }


    
}


function valfile($file){
    $f=$file;
$directory = new DirectoryIterator(dirname(__FILE__));
    $di =str_replace('include','',$directory->getPath());
    
    $xsd=$di.'include\\test100.xsd';
    $xml=$di.'toelab\\'.(basename($f));


    libxml_use_internal_errors(true);
    libxml_clear_errors();
    if (isset($xsd) && isset($xml)) {
        $cxml = fopen($xml, "r");
        $cxsd = fopen($xsd, "r");
  /*      if ($cxml == false) {
            return "FILE  XML NON TROVATO";
        }
        if ($cxsd == false) {
            return "FILE  XSD NON TROVATO";
        }*/
    } else {
       // $xsd = "/var/www/html/main/basic/xml/Schema_VFPR12.xsd";
       
       
       //../xml/Schema_DatiFattura_29052020.xsd";//sftp://root@www.anpira.it:8052/var/www/html/main/basic/xml/Schema_DatiFattura_29052020.xsd
       
       
        // $xml = '/var/www/html/main/basic/xml/ft2.xml';
        // libxml_use_internal_errors(true);
        $test = fopen($xml, "r");
        if ($test) {
            $x = fread($test, filesize($xml));
            // return $x;   
        }
    }

    $rxml = new DOMDocument();
    $rxml->load($xml);
//echo $doc->saveXML();
//return ( $rxml->saveXML());


    if (!$rxml->schemaValidate($xsd)) {
        // print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
        return libxml_get_errors();
    } else {

        echo $file.'fatttttooooooooooooooooo';
        return $file.'fatttttooooooooooooooooo';;
    }
}




function processafile_Copernico($file,$ind=null){
    $f=$file;
     
    ((is_null($ind)==true ) ? $ind=1 : $ind) ;
    $directory = new DirectoryIterator(dirname(__FILE__));
    $di =str_replace('include','',$directory->getPath());
    
    $file=$di.'toelab\\'.(basename($f));
    ini_set('error_reporting', E_ALL ^ E_WARNING);

    $data = new SimpleXmlElement($file, null, true);
    json_encode($data);
    $namespaces = $data->getNamespaces(true);

 
    $new = ($data->Order);
    $con = json_encode($new);
 
    $subnest = ($data->Order->Children("cac", TRUE)->OrderLine);
 
if (get_object_vars($subnest) <> false || count($subnest)<>0   ){
   $row="";
  // echo "TES";
   $row= "TES";
    try {   
$dt1=     strtotime($data->Order->Children("cbc", TRUE)->IssueDate);
$dt=date("d/m/Y",$dt1);
 //   echo "|".$dt;
 //   echo "|".$ind;
    
    $row=$row."|".$dt."|".$ind."|".$data->Order->Children("cac", TRUE)->BuyerCustomerParty->Children("cac", TRUE)->Party
    ->Children("cac", TRUE)->PartyTaxScheme->Children("cbc", TRUE)->CompanyID .
    "|"   .$data->Order->Children("cbc", TRUE)->IssueDate.
    "|".$data->Order->Children("cbc", TRUE)->ID."||||".PHP_EOL;
   // echo "|".$data->Order->Children("cac", TRUE)->BuyerCustomerParty->Children("cac", TRUE)->Party
   // ->Children("cac", TRUE)->PartyTaxScheme->Children("cbc", TRUE)->CompanyID;
    // echo "|"   .$data->Order->Children("cbc", TRUE)->IssueDate;
    // echo "|".$data->Order->Children("cbc", TRUE)->ID."||||".'<br>';
    foreach ($data->Order->Children("cac", TRUE)->OrderLine as $line) {
//echo "RIG"."|"   .$dt."|{$ind}||||";
//echo  $line->Children("cac",true)->LineItem->children("cac",true)->Item->children("cac",true)->BuyersItemIdentification->
//children("cbc",true)->ID."||";
//echo  $line->Children("cac",true)->LineItem->children("cbc",true)->Quantity;

//echo  "|".$line->Children("cac",true)->LineItem->children("cac",true)->Price->children("cbc",true)->PriceAmount;



$row=$row."RIG"."|"   .$dt."|{$ind}||||".
$line->Children("cac",true)->LineItem->children("cac",true)->Item->children("cac",true)->BuyersItemIdentification->
children("cbc",true)->ID."||".
$line->Children("cac",true)->LineItem->children("cbc",true)->Quantity.
"|".$line->Children("cac",true)->LineItem->children("cac",true)->Price->children("cbc",true)->PriceAmount.
PHP_EOL;
//echo '<br>';

    }
}

catch(Exception $var) {
    print $var->getMessage();
  }
  $di =str_replace('include','',$directory->getPath());
    $xml=$di.'toelab\\'.(basename($f));
  copy($xml, $di.'procfiles\\'.(basename($f)));
  unlink($xml);
return $row;
}



else{
    echo "<H1>il File {$f} É   DANNEGGIATO  O NON CORRETTO!!!!</BR></H1>";
}
}







function creafile($rows){

    $tmpfile=fopen('Sistemi_Roma_'.date('m-d-Y_hia').'.csv',"w") or die("NON POSSO CREARE IL FILE DI OUTPUT!!");
    fwrite($tmpfile,$rows);
    fclose($tmpfile);


}
}
?>







