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

      ///////////////////
    //                   //
    // Init (pre-header) //
    //                   //
      ///////////////////

    if(!isset($_GET["goto"]))
        // Se non viene richiesta pagina, va alla homepage
        $goto = "homepage";
    else
        // Traduce richieste in minuscolo e senza caratteri speciali pericolosi
        $goto = htmlspecialchars(strtolower($_GET["goto"]), ENT_COMPAT, "ISO-8859-1", true);

      ////////////////////
    //                    //
    // Costruzione pagina //
    //                    //
      ////////////////////
    
    $loginlabel = "Login";
    if(isset($_SESSION["user"]))
        // Imposta logout invece di login
        $loginlabel = "Logout";

    switch($goto) {
        // Costruzione pagina, head e top
        case "homepage":
        case "login":
        case "auth":
        case "register":
        case "azienda":
        case "listino":
        case "componente":  
        case "datasheet":
        case "package":
        case "search":
        case "details":
        case "success":
            // 200
            include("view/page-html-200.php");
            break;
        case "404":
        default:
            // 404
            include("view/page-html-404.php");
            break;
    }

    include("view/page-top.php");

    switch($goto) {
        // Costruzione pagina effettiva

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
                // Se già loggato, effettua il logout e rigenera il session_id usando GET destroy, vedi Session in alto
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
                if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]))
                    if(mysql_user_register($_POST["username"], $_POST["email"], $_POST["password"])) {
                        // Register successo
                        redirect_js("index.php?goto=success&msg=register&btngoto=login");
                        break;
                    }
                // Register fallito (probabile attacker/bot), torna alla pagina register
                redirect_js("index.php?goto=register&badregister");
            }
            else {
                // Passa al processore login
                if(isset($_POST["username"]) && isset($_POST["password"]))
                    if(mysql_user_login($_POST["username"], $_POST["password"])) {
                        // Login successo
                        redirect_js("index.php?goto=homepage");
                        break;
                    }
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
        case "package": // no icona
            // La view autolist costruisce tabelle di visualizzazione usando il $goto, quindi solo queste tabelle
            include_once("model/util-js.php");
            if(!isset($_SESSION["user"]))
                // Se non è loggato, mostra la pagina di login
                redirect_js("index.php?goto=login");
            else {
                // Genera una tabella UI contenente la tabella del DB
                include_once("model/util-search.php");
                include_once("model/util-db.php");
                include("view/search/page-autolist.php");
                // TODO: manca ancora la modifica ed eliminazione da parte dell'utente admin
                //if($_SESSION["user"] === "admin")
            }
            break;

        case "search":
            // Pagina risultati ricerca
            include_once("model/util-js.php");
            if(!isset($_POST["search-type"]) || !isset($_POST["for"]))
                redirect_js("index.php?goto=homepage");
            else {
                include_once("model/util-db.php");
                include_once("model/util-search.php");
                include_once("model/mgmt-db-conn.php");
                include("view/search/page-search.php");
                // Sanitize avviene nel model
                switch($_POST["search-type"]) {
                    case "generic":
                        $searchresults = mysql_select_all_like($_POST["for"], "datasheet JOIN documentato ON id_datasheet=fk_datasheet_id_datasheet JOIN componente ON fk_componente_id_componente=id_componente", CONTAINS, CASE_IGNORE);
                        break;
                    case "componente":
                        $searchresults = mysql_select_with_field_like($_POST["for"], $_POST["search-type"], "alias", CONTAINS, CASE_IGNORE);
                        break;
                }
                if(!isset($searchresults)) {
                    redirect_js("index.php?goto=homepage");
                    break;
                }
                while($searchrow = mysqli_fetch_assoc($searchresults)) {
                    if(isset($searchrow["icona"]) && $searchrow["icona"] != "")
                        $logo = $searchrow["icona"];
                    $title = strstr($searchrow["alias"], ",", true);
                    if(strlen($title) == 0)
                        $title = $searchrow["alias"];
                    $subtitle = $searchrow["descrizione"];
                    $alttitle = $searchrow["stato_produzione"];
                    $cid = $searchrow["id_componente"];
                    $conn = open_mysql_conn();
                    $links = mysqli_query($conn, 
                        "SELECT * FROM datasheet
                        JOIN documentato ON id_datasheet=fk_datasheet_id_datasheet 
                        WHERE fk_componente_id_componente='$cid';");
                    close_mysql_conn($conn);
                    include("view/search/page-search-block.php");
                }
            }
            break;

        case "details":
            // Mostra dettaglio di un datasheet specifico, assieme al link download
            include_once("model/util-js.php");
            if(!isset($_SESSION["user"]))
                // Se non è loggato, mostra la pagina di login
                redirect_js("index.php?goto=login");
            else if(!isset($_GET["ds"]) || $_GET["ds"] == "" || strlen($_GET["ds"]) > 512)
                redirect_js("index.php?goto=homepage");
            else {
                // Visualizza le informazioni dettagliate a partire dal datasheet
                include_once("model/mgmt-db-conn.php");
                $conn = open_mysql_conn();
                $ds = mysqli_real_escape_string($conn, htmlspecialchars($_GET["ds"], ENT_COMPAT, "ISO-8859-1", true));
                $detaildata = mysqli_query($conn, 
                    "SELECT famiglia, icona, link, azienda.nome AS 'aznome', componente.descrizione AS 'cpdesc', componente.alias AS 'cpalias', datasheet.nome AS 'dsnome', datasheet.versione AS 'dsver' FROM datasheet
                    JOIN documentato ON id_datasheet=fk_datasheet_id_datasheet
                    JOIN componente ON fk_componente_id_componente=id_componente 
                    JOIN listino ON fk_listino_famiglia=famiglia 
                    JOIN azienda ON listino.fk_azienda_nome=azienda.nome 
                    WHERE id_datasheet='$ds' LIMIT 1;"
                );
                if(mysqli_num_rows($detaildata) != 1) {
                    redirect_js("index.php?goto=404");
                    break;
                }
                else
                    $detaildata = mysqli_fetch_assoc($detaildata);
                    
                $detailpackages = mysqli_query($conn, 
                    "SELECT package.alias FROM datasheet
                    JOIN documentato ON id_datasheet=fk_datasheet_id_datasheet
                    JOIN componente ON documentato.fk_componente_id_componente=id_componente 
                    JOIN disponibile ON disponibile.fk_componente_id_componente=id_componente
                    JOIN package ON fk_package_id_package=id_package 
                    WHERE id_datasheet='$ds'
                    GROUP BY package.alias;"
                );
                close_mysql_conn($conn);
                include("view/details/page-details-datasheet.php");
            }
            break;

        case "success":
            // Mostra una schermata di operazione riuscita in base a paramteri GET
            include("view/page-success.php");
            break;

        case "404":
        default:
            // Pagina non implementata
            include("view/page-404.html");
            break;
    }

    echo "</div>"; // terminazione del div iniziato in page-html-200/404
    include("view/page-bottom.html");
    
      ////////////
    //            //
    //   Script   //
    //            //
      ////////////

    include_once("view/using/tailwindcss-script.html");
?>
</body>
</html>
