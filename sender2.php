<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>build gram</title>
    <script type="text/javascript" src="gram.js" ></script>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <script>


        function loadDoc()
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {


                    uzi2(this.responseText);

                }
            };
            kuld = "adat=valami";
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

            }





        }

        function valami()
        {
            if(popupid != "")
            {

                document.getElementById("s" + popupid).style.visibility = "hidden";
            }
        }


        function uzi2(inp)
        {
            var minden = "";
            var obj = JSON.parse(inp);
            var contents = obj[0].contents;

            for(i=0;i<contents.length;i++)
            {

                var sentence = contents[i].sentence;

                var distract1 = [];
                distract1 = contents[i].distractors;
                // var_dump($distract1);
                for(k=0;k<sentence.length;k++)
                {
                    var dist = [];
                    for(d=0;d<distract1.length;d++)
                    {
                        dist = distract1[d];

                        var inn = "";
                        for(b=0;b<dist.length;b++)
                        {
                            inn = inn + "<span class='word' id='" + i + k + d + b + "' onclick='vonalClick(this)' >" + dist[b] + "</span>";
                        }
                    }
                    var agi = contents[i].solutions;

                    var vonal = "<div class='tooltip2' id='" + i + k  + "' onclick='vonalClick(this);' > <span class='vona'>__________</span><span>" + agi[k] + "</span> <span id='s" + i + k + "' class='tooltiptext2'>" + inn + "</span></div>";

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
<body>
<a href="grami.php">grami</a>
<button onclick="loadDoc();" >nyom</button>
<button onclick="valami();">eltuntet</button>
<br />

<span id="afull"></span><br /><br />
<span id="demo" ></span>
<div id="test">???</div>
</body>

</html>