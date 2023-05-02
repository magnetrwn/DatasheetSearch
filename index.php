<?php
      /////////////
    //             //
    //   Session   //
    //             //
      /////////////

    include("model/mgmt-session.php");
    if(!check_dssessionid() || isset($_GET["destroy"]))
        // Controlliamo se l'host remoto ha cambiato indirizzo, se si: eliminiamo il cookie di sessione e rigeneriamo
        delete_dssessionid();
    create_dssessionid();
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="/static/img/favicon.png">
</head>
<body class="flex flex-col min-h-screen">
<div>
<?php
      ////////////////////
    //                    //
    // Costruzione pagina //
    //                    //
      ////////////////////

    $loginlabel = "Login";
    if(isset($_SESSION["user"]))
        // Imposta logout invece di login
        $loginlabel = "Logout";
    include("view/page-top.php");

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
                // Se già loggato, effettua il logout e rigenera il session_id usando destroy, vedi Session in alto
                unset($_SESSION);
                session_destroy();
                redirect_js("index.php?goto=homepage&destroy");
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
                if(mysql_user_register($_POST["username"], $_POST["email"], $_POST["password"]))
                    // Register successo
                    redirect_js("index.php?goto=success&msg=register&btngoto=login");
                else
                    // Register fallito (probabile attacker/bot), torna alla pagina register
                    redirect_js("index.php?goto=register&badregister");
            }
            else {
                // Passa al processore login
                if(mysql_user_login($_POST["username"], $_POST["password"]))
                    // Login successo
                    redirect_js("index.php?goto=homepage");
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
        case "package":
            // La view autolist costruisce tabelle di visualizzazione usando il $goto, quindi solo queste tabelle
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
?>
</div>
<?php
      ////////////
    //            //
    //   Script   //
    //            //
      ////////////

    include("view/page-bottom.html"); // anche il footer qui
    include_once("view/using/tailwindcss-script.html");
?>
</body>
</html>
