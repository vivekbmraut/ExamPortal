<?php
include "../conn.php";
session_start();
session_destroy();
header("Location:/project/Institute/");
pg_close();
die();
?>