<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>사용자 회원가입</title>

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
          <h1 class="display-6 fw-bolder">사용자 회원가입</h1>
        </div>
      </div>
    </header>
    <section class="login-section">
      <form class="login-form" action="userregister_server.php" method="post">
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
          type="text"
          class="form-control"
          placeholder="아이디를 입력해주세요."
          name="user_id"
        />

        <label>사용자 닉네임</label>
        <input
          type="text"
          class="form-control"
          placeholder="닉네임을 입력해주세요."
          name="user_name"
        />

        <label>비밀번호</label>
        <input
          type="password"
          class="form-control"
          placeholder="비밀번호를 입력해주세요."
          name="pass1"
        />

        <label>비밀번호 확인</label>
        <input
          type="password"
          class="form-control"
          placeholder="다시 비밀번호를 입력해주세요."
          name="pass2"
        />
        <p></p>
        <button type="submit" class="btn btn-secondary" name="save">
          회원가입
        </button>

        <a href="userlogin_view.php" class="save"
          >기존 사용자 로그인 (로그인 페이지)</a
        >
        <a href="mainlogin_view.php" class="save">(메인 로그인 페이지)</a>
      </form>
    </section>
    <!-- Footer -->
    <?php include('footer.php'); ?>
  </body>
</html>
