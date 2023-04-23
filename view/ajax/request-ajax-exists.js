const tabBaseClass = "rounded text-center px-6 py-3 mt-3 align-baseline font-bold text-sm text-2xl"

// Trasformato in funzione generica per risparmiare spazio
function ajax_exists(toVerify, elementId, UrlPrefix, positiveMsg, negativeMsg) {
	if(!toVerify) {
    document.getElementById(elementId).innerHTML = "..."
		document.getElementById(elementId).className = tabBaseClass
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
				}
				else {
          document.getElementById(elementId).innerHTML = positiveMsg
					document.getElementById(elementId).className = tabBaseClass + " bg-green-900 text-green-400"
				}
		}
		xmlhttp.open("GET", "ajax.php?" + UrlPrefix + "=" + toVerify, true)
		xmlhttp.send()
	}
}

function user_exists(username) {
	ajax_exists(username, "usercheck", "usrchk", "Username OK.", "Username in uso.")
}

function mail_exists(username) {
	ajax_exists(username, "mailcheck", "mlchk", "Email OK.", "Email duplicata.")
}