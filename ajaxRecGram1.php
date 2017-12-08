




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

    if(isset($_POST['fnev']))
    {
        $fileNeve = $_POST['fnev'] . ".json";
    }
    else
    {
        echo "Nincs file neve.";
        exit;
    }

if(isset($_POST['inst']))
{
    $instructions = $_POST['inst'];
}
else
{
    echo "Nincs instrukció megadva.";
    exit;
}

if(isset($_POST['cim']))
{
    $atitle = $_POST['cim'];
}
else
{
    echo "Nincs cím megadva.";
    exit;
}
// cim


    $pieces = "";
    if($van)
    {

        $cont = preg_replace('/\s+/', ' ', trim($cont));
        $pieces = explode("§", $cont);
    }


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


        // SOLUTIONS
        $allSolutions = $sentence = explode("_", $pieces[2]);



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



        // van-e file
        $van = file_exists($fileNeve);
        if(!$van)
        {
           // create file
            $myfile = fopen($fileNeve, "w");
        }



        $afile = file_get_contents($fileNeve);
        $fileArray = json_decode($afile);





        if(count($fileArray)<=0)
        {
            $bFrame = new BigFrame();
            $bFrame->title = $atitle;
            $bFrame->instructions = $instructions;

            $elsoArr = array();
            $elsoArr2 = array();
            $egym->id = 0;


            array_push($elsoArr2, $egym);
            $bFrame->contents = $elsoArr2;
            array_push($elsoArr, $bFrame);

            $menteni = json_encode($elsoArr);
            file_put_contents($fileNeve, $menteni);
            echo "saved 1";

        }
        else
        {
            $egym->id = ujid();
            array_push($fileArray[0]->contents, $egym);

            $menteni = json_encode($fileArray);
            file_put_contents($fileNeve, $menteni);
            echo "saved 2";
        }








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

