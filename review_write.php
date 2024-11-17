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
    <title>리뷰 작성하기</title>
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
          <h1 class="display-6 fw-bolder">리뷰 작성하기</h1>
        </div>
        <!-- Search form-->
        <form class="mt-4" action="search_result.php" method="get">
          <div class="input-group">
            <select class="btn btn-outline-light" name="catgo">
              <option value="review_title">제목</option>
              <option value="review_name">글쓴이</option>
              <option value="review_content">내용</option>
            </select>
            <input
              type="text"
              class="form-control"
              placeholder="리뷰할 식당 이름이나 음식을 검색해보세요!"
              aria-label="Search"
              required="required"
              aria-describedby="button-search"
            />
            <button
              class="btn btn-outline-light"
              type="submit"
              id="button-search"
            >
              검색
            </button>
          </div>
        </form>
      </div>
    </header>

    <!-- Section -->
    <section class="py-5">
        <div class="container-fluid px-1 px-md-4 mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="review_write_ok.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">제목</label>
                            <textarea class="form-control" id="title" name="review_title" rows="1" placeholder="제목" maxlength="100" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="uname" class="col-form-label">글쓴이</label>
                            <!-- Assuming the user is already logged in, use their username -->
                            <input type="text" class="form-control" id="uname" name="review_name" value="<?php echo $_SESSION["user_name"]; ?>" maxlength="100" readonly required />
                        </div>

                        <div class="mb-3">
                            <label for="ucontent" class="form-label">내용</label>
                            <textarea class="form-control" id="ucontent" name="review_content" rows="5" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="uploadPhoto" class="col-form-label">사진 업로드</label>
                            <input type="file" class="form-control-plaintext" id="uploadPhoto" name="b_file" accept="image/*" />
                            <button type="submit" class="btn btn-secondary">Go!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include('footer.php'); ?>
  </body>
</html>
