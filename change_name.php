<?php
include('UserDB.php');
session_start();

function changeName($conn, $user_id, $new_name) {
  // 데이터베이스에서 사용자의 이름 업데이트
  $odb = "UPDATE user_table SET user_name = :new_name WHERE user_id = :user_id";
  $stmt = oci_parse($conn, $odb);

  // 바인딩
  oci_bind_by_name($stmt, ":new_name", $new_name);
  oci_bind_by_name($stmt, ":user_id", $user_id);

  // 실행
  oci_execute($stmt);

  // 리소스 해제
  oci_free_statement($stmt);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $new_name = $_POST['new_name'];
  $user_id = $_SESSION['user_id'];

  changeName($conn, $user_id, $new_name);

  $_SESSION['message'] = "이름이 성공적으로 변경되었습니다!";
  session_unset();
  session_destroy();
  
  echo '<script>';
  echo 'alert("성공적으로 변경 되었습니다. 다시 로그인 해주세요.");';
  echo 'window.location.href = "index.php?success=성공적으로 변경됨";';
  echo '</script>';

  exit();
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
  </head>
  <body>
    <!-- Navigation-->
    <?php include('nav.php'); ?>
    <!-- Header-->
    <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
          <h1 class="display-5 fw-bolder">닉네임 변경</h1>
        </div>
      </div>
    </header>
    <section class="login-section">
      <form class="login-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        
        <label><?php echo "지금 회원님의 닉네임은 " . $_SESSION["user_name"] . "입니다.";; ?></label>
        <p></p>
        <label for="new_name">새로운 이름을 지어주세요!</label>
        <input
          type="text"
          class="form-control"
          placeholder="닉네임을 입력하세요!"
          name="new_name"
          id="new_name"
          required
        />
        <p></p>
        <button type="submit" class="btn btn-secondary">변경하기</button>
      </form>
    </section>
    <!-- Footer -->
    <?php include('footer.php'); ?>
  </body>
</html>
