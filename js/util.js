/**
JS File with common functions available through all the pages
Mainly navbar related js functions
*/
/*
Attach an event listener whenever the carousel animation ends
This is useful so that we can change the synopsis text
*/
$(document).ready(function () {
  $('#carouselExampleControls').on('slid.bs.carousel', function (event) {
    for (let i = 0; i < 3; i++) {
      if (event.to == i) {
        $("#syn" + i).show();
      } else
        $("#syn" + i).hide();
    }
  });

  $('#randomAnime').on('click', randomAnime);
  $('#logoutIcon').on('click', logout);
  $('#search_input').on('input', getAjaxRes);
  // $('#search_input').on('click', openSearchDropdown);
});


function emptyDiv() {
  $("#myDropdown").empty();
}
/**
 * Api:homepage
 */
function getAjaxRes() {
  $("#myDropdown").empty();
  let value = event.target.value;
  let option = $("#search_option").val();
  console.log(option);
  if (value != "" && value.length > 2) {//value.length >2 is to prevent heavy load on server
    switch (option) {
      default:
      case "Anime":
        $.ajax({
          url: "api/homepage/search_anime.php",
          type: "GET",
          data: { search: value },
          dataType: "json",
          success: function (response) {
            $("#myDropdown").empty();
            let anime = "";
            for (let i = 0; i < response.length; i++) {
              anime = '<a href="anime.php?id=' + response[i].id + '" class="show"><option class="anime" id="' + response[i].id + '">' + response[i].name + '</option></a>';
              $("#myDropdown").append(anime);
            }
          }
        })
        break;

      case "User":
        $.ajax({
          url: "api/homepage/search_user.php",
          type: "GET",
          data: { search: value },
          dataType: "json",
          success: function (response) {
            $("#myDropdown").empty();
            let anime = "";
            for (let i = 0; i < response.length; i++) {
              anime = '<a href="myanimepage.php?id=' + response[i].id + '" class="show"><option class="anime" id="' + response[i].id + '">' + response[i].name + '</option></a>';
              $("#myDropdown").append(anime);
            }
          }
        })
        break;
    }
  }
}

function randomAnime() {
  $.ajax({
    url: "api/homepage/random.php",
    type: "GET",
    dataType: "json",
    success: function (response) {
      if (response !== "error")
        window.location.href = "anime.php?id=" + response;
      // console.log(response);
      //redirect
    }
  })
}


function logout() {
  $.ajax({
    url: "api/user/logout.php",
    type: "GET",
    success: function (response) {
      // console.log(response);
      window.location.href = "index.php";
    }
  })

}
// function appendSelectedAnime() {
//   let id = event.target.id;
//   let title = event.target.innerHTML;
//   let anime = `<div class="anime" id="${id}">${title}</div>`;
//   $("#selected-anime").append(anime);
// }

// function goesToAnimePage($param) {
//   window.location.href = "anime.php?id=" + $param;
// }