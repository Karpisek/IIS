/**
 * @Author: Miroslav Karpíšek <miro>
 * @Date:   26-11-2017
 * @Email:  karpisek.m@email.cz
 * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 01-12-2017
 */

var Data;

function SortByName(a, b){
  var aName = a.prijmeni.toLowerCase();
  var bName = b.prijmeni.toLowerCase();
  return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
}

$.get('query/getEmployes.php', function(responseText) {

    Data = jQuery.parseJSON(responseText);
    fetchTable();
});

function fetchTable() {

    var colEnd = "</td>";
    var body = "";

    Data.forEach( function(elem, index) {

        // zakladni cast

        var contract = "<td>";

        var actualDate = new Date();
        var contractDate = new Date (elem.smlouva);

        if(elem.smlouva == "0000-00-00" || monthDiff(actualDate, contractDate) == 0) {
            contract = '<td><span class="glyphicon glyphicon-time" style="color: red; font-size: 16px"></span>';
        }
        if(monthDiff(actualDate, contractDate) < 3) {
            contract = '<td><span class="glyphicon glyphicon-time" style="color: orange; font-size: 16px"></span>';
        }

        contract += colEnd;

        var view = '<center><div class="glyphicon glyphicon-chevron-left view normal" style="font-size: 20px;"></div></center>';
        //var edit = '<button type="button" class="btn btn-success" style="margin-left: 2px;" > Edit </button>';

        var titul     =   '<td>' +   elem.titul    +   colEnd;
        var jmeno     =   '<td>' +   elem.jmeno    +   colEnd;
        var prijmeni  =   '<td>' +   elem.prijmeni +   colEnd;
        var email     =   '<td>' +   elem.mail     +   colEnd;
        var tlacitka  =   '<td style="padding: 5px 0px 3px 0px;" >' +   view   +   colEnd;



        var newLine =   '<tr class="header expand" id="h' + elem.idZamestnance + '">';
            newLine +=  titul + jmeno + prijmeni + email + contract + tlacitka;
            newLine +=  '</tr>';

        // rozsirena cast
        var titulForm =' <div class="col-xs-2"> <label for="ex1">Titul</label> <input class="form-control userForm" maxlength="5" type="text" '+ empty(elem.titul) + ' name="titul"> </div>';

        var jmenoForm = '<div class="col-xs-2"> <label for="ex1">Jméno</label> <input class="form-control userForm" maxlength="10" type="text" '+ empty(elem.jmeno) + ' name="jmeno"> </div>';

        var prijmeniForm = '<div class="col-xs-2"> <label for="ex2">Příjmení</label> <input class="form-control userForm" id="ex2" type="text" '+ empty(elem.prijmeni) + ' name="prijmeni"> </div>';

        var narozeniForm = '<div class="col-xs-3"> <label for="ex2">Datum narození</label> <input class="form-control userForm " id="ex3" type="date" placeholder="DD/MM/RRRR" '+ empty(elem.narozeni) + ' name="narozeni"> </div>';

        var tlacitkaForm = '<div class="col-xs-3" style="margin-top: 25px"> <div class="col-xs-2"></div> <button type="submit" class="btn btn-warning col-xs-fluid updateBut" style="margin-left:5px" name="update" value='+ elem.login +'>Update</button> <button type="submit" class="btn btn-danger col-xs-fluid kickBut" style="margin-left:5px" name="kick" value=' + elem.login + '>Kick</button></div>'
        var loginForm = '<div class="col-xs-3"> <label for="ex1">Login</label> <input class="form-control userForm" id="ex1" type="text" '+ empty(elem.login) + ' name="login"> </div>';

        var emailForm = '<div class="col-xs-3"> <label for="ex1">Email</label> <input class="form-control userForm" id="ex1" type="text" '+ empty(elem.mail) + ' name="email"> </div>';

        var rcForm = '<div class="col-xs-3"> <label for="ex2">Rodné číslo</label> <input class="form-control userForm" id="ex3" type="text" '+ empty(elem.rodneCislo) + ' name="rodneCislo"> </div>';

        var smlouva = '<div class="col-xs-3"> <label for="ex1">Smlouva</label> <input class="form-control userForm" id="ex1" type="date" '+ empty(elem.smlouva) + ' name="smlouva"> </div>';

        var plat = '<div class="col-xs-3 "> <label for="ex1">Plat</label> <input class="form-control userForm" id="ex1" type="number" '+ empty(elem.plat) + ' name="plat"> </div>';

        var specializace = '<div class="col-xs-3 "> <label for="osetrovatel">Pracovní poměr</label> <select class="form-control" id="osetrovatel" name="specializace" '+empty(elem.specializace) +'> <option value="osetrovatel" '+ check(elem.specializace, "osetrovatel") + '>Ošetřovatel</option> <option value="uklizec" ' + check(elem.specializace, "uklizec") +'>Pomocná síla</option> <option value="boss" '+ check(elem.specializace, "boss") + '>Vedoucí</option> </select> </div>';

        var hiddenOldSpecializace = '<input name="oldSpec" value="'+ elem.specializace +'" hidden></input>';

        var hiddenId= '<input name="idZamestnance" value="'+ elem.idZamestnance +'" hidden></input>'

        var line1 = '<div class="form-group row">' + titulForm + jmenoForm + prijmeniForm + narozeniForm + '</div>';
        var line2 = '<div class="form-group row">' + loginForm + emailForm + rcForm + '</div>';
        var line4 = '<div class="form-group row">' + specializace + smlouva + plat + hiddenId + tlacitkaForm + hiddenOldSpecializace + '</div>';



        var newInfo = '<tr class="active" style="display:none"> <td colspan="6"> <form method="post" action="" data-toggle="validator" role="form" >' + line1 + line2 + line4 + '</form> </td> </tr>';

        // sjednoceni
        body += newLine + newInfo;
    });


    document.getElementById("table").innerHTML = body;

    // rozkliknuti
    $('.header').click(function(){
        $(this).toggleClass('expand').nextUntil('tr.header').slideToggle(100);
    });

    // ukazani moznosti rozkliknuti
    $('.view').hide();

    $(".header").mouseover(function() {
        $(this).find('.view').show();
    });

    // smazani stareho
    $(".kickBut").click(function(event){
        if(!confirm("Opravdu chcete tohoto zaměstnance odebrat z IS?")) {
            event.preventDefault();
        }
    });


    $(".updateBut").click(function(event){
        if(!confirm("Opravdu si upravit informace zvoleného zaměstnance?")) {
            event.preventDefault();
        }
    });

    $(".header").click(function() {
        if($(this).find('.view').hasClass('glyphicon-chevron-left')) {
            $(this).find('.view').removeClass('glyphicon-chevron-left');
            $(this).find('.view').addClass('glyphicon-chevron-down');
            $('#tableBox').height($('#tableBox').height() + 313);

        }
        else {
            $(this).find('.view').removeClass('glyphicon-chevron-down');
            $(this).find('.view').addClass('glyphicon-chevron-left');

            setTimeout(function() {
                if($('#tableBox').height() - 313 < 500) {
                    $('#tableBox').height(500);
                }
                else {
                    $('#tableBox').height($('#tableBox').height() - 313);
                }
            },10);

        }

    });

    $(".header").mouseleave(function() {
        if($(this).find('.view').hasClass('glyphicon-chevron-left')) {
            $(this).find('.view').hide();
        }
    });

}

function monthDiff(d1, d2) {
    var months;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months -= d1.getMonth() + 1;
    months += d2.getMonth();
    return months <= 0 ? 0 : months;
}

function empty(string) {
    if(string == "" || string == "0" || string == "0000-00-00") {
        return;
    }
    else return 'value=' + string ;
}

function check(s1, s2) {
    if(s1 == s2) {
        return 'selected';
    }
}
