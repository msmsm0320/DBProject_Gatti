<?php
include('UserDB.php');

if (isset($_POST['user_id']) && isset($_POST['pass1'])) {
    $user_id = htmlspecialchars($_POST['user_id'], ENT_QUOTES, 'UTF-8');
    $pass1 = htmlspecialchars($_POST['pass1'], ENT_QUOTES, 'UTF-8');

    if (empty($user_id)) {
        header("location: userlogin_view.php?error=아이디가 비어있어요");
        exit();
    } else if (empty($pass1)) {
        header("location: userlogin_view.php?error=비밀번호가 비어있어요");
        exit();
    } else {
        // UserDB.php에서 오라클 DB 연결 정보가 이미 정의되어 있다고 가정합니다.
        // UserDB.php 파일에 $conn 변수가 이미 정의되어 있어야 합니다.

        // Use bind variables to prevent SQL injection
        $sql = "SELECT * FROM user_table WHERE user_id = :user_id";
        $result = oci_parse($conn, $sql);

        oci_bind_by_name($result, ':user_id', $user_id);

        oci_execute($result);

        if ($row = oci_fetch_assoc($result)) {
            $hash = $row['USER_PASSWORD'];

            if (password_verify($pass1, $hash)) {
                session_start();
                $_SESSION['user_id'] = $row['USER_ID'];
                $_SESSION['user_name'] = $row['USER_NAME'];
                echo '<script>';
                echo 'alert("어서오세요! Gatti 할까요?");';
                echo 'window.location.href = "index.php?success=login";';
                echo '</script>';
                exit();
            } else {
                header("location: userlogin_view.php?error=비밀번호가 일치하지 않아요");
                exit();
            }
        } else {
            header("location: userlogin_view.php?error=회원정보가 없습니다");
            exit();
        }

        // 오라클 데이터베이스 연결 종료
        oci_close($conn);
    }
} else {
    header("location: userlogin_view.php?error=알수없는 오류발생 (담당자에게 문의주세요)");
    exit();
}
?>
