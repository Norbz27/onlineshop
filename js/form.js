var inputPassword = document.getElementById("inputPassword")
  , inputConfirmPassword = document.getElementById("inputConfirmPassword");

function validatePassword(){
  if(inputPassword.value != inputConfirmPassword.value) {
    inputConfirmPassword.setCustomValidity("Passwords Don't Match");
  } else {
    inputConfirmPassword.setCustomValidity('');
  }
}

inputPassword.onchange = validatePassword;
inputConfirmPassword.onkeyup = validatePassword;