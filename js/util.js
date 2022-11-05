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
          for (let i = 0; i < response.length; i++) {
            anime = '<a href="anime.php?id='+response[i].id+'" class="show"><option class="anime" id="'+response[i].id+'">'+response[i].name+'</option></a>';
            // console.log(anime);
            console.log(anime);
            $("#myDropdown").append(anime);
          }
          console.log("------------------------");
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

function openSearchDropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function closeSearchDropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function selectFilteredValue() {
  document.getElementById("search_input").value  = event.target.getAttribute("data-value");
  closeSearchDropdown();
}

function filterSearchDropdown() {
  var input, filter, ul, li, span, i;
  input = document.getElementById("search_value");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  span = div.getElementsByTagName("span");
  for (i = 0; i < span.length; i++) {
      txtValue = span[i].textContent || span[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
          span[i].style.display = "";
      } else {
          span[i].style.display = "none";
      }
  }
}
