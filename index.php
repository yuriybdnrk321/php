<?php
require_once("./layout/header.php");
require_once("./layout/left-menu.php");

if(isset($_GET["action"]) &&
 $_GET["action"] == "main") {
require_once("views/main.php");
}
else if(isset($_GET["action"]) &&
 $_GET["action"] == "about") {
require_once("views/about.php");
}
else if(isset($_GET["action"]) &&
 $_GET["action"] == "registration") {
require_once("views/registration.php");
}
else {
require_once("views/main.php");
}

require_once("./layout/footer.php");
?>