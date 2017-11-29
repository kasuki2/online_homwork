/**
 * Created by telaw on 2017. 10. 11..
 */
function send()
{
    // process text area input

    var content = document.getElementById("text").value;
  //  alert(content.charCodeAt(0));
    // §=167
    var mondat = content.split("§");
    if(mondat.length == 2)
    {
        alert("a mondat: " +mondat[0]);
        processMondat((mondat[0]));
    }



}


function processMondat(mond)
{
    // _ 95

    var mondatParts = mond.split("_");
    // alert("ennyi részből áll amondat: " + mondatParts.length);
    var mondResz = "";

    for(i = 0;i<mondatParts.length;i++)
    {
        mondResz += mondatParts[i] + " (XXX) ";
    }

    alert(mondResz);

}
