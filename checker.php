<!DOCTYPE html>
<html>
<?php

$usersolus = $_POST["solus"];

?>

<head lang="en">
    <meta charset="UTF-8">
    <title>build gram</title>

    <link rel="stylesheet" type="text/css" href="style1.css">

<script>

    var userSolus = "<?php echo $usersolus; ?>";
    function loadDoc()
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {


                process(this.responseText);

            }
        };
        kuld = "adat=valami";
        xhttp.open("POST", "ajaxsend.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(kuld);
    }


    var obj;

    function testCheck(usTips, sols)
    {
        alert("Itt vagyok testChek");
        //alert("testCheck says: " + usTips);
        //return;


        //userTipps = "0-1-1-1-1-0";
        //solus = ["1a-1d-1a-1d-1-1d"];

        var usT = usTips.split('-');

        var finals = [];
        var numa = 0;
        var bestsolus = [];
        //var betuk = ["a", "b", "c", "d"];

        for(s=0;s<sols.length;s++)
        {
            var totcor = 0;
            var corre = sols[s].split('-');
            for(i=0;i<corre.length;i++)
            {

                if(corre[i].includes("a")) // a found A-kötés
                {
                    numa++;
                    var ok = false;
                    for(k=0;k<corre.length;k++) // check all
                    {
                        if(corre[k].includes("a") && corre[k].includes(usT[k]) == false) // correct only if all is correct
                        {
                            ok = false;
                            break;
                        }
                        else
                        {
                            ok = true;
                        }
                    }
                    if(ok)
                    {
                        finals[i] = "1"; // correct
                        totcor++;
                    }
                    else
                    {
                        finals[i] = "0"; // incorrect
                    }

                }
                else if(corre[i].includes("b"))
                {
                    ok = false;
                    for(k=0;k<corre.length;k++) // check all
                    {
                        if(corre[k].includes("b") && corre[k].includes(usT[k]) == false) // correct only if all is correct
                        {
                            ok = false;
                            break;
                        }
                        else
                        {
                            ok = true;
                        }
                    }
                    if(ok)
                    {
                        finals[i] = "1"; // correct
                        totcor++;
                    }
                    else
                    {
                        finals[i] = "0"; // incorrect
                    }
                }
                else if(corre[i].includes("c"))
                {
                    ok = false;
                    for(k=0;k<corre.length;k++) // check all
                    {
                        if(corre[k].includes("c") && corre[k].includes(usT[k]) == false) // correct only if all is correct
                        {
                            ok = false;
                            break;
                        }
                        else
                        {
                            ok = true;
                        }
                    }
                    if(ok)
                    {
                        finals[i] = "1"; // correct
                        totcor++;
                    }
                    else
                    {
                        finals[i] = "0"; // incorrect
                    }
                }
                else if(corre[i].includes("d"))
                {
                    ok = false;
                    for(k=0;k<corre.length;k++) // check all
                    {
                        if(corre[k].includes("d") && corre[k].includes(usT[k]) == false) // correct only if all is correct
                        {
                            ok = false;
                            break;
                        }
                        else
                        {
                            ok = true;
                        }
                    }
                    if(ok)
                    {
                        finals[i] = "1"; // correct
                        totcor++;
                    }
                    else
                    {
                        finals[i] = "0"; // incorrect
                    }
                }
                else // nincs kötés
                {
                    if(corre[i].includes(usT[i]))
                    {
                        finals[i] = "1"; // correct
                        totcor++;
                    }
                    else
                    {
                        finals[i] = "0"; // not correct
                    }
                }
            }

            var bestsolu = {};
            bestsolu.sol = finals;
            bestsolu.total = totcor;
            bestsolus.push(bestsolu);
            var min = "";
            for(i=0;i<finals.length;i++)
            {
                min = min + finals[i];
            }

            //alert(min);
        }



        var ossz = "";

         bestsolus.sort(function(a, b){return b.total - a.total});


        //  return bestsolus[0].sol; // return a bestsolu object
        alert(bestsolus[0].sol);
        /*
        for(z=0;z<bestsolus.length;z++)
         {
            ossz = ossz + bestsolus[z].total + "-";
        }
        alert(ossz);
        */
    }



    function process(inp)
    {
        var userSol = userSolus.split("_");
      //  alert(userSol.length);
        var minden = "";
        obj = JSON.parse(inp);
        document.getElementById("title").innerHTML = obj[0].uid;
        var contents = obj[0].contents;
        var von = 0;
        for(i=0;i<contents.length;i++)
        {

            var sentence = contents[i].sentence;

            var distract1 = [];
            distract1 = contents[i].distractors;
            // var_dump($distract1);

            var corSolu = contents[i].solu; // ez egy array???

            var corr = "";

            var kulsoSols = "";
            for(k=0;k<sentence.length;k++)
            {
                var sols = "";
                if(k==0)
                {
                    for(var v=von;v<von + sentence.length-1;v++)
                    {
                        sols = sols + userSol[v] + "-";
                    }
                    kulsoSols = sols;
                    var mindi = "";
                    for(q=0;q<corSolu.length;q++)
                    {
                        mindi = mindi + corSolu[q];
                    }
                    alert(kulsoSols + " ::: " + corSolu + " ho: " + corSolu.length);
                   //  testCheck(kulsoSols, corSolu);
                  //  var finalSole = testCheck(kulsoSols, corSolu); //string + array
                   //  alert(finalSole);
                }

                // egy sor összes user tipple egy stringbe, pl: 1-1-0




                var dist = [];
                for(d=0;d<distract1.length;d++)
                {
                    dist = distract1[d];

                    var inn = "";
                    for(b=0;b<dist.length;b++)
                    {
                        inn = inn + "<span class='word' id='" + i + "w" + k + "w" + b + "' onclick='vonalClick(this)' >" + dist[b] + "</span>";
                    }
                }



               var vonalRa = "??";
                if(userSol[von].trim() != "GGG")
                {
                    vonalRa = dist[userSol[von]]; // de még nem tudjuk, hogy ez jó-e
                }
                else
                {
                    vonalRa = "__________";
                }


                var vonal = "<div class='tooltip2' id='" + i + k  + "' onclick='vonalClick(this);' > <span class='vona'>" + vonalRa + "</span><span id='s" + i + k + "' class='tooltiptext2'>" + inn + "</span></div>";

                if(k == sentence.length -1)
                {
                    vonal = " ";
                }
                else
                {
                    von++;
                }

                minden = minden + sentence[k] + vonal;

            }
            minden = minden + "<br />";




        }

        document.getElementById("test").innerHTML = minden;
    }

    function testing()
    {
        var user = "<?php echo $usersolus; ?>";
        alert(user);
    }


</script>







</head>
<body>
<div><?php echo $usersolus; ?></div>
<button onclick="testing();">test1</button>
<button onclick="loadDoc();">fill</button>
<div id="title">title</div>
<div style="max-width: 700px" id="test">???</div>




</body>
</html>