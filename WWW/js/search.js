/**
 * @Author: Miroslav Karpíšek <miro>
 * @Date:   26-11-2017
 * @Email:  karpisek.m@email.cz
 * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 30-11-2017
 */


$("#search").on("keyup", function() {
    fetchTable();
    filterTable();
});

function filterTable() {
    var value = $("#search").val().toLowerCase();
    $("#table tr").filter(function() {
        if($(this).hasClass('header')) {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        }
    });
}
