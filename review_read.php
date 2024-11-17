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
    <title>리뷰 게시판</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" type="text/css" href="css/login.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <style>
    </style>
  </head>
  <body>
    <!-- Navigation-->
    <?php include('nav.php'); ?>
    <!-- Header-->
    <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
          <h1 class="display-6 fw-bolder">리뷰 게시판</h1>
        </div>
      </div>
    </header>
    <?php
    $bno = isset($_GET['review_idx']) ? intval($_GET['review_idx']) : 0;

    if ($bno > 0) {
      // 조회수 증가
      $hitUpdate = oci_parse($conn, "UPDATE review SET review_hit = review_hit + 1 WHERE review_idx = :bno");
      oci_bind_by_name($hitUpdate, ":bno", $bno);
      oci_execute($hitUpdate);

      // 게시글 조회
      $reviewQuery = oci_parse($conn, "SELECT TO_CHAR(REVIEW_DATE, 'YYYY-MM-DD HH:mm:ss') as formatted_date, review.* FROM review WHERE review_idx = :bno");
      oci_bind_by_name($reviewQuery, ":bno", $bno);
      oci_execute($reviewQuery);

      $review = oci_fetch_assoc($reviewQuery);


      if ($review) {
          ?>
    <!-- Section-->
    <section class="content-section">
        
        <div id="bo_ser">
          <ul class="list-inline">
            <li class="list-inline-item"><a class="btn btn-outline-dark" href="CheckReview.php">목록으로</a></li>
            <li class="list-inline-item"><a class="btn btn-outline-dark" href="review_thumbup.php?REVIEW_IDX=<?php echo $review['REVIEW_IDX']; ?>">추천</a></li>
            <li class="list-inline-item"><a class="btn btn-outline-dark" href="review_modify.php?REVIEW_IDX=<?php echo $review['REVIEW_IDX']; ?>">수정</a></li>
            <li class="list-inline-item"><a class="btn btn-outline-dark" href="review_delete.php?REVIEW_IDX=<?php echo $review['REVIEW_IDX']; ?>">삭제</a></li>
          </ul>
        </div>
        <div id="review_read">
          <h4>제목: <?php echo $review['REVIEW_TITLE']; ?></h4>
          <div id="user_info">
            작성자: <?php echo $review['REVIEW_NAME']; ?>
            <div id="bo_line">일시: <?php echo $review['FORMATTED_DATE']; ?> 조회: <?php echo $review['REVIEW_HIT']; ?> 추천: <?php echo $review['REVIEW_THUMBUP']; ?></div>
          </div>
          <div>
            <br>
            <!-- 이미지 표시 -->
            <?php
            $imagePath = $review['REVIEW_FILE']; // 이미지 경로를 review_file 컬럼에서 읽어옴

            // 이미지 MIME 타입 확인
            $finfo = new finfo(FILEINFO_MIME_TYPE);

            // 파일에서 데이터를 문자열로 내보내기
            $lobData = file_get_contents($imagePath);
            $mime = $finfo->buffer($lobData);

            // 이미지 경로 확인
            //echo 'Image Path: ' . $imagePath . '<br>';

            if ($mime && strpos($mime, 'image/') === 0) {
                // 이미지 출력
                echo '<img src="data:' . $mime . ';base64,' . base64_encode($lobData) . '" alt="Review Image" height="360px">';
            } else {
                echo '이미지를 찾을 수 없습니다.';
            }
            ?>
        </div>
          <div id="bo_content">
            <h4><?php
            $lob = $review['REVIEW_CONTENT'];
                echo nl2br($lob->load());
            ?>
            <h4>
          </div>
        </div>
            <?php
        } else {
            echo '게시글을 찾을 수 없습니다.';
        }
    } else {
        echo '올바르지 않은 게시글 인덱스입니다.';
    }
    ?>
    </section>
    <!-- Footer-->
    <?php include('footer.php'); ?>
  </body>
</html>
