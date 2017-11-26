/**
 * @Author: Miroslav Karpíšek <miro>
 * @Date:   26-11-2017
 * @Email:  karpisek.m@email.cz
 * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 26-11-2017
 */

 $.get('query/getEmployes.php', function(responseText) {

     var Table = $("#table");

     for(var i = 0; i < 10; i++) {
         var tRow = "<th></th>"
     }

     var Data = jQuery.parseJSON(responseText);

     Data.forEach( function(elem) {
         console.log(elem);


     });

 });
