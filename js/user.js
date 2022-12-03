/*JS File with user-related functions, such as login,sign-up etc*/
function redirectRegistrati() { window.location.href = 'registrati.html'; }
function redirectLogin() { window.location.href = 'login.html'; }
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
function checkRegistrati() {
  let username = $("#username").val();
  let password = $("#pw").val();

  //check if username respects the regex [A-Za-z][A-Za-z0-9]{5,15}
  let regex = /^[A-Za-z][A-Za-z0-9]{5,15}$/;
  if (!regex.test(username)) {
    $("#login-error").html("Username must be between 6 and 16 characters and can only contain letters and numbers and must start with a letter");
    return;
  } else {
    // $("#login-error").html("Success");
  }
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