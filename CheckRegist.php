<?php
/* 검색 변수 */
  $catagory = $_GET['catgo'];
  $search_con = $_GET['search'];
  if($catagory=='board_title'){
    $catname = '제목';
  } else if($catagory=='board_name'){
    $catname = '작성자';
  } else if($catagory=='board_content'){
    $catname = '내용';
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>약속 전체보기</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css" />
  </head>
  <body>
    <!-- Navigation-->
    <?php include('nav.php'); ?>
    <!-- Header-->
    <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
          <h1 class="display-6 fw-bolder">약속 전체보기</h1>
        </div>
        <!-- Search form-->
        <form class="mt-4" action="search_result.php" method="get">
          <div class="input-group">
            <select class="btn btn-outline-light" name="catgo">
              <option value="board_title">제목</option>
              <option value="board_name">작성자</option>
              <option value="board_content">내용</option>
            </select>
            <input
              type="text"
              class="form-control"
              name="search"
              placeholder="약속할 식당 이름이나 음식을 검색해보세요!"
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
    <!-- Section-->
    <section class="login-section">
      <form action="write.php" method="post">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th width="500">제목</th>
              <th width="100">작성자</th>
              <th width="120">작성일</th>
              <th width="100">조회수</th>
              <th width="100">참여자수</th>
            </tr>
          </thead>
          <?php
          $sql_total = "SELECT COUNT(*) as total FROM board";
          $result_total = oci_parse($conn, $sql_total);
          oci_execute($result_total);
          
          if (!$result_total) {
              die("Error in SQL query: " . oci_error($conn));
          }
          
          $total_rows = oci_fetch_assoc($result_total)['TOTAL'];
          $list = 10; // Number of items to display per page
          $total_page = ceil($total_rows / $list);
          
          if (isset($_GET['page'])) {
              $page = $_GET['page'];
          } else {
              $page = 1;
          }

          $start_num = (($page - 1) * $list) + 1;
          $end_num = $page * $list;

          // Fetch data for the current page
          $sql_page = "SELECT * FROM (SELECT TO_CHAR(BOARD_DATE, 'YYYY-MM-DD') as formatted_date, board.*, ROWNUM AS rnum FROM (SELECT * FROM board ORDER BY BOARD_DATE DESC) board WHERE ROWNUM <= $end_num) WHERE rnum >= $start_num";
          $result_page = oci_parse($conn, $sql_page);
          oci_execute($result_page);

          while ($board = oci_fetch_assoc($result_page)) {
            $title = $board["BOARD_TITLE"];
            if (strlen($title) > 30) {
              $title = mb_substr($board["BOARD_TITLE"], 0, 30, "utf-8") . "...";
            }
            ?>
            <tbody>
              <tr>
                <td><a href="read.php?board_idx=<?php echo $board["BOARD_IDX"]; ?>"><?php echo $title; ?></a></td>
                <td><?php echo $board['BOARD_NAME']; ?></td>
                <td><?php echo $board['FORMATTED_DATE']; ?></td>
                <td><?php echo $board['BOARD_HIT']; ?></td>
                <td><?php echo $board['BOARD_THUMBUP']; ?></td>
              </tr>
            </tbody>
            <?php
          }
    
          // Calculate block start and end numbers
          $block_ct = 5; // Number of page links to display in each block
          $block_num = ceil($page / $block_ct);
          $block_start = ($block_num - 1) * $block_ct + 1;
          $block_end = min($block_start + $block_ct - 1, $total_page);
    
          // Ensure $block_start is not less than 1
          $block_start = max($block_start, 1);
          ?>
        </table>
        <!-- Pagination links -->
        <div class="d-flex justify-content-between align-items-center mt-4">
          <a href='?page=1' class='btn' id='firstPageBtn'>
              <span aria-hidden="true"></span> 처음
          </a>
          
          <?php if ($page > 1): ?>
              <a href='?page=<?php echo $page - 1; ?>' class='btn' id='prevPageBtn'>
                  <span aria-hidden="true">&laquo;</span>
              </a>
          <?php else: ?>
              <a class="btn">
                  <span aria-hidden="true">&laquo;</span>
              </a>
          <?php endif; ?>
          
          <div class="pagination">
              <?php for ($i = $block_start; $i <= $block_end; $i++): ?>
                  <?php if ($page == $i): ?>
                      <a class='btn btn-secondary active'><?php echo $i; ?></a>
                  <?php else: ?>
                      <a href='?page=<?php echo $i; ?>' class='btn'><?php echo $i; ?></a>
                  <?php endif; ?>
              <?php endfor; ?>
          </div>
      
          <?php if ($page < $total_page): ?>
              <a href='?page=<?php echo $page + 1; ?>' class='btn' id='nextPageBtn'>
                  <span aria-hidden="true">&raquo;</span>
              </a>
          <?php else: ?>
              <a class='btn' id='nextPageBtn'>
                  <span aria-hidden="true">&raquo;</span>
              </a>
          <?php endif; ?>
          
          <a href='?page=<?php echo $total_page; ?>' class='btn' id='lastPageBtn'>
              마지막 <span aria-hidden="true"></span>
          </a>
      
          <button class="btn btn-secondary" type="submit">
              <i class="login"></i>
              약속하기
          </button>
        </div>
      </form>
    </section>
    <!-- Footer-->
    <?php include('footer.php'); ?>
  </body>
</html>
