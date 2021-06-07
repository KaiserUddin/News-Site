<?php
    ob_start();
    SESSION_START();
    SESSION_UNSET();
    SESSION_DESTROY();
    header("Location:index.php");
    ob_end_flush();
?>