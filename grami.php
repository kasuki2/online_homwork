<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>build gram</title>
    <script type="text/javascript" src="gram.js" ></script>

</head>
<body>

<a href="sender2.php">sender 2</a>

<div>BUILD GRAMMAR</div>

<div>
    Write in a sentence and at the gaps, put this: _ .<br>
    After the sentence, put this: §. <br>
    Below this you can write the distractors. Start them with: _ . <br>
    After each distractor package, put a ß . <br>
    How _ money did you spend and how _ people did you need?§<br>
    _much<br>
    _many<br>
    ß<br>
    _much<br>
    _many<br>
    ß<br>
    §<br>
    _0-1<br>
    _1-1 (alternative solus)<br>
    §<br>
    _C<br>
    _money is UC, so use much with it, not many<br>
    ß<br>
    _people is C, so use many<br>
    _C<br>



</div>


<div style="width: 600px;margin-left: auto;margin-right: auto">

<?php





class BigFrame
{
    public $title;
    public $uid;
    public $instructions;
    public $contents; // array of arrays of OneItem
}

class OneItem
{
    public $id;
    public $sentence;
    public $solutions;
    public $distractors;
    public $solu;
    public $remarks;
}

$cont = "semmi";
$van = false;
if(isset($_POST['text1']))
{
    $cont = $_POST['text1'];
    $van = true;
}

$pieces = "";
if($van)
{

    $cont = preg_replace('/\s+/', ' ', trim($cont));
    $pieces = explode("§", $cont);
}

echo "<br>A teljes szöveg: " . $cont . "<br>";
if($van)
{


 //   echo "<br>" . $mind . "<br>";
    $sentence = explode("_", $pieces[0]);

    $egym = new OneItem();
    $egym->sentence = $sentence;
    $sols = array();
    for($i=0;$i<count($sentence)-1;$i++)
    {
        array_push($sols, "GGG");
    }
    $egym->solutions = $sols;
    echo "<br>Mondat darabok szám: " . count($egym->sentence) . "<br>";
    /*
    $minden = "";
    for($i=0;$i<count($egym->sentence);$i++)
    {
        $minden = $minden . $egym->sentence[$i] . "(xxx)";
    }
    //echo $minden;
    */

    // DISTRACTORS
    $allDist = explode("ß", $pieces[1]); // a mondat utáni rész sg like this: _Have _ Did ß _seen _see _saw

    $mainDistractors = array(); // all the distractor arrays



    for($i=0;$i<count($allDist);$i++)
    {
        $distractors = array(); // the array of distractors belonging to a gap

        $distra = explode("_", $allDist[$i]); // distractors belongint to one single gap
        for($k=0;$k<count($distra);$k++)
        {
            if(trim($distra[$k]) != "")
            {
                array_push($distractors, $distra[$k]);
            }

        }
        if(count($distractors) > 0)
        {
            array_push($mainDistractors, $distractors); // the length of $mainDistractors is the same as many gaps there are in the sentence
        }

    }


    $egym->distractors = $mainDistractors;
    echo "<br>Number of gaps: " . count($egym->distractors) . "<br>";


    // SOLUTIONS
    $allSolutions = $sentence = explode("_", $pieces[2]);

    echo "<br>Solutions: " . count($allSolutions) . "<br>";

    $solArr = array();

    for($i=0;$i<count($allSolutions);$i++)
    {
        if(trim($allSolutions[$i]) != "")
        {
            array_push($solArr, trim($allSolutions[$i]));
        }
    }

    function notempty($v)
    {
        if(trim($v) != '')
        {
            return $v;
        }
    }

    $resu = array_filter($allSolutions, "notempty");
    $resu = array_values($resu);
    $egym->solu = $solArr;



    // REMARKS
    $allRemarks = explode("ß", $pieces[3]); // a mondat utáni rész sg like this: _Have _ Did ß _seen _see _saw

    $mainRemarks = array(); // all the distractor arrays



    for($i=0;$i<count($allRemarks);$i++)
    {
        $remarkers = array(); // the array of distractors belonging to a gap

        $remar = explode("_", $allRemarks[$i]); // distractors belongint to one single gap
        for($k=0;$k<count($remar);$k++)
        {
            if(trim($remar[$k]) != "")
            {
                array_push($remarkers, $remar[$k]);
            }

        }
        if(count($remarkers) > 0)
        {
            array_push($mainRemarks, $remarkers); // the length of $mainDistractors is the same as many gaps there are in the sentence
        }

    }

    $egym->remarks = $mainRemarks;
    echo "<br>Number of remarks: " . count($egym->remarks) . "<br>";









    $afile = file_get_contents("ujfile.json");
    $fileArray = json_decode($afile);





    if(count($fileArray)<=0)
    {
        $bFrame = new BigFrame();
        $bFrame->title = "Nyelvtan";
        $bFrame->instructions = "Fill in the gaps.";

        $elsoArr = array();
        $elsoArr2 = array();
        $egym->id = 0;


        array_push($elsoArr2, $egym);
        $bFrame->contents = $elsoArr2;
        array_push($elsoArr, $bFrame);

        $menteni = json_encode($elsoArr);
        file_put_contents("ujfile.json", $menteni);


    }
    else
    {
        $egym->id = ujid();
        array_push($fileArray[0]->contents, $egym);

        $menteni = json_encode($fileArray);
        file_put_contents("ujfile.json", $menteni);

    }






    echo "<br>" . $menteni . "<br>";

}


function ujid()
{
    global $fileArray;
    $idarray = $fileArray[0]->contents;
    //usort($idarray, "cmp");
   // sortScripts($idarray, "cmp");
    ujSor($idarray);

    return $idarray[count($idarray)-1]->id + 1;
}


function sortScripts($a, $b)
{
    return ($b["id"]+0) - ($a["id"]+0);

}

function ujSor($array)
{
usort($array, function($a, $b)
    {
        return strnatcmp($a->id, $b->id);
    }
);
}



?>

</div>

<div style="width:600px;margin-left: auto;margin-right: auto">

    <form method="post" action="grami.php">

        <textarea name="text1">

        </textarea>

        <input type="submit" value="send">

    </form>



</div>


</body>
</html>