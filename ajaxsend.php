<?php


$fileToOpen = $_POST['openthis'];

$afile = file_get_contents($fileToOpen);
//$fileArray = json_decode($afile);
// it sends the whole file, but when it is not filled, it should send the file w/o the solutions
echo $afile;

?>