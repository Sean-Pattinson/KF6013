<?php

session_start();
if(isset($_SESSION)) {
    session_destroy();
    header('Location: index.php');
}

var_dump($_SESSION);

?>