/**
 * Api:animepage
 */
function deleteEntry(id_user, mal_id) {
  $.ajax({
    url: "api/animepage/deleteEntry.php",
    type: "POST",
    data: { id_user: id_user, mal_id: mal_id },
    dataType: "json",
    success: function (response) {
      $("#" + mal_id).empty();
      //delete the entry from the table

    }
  });
}