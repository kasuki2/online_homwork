<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>build gram</title>
    <script type="text/javascript" src="gram.js" ></script>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

<br />

<a href="grami.php">grami</a>
<a href="sender2.php">sender2</a>
<br />

<?php

class BigFrame
{
public $title;
public $instructions;
public $contents; // array of arrays of OneItem
}

class OneItem
{
public $id;
public $sentence;
public $distractors;
public $solu;
public $remarks;
}

class EgyItem
{
    public $id;
    public $sentence;
    public $distractors;
}


$afile = file_get_contents("ujfile.json");
$fileArray = json_decode($afile);


//echo "<br>". count($fileArray) . "<br>";

$contentArray = $fileArray[0]->contents;

echo "<br> content array hossza: ". count($contentArray) . "<br>";

if(count($contentArray)>0)
{
    $egyItems = array();
    for($i=0;$i<count($contentArray);$i++)
    {
        $egyItem = new EgyItem();
        $egyItem->id = $contentArray[$i]->id;
        $egyItem->sentence = $contentArray[$i]->sentence;
        $egyItem->distractors = $contentArray[$i]->distractors;

        array_push($egyItems, $egyItem);

    }
  //  var_dump($egyItems);



    for($i=0;$i<count($contentArray);$i++)
    {
        $sentence = array();
        $sentence = $contentArray[$i]->sentence;

        $distract1 = array();
        $distract1 = $contentArray[$i]->distractors;
       // var_dump($distract1);
        for($k=0;$k<count($sentence);$k++)
        {
            $dist = array();
            for($d=0;$d<count($distract1);$d++)
            {
                $dist = $distract1[$d];

                $inn = "";
                for($b=0;$b<count($dist);$b++)
                {
                    $inn = $inn . $dist[$b] . " ";
                }
            }
            $vonal = "<div class='tooltip'> __________ <span class='tooltiptext'>" . $inn . "</span></div>";
            if($k == count($sentence)-1)
            {
                $vonal = " ";
            }
            echo $sentence[$k] . $vonal;
        }
        echo "<br />";




    }


}
else
{
    echo "<br />". "Nincs ebben file-ban semmi." . "<br />";
}



?>

</body>
</html>