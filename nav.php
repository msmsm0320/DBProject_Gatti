<?php
if (session_status() === PHP_SESSION_NONE) {
    // 세션을 시작하지 않은 경우에만 세션 시작
    session_start();
}

include('UserDB.php');

if (isset($_SESSION["user_id"])) {
  $welcomeText = "Welcome! " . $_SESSION["user_name"] . " ";
  $loginText = "Log Out";
  $signupText = "mypage";
  $loginLink = "logout.php?after";
  $appointmentlink="CheckRegist.php";
  $mypageLink = "mypage.php";
} else {
  // 사용자가 로그인하지 않은 경우
  $welcomeText = "";
  $loginText = "Log in";
  $signupText = "";
  $loginLink = "mainlogin_view.php?after";
  $signupLink = "";
  $mypageLink = "";
}
?>
<!-- Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container px-4 px-lg-5">
    <a href="index.php">
      <img src="./img/logo.png" height="35px" alt="Gatti" />
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
        <li class="nav-item"><a class="nav-link" href="restaurant_list.php">Restaurant</a></li>
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            id="navbarDropdown"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >More</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li>
              <a class="dropdown-item" href="CheckRegist.php">Regist</a>
            </li>
            <li><hr class="dropdown-divider" /></li>
            <li>
              <a class="dropdown-item" href="CheckReview.php">Review</a>
            </li>
          </ul>
        </li>
      </ul>
      <div id="welcomeMsg"><?php echo $welcomeText; ?></div>
      <p>&nbsp;</p>
      
      <?php if (isset($_SESSION["user_id"])): ?>
        <form class="d-flex" action="<?php echo $mypageLink?>" method="post">
          <button class="btn btn-outline-dark" type="submit">
            <i class="login"></i>
            <?php echo $signupText?>
          </button>
        </form>
      <?php endif; ?>
      <p>&nbsp;</p>
      <form class="d-flex" action="<?php echo $loginLink?>" method="post">
        <button class="btn btn-outline-dark" type="submit">
          <i class="login"></i>
          <?php echo $loginText?>
        </button>
      </form>
    </div>
  </div>
</nav>