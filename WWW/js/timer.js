/**
* @Author: Miroslav Karpíšek <miro>
* @Date:   26-11-2017
* @Email:  karpisek.m@email.cz
* @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 30-11-2017
*/

var timer = 300000;

$(window).click(function() {
    timer = 300000;
});

$(window).mousemove(function() {
    timer = 300000;
});

var x = setInterval(function() {
    // Time calculations for days, hours, minutes and seconds
    var minutes = Math.floor((timer % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((timer % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    if(timer < 60000) {
        $("#timestamp").show();
        document.getElementById("timestamp").innerHTML = minutes + "m " + seconds + "s ";
    }
    else {
        $("#timestamp").hide();
    }

    // If the count down is finished, write some text
    if (timer <= 0) {
        clearInterval(x);
         //volani php na odhlaseni
         $.ajax({
             url: "http://www.stud.fit.vutbr.cz/~xkarpi05/session/logout.php", //the page containing php script
             type: "post", //request type,
             data: {logout: "true"},
             success: function(data) {
                 window.location.replace("http://www.stud.fit.vutbr.cz/~xkarpi05");
             }
         });
    }

    timer -= 1000;


}, 1000);
