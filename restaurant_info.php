<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>식당 정보</title>
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
    <link href="css/styles.css" rel="stylesheet" />
    <!-- 필요한 CSS 스타일링을 여기에 추가하세요. -->
    <style>
        /* 예시 스타일링 */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1, p {
            margin: 0;
            padding: 0;
        }

        .restaurant-details {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 20px;
            overflow: hidden;
        }

        img {
            float: left;
            max-width: 500px; /* 이미지의 최대 너비 지정 */
            margin-right: 10px; /* 이미지와 텍스트 사이의 간격 지정 */
            cursor: pointer; /* 이미지에 커서를 손가락 모양으로 변경 */
        }
    </style>
</head>
<body>

<?php
// 데이터베이스 연결
include ('UserDB.php');

// 식당 ID 가져오기
$restaurant_id = isset($_GET['restaurant_id']) ? (int)$_GET['restaurant_id'] : 0;

// 식당 정보를 가져오는 쿼리
$query = "SELECT * FROM restaurant WHERE restaurant_id = :restaurant_id";
$stmt = oci_parse($conn, $query);
oci_bind_by_name($stmt, ':restaurant_id', $restaurant_id);
oci_execute($stmt);

// 쿼리 결과 확인
if ($row = oci_fetch_assoc($stmt)) {
    $rating = $row['RESTAURANT_RATING'];
    $fullStars = floor($rating); // 정수 부분
    $halfStar = ($rating - $fullStars) > 0.3;
    echo '<div class="restaurant-details">';
    echo '<h1>' . $row['RESTAURANT_NAME'] . '</h1>';
    echo '<img src="' . $row['RESTAURANT_PHOTO'] . '" alt="식당 이미지">';
    echo '<h3>대표 메뉴: ' . $row['RESTAURANT_MENU'] . '</h3>';
    echo '<h3>카테고리: ' . $row['RESTAURANT_CATEGORY'] . '</h3>';
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

    echo '<a class="btn btn-outline-dark mt-auto" href="restaurant_list.php">돌아가기</a>';
    echo '</div>'; // .restaurant-details 종료
} else {
    echo '해당 식당의 정보를 가져오는 중 오류가 발생했습니다.';
}

// 데이터베이스 연결 종료
oci_free_statement($stmt);
oci_close($conn);
?>
