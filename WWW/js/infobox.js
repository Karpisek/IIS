/**
 * @Author: Miroslav Karpíšek <miro>
 * @Date:   27-11-2017
 * @Email:  karpisek.m@email.cz
 * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 27-11-2017
 */

$(".infoBox").hide();

function infoPanel(message, type) {
    $(".infoBox").fadeIn("slow");
    $("#infoMessage").html(message);
    $("#infoMessage").addClass(type);
    setTimeout(function() {
        $(".infoBox").fadeOut("slow");
    },1500);
}
