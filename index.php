<!DOCTYPE html>
<html>
<head>
</head>
<body class="flex flex-col min-h-screen">
	
<?php
/////////////////////
// Header (navbar) //
/////////////////////
include("view/page-top.html");
?>

<div><?php
///////////////////////////////////////
// Sezione principale del controller //
///////////////////////////////////////
if(!isset($_GET["goto"]))
    // Se non viene richiesta pagina, va alla homepage
    $goto = "homepage";
else
    // Traduce richieste in minuscolo
    $goto = strtolower($_GET["goto"]);

switch($goto) {

    case "homepage":
        // Pagina home
        $welcome = "Benvenuto su Datasheet Search!";
        if(isset($_SESSION["user"])) {
            echo $_SESSION["user"];
            // Mostra username se loggato
            $welcome = "Benvenuto ".$_SESSION["user"]."!";
            include("view/page-homepage.php");
        }
        else
            include("view/page-homepage.php");
        break;

    case "login":
        // Pagina login
        include_once("model/util-js.php");
        if(isset($_SESSION["user"]))
            // Già loggato, torna alla homepage
            redirect_js("index.php?goto=homepage");
        else
            include("view/auth/page-login.html");
        break;

    case "auth":
        // Tentativo autenticazione successivo al login
        include_once("model/util-js.php");
        include_once("model/auth-login.php");
        if(mysql_user_login($_POST["username"], $_POST["password"])) 
            // Login successo
            redirect_js("index.php?goto=homepage");
        else
            // Login fallito, torna alla pagina login
            // TODO: manca il messaggio "credenziali errate"
            redirect_js("index.php?goto=login");
        break;

    default:
        // Pagina non implementata
        http_response_code(404); // non funziona?
        include("view/page-404.html");
        break;
}

?></div>

<?php
////////////
// Footer //
////////////
include("view/page-bottom.html");

/////////////
// Scripts //
/////////////
include_once("view/using/tailwindcss-script.html");
?>
	
</body>
</html>
