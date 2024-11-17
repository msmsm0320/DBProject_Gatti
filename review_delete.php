<?php
session_start();

include('UserDB.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle unauthorized access
    header("Location: mainlogin_view.php");
    exit();
}

// Get the board index from the URL
$bno = $_GET['REVIEW_IDX'];

// Fetch the post details from the database
$sql = "SELECT * FROM REVIEW WHERE REVIEW_IDX=:bno";
$result = oci_parse($conn, $sql);
oci_bind_by_name($result, ":bno", $bno);
oci_execute($result);

if (oci_fetch($result)) {
    // Check if the logged-in user is the creator of the post
    if ($_SESSION['user_name'] == oci_result($result, "REVIEW_NAME")) {
        // User is authorized to delete the post
        $deleteSql = "DELETE FROM REVIEW WHERE REVIEW_IDX=:bno";
        $deleteStatement = oci_parse($conn, $deleteSql);
        oci_bind_by_name($deleteStatement, ":bno", $bno);

        if (oci_execute($deleteStatement)) {
            echo '<script type="text/javascript">alert("삭제되었습니다.");</script>';
            header("refresh:0; url=CheckReview.php?after");
            exit();
        } else {
            echo "Error deleting record: " . oci_error($conn);
        }
    } else {
        // User is not authorized to delete the post
        echo '<script type="text/javascript">alert("권한이 없습니다.");</script>';
        header("refresh:0; url=CheckReview.php?after");
        exit();
    }
} else {
    echo "Post not found";
}

oci_free_statement($result);
oci_free_statement($deleteStatement);
oci_close($conn);
?>
