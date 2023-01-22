/**
 * Api:animepage
 */
$(document).ready(function () {
  //foreach entry in the table with class 'anime-entry', add event listener on click with parameter set to the id of the entry
  $(".anime-entry").each(function () {
    $(this).on("click", function () {
      //the id is in format btn<id of the entry in the database>, split it
      var id = $(this).attr("id").split("delete")[1];
      deleteEntry(id);
    });
  });
});
function deleteEntry(mal_id) {
  $.ajax({
    url: "api/animepage/deleteEntry.php",
    type: "POST",
    data: { mal_id: mal_id },
    dataType: "json",
    success: function (response) {
      if (response == "success")
        $("#" + mal_id).empty();
      //delete the entry from the table

    }
  });
}