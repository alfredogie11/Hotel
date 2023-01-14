<?php
$imagePath= "images/newGallery";
$imagesPath =  scandir($imagePath);

$responseImagespath = []; 
foreach($imagesPath as $path){

    $dotSign = ".";
    $isAllDot = true;

    
    for($a=0;$a<strlen($path);$a++){
       if($dotSign!=$path[$a]){
             $isAllDot = false;
             break;
       }
    }


    if(!$isAllDot){
       // echo $path."<br>";
       array_push($responseImagespath, $path);
    }
   
}

echo json_encode($responseImagespath);
?>