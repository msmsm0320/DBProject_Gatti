<?php
include('UserDB.php');

$bno = $_GET['BOARD_IDX'];
$sql = oci_parse($conn, "SELECT * FROM BOARD WHERE BOARD_IDX = :bno");
oci_bind_by_name($sql, ":bno", $bno);
oci_execute($sql);

// oci_fetch_assoc로 변경
$board = oci_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include('login_ckeck.php'); ?>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>게시물 수정</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body>
    <!-- Navigation-->
    <?php include('nav.php'); ?>
    <!-- Header-->
    <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
          <h1 class="display-6 fw-bolder">게시물 수정</h1>
        </div>
      </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container-fluid px-1 px-md-4 mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="modify_ok.php?board_idx=<?php echo $bno; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">제목</label>
                            <input type="text" class="form-control" name="board_title" id="utitle" value="<?php echo $board['BOARD_TITLE']; ?>" maxlength="100" required>
                        </div>

                        <div class="mb-3">
                            <label for="uname" class="col-form-label">작성자</label>
                            <!-- Assuming the user is already logged in, use their username -->
                            <input type="text" class="form-control" id="uname" name="board_name" value="<?php echo $_SESSION["user_name"]; ?>" maxlength="100" readonly required />
                        </div>

                        <div class="mb-3">
                            <label for="ucontent" class="form-label">내용</label>
                            <textarea class="form-control" name="board_content" id="ucontent"  rows="5" required><?php echo $board['BOARD_CONTENT']->load(); ?></textarea>
                        </div>

                        <div class="mb-4">
                            <!--<label for="promise_time" class="blacklabel">약속 날짜 및 시간을 수정해주세요!</label>
                            <p></p>
                            <input type="datetime-local" class="form-control-sm" id="promise_time" name="promise_time"/>-->
                            <button type="submit" class="btn btn-secondary">수정하기!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <?php include('footer.php'); ?>
  </body>
</html>
