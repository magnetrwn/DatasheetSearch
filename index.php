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
    $goto = "homepage";
else
    $goto = strtolower($_GET["goto"]);

switch($goto) {
    case "homepage":
        include("view/page-homepage.html");
        break;
    case "login":
        include("view/auth/page-login.html");
        break;
    case "auth":
    default:
        http_response_code(404);
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
