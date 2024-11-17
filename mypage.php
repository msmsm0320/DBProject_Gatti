<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>마이페이지</title>

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
        .custom-btn {
        width: 100%; /* 최대 너비를 100%로 지정 */
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
          <h1 class="display-5 fw-bolder">마이페이지</h1>
          <p></p>
          <h3>
            밥은 드셨나요,
            <?php echo $_SESSION['user_name']; ?>님?
          </h3>
        </div>
      </div>
    </header>
    <section class="login-section">
      <form class="login-form">
        <p class="text-white fs-5">
          현재 아이디:
          <?php echo $_SESSION['user_id']; ?>
        </p>
        <p class="text-white fs-5">
          현재 닉네임:
          <?php echo $_SESSION['user_name']; ?>
        </p>
        <div class="row">
          <div class="col">
            <a
              href="change_name.php"
              class="btn btn-secondary mb-2 d-inline-block custom-btn text-truncate"
              >Change Nickname</a
            >
          </div>
          <div class="col">
            <a
              href="change_pw.php"
              class="btn btn-danger mb-2 d-inline-block custom-btn text-truncate"
              >Change Password</a
            >
          </div>
        </div>
        <div class="col">
          <a
            href="logout.php"
            class="btn btn-danger mb-2 d-inline-block custom-btn text-truncate"
            >Logout</a
          >
        </div>
      </form>
    </section>
    <!-- Footer -->
    <?php include('footer.php'); ?>
  </body>
</html>
