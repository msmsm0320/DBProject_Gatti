<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>로그인</title>

    <!-- 스타일 시트 line10 of -->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css" />
    <style>
      .btn-long {
        width: 100%;
      }
    </style>
    <!--<link rel="stylesheet" type="text/css" href="css/join.css">-->
  </head>
  <body>
    <!-- Navigation-->
    <?php include('nav.php'); ?>
    <!-- Header-->
    <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
          <h1 class="display-6 fw-bolder">로그인 선택</h1>
        </div>
      </div>
    </header>
    <section class="login-section">
      <div class="login-form">
        <a href="userlogin_view.php">
          <button
            type="submit"
            class="btn btn-secondary btn-lg btn-long"
            name="user_login_btn"
          >
            사용자 로그인
          </button>
        </a>
        &nbsp;
        <a href="adminlogin_view.php">
          <button
            type="submit"
            class="btn btn-secondary btn-lg btn-long"
            name="admin_login_btn"
          >
            관리자 로그인
          </button>
        </a>
      </div>
    </section>

    <!-- Footer -->
    <?php include('footer.php'); ?>
  </body>
</html>
