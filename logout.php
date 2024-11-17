<?php
    session_start();

    echo '<script>';
    echo 'alert("다음에 또 봐요! 안전하게 로그아웃 되었습니다.");';
    echo 'window.location.href = "index.php?success=성공적으로 로그아웃됨";';
    echo '</script>';
    
    session_unset();
    session_destroy();
  
    exit();
?>