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
    <title>약속 계시판</title>
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
  </head>
  <body>
    <!-- Navigation-->
    <?php include('nav.php'); ?>
    <!-- Header-->
    <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
          <h1 class="display-6 fw-bolder">약속 게시판</h1>
        </div>
      </div>
    </header>
    <?php
    $bno = isset($_GET['board_idx']) ? intval($_GET['board_idx']) : 0;

    if ($bno > 0) {
      // 조회수 증가
      $hitUpdate = oci_parse($conn, "UPDATE board SET board_hit = board_hit + 1 WHERE board_idx = :bno");
      oci_bind_by_name($hitUpdate, ":bno", $bno);
      oci_execute($hitUpdate);

      // 게시글 조회
      $boardQuery = oci_parse($conn, "SELECT TO_CHAR(BOARD_DATE, 'YYYY-MM-DD HH:mm:ss') as formatted_date, board.* FROM board WHERE board_idx = :bno");
      oci_bind_by_name($boardQuery, ":bno", $bno);
      oci_execute($boardQuery);

      $board = oci_fetch_assoc($boardQuery);

      if ($board) {
          ?>
    <!-- Section-->
    <section class="login-section">
      <form action="reply_ok.php" method="post">
        <div id="bo_ser">
          <ul class="list-inline">
            <li class="list-inline-item"><a class="btn btn-outline-dark" href="CheckRegist.php">목록으로</a></li>
            <li class="list-inline-item"><a class="btn btn-outline-dark" href="thumbup.php?BOARD_IDX=<?php echo $board['BOARD_IDX']; ?>">약속하기</a></li>
            <li class="list-inline-item"><a class="btn btn-outline-dark" href="modify.php?BOARD_IDX=<?php echo $board['BOARD_IDX']; ?>">수정</a></li>
            <li class="list-inline-item"><a class="btn btn-outline-dark" href="delete.php?BOARD_IDX=<?php echo $board['BOARD_IDX']; ?>">삭제</a></li>
          </ul>
        </div>
        <div id="board_read">
          <h4>제목: <?php echo $board['BOARD_TITLE']; ?></h4>
          <div id="user_info">
            작성자: <?php echo $board['BOARD_NAME']; ?>
            <div id="bo_line">일시: <?php echo $board['FORMATTED_DATE']; ?> 조회: <?php echo $board['BOARD_HIT']; ?> 참여자: <?php echo $board['BOARD_THUMBUP']; ?></div>
          </div>
          <p></p>
          <div id="bo_content">
            <h4><?php
            $lob = $board['BOARD_CONTENT'];
                echo nl2br($lob->load());
            ?>
            <h4>
          </div>
        </div>
        <div class="reply_view">
      </form>
    <p></p>
    <h4>댓글</h4>
    <?php
    $replyQuery = oci_parse($conn, "SELECT * FROM reply WHERE BOARD_IDX = :bno ORDER BY BOARD_IDX DESC");
    oci_bind_by_name($replyQuery, ":bno", $bno);
    oci_execute($replyQuery);

    while ($reply = oci_fetch_assoc($replyQuery)) {
        ?>
        <div class="dap_lo">
            <div><b><?php echo $reply['REPLY_NAME']; ?></b></div>
            <div class="dap_to comt_edit"><?php echo nl2br($reply['REPLY_CONTENT']->load()); ?></div>
            <div class="rep_me dap_to"><?php echo $reply['REPLY_DATE']; ?></div>
            <div class="rep_me rep_menu">
                <div class='dat_delete'>
                    <!--추후 추가 예정
                    <form action="reply_delete.php" method="post">
                        <input type="hidden" name="reply_rno" value="<?php echo $reply['BOARD_IDX']; ?>" />
                        <input type="hidden" name="reply_b_no" value="<?php echo $bno; ?>">
                        <input type="submit" value="삭제">
                    </form>-->
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- 댓글 입력 폼 -->
    <div class="dap_ins">
    <form action="reply_ok.php" method="post"> <!-- 여기서 reply_ok.php?board_idx=$bno는 get방식이고 reply_ok.php에서는 post로 받고 있었음 -->
      <input type="hidden" name="board_idx" value="<?php echo $bno; ?>"> <!-- 이 줄이 없어서 board_idx가 넘어가지 않았음 -->
        <div class="mb-3">
            <label for="reply_content" class="form-label">댓글 입력</label>
            <textarea name="reply_content" class="form-control" id="reply_content" rows="1"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">댓글 등록</button>
    </form>
</div>
</div>
<!-- 댓글 불러오기 끝 -->
            <?php
        } else {
            echo '게시글을 찾을 수 없습니다.';
        }
    } else {
        echo '올바르지 않은 게시글 인덱스입니다.';
    }
    ?>
      </form>
    </section>
    <!-- Footer-->
    <?php include('footer.php'); ?>
  </body>
</html>
