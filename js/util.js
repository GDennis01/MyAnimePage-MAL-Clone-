/**
 * Api:homepage
 */
function getAjaxRes() {
  $("#myDropdown").empty();
  let value = event.target.value;
  if (value != "" && value.length > 2) {//value.length >2 is to prevent heavy load on server
    $.ajax({
      url: "api/homepage/search.php",
      type: "GET",
      data: { search: value },
      dataType: "json",
      success: function (response) {
        //console.log(response);
        $("#myDropdown").empty();
        let anime = "";
        console.log(response);
        for (let i = 0; i < response.length; i++) {
          anime = '<a href="anime.php?id=' + response[i].id + '" class="show"><option class="anime" id="' + response[i].id + '">' + response[i].name + '</option></a>';
          // console.log(anime);
          console.log(anime);
          $("#myDropdown").append(anime);
        }
        console.log("------------------------");
      }
    })
  }
}
/**
 * Api:homepage
 */
function randomAnime() {
  $.ajax({
    url: "api/homepage/random.php",
    type: "GET",
    dataType: "json",
    success: function (response) {
      console.log(response);
      //redirect
      window.location.href = "anime.php?id=" + response;
    }
  })
}

function appendSelectedAnime() {
  let id = event.target.id;
  let title = event.target.innerHTML;
  let anime = `<div class="anime" id="${id}">${title}</div>`;
  $("#selected-anime").append(anime);
}

function goesToAnimePage($param) {
  window.location.href = "anime.php?id=" + $param;
}


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
      } else {
        $("#login-error").html(response);
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
        // $("#review-error").html("Review posted!");//TODO: append the review
      } else {
        $("#review-error").html(response);
      }
    }
  })
}
/**
 * Api:user
 */
function checkLogin() {

  let username = $("#username").val();
  let password = $("#pw").val();
  $.ajax({
    url: "api/user/login.php",
    type: "POST",
    data: { username: username, password: password },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response == "success") {
        window.location.href = "index.php";
      } else {
        $("#login-error").html(response);
      }
    }
  })
}

/**
 * Api:user
 */
function checkRegistrati() {
  let username = $("#username").val();
  let password = $("#pw").val();
  $.ajax({
    url: "api/user/registrati.php",
    type: "POST",
    data: { username: username, password: password },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response == "success") {
        window.location.href = "index.php";
      } else {
        $("#login-error").html(response);
      }
    }
  })
}
/**
 * Api:user
 */
function logout() {
  $.ajax({
    url: "api/user/logout.php",
    type: "GET",
    success: function (response) {
      console.log(response);
      window.location.href = "index.php";
    }
  })
}