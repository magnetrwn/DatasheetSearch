const tabBaseClass = document.getElementById("usercheck").className;
const buttonBaseClass = document.getElementById("register").className;

function tabSetColor(elementId, color = "none") {
  if (!color || color == "none")
    document.getElementById(elementId).className = tabBaseClass;
  else
    document.getElementById(elementId).className =
      tabBaseClass + " bg-" + color + "-900 text-" + color + "-400";
}

function enableNext(currentId) {
  switch(currentId) {
    case "usercheck":
      document.getElementById("email").disabled = false;
      break;
    case "mailcheck":
      document.getElementById("password").disabled = false;
      break;
    case "pwdcheck":
      document.getElementById("register").disabled = false;
      document.getElementById("register").className =
        buttonBaseClass +
        " outline outline-offset-2 outline-green-600";
      break;
  }
}

function disableAllNext(currentId) {
  switch(currentId) {
    case "usercheck":
      document.getElementById("email").disabled = true;
    case "mailcheck":
      document.getElementById("password").disabled = true;
    case "pwdcheck":
      document.getElementById("register").disabled = true;
      document.getElementById("register").className =
        buttonBaseClass +
        " outline outline-offset-2 outline-red-600 cursor-not-allowed";
      break;
  }
}

function mailValid(email) {
  if (!email) {
    document.getElementById("mailcheck").innerHTML = "...";
    tabSetColor("mailcheck", "none");
    disableAllNext("mailcheck");
    return;
  }
  const mailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (email.match(mailRegex)) mailExists(email);
  else {
    document.getElementById("mailcheck").innerHTML = "Email non valida.";
    tabSetColor("mailcheck", "red");
    disableAllNext("mailcheck");
  }
}

function passwordValid(password) {
  if (!password) {
    document.getElementById("pwdcheck").innerHTML = "...";
    tabSetColor("pwdcheck", "none");
    disableAllNext("pwdcheck");
    return;
  }
  const isCorrectLength = password.length >= 6 && password.length <= 32;
  const hasUpperCase = /[A-Z]/.test(password);
  const hasLowerCase = /[a-z]/.test(password);
  const hasNumbers = /\d/.test(password);
  const hasSpecial = /\W/.test(password);
  if (
    !isCorrectLength ||
    !hasUpperCase ||
    !hasLowerCase ||
    !hasNumbers ||
    !hasSpecial
  ) {
    tabSetColor("pwdcheck", "red");
    disableAllNext("pwdcheck");
  } else {
    tabSetColor("pwdcheck", "green");
    enableNext("pwdcheck");
  }
  if (!isCorrectLength)
    document.getElementById("pwdcheck").innerHTML = "Lunghezza tra 6 e 32?";
  else if (!hasUpperCase)
    document.getElementById("pwdcheck").innerHTML = "Maiuscola?";
  else if (!hasLowerCase)
    document.getElementById("pwdcheck").innerHTML = "Minuscola?";
  else if (!hasNumbers)
    document.getElementById("pwdcheck").innerHTML = "Numero?";
  else if (!hasSpecial)
    document.getElementById("pwdcheck").innerHTML = "Simbolo?";
  else document.getElementById("pwdcheck").innerHTML = "Password sicura.";
}
