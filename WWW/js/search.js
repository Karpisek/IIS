/**
 * @Author: Miroslav Karpíšek <miro>
 * @Date:   26-11-2017
 * @Email:  karpisek.m@email.cz
 * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 27-11-2017
 */


$("#search").on("keyup", function() {
    filterTable();
});

function filterTable() {
    var value = $("#search").val().toLowerCase();
    $("#table tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
}
