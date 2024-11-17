<?php

include('UserDB.php');

if (isset($_POST['user_id']) && isset($_POST['user_name']) && isset($_POST['pass1']) && isset($_POST['pass2'])) {
    $user_id = htmlspecialchars($_POST['user_id'], ENT_QUOTES, 'UTF-8');
    $user_name = htmlspecialchars($_POST['user_name'], ENT_QUOTES, 'UTF-8');
    $pass1 = htmlspecialchars($_POST['pass1'], ENT_QUOTES, 'UTF-8');
    $pass2 = htmlspecialchars($_POST['pass2'], ENT_QUOTES, 'UTF-8');

    if (empty($user_id) || empty($user_name) || empty($pass1) || empty($pass2)) {
        header("location: userregister_view.php?error=입력값이 비어있습니다");
        exit();
    } elseif ($pass1 !== $pass2) {
        header("location: userregister_view.php?error=비밀번호가 일치하지 않습니다");
        exit();
    } else {
        // 암호화
        $pass1 = password_hash($pass1, PASSWORD_DEFAULT);

        // 중복 체크
        $sql_same = "SELECT * FROM user_table WHERE user_id = :user_id OR user_name = :user_name";
        $order = oci_parse($conn, $sql_same);
        oci_bind_by_name($order, ':user_id', $user_id);
        oci_bind_by_name($order, ':user_name', $user_name);
        oci_execute($order);

        if (oci_fetch_assoc($order)) {
            header("location: userregister_view.php?error=아이디 또는 닉네임이 이미 존재합니다");
            exit();
        } else {
            // 사용자 등록
            $sql_save = "INSERT INTO user_table(user_id, user_name, user_password) VALUES (:user_id, :user_name, :pass1)";
            $result = oci_parse($conn, $sql_save);
            oci_bind_by_name($result, ':user_id', $user_id);
            oci_bind_by_name($result, ':user_name', $user_name);
            oci_bind_by_name($result, ':pass1', $pass1);
            oci_execute($result);

            if ($result) {
                echo '<script>alert("환영합니다! 성공적으로 가입되었습니다."); window.location.href = "index.php?success=가입 성공";</script>';
                exit();
            } else {
                header("location: userregister_view.php?error=가입에 실패하였습니다");
                exit();
            }
        }
    }
} else {
    header("location: userregister_view.php");
    exit();
}

?>
