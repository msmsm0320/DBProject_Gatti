<?php
include('UserDB.php');

$bno = $_GET['REVIEW_IDX'];

// 이전에는 mysqli_fetch_array를 사용했으나, oci_fetch_assoc로 변경
$result = oci_parse($conn, "SELECT REVIEW_THUMBUP FROM REVIEW WHERE REVIEW_IDX = :bno");
oci_bind_by_name($result, ":bno", $bno);
oci_execute($result);

// oci_fetch_assoc를 사용하여 결과를 가져옴
$thumbupRow = oci_fetch_assoc($result);

// 기존의 mysqli_fetch_array와는 다르게 필드명을 바로 사용
$thumbup = $thumbupRow['REVIEW_THUMBUP'] + 1;

// OCI8에서는 쿼리를 직접 실행하는 것이 아닌 OCI8 Statement를 사용
$updateStatement = oci_parse($conn, "UPDATE REVIEW SET REVIEW_THUMBUP = :thumbup WHERE REVIEW_IDX = :bno");
oci_bind_by_name($updateStatement, ":thumbup", $thumbup);
oci_bind_by_name($updateStatement, ":bno", $bno);
oci_execute($updateStatement);

// 메시지 및 리다이렉션
echo "<script type='text/javascript'>alert('추천되었습니다.');</script>";
header("refresh:0;url=CheckReview.php");

// OCI8 Statement를 닫아줌
oci_free_statement($result);
oci_free_statement($updateStatement);
oci_close($conn);
?>
