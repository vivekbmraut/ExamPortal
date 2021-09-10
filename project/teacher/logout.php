<?php
include "../conn.php";
session_start();
session_destroy();
header("Location:/project/teacher");
pg_close();
die();
?>