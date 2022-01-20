
<?php
class ls {

function elefile($dir){

$oripath= glob('c:\youdox\ordininso\*.xml');

$directory = new DirectoryIterator(dirname(__FILE__));
$di =str_replace('include','',$directory->getPath());


    foreach ($oripath as $f){
    if(!file_exists($di.'toelab\\'.(basename($f))))
    {
        copy($f, $di.'toelab\\'.(basename($f)));
    } 
    }




    if ($dir=1){
    $lpath = glob($di.'toelab\*.xml');

    foreach ($lpath as $f) {
        echo   (basename($f)) . '<br>';
      
    }
}else {
    $lpath = glob($di.'procfiles\*.xml');

    foreach ($lpath as $f) {
        echo   (basename($f)) . '<br>';
}
}
}

 

function localelab(){
    $directory = new DirectoryIterator(dirname(__FILE__));
    $di =str_replace('include','',$directory->getPath());
    $lpath = glob($di.'toelab\*.xml');
    foreach ($lpath as $f) {
    echo $f;
    
    }

}




}
?>