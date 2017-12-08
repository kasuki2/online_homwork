<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>build gram</title>
    <script type="text/javascript" src="gram.js" ></script>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <script>


        function loadDoc(afile)
        {
            document.getElementById("fileName").value = afile;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {


                    uzi2(this.responseText);

                }
            };
            kuld = "openthis=" + afile + ".json";
            xhttp.open("POST", "ajaxsend.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(kuld);
        }


        var popupid= "";

        var nyit = true;

        function vonalClick(el)
        {

            if(popupid !== "") // close previous
            {
                var eleme = document.getElementById(popupid);
                eleme.style.visibility = "hidden";
                var vonal = eleme.parentElement;
                vonal.style.backgroundColor = "transparent";
            }


            if(el.className === "word")
            {

                nyit = false;
                var pari = el.parentNode;
                document.getElementById(pari.id).style.visibility = "hidden";

                var pari1 = el.parentElement;
                var pari2 = pari1.parentElement;
                pari2.style.backgroundColor = "transparent";

                var avonal = pari2.getElementsByClassName("vona")[0];

                avonal.innerHTML = el.innerHTML;
                avonal.style.color = "#4466ff";
                avonal.style.fontWeight = "bold";

                // write in solution to the json tree
                var azo = el.id;
                var szamok = azo.split("w"); // 0 hanyadik mondat; 1 hagyadik gap; 2 hanyadik szó, ez a megoldás száma
                var szam1 = parseInt(szamok[0]);
                var szam2 = parseInt(szamok[1]);


                obj[0].contents[szam1].solutions[szam2] = szamok[2];
                var miez = obj[0].contents[szam1].solutions[szam2];
               // alert(miez);
            }


            if(el.className === "tooltip2") // vonal click
            {
                var popi = el.getElementsByClassName("tooltiptext2");

                popupid = popi[0].id;
                if(nyit === true)
                {
                    document.getElementById(popi[0].id).style.visibility = "visible";
                    el.style.backgroundColor = "#ffff66";
                }
                nyit = true;

               // var elem = document.getElementById("abody");
              //  elem.addEventListener("click", vonalClick, false);
            }




        }



        function testCheck(usTips, sols)
        {
            var userTipps = usTips; // string with -
            var solus = sols; // array
            userTipps = "1-";
            solus = "1";

            var usT = userTipps.split("-");

            var finals = [];
            var numa = 0;
            var bestsolus = [];
            var betuk = ["a", "b", "c", "d"];

            for(s=0;s<solus.length;s++)
            {
                var totcor = 0;
                var corre = solus[s].split("-");
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
            for(z=0;z<bestsolus.length;z++)
            {
                ossz = ossz + bestsolus[z].total + "-";
            }
            alert(bestsolus[0].sol);
        }


        function check()
        {
            var mind = "";
            var contents = obj[0].contents;


            for(i=0;i<contents.length;i++)
            {

                var sentence = contents[i].solutions;


                for(k=0;k<sentence.length;k++)
                {
                    var agi = contents[i].solutions;
                    mind = mind + agi[k] + "_";

                }


            }
            if(mind.includes("GGG"))
            {
                alert("Nem írtál be választ minden kérdéshez.");
            }
            document.getElementById("test2").innerHTML = mind;
            document.getElementById("userstips").value = mind;
            document.getElementById("soluform").submit();
        }

        function valami()
        {
            if(popupid !== "") // close previous
            {
                var eleme = document.getElementById(popupid);
                eleme.style.visibility = "hidden";

            }


        }

        var obj;
        function uzi2(inp)
        {


            var minden = "";
            obj = JSON.parse(inp);
            document.getElementById("title").innerHTML = obj[0].uid;
            var contents = obj[0].contents;

            for(i=0;i<contents.length;i++)
            {

                var sentence = contents[i].sentence;

                var distract1 = [];
                distract1 = contents[i].distractors;

                for(k=0;k<sentence.length;k++)
                {
                        if(k<sentence.length-1)
                        {
                            var dist = [];
                            for(d=0;d<distract1[k].length;d++)
                            {
                                dist = distract1[k];

                                var inn = "";
                                for(b=0;b<dist.length;b++)
                                {
                                    inn = inn + "<span class='word' id='" + i + "w" + k + "w" + b + "' onclick='vonalClick(this)' >" + dist[b] + "</span>";
                                }
                            }
                        }





                    var agi = contents[i].solutions;

                  //  var vonal = "<div class='tooltip2' id='" + i + k  + "' onclick='vonalClick(this);' > <span class='vona'>__________</span><span>" + agi[k] + "</span> <span id='s" + i + k + "' class='tooltiptext2'>" + inn + "</span></div>";
                    var vonal = "<div class='tooltip2' id='" + i + k  + "' onclick='vonalClick(this);' > <span class='vona'>__________</span><span id='s" + i + k + "' class='tooltiptext2'>" + inn + "</span></div>";

                    if(k == sentence.length -1)
                    {
                        vonal = " ";
                    }

                    minden = minden + sentence[k] + vonal;
                }
                minden = minden + "<br />";




            }

            document.getElementById("test").innerHTML = minden;
        }


    </script>
</head>
<body class="semmi" id="abody" ">
<a href="grami.php">grami</a><br/>
<div id="title">cim</div>
<button onclick="loadDoc('ujfile');" >angol</button>
<button onclick="loadDoc('ujfile2');" >német</button>
<button onclick="loadDoc('ujtestfile');" >angol 2</button>
<!-- <button onclick="valami();">eltuntet</button><br> -->
<button onclick="check();">submit for checking</button><br/>
<!-- <button onclick="testCheck();">test check</button><br /> -->
<br />

<span id="afull"></span><br /><br />
<span id="demo" ></span>
<div id="test">???</div>

<div id="test2" >???</div>
<form id="soluform" method="post"  action="checker.php">

<input type="hidden" id="userstips" name="solus" value="3333">
<input type="hidden" id="fileName" name="fileNeve" value="">

</form>

</body>

</html>