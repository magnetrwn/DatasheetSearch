<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="/static/img/favicon.png">
</head>
<body class="flex flex-col min-h-screen">
	
<?php
/////////////////////
// Header (navbar) //
/////////////////////
session_name("dssessionid");
session_start();
$loginlabel = "Login";
if(isset($_SESSION["user"]))
    $loginlabel = "Logout";
include("view/page-top.php");
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
        if(isset($_SESSION["user"]))
            // Mostra username se loggato
            $welcome = "Bentornato, ".$_SESSION["user"].".";
        include("view/page-homepage.php");
        break;

    case "login":
        // Pagina login
        include_once("model/util-js.php");
        if(isset($_SESSION["user"])) {
            // Se già loggato, effettua il logout
            unset($_SESSION["user"]);
            session_destroy();
            redirect_js("index.php?goto=homepage");
        }
        else {
            include("view/auth/page-login.php");
        }
        break;

    case "auth":
        // Autenticazione successiva al login/register
        include_once("model/util-js.php");
        include_once("model/mgmt-auth.php");
        if(isset($_GET["newuser"])) {
            // Passa al processore register
            if(mysql_user_register($_POST["username"], $_POST["email"], $_POST["password"]))  {
                // Register successo
                redirect_js("index.php?goto=success&msg=register&btngoto=login");
            }
            else
                // Register fallito (difficile), torna alla pagina register
                redirect_js("index.php?goto=register&badregister");
        }
        else {
            // Passa al processore login
            if(mysql_user_login($_POST["username"], $_POST["password"]))  {
                // Login successo
                redirect_js("index.php?goto=homepage");
            }
            else
                // Login fallito, torna alla pagina login
                redirect_js("index.php?goto=login&badlogin");
        }
        break;

    case "register":
        // Pagina di registrazione
        include_once("model/util-js.php");
        if(isset($_SESSION["user"])) {
            // Se già loggato, torna alla homepage
            redirect_js("index.php?goto=homepage");
        }
        else {
            include("view/auth/page-register.php");
        }
        break;

    case "azienda":
    case "listino":
    case "componente":  
    case "datasheet":
    //case "package":
        include_once("model/util-search.php");
        include_once("model/util-db.php");
        include("view/search/page-autolist.php");
        break;

    case "search":
        include("view/search/page-search.php");
        break;

    case "success":
        // Mostra una schermata di operazione riuscita in base a paramteri GET
        include("view/page-success.php");
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
