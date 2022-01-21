
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




function processafile($file){
    $f=$file;
    $directory = new DirectoryIterator(dirname(__FILE__));
    $di =str_replace('include','',$directory->getPath());
    
    $file=$di.'toelab\\'.(basename($f));
    ini_set('error_reporting', E_ALL ^ E_WARNING);

    $data = new SimpleXmlElement($file, null, true);
    json_encode($data);
    $namespaces = $data->getNamespaces(true);

    /*foreach($data->children($namespaces['cac']) as $entry) { 
    $eID = $entry->ID ; echo $entry." ".$eID."<br>"; } 
   */
    $new = ($data->Order);
    $con = json_encode($new);
    // Convert into associative array
    //$newArr = json_decode($con, true);
    $subnest = json_encode($data->Order->OrderLine);
    //var_dump(json_decode($stocazzo,TRUE));
    //var_dump( strval($data->Order));
    //$t = simplexml_load_string($xmlstr);
    //var_dump($data->Order->OrderLine);

    try {   
    echo $data->Order->CustomerReference . PHP_EOL . '<br>';
   foreach ($data->Order->OrderLine as $line) {
        echo "Type:" . $line->LineItem->ID . PHP_EOL . '<br>';
        echo "ITem:" . $line->LineItem->Item->Name . PHP_EOL . '<br>';
        $c = $line->LineItem->Item->Name;
        var_dump($c);
        $qtaatt = $line->LineItem->Quantity->attributes();

        echo "Qta:  " . $line->LineItem->Quantity . '<br> unitCode=>' . $qtaatt['unitCode'] . '<br> unitCodeListID=>  '
            . $qtaatt['unitCodeListID'] . '<br>';
        echo "ClassifiedTaxCategory" . $line->LineItem->Item->ClassifiedTaxCategory->ID . PHP_EOL . '<br>';
        echo "ClassifiedTaxCategoryaee" . $line->LineItem->Item->ClassifiedTaxCategory->attributes()->schemeID . '<br>';
        $testatt = $line->LineItem->Item->ClassifiedTaxCategory->ID->attributes();
        echo "attClassifiedTaxCategoryaee" . $testatt['schemeID'] . '<br>';
    }
}
catch(Exception $var) {
    print $var->getMessage();
  }

}




}

?>