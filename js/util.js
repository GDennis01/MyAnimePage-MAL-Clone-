function getAjaxRes() {
  let value = event.target.value;
  if (value != "") {
    $.ajax({
      url: "api/search.php",
      type: "GET",
      data: { search: value },
      dataType: "json",
      success: function (response) {
        //console.log(response);
        jQuery(document).ready(function () {
          $("#search-result").empty();
          let anime = "";
          for (let i = 0; i < response.length; i++) {
            anime = '<a href="anime.php?id='+response[i].id+'"><option class="anime" id="'+response[i].id+'">'+response[i].name+'</option></a>';
            // console.log(anime);
            console.log(anime);
            $("#search-result").append(anime);
          }
          console.log("------------------------");
        });
      }
    })
  }
}

function appendSelectedAnime() {
  let id = event.target.id;
  let title = event.target.innerHTML;
  let anime = `<div class="anime" id="${id}">${title}</div>`;
  $("#selected-anime").append(anime);
}