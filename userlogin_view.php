<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>사용자 로그인</title>

    <!-- 스타일 시트 line10 of -->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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
          <h1 class="display-6 fw-bolder">사용자 로그인 하기</h1>
        </div>
      </div>
    </header>
    <section class="login-section">
      <form class="login-form" action="userlogin_server.php" method="post">
        <!--에러메세지-->
        <?php if(isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <!--성공메세지-->
        <?php if(isset($_GET['success'])) { ?>
        <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

        <label>아이디</label>
        <input
          class="form-control"
          type="text"
          placeholder="아이디를 입력하세요!"
          name="user_id"
        />

        <label>비밀번호</label>
        <input
          class="form-control"
          type="password"
          placeholder="비밀번호를 입력하세요!"
          name="pass1"
        />
        <p></p>
        <button type="submit" class="btn btn-secondary" name="login_btn">
          로그인
        </button>
        <a href="userregister_server.php" class="save"
          >아직 회원이 아니신가요? (회원가입 페이지)</a
        >
      </form>
    </section>
    <!-- Footer -->
    <?php include('footer.php'); ?>
  </body>
</html>
