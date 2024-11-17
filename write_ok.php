<?php
session_start();
include('UserDB.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $board_title = $_POST["board_title"];
    $board_name = $_SESSION["user_name"];
    $board_content = $_POST["board_content"];
    $board_password = "";

    // Get the current date
    $board_date = date("Y-m-d H:i:s");

    // Prepare the Oracle SQL statement
    $sql = "INSERT INTO board (board_name, board_password, board_title, board_content, board_date) VALUES (:board_name, :board_password, :board_title, :board_content, TO_DATE(:board_date, 'YYYY-MM-DD HH24:MI:SS'))";

    $stmt = oci_parse($conn, $sql);

    // Bind variables
    oci_bind_by_name($stmt, ':board_name', $board_name);
    oci_bind_by_name($stmt, ':board_password', $board_password);
    oci_bind_by_name($stmt, ':board_title', $board_title);
    oci_bind_by_name($stmt, ':board_content', $board_content);
    oci_bind_by_name($stmt, ':board_date', $board_date);

    // Execute the statement
    $result = oci_execute($stmt);

    if ($result) {
        echo "<script>
        alert('글 작성이 완료되었습니다.');
        location.href='CheckRegist.php';</script>";
    } else {
        $error_message = oci_error($stmt);
        echo "Error: " . $error_message['message'];
    }

    // Close the statement
    oci_free_statement($stmt);
    
    // Close the database connection
    oci_close($conn);
}
?>
