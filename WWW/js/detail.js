/**
 * @Author: Miroslav Karpíšek <miro>
 * @Date:   27-11-2017
 * @Email:  karpisek.m@email.cz
 * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 27-11-2017
 */

$("#updateBut").addClass('disabled');

$(".userForm").click(function() {
    $("#updateBut").removeClass('disabled');
});

$("#updateBut").click(function() {

    if (confirm("Are you sure?")) {
            infoPanel("Údaje o zaměstnanci byly aktualizovány", "alert-warning");
    }
    
});
