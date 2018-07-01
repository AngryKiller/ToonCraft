<!DOCTYPE html>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="5;URL=./index.php">
<?php

echo "<h1> Mise à jour... </h1>";

$f = fopen("http://angrykiller.raidghost.com/vercheck/tooncraft/tooncraftupdate.zip", 'r');
if($f != null)
    file_put_contents("TMPUPDATE.zip", $f);
$zip = new ZipArchive;
if ($zip->open('TMPUPDATE.zip') === TRUE) { 
$zip->extractTo("./");
$zip->close();
}
try{
    unlink("TMPUPDATE.zip");
}catch(Exception $ex){
    die();
    echo "Erreur interne, veuillez refaire la mise à jour. Si le problème persiste, contactez AngryKiller sur le forum de CraftMyWebsite.";
}