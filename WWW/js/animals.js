/**
 * @Author: Miroslav Karpíšek <miro>
 * @Date:   28-11-2017
 * @Email:  karpisek.m@email.cz
 * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 01-12-2017
 */


  var Data;
  var Expos;
  var Osetrovatel;
  var Spicies;





  $.get('query/getAnimals.php', function(responseText) {
      Data = jQuery.parseJSON(responseText);
      $.get('query/getExpo.php', function(responseText) {
          Expos = jQuery.parseJSON(responseText);
          $.get('query/getOsetrovatel.php', function(responseText) {
              Osetrovatel = jQuery.parseJSON(responseText);
              $.get('query/getSpicies.php', function(responseText) {
                  Spicies = jQuery.parseJSON(responseText);

                  fetchTable();
              });
          });
      });





  });


 function getExpoSelect(actual) {
     var string = '<option value=""></option>';

     Expos.forEach( function(elem, index) {
         string += '<option class="selectExpo" value="' + elem.idExpo + '" '+ check(actual.idExpo, elem.idExpo) + '>' + capitalizeFirstLetter(elem.druh) + " " + elem.jmeno + '</option>';
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

 function getSpiciesSelect() {
     var string = "";
     Spicies.forEach( function(elem, index) {
         string += '<option class="selectExpo" value="' + elem.idDruh + '">' + elem.rodoveJmeno + " " + elem.druhoveJmeno + '</option>';
     });

     return string;
 }


 var druhy = Array();

 function fetchTable() {

     var colEnd = "</td>";
     var body = "";

     var lastType = "";

     Data.forEach( function(elem, index) {

         var actualLine = "";

         var info = '<td style="padding: 5px 0px 3px 0px;" > <center><div class="glyphicon glyphicon-info-sign view normal info" style="font-size: 20px;"></div></center>' + colEnd;
         var view = '<td style="padding: 5px 0px 3px 0px;" > <center><div class="glyphicon glyphicon-chevron-left view normal" style="font-size: 20px;"></div></center>' + colEnd;


         // novy druh, je treba vytvorit zalozuku
         if(elem.idDruh != lastType) {



             var rod      = '<td><b>' + capitalizeFirstLetter(elem.rodoveJmeno) + '</b>' + colEnd;
             var druh     = '<td>' + capitalizeFirstLetter(elem.druhoveJmeno) + colEnd;
             var space    = '<td>' + colEnd;
            var druhInfo = '<td id="e'+ elem.idDruh +'" class="druhInfo">' + colEnd;
            getWarnings(elem.idDruh, 'e' + elem.idDruh);

             var jidlo    = '<td colspan="2">' + getFood(elem.strava) + colEnd;


             var newLine =   '<tr class="header expand ' + '">';
                 newLine +=  rod + druh + jidlo + druhInfo + space + view;
                 newLine +=  '</tr>';

            actualLine += newLine;
         }

         var space   =  '<td>' + colEnd;
         var vek     =  '<td>' + yearDiff(new Date(elem.narozeni), new Date()) + colEnd;
         var pohlavi =  '<td>' + getGender(elem.pohlavi) + colEnd;
         var jmeno   =  '<td><i>' + capitalizeFirstLetter(elem.jmeno) + '</i>'+ colEnd;
         var prirazeni = '<td>' + '<select name="osetrovatel" class="col-xs-6 osetrovatel" druh="'+ elem.idDruh +'" id="'+ elem.idZvire +'">' + getOsetrovatelSelect(elem) + ' </select>' + '<select name="expo" class="expo col-xs-offset-1 col-xs-5" id="'+ elem.idZvire +'" druh="'+ elem.idDruh +'">' + getExpoSelect(elem) + ' </select>' +colEnd;
         var infoBar = '<td>' + checkAnimal(elem) + colEnd;



         var animalsInfo = '<tr id='+ elem.idZvire +' class="active animal_info" style="display:none">' + space + jmeno + vek + pohlavi + infoBar + prirazeni+ info + '</td> </tr>';

         actualLine += animalsInfo;

         lastType = elem.idDruh;

         body += actualLine;
     });



    document.getElementById("table").innerHTML = body;

    $('#osetrovatel').html(getOsetrovatelSelect(NaN));

    $('#expo').html(getExpoSelect(NaN));

    $('#druhStary').html(getSpiciesSelect());

    $('.expo').change(function() {
        var expo = $(this).val();
        var zvire = $(this).attr('id');
        var druh = $(this).attr('druh');
        var checkbox = $(this);

        $.post('query/animalChangeExpo.php', {idExpo: expo, idZvire: zvire}, function() {
            if(expo == "") {
                checkbox.closest('tr').find('.infoExpo').show();

                $('#e' + druh).attr('e', parseInt($('#e' + druh).attr('e')) + 1);
                $('#e' + druh).find('.infoExpo').show();
            }
            else {

                if(checkbox.closest('tr').find('.infoExpo').is(":visible")) {
                    $('#e' + druh).attr('e', parseInt($('#e' + druh).attr('e')) - 1);
                }
                if($('#e' + druh).attr('e') == 0) {
                    $('#e' + druh).find('.infoExpo').hide();
                }

                checkbox.closest('tr').find('.infoExpo').hide();
            }

        });
    });

    $('.osetrovatel').change(function() {
        var osetrovatel = $(this).val();
        var zvire = $(this).attr('id');
        var checkbox = $(this);
        var druh = $(this).attr('druh');

        $.post('query/animalChangeOsetrovatel.php', {idOsetrovatel: osetrovatel, idZvire: zvire});
        if(osetrovatel == "") {
            checkbox.closest('tr').find('.infoUser').show();

            $('#e' + druh).attr('z', parseInt($('#e' + druh).attr('z')) + 1);
            $('#e' + druh).find('.infoUser').show();

        }
        else {


            if(checkbox.closest('tr').find('.infoUser').is(":visible")) {
                $('#e' + druh).attr('z', parseInt($('#e' + druh).attr('z')) - 1);
            }
            if($('#e' + druh).attr('z') == 0) {
                $('#e' + druh).find('.infoUser').hide();
            }
            checkbox.closest('tr').find('.infoUser').hide();
        }
    });


     // rozkliknuti
     $('.header').click(function(){
         $(this).toggleClass('expand').nextUntil('tr.header').slideToggle(100);
     });

     // ukazani moznosti rozkliknuti
     $('.view').hide();

     $('.info').click(function(){
         var zvire = $(this).closest('tr').attr('id');
         $.get('query/getAnimalInfo.php', {idZvire: zvire}, function(returned) {
             var Data = jQuery.parseJSON(returned);
             if(Data.puvod == '') {
                 Data.puvod = '-';
             }

             $('#sPohlavi').html(getGender(Data.pohlavi));
             $('#sTitulek').html(capitalizeFirstLetter(Data.rodoveJmeno) + ' ' + (Data.druhoveJmeno));
             $('#sVyskyt').html(capitalizeFirstLetter(Data.vyskyt));
             $('#sPuvod').html(capitalizeFirstLetter(Data.puvod));
             $('#sNarozeni').html(Data.narozeni);
             $('#sJmeno').html(capitalizeFirstLetter(Data.jmeno));
             $('#sStrava').html(getFood(Data.strava));
             $('#kickBut').val(Data.idZvire);

             // TODO INFORMACE

             $('#animalShow').modal('toggle');
         });

     });

     $('.info').mouseover( function() {
         $(this).toggleClass('blue');
     });
     $('.info').mouseleave( function() {
         $(this).toggleClass('blue');
     });

     $(".header").mouseover(function() {
         $(this).find('.view').show();
     });

     $(".animal_info").mouseover(function() {
         $(this).find('.view').show();
     });

     $(".kickBut").click(function(event){
         if(!confirm("Opravdu přejete toto zvíře odebrat?")) {
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

     $(".animal_info").mouseleave(function() {
         if($(this).find('.view').hasClass('glyphicon glyphicon-info-sign')) {
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

 function yearDiff(d1, d2) {
    var years;
    years = (d2.getFullYear() - d1.getFullYear());
    return years <= 0 ? 0 : years;
 }

 function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function getFood(food) {
    if(food == "B") {
        return '<i class="glyphicon glyphicon-leaf"></i>';
    }
    if(food == "M") {
        return '<img src="svg/meat.png" width="14px" height="16px" > </img>';
    }
    if(food == "V") {
        return '<i class="glyphicon glyphicon-leaf"></i><img src="svg/meat.png" width="14px" height="16px" > </img>';
    }
}

function getGender(gender) {
    if(gender == "F") return '<i class="fa fa fa-venus" style="font-size:18px;"></i>';
    else if(gender == "M") return '<i class="fa fa fa-mars" style="font-size:18px;"></i>';
    else return '<i class="fa fa fa-neuter" style="font-size:18px"></i>';
}

// pridani noveho druhu

$('.novyDruh').hide();
$('#druh').click( function() {
    $('.novyDruh').toggle();
    $('.staryDruh').toggle();
});

$('#pohlavi').click( function() {
    $(this).removeClass('btn-danger');
    $(this).removeClass('btn-info');
    $(this).removeClass('btn-warning');

    if($('#hType').val() == "M") {
        $(this).addClass('btn-danger');
        $(this).html('<i class="fa fa fa-venus" style="font-size:18px; width:21px"></i>');
        $('#hType').val("F");
    }
    else if($('#hType').val() == "F") {
        $(this).addClass('btn-warning');
        $(this).html('<i class="fa fa fa-neuter" style="font-size:18px; width:21px"></i>');
        $('#hType').val("N");
    }
    else {
        $(this).addClass('btn-info');
        $(this).html('<i class="fa fa fa-mars" style="font-size:18px; width:21px"></i>');
        $('#hType').val("M");
    }
});

$('#strava').click( function() {
    if($('#hStrava').val() == "M") {
        $(this).html('<i class="glyphicon glyphicon-leaf"></i>');
        $('#hStrava').val("B");
    }
    else {
        $(this).html('<img src="svg/meat.png" width="14px" height="16px" > </img>');
        $('#hStrava').val("M");
    }
});

function check(s1, s2) {
    if(s1 == s2) {
        return 'selected';
    }
}

function checkAnimal(animal) {
    var string="";
    if(animal.idZamestnance == null) {
        string += '<span class="glyphicon glyphicon-user infoUser" style="color: red; margin-left:10px "></span>';
    }
    else {
        string += '<span class="glyphicon glyphicon-user infoUser" style="color: red; margin-left:10px ; display: none"></span>';
    }

    if(animal.idExpo == null) {
        string += '<span class="glyphicon glyphicon-home infoExpo" style="color: red; margin-left:10px ;"></span>';
    }
    else {
        string +=  '<span class="glyphicon glyphicon-home infoExpo" style="color: red; margin-left:10px ; display: none"></span>';
    }

    return string;
}

function getWarnings(elem, elemID) {
    $.get('query/noExpoOrEmpl.php?idDruh='+elem, function(data) {
        var Info = jQuery.parseJSON(data);
        string = " ";
        var z = 0;
        var e = 0
        if(typeof Info != 'undefined') {
            Info.forEach( function(elem, index) {
                if(elem.idZamestnance == null) {
                    z++;
                }
                if(elem.idExpo == null) {
                    e++;
                }


            });
        }

        if(z > 0) {
            string += '<span class="glyphicon glyphicon-user infoUser" style="color: red; margin-left:10px "></span>';
        }
        else {
            string += '<span class="glyphicon glyphicon-user infoUser" style="color: red; margin-left:10px ; display: none"></span>';
        }

        if(e > 0) {
            string += '<span class="glyphicon glyphicon-home infoExpo" style="color: red; margin-left:10px ;"></span>';
        }
        else {
            string +=  '<span class="glyphicon glyphicon-home infoExpo" style="color: red; margin-left:10px ; display: none"></span>';
        }



        $('#'+ elemID).html(string);
        $('#'+ elemID).attr('z', z);
        $('#'+ elemID).attr('e', e);

    });
}
