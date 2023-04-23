const tabBaseClass = "rounded text-center px-6 py-3 mt-3 align-baseline font-bold text-sm text-2xl"

function enableNext(currentId) {
	if(currentId == "usercheck")
		document.getElementById("email").disabled = false
	else if(currentId == "mailcheck")
		document.getElementById("password").disabled = false
	else if(currentId == "pwdcheck")
		document.getElementById("register").disabled = false
}

function disableAllNext(currentId) {
	if(currentId == "usercheck")
		document.getElementById("email").disabled = true
	if(currentId == "usercheck" || currentId == "mailcheck")
		document.getElementById("password").disabled = true
	if(currentId == "usercheck" || currentId == "mailcheck" || currentId == "pwdcheck")
		document.getElementById("register").disabled = true
}

// Trasformato in funzione generica per risparmiare spazio
function ajaxExists(toVerify, elementId, UrlPrefix, positiveMsg, negativeMsg) {
	if(!toVerify) {
    document.getElementById(elementId).innerHTML = "..."
		document.getElementById(elementId).className = tabBaseClass
		disableAllNext(elementId)
		return
  }
	else {
		var xmlhttp = new XMLHttpRequest()
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200)
        // Esegue alla risposta ricevuta
        if(this.responseText == 1) {
				  document.getElementById(elementId).innerHTML = negativeMsg
					document.getElementById(elementId).className = tabBaseClass + " bg-red-900 text-red-400"
					disableAllNext(elementId)
				}
				else {
          document.getElementById(elementId).innerHTML = positiveMsg
					document.getElementById(elementId).className = tabBaseClass + " bg-green-900 text-green-400"
					enableNext(elementId)
				}
		}
		xmlhttp.open("GET", "ajax.php?" + UrlPrefix + "=" + toVerify, true)
		xmlhttp.send()
	}
}

function userExists(username) {
	ajaxExists(username, "usercheck", "usrchk", "Username OK.", "Username in uso.")
}

function mailExists(email) {
	ajaxExists(email, "mailcheck", "mlchk", "Email OK.", "Email duplicata.")
}

function mailValid(email) {
	if(!email) {
    document.getElementById("mailcheck").innerHTML = "..."
		document.getElementById("mailcheck").className = tabBaseClass
		disableAllNext(elementId)
		return
  }
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
	if(email.match(mailformat))
		mailExists(email)
	else {
		document.getElementById("mailcheck").innerHTML = "Email non valida."
		document.getElementById("mailcheck").className = tabBaseClass + " bg-red-900 text-red-400"
		disableAllNext(elementId)
	}
}

disableAllNext("usercheck")