<?php
    session_start();
    // Check if the user is logged in
    if (!isset($_SESSION["user_id"])) {
    // Redirect to a login page or show an error message
        echo '<script>';
        echo 'alert("로그인 시 이용하실 수 있습니다.");';
        echo 'window.location.href = "mainlogin_view.php";';
        echo '</script>';
        exit();
    }
?>