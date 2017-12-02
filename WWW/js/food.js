/**
 * @Author: Miroslav Karpíšek <miro>
 * @Date:   01-12-2017
 * @Email:  karpisek.m@email.cz
 * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 01-12-2017
 */



var Food;

$.get('query/getFood.php', function(data) {
    Food = jQuery.parseJSON(data);

    fetchTable();
});

function getDate(elem) {
    var actualDate = new Date();
    var contractDate = new Date (elem.trvanlivost);
    var months = monthDiff(actualDate, contractDate);

    string = "";
    if(months <= 1) {
        string = '<span class="glyphicon glyphicon-time col-xs-5 col-xs-offset-7" style="color: orange; font-size: 16px; "></span>';
    }
    if(months <= 0) {
        string = '<span class="glyphicon glyphicon-time col-xs-5 col-xs-offset-7" style="color: red; font-size: 16px; "></span>';
    }

    return string;
}

function fetchTable() {
    var colEnd = "</td>";
    var body = "";
    var info = '<td style="padding: 5px 0px 3px 0px;" > <center><div class="glyphicon glyphicon-info-sign view normal info" style="font-size: 20px;"></div></center>' + colEnd;
    var plusAndminus = '<td style="padding: 5px 0px 3px 0px;" ><center><div class="glyphicon glyphicon-minus-sign view normal minus" style="font-size: 20px; margin-left: 5px;"></div><div class="glyphicon glyphicon-plus-sign view normal plus" style="font-size: 20px; margin-left: 5px;"></div></center>' + colEnd;

    Food.forEach(function(elem, index) {
         var actualLine = "";

         var nazev          = '<td>' + capitalizeFirstLetter(elem.druh) + colEnd;
         var typ            = '<td>' + getFood(elem.kategorie) + colEnd;
         var mnozstvi       = '<td class="mnozstvi" mnozstviMem="'+ elem.mnozstvi +'" >' + elem.mnozstvi + colEnd;
         var trvanlivost    = '<td>' + elem.trvanlivost + colEnd;
         var porizeno       = '<td>' + elem.porizeno + colEnd;



         var expiration     = '<td>' + getDate(elem) + colEnd;

         if(elem.mnozstvi > 0) {
             actualLine += '<tr id='+ elem.idKrmiva +' class="animal_info" >' + nazev + typ + mnozstvi + expiration + trvanlivost + porizeno + plusAndminus + info + '</td> </tr>';
             body += actualLine;
         }

    });

    document.getElementById("table").innerHTML = body;

    $('.view').hide();

    $('.minus').mouseover( function() {
        $(this).toggleClass('red_color');
    });
    $('.minus').mouseleave( function() {
        $(this).toggleClass('red_color');
    });

    $('.plus').mouseover( function() {
        $(this).toggleClass('green');
    });
    $('.plus').mouseleave( function() {
        $(this).toggleClass('green');
    });

    $('.info').mouseover( function() {
        $(this).toggleClass('blue');
    });
    $('.info').mouseleave( function() {
        $(this).toggleClass('blue');
    });


    $('.info').click(function(){
        var krmivo = $(this).closest('tr').attr('id');
        $.get('query/getFoodInfo.php', {idKrmiva: krmivo}, function(returned) {
            var Data = jQuery.parseJSON(returned);

             $('#sTitulek').html(capitalizeFirstLetter(Data.druh));
             $('#sTyp').html(getFood(Data.kategorie));
             $('#sTrvanlivost').html(Data.trvanlivost);
             $('#sPorizeno').html(Data.porizeno);
             $('#sMnozstvi').html(Data.mnozstvi);
             $('#kickBut').val(Data.idKrmiva);

            $('#foodShow').modal('toggle');
        });

    });

    var timer;
    $('.minus')
      .mousedown(function(){
          var helper = this;
           timer=setInterval(function(){
               if(parseInt($(helper).closest('tr').find('.mnozstvi').html()) > 0 ) {
                   $(helper).closest('tr').find('.mnozstvi').html( parseInt($(helper).closest('tr').find('.mnozstvi').html(  )) - 1);
               }
           }, 100); // the above code is executed every 100 ms
      });


    $('.minus').click(function() {
        if(parseInt($(this).closest('tr').find('.mnozstvi').html()) > 0 ) {
            $(this).closest('tr').find('.mnozstvi').html( parseInt($(this).closest('tr').find('.mnozstvi').html(  )) - 1);
        }
        updateTr($(this).closest('tr').attr('id'));
        if (timer) clearInterval(timer);
    })

    $('.plus')
      .mousedown(function(){
          var helper = this;
           timer=setInterval(function(){
                  $(helper).closest('tr').find('.mnozstvi').html( parseInt($(helper).closest('tr').find('.mnozstvi').html(  )) + 1);

           }, 100); // the above code is executed every 100 ms
      });


    $('.plus').click(function() {
        $(this).closest('tr').find('.mnozstvi').html( parseInt($(this).closest('tr').find('.mnozstvi').html(  )) + 1);
        updateTr($(this).closest('tr').attr('id'));
        if (timer) clearInterval(timer);
    })


    $(".animal_info").mouseover(function() {
        $(this).find('.view').show();
    });

    $(".animal_info").mouseleave(function() {
     if($(this).find('.view').hasClass('glyphicon glyphicon-info-sign')) {
         $(this).find('.view').hide();
     }
    });

    $('#druhStary').html(getFoodSelect());
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

function monthDiff(d1, d2) {
    var months;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months -= d1.getMonth() + 1;
    months += d2.getMonth();
    return months <= 0 ? 0 : months;
}

function getKrmivoSelect() {
    var string = '<select value=""> </select>';
    return string;
}

$('.novyDruh').hide();

$('#druh').click( function() {
    $('.novyDruh').toggle();
    $('.staryDruh').toggle();
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

function getFoodSelect() {
    var string = "";

    var prevFood;
    Food.forEach( function(elem, index) {
        if(prevFood != elem.druh) {
            string += '<option class="selectExpo" value="' + elem.druh + '">' + capitalizeFirstLetter(elem.druh) + '</option>';
        }
        prevFood = elem.druh;
    });

    return string;
}

function updateTr(id) {
    var mnozstvi = parseInt($('#' + id).find('.mnozstvi').html());
    var mnozstviMem = parseInt($('#' + id).find('.mnozstvi').attr('mnozstviMem'));
    if(mnozstvi == 0) {
        $('#' + id).hide();
    }
    $.post('query/pushFood.php', {change: id, number: mnozstvi, mem: mnozstviMem});
    $('#' + id).find('.mnozstvi').attr('mnozstviMem', mnozstvi);
}
