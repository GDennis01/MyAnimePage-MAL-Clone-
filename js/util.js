function getAjaxRes() {
  $("#myDropdown").empty();
  let value = event.target.value;
  if (value != "" && value.length > 2) {//value.length >2 is to prevent heavy load on server
    $.ajax({
      url: "api/search.php",
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
function randomAnime() {
  $.ajax({
    url: "api/random.php",
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

function logout() {
  $.ajax({
    url: "api/logout.php",
    type: "GET",
    success: function (response) {
      console.log(response);
      window.location.href = "index.php";
    }
  })
}

function addToList(mal_id, id_user) {
  $.ajax({
    url: "api/addList.php",
    type: "POST",
    data: { mal_id: mal_id, id_user: id_user },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response == "success") {
        $("#btnAddList").html("Already added to list");
        $("#btnAddList").attr("disabled", true);
      } else {
        $("#login-error").html(response);
      }
    }
  })
}
function checkLogin() {

  let username = $("#username").val();
  let password = $("#pw").val();
  $.ajax({
    url: "api/login.php",
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

function checkRegistrati() {
  let username = $("#username").val();
  let password = $("#pw").val();
  $.ajax({
    url: "api/registrati.php",
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