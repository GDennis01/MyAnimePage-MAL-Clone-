/*TODO: location reload*/
/*JS File with anime.php related functions such as 'adding to list an anime' or posting a review*/

var anime_id = window.location.href.split("=")[1];
$(document).ready(function () {
  $("#btnAddList").on("click", addToList);
  $("#btnRemove").on("click", removeFromList);
  $("#btnReview").on("click", postReview);

  $(".review-entry").each(function () {
    $(this).on("click", function () {
      var id = $(this).attr("id").split("delReview")[1];
      console.l
      deleteReview(id);
    });
  });

});
/**
 * Api:anime
 * @param {*} mal_id id of myanimelist entry in the database
 * @param {*} id_user id of the user in the user table
 */
function addToList() {
  $.ajax({
    url: "api/anime/addList.php",
    type: "POST",
    // data: { mal_id: mal_id },
    data: { mal_id: anime_id },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response == "success") {
        $("#btnAddList").html("Already added to your anime page");
        $("#btnAddList").attr("disabled", true);
        $("#btnRemove").css("display", "block");
        // $("#btnRemove").on("click", function () {
        //   removeFromList(mal_id, id_user);
        // })
      }
    }
  })
}
/**
 * Api:anime
 * @param {*} mal_id 
 * @param {*} id_user 
 */
function removeFromList() {
  $.ajax({
    url: "api/animepage/deleteEntry.php",
    type: "POST",
    // data: { mal_id: mal_id },
    data: { mal_id: anime_id },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response == "success") {
        $("#btnAddList").html("Add to list");
        $("#btnAddList").attr("disabled", false);
        //add event listener on click addToList
        // $("#btnAddList").on("click", function () {
        //   addToList(mal_id, id_user);
        // })
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
function postReview() {
  var reviewText = $("#review").val();
  //parse it from xss 
  var reviewText = $("<div>" + reviewText + "</div>").text();//to prevent xss
  console.log(reviewText);
  $.ajax({
    url: "api/anime/postReview.php",
    type: "POST",
    // data: { mal_id: mal_id, review: review },
    data: { mal_id: anime_id, review: reviewText },
    dataType: "json",
    success: function (response) {
      console.log(response);
      //split the response to get the id of the review
      if (response.esito == "error") {
        $("#review-error").html("Error while posting review");
        return;
      }
      let user = response.name;
      let id_review = response.id;
      let review = "<li><b>" + user + "</b>: " + reviewText;
      let addEvent = false;
      if (user == "admin") {
        addEvent = true;
        review = review + "<button id='delReview" + id_review + "' class='review-entry' > <i class='fa-solid fa-trash'></i></button ></li > ";
      }
      $("#animeReviews>ul").append(review);
      if (addEvent) {
        $("#delReview" + id_review).on("click", function () {
          deleteReview(id_review);
        });
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
        // location.reload();
        $("#delReview" + id_review).parent().remove();
      } else {
        $("#review-error").html("Error while deleting review");
      }
    }
  })
}