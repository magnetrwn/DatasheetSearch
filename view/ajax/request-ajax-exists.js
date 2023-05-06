// Le richieste "exists" sono utilizzate dal modulo di registrazione

// "view/auth/util-valid-interactive.js" deve essere incluso!
function ajaxExists(toVerify, elementId, urlPrefix, positiveMsg, negativeMsg) {
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
        if(this.responseText == "true") {
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
		xmlhttp.open("GET", "ajax.php?" + urlPrefix + "=" + toVerify, true)
		xmlhttp.send()
	}
}

function userExists(username) {
	ajaxExists(username, "usercheck", "usrchk", "Username OK.", "Username in uso.")
}

function mailExists(email) {
	ajaxExists(email, "mailcheck", "mlchk", "Email OK.", "Email duplicata.")
}
