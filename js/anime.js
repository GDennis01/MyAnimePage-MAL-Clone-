/*JS File with anime.php related functions such as 'adding to list an anime' or posting a review*/

/**
 * Api:anime
 * @param {*} mal_id id of myanimelist entry in the database
 * @param {*} id_user id of the user in the user table
 */
function addToList(mal_id, id_user) {
  $.ajax({
    url: "api/anime/addList.php",
    type: "POST",
    data: { mal_id: mal_id, id_user: id_user },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response == "success") {
        $("#btnAddList").html("Already added to your anime page");
        $("#btnAddList").attr("disabled", true);
        $("#btnRemove").css("display", "block");
        $("#btnRemove").on("click", function () {
          removeFromList(mal_id, id_user);
        })
      }
    }
  })
}
/**
 * Api:anime
 * @param {*} mal_id 
 * @param {*} id_user 
 */
function removeFromList(mal_id, id_user) {
  $.ajax({
    url: "api/animepage/deleteEntry.php",
    type: "POST",
    data: { mal_id: mal_id, id_user: id_user },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response == "success") {
        $("#btnAddList").html("Add to list");
        $("#btnAddList").attr("disabled", false);
        //add event listener on click addToList
        $("#btnAddList").on("click", function () {
          addToList(mal_id, id_user);
        })
        $("#btnRemove").css("display", "none");
      }
    }
  })
}
/**
 * Api:anime
 * @param {Integer} mal_id 
 * @param {Integer} id_user 
 */
function postReview(mal_id, id_user) {
  let review = $("#review").val();
  console.log(review);
  $.ajax({
    url: "api/anime/postReview.php",
    type: "POST",
    data: { mal_id: mal_id, id_user: id_user, review: review },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response == "success") {
        location.reload();
        // $("#review").val("");
        // $("#review-error").html("Review posted!");
      } else {
        $("#review-error").html(response);
      }
    }
  })
}
/**
 * Api:anime
 * @param {Integer} mal_id
 * @param {Integer} id_user
 */
function deleteReview(id_review) {
  $.ajax({
    url: "api/anime/deleteReview.php",
    type: "POST",
    data: { id_review: id_review },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response == "success") {
        location.reload();
      } else {
        $("#review-error").html(response);
      }
    }
  })
}