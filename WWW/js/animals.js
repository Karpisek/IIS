/**
 * @Author: Miroslav Karpíšek <miro>
 * @Date:   28-11-2017
 * @Email:  karpisek.m@email.cz
 * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 28-11-2017
 */

 /**
  * @Author: Miroslav Karpíšek <miro>
  * @Date:   26-11-2017
  * @Email:  karpisek.m@email.cz
  * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 28-11-2017
  */

 var Data;


 $.get('query/getAnimals.php', function(responseText) {

     Data = jQuery.parseJSON(responseText);

     if(fetch) {
         fetchTable();
     }

 });

 function fetchTable() {

     var colEnd = "</td>";
     var body = "";

     Data.forEach( function(elem, index) {

         // zakladni cast

         var lineStyle = "";

         var actualDate = new Date();
         var contractDate = new Date (elem.smlouva);

         if(monthDiff(actualDate, contractDate) < 3) {
             lineStyle = "warning";
         }
         else if(monthDiff(actualDate, contractDate) === 0) {
             lineStyle = "danger";
         }


         var view = '<center><div class="glyphicon glyphicon-chevron-left view normal" style="font-size: 20px;"></div></center>';
         //var edit = '<button type="button" class="btn btn-success" style="margin-left: 2px;" > Edit </button>';

         var titul     =   '<td class="col-xs-1">' +   elem.titul    +   colEnd;
         var jmeno     =   '<td class="col-xs-3">' +   elem.jmeno    +   colEnd;
         var prijmeni  =   '<td class="col-xs-3">' +   elem.prijmeni +   colEnd;
         var email     =   '<td class="col-xs-3">' +   elem.mail     +   colEnd;
         var tlacitka  =   '<td class="col-xs-1" style="padding: 5px 0px 3px 0px;" >' +   view   +   colEnd;



         var newLine =   '<tr class="header expand ' + lineStyle + '" id="h' + elem.idZamestnance + '">';
             newLine +=  titul + jmeno + prijmeni + email + tlacitka;
             newLine +=  '</tr>';


         // rozsirena cast

         var titulForm =' <div class="col-xs-2"> <label for="ex1">Titul</label> <input class="form-control userForm" maxlength="5" type="text" value=' + elem.titul + ' name="titul"> </div>';

         var jmenoForm = '<div class="col-xs-2"> <label for="ex1">Jméno</label> <input class="form-control userForm" maxlength="10" type="text" value=' + elem.jmeno + ' name="jmeno"> </div>';

         var prijmeniForm = '<div class="col-xs-2"> <label for="ex2">Příjmení</label> <input class="form-control userForm" id="ex2" type="text" value=' + elem.prijmeni + ' name="prijmeni"> </div>';

         var narozeniForm = '<div class="col-xs-3"> <label for="ex2">Datum narození</label> <input class="form-control userForm" id="ex3" type="date" placeholder="DD/MM/RRRR" value=' + elem.narozeni + ' name="narozeni"> </div>';

         var tlacitkaForm = '<div class="col-xs-3" style="margin-top: 25px"> <div class="col-xs-2"></div> <input type="button" class="btn btn-warning col-xs-fluid updateBut" style="margin-left:5px" value="Update"> <input type="button" class="btn btn-danger col-xs-fluid kickBut" style="margin-left:5px" value="Kick"> </div>'

         var loginForm = '<div class="col-xs-3"> <label for="ex1">Login</label> <input class="form-control userForm" id="ex1" type="text" value=' + elem.login + ' name="login"> </div>';

         var emailForm = '<div class="col-xs-3"> <label for="ex1">Email</label> <input class="form-control userForm" id="ex1" type="text" value=' + elem.mail + ' name="mail"> </div>';

         var rcForm = '<div class="col-xs-3"> <label for="ex2">Rodné číslo</label> <input class="form-control userForm" id="ex3" type="text" value=' + elem.rodneCislo + ' name="rodneCislo"> </div>';

         var vzdelaniForm = '<div class="col-xs-9"> <label for="ex1">Vzdelani</label> <input class="form-control userForm" id="ex1" type="text" value=' + elem.vzdelani + ' name="vzdelani"> </div>';

         var smlouva = '<div class="col-xs-3"> <label for="ex1">Smlouva</label> <input class="form-control userForm '+ lineStyle +'" id="ex1" type="date" value=' + elem.smlouva + ' name="smlouva"> </div>';

         var plat = '<div class="col-xs-3 "> <label for="ex1">Plat</label> <input class="form-control userForm" id="ex1" type="number" value=' + elem.plat + ' name="plat"> </div>';


         var line1 = '<div class="form-group row">' + titulForm + jmenoForm + prijmeniForm + narozeniForm + '</div>';
         var line2 = '<div class="form-group row">' + loginForm + emailForm + rcForm + '</div>';
         var line3 = '<div class="form-group row">' + vzdelaniForm + '</div>';
         var line4 = '<div class="form-group row">' + '<div class="col-xs-3"></div>' + smlouva + plat + tlacitkaForm + '</div>';



         var newInfo = '<tr class="active" style="display:none"> <td colspan="5"> <form>' + line1 + line2 + line3 + line4 + '</form> </td> </tr>';

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
         serializedNewForm = $(this).closest('form').serialize();
         alert("kick");
     });

     // smazani stareho
     $(".updateBut").click(function(event){
         serializedNewForm = $(this).closest('form').serialize();
         alert("update");
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

 function SortByName(a, b){
   var aName = a.prijmeni.toLowerCase();
   var bName = b.prijmeni.toLowerCase();
   return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
 }




 // pridani noveho
 var serializedNewForm;

 $("#newEmpBut").click(function(event){
     if($("#newEmpForm").validate()) {
         if($("#newEmpForm").valid()) {
             serializedNewForm = $( "#newEmpForm" ).serialize();
             $('#addEmp').find(".form-control").val('').end();
             $('#addEmp').modal('toggle');
             $('#setLogin').modal('toggle');
         }
     }
 });

 $("#setLoginBut").click(function(event){
     if($("#setLoginForm").validate()) {
         if($("#setLoginForm").valid()) {
             serializedNewForm = $( "#setLoginForm" ).serialize();
             $('#setLogin').find(".form-control").val('').end();
             $('#setLogin').modal('toggle');

             alert(serializedNewForm);
             location.reload();
         }
     }


 });


 function monthDiff(d1, d2) {
     var months;
     months = (d2.getFullYear() - d1.getFullYear()) * 12;
     months -= d1.getMonth() + 1;
     months += d2.getMonth();
     return months <= 0 ? 0 : months;
 }
