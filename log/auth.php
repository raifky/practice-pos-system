<?php
session_start();

function checkLoginSessionValidity()
{
    $session_duration = 30000; // 1 minggu dalam detik
    if (isset($_SESSION['login_time'])) {
        $login_time = $_SESSION['login_time'];
        $current_time = time();
        $duration = $current_time - $login_time;
        if ($duration > $session_duration) {
            session_unset();
            session_destroy();
            header("location: ../log/login_page.php");
            exit;
        }
    } else {
        header("location: ../log/login_page.php");
        exit;
    }
}
?>
