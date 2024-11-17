<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

header('Content-Type: text/html; charset=utf-8');

// 오라클 데이터베이스 연결 정보 설정
$host = "";  // 오라클 데이터베이스 호스트 주소
$port = "";             // 오라클 데이터베이스 포트
$db_service_name = ""; // 오라클 데이터베이스 서비스 이름

// 사용자 정보
$username = "";
$password = "";

// 연결 문자열 생성
$db = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST={$host})(PORT={$port})))(CONNECT_DATA=(SERVICE_NAME={$db_service_name})))";

// 오라클 데이터베이스 연결 시도
// $conn = oci_connect($username, $password, $db);
$conn = oci_connect($username, $password, $db, 'AL32UTF8');

// 연결 여부 확인
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

?>