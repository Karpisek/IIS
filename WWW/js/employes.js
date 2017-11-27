/**
 * @Author: Miroslav Karpíšek <miro>
 * @Date:   26-11-2017
 * @Email:  karpisek.m@email.cz
 * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 27-11-2017
 */

var rowMem;
var idexMem;



$.get('query/getEmployes.php', function(responseText) {

    var Data = jQuery.parseJSON(responseText);
    fetchTable(Data);
});

function fetchTable(Data) {

    var colStart = "<td>";
    var colEnd = "</td>";
    var tBody = "";

    Data.sort(SortByName);
    Data.reverse();

    Data.forEach( function(elem, index) {

        var viewB = '<button type="button" class="btn btn-primary view" value='+ index +'>View</button>';
        var editB = '<button type="button" class="btn btn-success" >Edit</button>';

        var titul = '<td class="col-xs-1 container">' + elem.titul + colEnd;
        var jmeno = '<td class="col-xs-2 container">' + elem.jmeno + colEnd;
        var prijmeni = '<td class="col-xs-3 container">' + elem.prijmeni + colEnd;
        var email = '<td class="col-xs-3  container">' + elem.mail + colEnd;
        var edit = '<td class="col-xs-2 container ">' + viewB + " " + editB + colEnd;

        tBody += "<tr>";
        tBody += titul + jmeno + prijmeni + email + edit;
        tBody += "</tr>";
    });

    document.getElementById("table").innerHTML += tBody;

    $('.view').click(function(){

        indexMem = this.value;
        rowMem = $(this).closest('tr').html();

        // zmenim dany radek na vypis detailu
        $(this).closest('tr').load('shared/detail.php?id=' + Data[indexMem].idZamestnance);

    });
}

function SortByName(a, b){
  var aName = a.prijmeni.toLowerCase();
  var bName = b.prijmeni.toLowerCase();
  return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
}
