/**
 * @Author: Miroslav Karpíšek <miro>
 * @Date:   28-11-2017
 * @Email:  karpisek.m@email.cz
 * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 01-12-2017
 */


  var Expos;
  var ExpoTypes;
  var Uklizec;



  function getExpoSelect() {
      var string = '';

      ExpoTypes.forEach( function(elem, index) {
          string += '<option class="selectExpo" value="' + elem.druh + '">' + capitalizeFirstLetter(elem.druh) + '</option>';
      });

      return string;
  }

  function getOsetrovatelSelect(actual) {
      var string = '<option value=""></option>';
      Osetrovatel.forEach( function(elem, index) {
          string += '<option class="selectExpo" value="' + elem.idZamestnance + '" '+ check(actual.idZamestnance, elem.idZamestnance) + '>' + capitalizeFirstLetter(elem.jmeno) + " " + capitalizeFirstLetter(elem.prijmeni) + '</option>';
      });

      return string;
  }
  $.get('query/getUklizec.php', function(responseText) {
      Osetrovatel = jQuery.parseJSON(responseText);
      $.get('query/getExpo.php', function(responseText) {
          Expos = jQuery.parseJSON(responseText);
          $.get('query/getTypesExpo.php', function(data) {
              ExpoTypes = jQuery.parseJSON(data);

              fetchTable();
          });
      });
  });

 var typy = Array();

 function fetchTable() {

     var colEnd = "</td>";
     var body = "";

     var lastType = "";

     Expos.forEach( function(elem, index) {

         var actualLine = "";

         var info = '<td style="padding: 5px 0px 3px 0px;" > <center><div class="glyphicon glyphicon-info-sign view normal info" style="font-size: 20px;"></div></center>' + colEnd;
         // novy druh, je treba vytvorit zalozuku
         if(elem.druh != lastType) {
             var view = '<td style="padding: 5px 0px 3px 0px;" > <center><div class="glyphicon glyphicon-chevron-left view normal" style="font-size: 20px;"></div></center>' + colEnd;


             var expoName  =   '<td><b>' + capitalizeFirstLetter(elem.druh) + '</b> ' + colEnd;


             var space     =   '<td colspan="8">' + colEnd;

             var newLine =   '<tr class="header expand ' + '">';
                 newLine +=  expoName + space + view;
                 newLine +=  '</tr>';

            actualLine += newLine;
         }


         var jmeno   =  '<td colspan="1"><i>' + capitalizeFirstLetter(elem.jmeno) + '</i>'+ colEnd;
         var count   =  '<td colspan="1" id=e'+elem.idExpo+'>' + colEnd;
         var prirazeni = '<td colspan="5">' + '<select name="uklizec" class="col-xs-6 osetrovatel" id="'+ elem.idExpo +'">' + getOsetrovatelSelect(elem) + ' </select>' +colEnd;

         getCount(elem.idExpo, 'e' + elem.idExpo);

         var infoBar = '<td colspan="1">' + checkExpo(elem) + colEnd;

         var animalsInfo = '<tr id='+ elem.idExpo +' class="active animal_info" style="display:none"> <td colspan="1"></td> '+ jmeno + count + infoBar + prirazeni + info +'</td> </tr>';

         actualLine += animalsInfo;

         lastType = elem.druh;

         body += actualLine;
     });



    document.getElementById("table").innerHTML = body;

    $('.osetrovatel').change(function() {
        var osetrovatel = $(this).val();
        var expo = $(this).attr('id');
        var checkbox = $(this);
        $.post('query/expoChangeOsetrovatel.php', {idOsetrovatel: osetrovatel, idExpo: expo});
        if(osetrovatel == "") {
            checkbox.closest('tr').find('.infoUser').show();
        }
        else {
            checkbox.closest('tr').find('.infoUser').hide();
        }
    });


     // rozkliknuti
     $('.header').click(function(){
         $(this).toggleClass('expand').nextUntil('tr.header').slideToggle(100);
     });

     $('.info').click(function(){
         $('#expoShow').modal('toggle');
         //alert( $(this).closest('tr').attr('id'));
     });

     // ukazani moznosti rozkliknuti
     $('.view').hide();

     $('.info').click(function(){
         var expo = $(this).closest('tr').attr('id');
         $.get('query/getExpoInfo.php', {idExpo: expo}, function(returned) {
             var Data = jQuery.parseJSON(returned);
             if(Data.jmeno == '') {
                 Data.jmeno = '-';
             }

             $('#sTitulek').html(capitalizeFirstLetter(Data.druh) + ' ' + capitalizeFirstLetter(Data.jmeno));
             getCount(Data.idExpo, 'sKapacita');
             getName(Data.idZamestnance, 'sPracovnik');
             $('#kickBut').val(Data.idExpo);

             // TODO INFORMACE

             $('#animalShow').modal('toggle');
         });
     });

     $(".header").mouseover(function() {
         $(this).find('.view').show();
     });

     $(".animal_info").mouseover(function() {
         $(this).find('.view').show();
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

     $(".animal_info").mouseleave(function() {
         if($(this).find('.view').hasClass('glyphicon glyphicon-info-sign')) {
             $(this).find('.view').hide();
         }
     });

     $("#expoStary").html(getExpoSelect());
     $('#osetrovatel').html(getOsetrovatelSelect(NaN));
 }

 function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function getCount(id, elemID) {

    $.get('query/getNumberPerExpo.php?idExpo='+id, function(data) {
        var count = jQuery.parseJSON(data);
        var begin = '';
        var end   = '';

        if(count[0].pocet == count[0].max) {
            begin = '<b style="color:red">';
            end   = '</b>'
        }

        $('#'+ elemID).html(begin + count[0].pocet + end + '<b> / ' + count[0].max + '</b>');
    });
}

function getName(id, elemID) {
    $.get('query/getThisEmpl.php?idZamestnance='+id, function(data) {
        var result = jQuery.parseJSON(data);
        var jmeno = result.jmeno;
        var prijmeni = result.prijmeni;

        $('#' + elemID).html(capitalizeFirstLetter(jmeno) + ' ' + capitalizeFirstLetter(prijmeni));
    });
}

$('#typ').click( function() {
    $('.novyExpo').toggle();
    $('.staryExpo').toggle();
});

$('.novyExpo').hide();

$(".kickBut").click(function(event){
    if(!confirm("Opravdu si přejete smazat tuto expozici?")) {
        event.preventDefault();
    }
});



function checkExpo(elem) {
    var string="";
    if(elem.idZamestnance == null) {
        string += '<span class="glyphicon glyphicon-user infoUser" style="color: red; margin-left:10px "></span>';
    }
    else {
        string += '<span class="glyphicon glyphicon-user infoUser" style="color: red; margin-left:10px ; display: none"></span>';
    }

    return string;
}

function check(s1, s2) {
    if(s1 == s2) {
        return 'selected';
    }
}
