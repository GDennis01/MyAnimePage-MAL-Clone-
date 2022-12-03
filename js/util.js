/**
JS File with common functions available through all the pages
Mainly navbar related js functions
*/

async function sendApiRequest(mal_id, number_div = -1) {
  // Here we define our query as a multi-line string
  // Storing it in a separate .graphql/.gql file is also possible
  var query = `
query ($id: Int) { # Define which variables will be used in the query (id)
  Media (id: $id, type: ANIME) { # Insert our variables into the query arguments (id) (type: ANIME is hard-coded in the query)
    id
    title {
      romaji
      english
      native
    }
    coverImage{
      large
    }
  }
}
`;

  // Define our query variables and values that will be used in the query request
  var variables = {
    id: mal_id
    // id: 1
  };

  // Define the config we'll need for our Api request
  var url = 'https://graphql.anilist.co',
    options = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify({
        query: query,
        variables: variables
      })
    };


  // Make the HTTP Api request
  let _handleData = await fetch(url, options).then(handleResponse)
    .then(
      (data) => {
        // console.log(data);
        return data;
      }
    )
    .catch(handleError);
  console.log(_handleData);
  if (number_div != -1) {
    $("#slider_" + number_div).attr("src", _handleData.data.Media.coverImage.large);
    $("#slider_a_" + number_div).attr("href", "anime.php?id=" + _handleData.data.Media.id);
  }
  return _handleData;

}

function handleResponse(response) {
  return response.json().then(function (json) {
    return response.ok ? json : Promise.reject(json);
  });
}

function handleData(data) {
  _handleData = data;
  // console.log(data);
}

function handleError(error) {
  // alert('Error, check console');
  // console.error(error);
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