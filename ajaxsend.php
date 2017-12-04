<?php

$afile = file_get_contents("ujfile.json");
//$fileArray = json_decode($afile);
// it sends the whole file, but when it is not filled, it should send the file w/o the solutions
echo $afile;

?>