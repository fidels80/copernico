
<?php
class ls {

public $ini_array=array();
 


function elefile($dir){


$ini_array=parse_ini_file("config.ini", true /* will scope sectionally */);
$ext= $ini_array['Parametri']['estensione'];
if (!is_dir($ini_array['percorsi']['oripath'])){
ECHO "<H1>attenzione la directory di origine gli nso non esiste controllare il config.ini voce oripath</h1>";
}

//var_dump($ini_array);
$oripath= glob($ini_array['percorsi']['oripath'].$ext);
//var_dump($oripath);
//var_dump($ini_array['percorsi']['oripath']);

$directory = new DirectoryIterator(dirname(__FILE__));
$di =str_replace('include','',$directory->getPath());


    foreach ($oripath as $f){
    if(!file_exists($di.$ini_array['percorsi']['procfiles'].(basename($f))))
    {
        copy($f, $di.$ini_array['percorsi']['toelab'].(basename($f)));
    } else
    {
    
    } 
    }



    $res=[];
    if ($dir==1){
    $lpath = glob($di.$ini_array['percorsi']['toelab'].$ext);
    foreach ($lpath as $f) {
      array_push($res,basename($f));
    }
}else {
    $lpath = glob($di.$ini_array['percorsi']['procfiles'].$ext);

    foreach ($lpath as $f) {
   array_push($res,basename($f));
}
}


return $res;
}

 

function localelab(){
$ini_array=parse_ini_file("config.ini", true /* will scope sectionally */);
$ext= $ini_array['Parametri']['estensione'];
    $directory = new DirectoryIterator(dirname(__FILE__));
    $di =str_replace('include','',$directory->getPath());
    $lpath = glob($di.$ini_array['percorsi']['toelab'].$ext);
    foreach ($lpath as $f) {
    
    }


    
}

/*da testare che valfile che non si riesce a rimediare un xsd del nso da nessuna parte */
function valfile($file){
$ini_array=parse_ini_file("config.ini", true /* will scope sectionally */);

    $f=$file;
$directory = new DirectoryIterator(dirname(__FILE__));
    $di =str_replace('include','',$directory->getPath());
    
    $xsd=$di.'include\\test100.xsd';
    $xml=$di.$ini_array['percorsi']['toelab'].(basename($f));


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

    if (!$rxml->schemaValidate($xsd)) {
        // print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
        return libxml_get_errors();
    } else {

        echo $file.'fatto';
        return $file.'fatto';;
    }
}




function processafile_Copernico($file,$ind=null){
$ini_array=parse_ini_file("config.ini", true /* will scope sectionally */);
$ext= $ini_array['Parametri']['estensione'];
    $f=$file;
     
    ((is_null($ind)==true ) ? $ind=1 : $ind) ;
    $directory = new DirectoryIterator(dirname(__FILE__));
    $di =str_replace('include','',$directory->getPath());
    
    $file=$di.$ini_array['percorsi']['toelab'].(basename($f));
    ini_set('error_reporting', E_ALL ^ E_WARNING);

    $data = new SimpleXmlElement($file, null, true);
    json_encode($data);
    $namespaces = $data->getNamespaces(true);

 
    $new = ($data->Order);
    $con = json_encode($new);
 
    $subnest = ($data->Order->Children("cac", TRUE)->OrderLine);
 
if (get_object_vars($subnest) <> false || count($subnest)<>0   ){
   $row="";
   $row= "TES";
    try {   
$dt1=     strtotime($data->Order->Children("cbc", TRUE)->IssueDate);
$dt=date("d/m/Y",$dt1);
    
    $row=$row."|".$dt."|".$ind."|".$data->Order->Children("cac", TRUE)->BuyerCustomerParty->Children("cac", TRUE)->Party
    ->Children("cac", TRUE)->PartyTaxScheme->Children("cbc", TRUE)->CompanyID .
    "|"   .$data->Order->Children("cbc", TRUE)->IssueDate.
    "|".$data->Order->Children("cbc", TRUE)->ID."||||".PHP_EOL;
    foreach ($data->Order->Children("cac", TRUE)->OrderLine as $line) {

$row=$row."RIG"."|"   .$dt."|{$ind}||||".
$line->Children("cac",true)->LineItem->children("cac",true)->Item->children("cac",true)->BuyersItemIdentification->
children("cbc",true)->ID."||".
$line->Children("cac",true)->LineItem->children("cbc",true)->Quantity.
"|".$line->Children("cac",true)->LineItem->children("cac",true)->Price->children("cbc",true)->PriceAmount.
PHP_EOL;

    }
}

catch(Exception $var) {
    print $var->getMessage();
  }
  $di =str_replace('include','',$directory->getPath());
    $xml=$di.$ini_array['percorsi']['toelab'].(basename($f));
  copy($xml, $di.$ini_array['percorsi']['procfiles'].(basename($f)));
  echo $xml;
  unlink($xml);
return $row;
}



else{
    echo "<H1>il File {$f} É   DANNEGGIATO  O NON CORRETTO!!!!</BR></H1>";
}
}







function creafile($rows){
$ini_array=parse_ini_file("config.ini", true /* will scope sectionally */);

    $nfile=$ini_array['percorsi']['output'].$ini_array['Parametri']['NomeOut'].date('m-d-Y_hia').'.csv';
    $tmpfile=fopen($nfile,"w") 
    or   $this->extremesave($rows); 
    /*die("NON POSSO CREARE IL FILE DI OUTPUT!! COntrollare cartella e permessi!! "
    .$ini_array['percorsi']['output'].'Sistemi_Roma_'.date('m-d-Y_hia').'.csv'
    

);*/
    fwrite($tmpfile,$rows);
    fclose($tmpfile);
    $webf=fopen($ini_array['Parametri']['NomeOut'].date('m-d-Y_hia').'.csv',"w") or
     $this->extremesave($rows);
    fwrite($webf,$rows);
    
if (strlen($rows)>10){

    return $nfile;
}else{
    return "";
}


}
function extremesave($row)
{

    fwrite("c:\nso_".date('m-d-Y_hia').'.csv',$row);
    die("NON POSSO CREARE IL FILE DI OUTPUT  !! COntrollare cartella e permessi!! ");



}

function reset($file){
unlink($file);

}
}
?>






