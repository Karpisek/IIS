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
var trMem;
var Data;

getData(true);

$(window).click(function(e) {
    if (!(e.target.id == "detail" || $(e.target).parents("#detail").length)) {
        if ( $( "#detail" ).length ) {
            if ($(e.target).hasClass('view')) {
                $("#table").hide();
            }

            setTimeout(function() {
                $.get('query/getEmployes.php', function(responseText) {

                    Data = jQuery.parseJSON(responseText);



                    fetchTable();

                    if ($(e.target).hasClass('view')) {
                            var view = $('button[value="'+e.target.value+'"]').closest('tr').find('.view');
                            view.value = e.target.value;
                            ViewListener(view);
                            $("#table").fadeIn();
                    }

                    filterTable();
                });

            }, 1);
        }

    }
});


function getData(fetch) {
    $.get('query/getEmployes.php', function(responseText) {

        Data = jQuery.parseJSON(responseText);

        if(fetch) {
            fetchTable();
        }

    });
}


function fetchTable() {

    var colStart = "<td>";
    var colEnd = "</td>";
    var tBody = "";

    Data.forEach( function(elem, index) {

        var viewB = '<button type="button" class="btn btn-primary view" value='+ Data[index].idZamestnance +'>View</button>';
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

    document.getElementById("table").innerHTML = tBody;

    $('.view').click(function(){
        ViewListener(this);
    });

}

function SortByName(a, b){
  var aName = a.prijmeni.toLowerCase();
  var bName = b.prijmeni.toLowerCase();
  return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
}

function ViewListener(e) {
        indexMem = e.value;
        rowMem = $(e).closest('tr').html();

        // zmenim dany radek na vypis detailu
        trMem = $(e).closest('tr');
        trMem.load('shared/detail.php?id=' + e.value);

}
