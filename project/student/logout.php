<?php
include "../conn.php";
session_start();
session_destroy();
header("Location:/project/");
pg_close();
die();
?>