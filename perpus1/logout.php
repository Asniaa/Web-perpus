<?php
session_start();
include "config/app.php";

if (isset($_SESSION['user_id'])) {
    log_activity($_SESSION['user_id'], "Logout dari sistem");
} else {
    log_activity(0, "Logout dari sistem (ID user tidak diketahui)");
}

session_destroy();
header("Location: frmlogin.php");
exit();
?>