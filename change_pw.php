<?php
include('UserDB.php');
session_start();

function changePassword($conn, $user_id, $new_password) {
  $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
  
  // 데이터베이스에서 사용자의 비밀번호 업데이트
  $odb = "UPDATE user_table SET user_password = :hashed_password WHERE user_id = :user_id";
  $stmt = oci_parse($conn, $odb);

  // 바인딩
  oci_bind_by_name($stmt, ":hashed_password", $hashed_password);
  oci_bind_by_name($stmt, ":user_id", $user_id);

  // 실행
  $result = oci_execute($stmt);

  // 리소스 해제
  oci_free_statement($stmt);

  return $result;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];
    $user_id = $_SESSION['user_id'];

    if ($new_password === $confirm_new_password) {
        $success = changePassword($conn, $user_id, $new_password);

        if ($success) {
          $_SESSION['message'] = "비밀번호가 성공적으로 변경되었습니다!";
          session_unset();
          session_destroy();
          
          echo '<script>';
          echo 'alert("성공적으로 변경 되었습니다. 다시 로그인 해주세요.");';
          echo 'window.location.href = "index.php?success=성공적으로 변경됨";';
          echo '</script>';
          
          exit();
        }       
    } else {
        $error = "새로운 비밀번호와 확인 비밀번호가 일치하지 않습니다.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>회원정보 수정</title>

    <!-- 스타일 시트 line10 of -->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css" />

    <!--<link rel="stylesheet" type="text/css" href="css/join.css">-->
    <script>
      // 비밀번호가 틀렸을 시 다시 페이지 로드
      function promptAgain() {
        location.reload(); // Reload the page to clear input fields
      }
    </script>
  </head>
  <body>
    <!-- Navigation-->
    <?php include('nav.php'); ?>
    <!-- Header-->
    <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
          <h1 class="display-6 fw-bolder">비밀번호 변경</h1>
        </div>
      </div>
    </header>
    <section class="login-section">
      <form
        class="login-form"
        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
        method="post"
      >
        <!-- 오류메세지 -->
        <?php if (isset($error)) { ?>
          <div class="alert alert-danger" role="alert">
          <?php echo htmlspecialchars($error); ?>
          </div>
        <?php } ?>
        <label for="new_password">새로운 비밀번호를 입력하세요</label>
        <input
          type="password"
          class="form-control"
          name="new_password"
          id="new_password"
          required
        />
        <label for="confirm_new_password">새로운 비밀번호 확인</label>
        <input
          type="password"
          class="form-control"
          name="confirm_new_password"
          id="confirm_new_password"
          required
        />
        <p></p>
        <button type="submit" class="btn btn-secondary">변경하기</button>
      </form>
    </section>
    <!-- Footer -->
    <?php include('footer.php'); ?>
</html>
