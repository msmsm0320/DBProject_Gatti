<?php
session_start();
include('UserDB.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 업로드 폴더 확인 및 생성
    $uploadFolder = 'upload/';

    // 폼 데이터 가져오기
    $filename = $_FILES['b_file']['name'];
    $folder = $uploadFolder . $filename;

    if (move_uploaded_file($_FILES['b_file']['tmp_name'], $folder)) {
        $review_title = $_POST["review_title"];
        $review_name = $_SESSION["user_name"];
        $review_content = $_POST["review_content"];
        $review_password = "";
        
        // 현재 날짜 가져오기
        $review_date = date("Y-m-d H:i:s");
        // 파일 경로 데이터베이스에 삽입
        echo "Folder: " . $folder;
        $sql = "INSERT INTO review (review_name, review_password, review_title, review_content, review_date, review_file) VALUES (:review_name, :review_password, :review_title, :review_content, TO_DATE(:review_date, 'YYYY-MM-DD HH24:MI:SS'), :folder)";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ':review_name', $review_name);
        oci_bind_by_name($stmt, ':review_password', $review_password);
        oci_bind_by_name($stmt, ':review_title', $review_title);
        oci_bind_by_name($stmt, ':review_content', $review_content);
        oci_bind_by_name($stmt, ':review_date', $review_date);
        oci_bind_by_name($stmt, ':folder', $folder);

        if (oci_execute($stmt, OCI_DEFAULT)) {
            // 커밋
            oci_commit($conn);

            echo "<script>
            alert('리뷰 작성이 완료되었습니다.');
            location.href='CheckReview.php';</script>";
        } else {
            $e = oci_error($stmt);
            echo "에러: " . htmlentities($e['message'], ENT_QUOTES);
        }

        // 명령문 닫기
        oci_free_statement($stmt);
        } else {
        echo "파일 업로드 실패";
        }
    
    // 데이터베이스 연결 닫기
    oci_close($conn);
}
?>

