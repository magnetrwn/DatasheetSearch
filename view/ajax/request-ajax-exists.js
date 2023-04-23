// Funzioni per il controllo dinamico lato client dei valori di username ed email già in uso
// "view/auth/util-valid-interactive.js" deve essere incluso!

// Trasformato in funzione generica per risparmiare spazio
function ajaxExists(toVerify, elementId, UrlPrefix, positiveMsg, negativeMsg) {
	if(!toVerify) {
    document.getElementById(elementId).innerHTML = "..."
    tabSetColor(elementId, "none")
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
					tabSetColor(elementId, "red")
					disableAllNext(elementId)
				}
				else {
          document.getElementById(elementId).innerHTML = positiveMsg
					tabSetColor(elementId, "green")
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