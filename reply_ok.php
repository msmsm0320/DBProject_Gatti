<?php
session_start();
include('UserDB.php');

$bno = $_POST['board_idx'];
$userpw = ""; // 사용자 비밀번호 부분은 현재 빈 문자열로 처리되어 있습니다. 실제로 사용자 비밀번호를 사용해야 하는 경우 적절한 처리를 해주셔야 합니다.

if ($bno && $_SESSION['user_name'] && $_POST['reply_content']) {
    // 댓글을 삽입하는 오라클 쿼리
    $sql = oci_parse($conn, "INSERT INTO reply (board_idx, reply_name, reply_password, reply_content) VALUES (:bno, :username, :userpw, :content)");
    
    oci_bind_by_name($sql, ":bno", $bno);
    oci_bind_by_name($sql, ":username", $_SESSION['user_name']);
    oci_bind_by_name($sql, ":userpw", $userpw);
    oci_bind_by_name($sql, ":content", $_POST['reply_content']);

    $result = oci_execute($sql);

    if ($result) {
        echo "<script>alert('댓글이 작성되었습니다.'); 
        location.href='read.php?board_idx=$bno';</script>";
    } else {
        $e = oci_error($sql);
        echo "<script>alert('댓글 작성에 실패했습니다. 오류 메시지: " . htmlentities($e['message'], ENT_QUOTES) . "'); 
        history.back();</script>";
    }
} else {
    echo "<script>alert('댓글 작성에 실패했습니다.'); 
    history.back();</script>";
}
?>
