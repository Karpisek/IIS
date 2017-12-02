/**
 * @Author: Miroslav Karpíšek <miro>
 * @Date:   01-12-2017
 * @Email:  karpisek.m@email.cz
 * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 02-12-2017
 */

/*
<div class="container col-xs-10 col-xs-offset-1">
    <div class=" panel panel-danger">
        <div class="panel-heading">
            <b>Krmení</b>
        </div>
        <div class="panel-body">
            <b><i class="glyphicon glyphicon-time"></i></b>
            22.12.2017
            <br>
            <b><i class="glyphicon glyphicon-map-marker"></i></b>
            Pavilon ptáků
            <br>
            <b><i class="glyphicon glyphicon-eye-open"></i></b>
            Pterodaktil <i>Pepa</i> <i class="glyphicon glyphicon-leaf"></i>
            <br>
        </div>
    </div>
</div>
*/

actualInfo();

function actualInfo() {
    var todo = '<div class="col-xs-10 col-xs-offset-1" style="height: 80px"><center><i class="glyphicon todoExpo glyphicon-remove" style="color:red; font-size: 50px" ></i></center></div>';
    var today = '<div class="col-xs-10 col-xs-offset-1" style="height: 80px"><center><i class="glyphicon glyphicon-time" style="color:orange; font-size: 50px" ></i></center></div>';
    var done = '<div class="col-xs-10 col-xs-offset-1" style="height: 80px"><center><i class="glyphicon glyphicon-ok" style="color:green; font-size: 50px" ></i></center></div>';

    $('#todo').html(todo);
    $('#today').html(today);
    $('#done').html(done);
    $.get('query/getTodo', {idZamestnance:0 , expoTODO:true}, function(Data) {
        var json = jQuery.parseJSON(Data);
        fetchE(json, 'todo');
    });

    $.get('query/getTodo', {idZamestnance:0 , expoTODAY:true}, function(Data) {
        var json = jQuery.parseJSON(Data);
        fetchE(json, 'today');
    });

    $.get('query/getTodo', {idZamestnance:0 , expoDONE:true}, function(Data) {
        var json = jQuery.parseJSON(Data);
        fetchE(json, 'done');
    });


    $.get('query/getTodo', {idZamestnance:42 , animalTODO:true}, function(Data) {
        var json = jQuery.parseJSON(Data);
        fetchA(json, 'todo');
    });

    $.get('query/getTodo', {idZamestnance:42 , animalTODAY:true}, function(Data) {
        var json = jQuery.parseJSON(Data);
        fetchA(json, 'today');
    });

    $.get('query/getTodo', {idZamestnance:42 , animalDONE:true}, function(Data) {
        var json = jQuery.parseJSON(Data);
        fetchA(json, 'done');
    });

}

// expo
function fetchE(selected, dest) {
    var color = "";
    switch(dest) {
        case 'todo':
            color = 'danger';
        break;
        case 'today':
            color = 'warning';
        break;
        case 'done':
            color = 'success';
        break;
    }
    // todolist
    selected.forEach( function(elem, index) {
        var panel = '<div class="container col-xs-10 col-xs-offset-1"><div id="'+elem.idUklid+'" expo="'+ elem.id +'" class="todoExpo'+dest+' panel panel-' + color + '">';
        panel += '<div class="panel-heading"><b>Úklid</b></div>';
        panel += '<div class="panel-body"><b><i class="glyphicon glyphicon-time"></i></b> ';
        panel += getDate(elem.datum);
        panel += '<br><b><i class="glyphicon glyphicon-map-marker"></i></b> ';
        panel += capitalizeFirstLetter(elem.druhExpo) + ' ' + elem.jmenoExpo;
        panel += '<br><b><i class="glyphicon glyphicon-user"></i></b> ';
        panel += capitalizeFirstLetter(elem.jmeno) + ' ' + capitalizeFirstLetter(elem.prijmeni);
        panel += '</div></div></div>';

        $('#' + dest).append(panel);


    });

    $('.todoExpo' + dest).click(function () {
        $.post('query/pushDone.php', {idExpo: $(this).attr('expo'), dest: 'E'+ dest, idUklid: $(this).attr('id')}, function(data) {
            actualInfo();
        });
    });
}

// expo
function fetchA(selected, dest) {
    var color = "";
    switch(dest) {
        case 'todo':
            color = 'danger';
        break;
        case 'today':
            color = 'warning';
        break;
        case 'done':
            color = 'success';
        break;
    }
    // todolist
    selected.forEach( function(elem, index) {
        var panel = '<div class="container col-xs-10 col-xs-offset-1"><div id="'+elem.idKrmeni+'" expo="'+ elem.id +'" class="todoAnimal'+dest+' panel panel-' + color + '">';
        panel += '<div class="panel-heading"><b>Krmení</b></div>';
        panel += '<div class="panel-body"><b><i class="glyphicon glyphicon-time"></i></b> ';
        panel += getDate(elem.datum);
        panel += '<br><b><i class="glyphicon glyphicon-map-marker"></i></b> ';
        panel += capitalizeFirstLetter(elem.druhExpo) + ' ' + elem.jmenoExpo;
        panel += '<br><b><i class="glyphicon glyphicon-eye-open"></i></b> ';
        panel += capitalizeFirstLetter(elem.rod) + ' ' + elem.druh + ' <i>' + elem.jmenoZvire + '</i>';
        panel += '<br><b><i class="glyphicon glyphicon-user"></i></b> ';
        panel += capitalizeFirstLetter(elem.jmeno) + ' ' + capitalizeFirstLetter(elem.prijmeni);
        panel += '</div></div></div>';

        $('#' + dest).append(panel);


    });

    $('.todoAnimal' + dest).click(function () {
        $.post('query/pushDone.php', {idExpo: $(this).attr('expo'), dest: 'A'+ dest, idUklid: $(this).attr('id')}, function(data) {
            actualInfo();
        });
    });
}


function capitalizeFirstLetter(string) {
   return string.charAt(0).toUpperCase() + string.slice(1);
}

function getDate(elem) {
    if(elem == '0000-00-00') {
        return '<i>bez záznamu</i>';
    }
    else {
        return elem;
    }
}
