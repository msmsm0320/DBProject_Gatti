<?php
include('UserDB.php');

// 게시글 번호와 수정할 내용을 받아옴
$bno = $_GET['board_idx'];
$username = $_POST['board_name'];
$title = $_POST['board_title'];
$content = $_POST['board_content'];

// OCI8 Statement를 사용하여 UPDATE 쿼리 작성
$updateStatement = oci_parse($conn, "UPDATE BOARD SET BOARD_NAME = :username, BOARD_TITLE = :title, BOARD_CONTENT = :content WHERE BOARD_IDX = :bno");
oci_bind_by_name($updateStatement, ":username", $username);
oci_bind_by_name($updateStatement, ":title", $title);
oci_bind_by_name($updateStatement, ":content", $content);
oci_bind_by_name($updateStatement, ":bno", $bno);

// UPDATE 실행
oci_execute($updateStatement);

// 메시지 및 리다이렉션
echo "<script type='text/javascript'>alert('수정되었습니다.');</script>";
header("refresh:0;url=CheckRegist.php");

// OCI8 Statement 닫아줌
oci_free_statement($updateStatement);
oci_close($conn);
?>
