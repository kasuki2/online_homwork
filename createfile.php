<?php

//$myfile = fopen("testfile.txt", "w");
//echo $myfile;

$van = file_exists("testfile.txt");
if($van)
{
    echo "van file";
}
else
{
    echo "nincs file";
}

?>