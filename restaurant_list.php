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
    <title>식당 리스트</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <!-- 부트스트랩 CSS 파일 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- FontAwesome CSS 파일 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css" />

    <style>
        .restaurant {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 800px;
            overflow: hidden; /* 이미지가 부모 요소를 벗어나는 것을 방지 */
        }
        .restaurant-details {
            /* 이미지의 오른쪽에 텍스트 배치 */
            margin-left: 220px; /* 이미지의 최대 너비 + 간격 이상의 여백 확보 */
        }
        img {
            float: left;
            max-width: 300px; /* 이미지의 최대 너비 지정 */
            max-height: 300px; /* 이미지의 최대 너비 지정 */
            opacity: 1;
            margin-right: 10px; /* 이미지와 텍스트 사이의 간격 지정 */
            cursor: pointer; /* 이미지에 커서를 손가락 모양으로 변경 */
        }
        .btn a {
          text-decoration: none; /* 하이퍼링크의 밑줄 제거 */
          color: inherit; /* 기본 텍스트 색상으로 설정 */
        }
        .pagination {
            margin-top: 20px;
            margin-bottom: 20px;

            justify-content: center;
            align-items: center;
        }

        .pagination a {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            border: 1px solid #ccc;
            text-decoration: none;
        }
    </style>
  </head>
  <body>
    <!-- Navigation-->
    <?php include('nav.php'); ?>
    <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
          <h1 class="display-6 fw-bolder">식당 리스트</h1>
        </div>
        <!-- Search form-->
        <form class="mt-4" id="searchForm" action="restaurant_list.php" method="get">
          <div class="input-group">
            <input
                type="text"
                class="form-control"
                placeholder="식당 이름이나 음식을 검색해보세요!"
                aria-label="Search"
                aria-describedby="button-search"
                id="searchInput"
                name="search"
            />
            <button
                class="btn btn-outline-light"
                type="button"
                id="button-search"
                onclick="submitSearchForm()"
            >
                검색
            </button>
          </div>
      </form>

      <script>
        function submitSearchForm() {
            // Get the input value
            var searchInputValue = document.getElementById('searchInput').value;

            // Set the value of the hidden input field in the form
            document.getElementById('hiddenSearchInput').value = searchInputValue;

            // Submit the form
            document.getElementById('searchForm').submit();
        }
      </script>
      </div>
    </header>
    <!-- 이미지 클릭 시 comment.php로 이동하는 스크립트 추가 -->
    <?php
    // 데이터베이스 연결

    // 페이지당 식당 수
    $restaurants_per_page = 5;

    // 현재 페이지 번호 가져오기
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // 시작 위치 계산
    $start = ($current_page - 1) * $restaurants_per_page;

    // 검색어 가져오기
    $search_term = isset($_GET['search']) ? $_GET['search'] : '';

    // 식당 리스트를 가져오는 쿼리 (페이징 및 검색어 추가)
    $query = "SELECT * FROM (SELECT a.*, ROWNUM rnum FROM (SELECT * FROM restaurant";

    // 검색어가 있을 경우 WHERE 절 추가
    if (!empty($search_term)) {
        // 검색어를 소문자로 변환
        $searchKeyword = strtolower($search_term);

        // WHERE 절에 검색어를 적용 (대소문자 구별 없이)
        $query .= " WHERE LOWER(restaurant_name) LIKE '%' || :search_term || '%' OR LOWER(restaurant_category) LIKE '%' || :search_term || '%' OR LOWER(restaurant_menu) LIKE '%' || :search_term || '%'";
    }

    $query .= " ORDER BY restaurant_id) a WHERE ROWNUM <= :end_row) WHERE rnum >= :start_row";

    $stmt = oci_parse($conn, $query);

    $start_row_value = $start + 1;
    $end_row_value = $start + $restaurants_per_page;

    oci_bind_by_name($stmt, ':start_row', $start_row_value);
    oci_bind_by_name($stmt, ':end_row', $end_row_value);

    // 검색어 바인딩
    if (!empty($search_term)) {
        $search_param = '%' . $search_term . '%';
        oci_bind_by_name($stmt, ':search_term', $search_param);
    }

    oci_execute($stmt);
    ?>
    <section class="content-section">
    <?php
    echo '<p></p><h4>식당 정보를 확인하려면 사진을 클릭해주세요!</h4><p></p>';
    // 쿼리 결과 확인
    if ($stmt) {
        
        while ($row = oci_fetch_assoc($stmt)) {
            $rating = $row['RESTAURANT_RATING'];
            $fullStars = floor($rating); // 정수 부분
            $halfStar = ($rating - $fullStars) > 0.3;
            echo '<div class="restaurant">';
            echo '<img src="' . $row['RESTAURANT_PHOTO'] . '" alt="식당 이미지" width="360" height="240">';
            echo '<div class="restaurant-details">';
            echo '<h2>' . $row['RESTAURANT_NAME'] . '</h2>';
            echo '<p>평점: ';

            // Full stars 출력
            for ($i = 0; $i < $fullStars; $i++) {
                echo '<i class="fas fa-star"></i>';
            }

            // Half star 출력
            if ($halfStar) {
                echo '<i class="fas fa-star-half-alt"></i>';
            }

            echo ' ('. $row['RESTAURANT_RATING'] .')</p>';

            echo '<p><a class="btn btn-outline-dark mt-auto" href="https://map.naver.com/p/search/' . urlencode($row['RESTAURANT_LOCATION']) . '" target="_blank">
                <i class="fas fa-map-marker-alt"></i> ' . $row['RESTAURANT_LOCATION'] . '
                </a></p>';

            // 리뷰보기 버튼에 URL 링크 추가
            echo '<p><button class="btn btn-outline-dark mt-auto"><a href="CheckReview.php?restaurant_id=' . $row['RESTAURANT_ID'] . '">Show review</a></button></p>';
            // 예약하기 버튼에 URL 링크 추가
            echo '<p><button class="btn btn-outline-dark mt-auto"><a href="CheckRegist.php?restaurant_id=' . $row['RESTAURANT_ID'] . '">Go Appointment</a></button></p>';
            echo '</div>'; // .restaurant-details 종료
            echo '</div>'; // .restaurant 종료
        }

        // 페이지 번호 출력
        $total_pages_query = "SELECT COUNT(*) as total FROM restaurant";
        $total_pages_stmt = oci_parse($conn, $total_pages_query);
        oci_execute($total_pages_stmt);
        $total_pages_result = oci_fetch_assoc($total_pages_stmt);
        $total_pages = $total_pages_result['TOTAL'];
        $total_pages = ceil($total_pages / $restaurants_per_page);

        echo '<div class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<a class="btn btn-outline-dark mt-auto" href="?page=' . $i . '&search=' . $search_term . '">' . $i . '</a>';
        }
        echo '</div>';
        ?>
        </section>
        <?php

    } else {
        echo '식당 리스트를 가져오는 중 오류가 발생했습니다.';
    }

    // 데이터베이스 연결 종료
    oci_free_statement($stmt);
    oci_close($conn);
    ?>

<!-- 추가적인 HTML, CSS 등의 내용은 여기에 추가하세요. -->
<script>
        // 이미지 클릭 시 이동하는 함수
        function goToInformation(restaurantId) {
            // restaurant_info.php로 이동
            window.location.href = 'restaurant_info.php?restaurant_id=' + restaurantId;
        }

        // 이벤트 핸들러를 등록하여 이미지 클릭 시 함수 호출
        document.addEventListener('DOMContentLoaded', function () {
            // 각 이미지 요소에 대해 이벤트 핸들러 등록
            var restaurantImages = document.querySelectorAll('.restaurant img');
            restaurantImages.forEach(function (img) {
                img.addEventListener('click', function () {
                    // 이미지의 부모 요소에서 식당 ID 가져오기
                    var restaurantId = this.parentElement.querySelector('.restaurant-details button a').href.split('=')[1];
                    // 함수 호출
                    goToInformation(restaurantId);
                });
            });
        });
</script>
<?php include('footer.php'); ?>
</body>
</html>