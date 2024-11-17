<?php
session_start();
include('UserDB.php');

// 사용자로부터 받은 review_idx를 정수로 변환
$bno = intval($_GET['review_idx']);

// 사용자로부터 받은 값들
$username = $_SESSION['user_name'];
$title = $_POST['review_title'];
$content = $_POST['review_content'];

// SQL 쿼리 작성 - 바인드 변수 사용
$sql = oci_parse($conn, "UPDATE review SET review_name = :username, review_title = :title, review_content = :content WHERE review_idx = :bno");

// 바인드 변수에 값 할당
oci_bind_by_name($sql, ":username", $username);
oci_bind_by_name($sql, ":title", $title);
oci_bind_by_name($sql, ":content", $content);
oci_bind_by_name($sql, ":bno", $bno);

// SQL 실행
oci_execute($sql);

// 메시지 및 리다이렉션
echo "<script type='text/javascript'>alert('수정되었습니다.');</script>";
header("refresh:0;url=CheckReview.php");

// OCI8 Statement 닫기
oci_free_statement($sql);

// OCI8 연결 닫기
oci_close($conn);
?>
