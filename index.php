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
    <title>Gatti</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
  </head>
  <body>
    <!-- Navigation-->
    <?php include('nav.php'); ?>
    <!-- Header-->
    <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
          <h1 class="display-4 fw-bolder">Let's Gatti!</h1>
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
    <!-- Section-->
    <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div
          class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
        >
          <div class="col mb-5">
            <div class="card h-100">
              <!-- book badge-->
              <div class="position-relative">
                <div
                  class="badge bg-dark text-white position-absolute"
                  style="top: 0.5rem; right: 0.5rem"
                >
                AD
                </div>
              </div>
              <!-- Product image-->
              <img
                class="card-img-top"
                src="upload/gugbab.jpg"
                alt="..."
              />
              <!-- Product details-->
              <div class="card-body p-4">
                <div class="text-center">
                  <!-- Product name-->
                  <h5 class="fw-bolder">Aunt's Rice and Fork Soup</h5>
                  <!-- Product reviews-->
                  <div
                    class="d-flex justify-content-center small text-warning mb-2"
                  >
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                  </div>
                  <!-- Product price-->
                  7000 ₩ - 32000 ₩
                </div>
              </div>
              <!-- Product actions-->
              <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                  <a class="btn btn-outline-dark mt-auto" href="restaurant_list.php">Show</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col mb-5">
            <div class="card h-100">
              <!-- book badge-->
              <div class="position-relative">
                <div
                  class="badge bg-dark text-white position-absolute"
                  style="top: 0.5rem; right: 0.5rem"
                >
                3/4 reservations
                </div>
              </div>

              <!-- Product image-->
              <img
                class="card-img-top"
                src="upload/budae.jpg"
                alt="..."
              />
              <!-- Product details-->
              <div class="card-body p-4">
                <div class="text-center">
                  <!-- Product name-->
                  <h5 class="fw-bolder">Budaejjigae</h5>
                  <h6 class="fw-lighter">Bu President</h6>
                  <!-- Product reviews-->
                  <div
                    class="d-flex justify-content-center small text-warning mb-2"
                  >
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-half"></div>
                  </div>
                  <!-- Product price-->
                  <span class="text-muted text-decoration-line-through"
                    >20000 ₩</span>
                  5000 ₩
                </div>
              </div>
              <!-- Product actions-->
              <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                  <a class="btn btn-outline-dark mt-auto" href="CheckRegist.php">Eat Together</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col mb-5">
            <div class="card h-100">
              <!-- book badge-->
              <div class="position-relative">
                <div
                  class="badge bg-dark text-white position-absolute"
                  style="top: 0.5rem; right: 0.5rem"
                >
               1/2 reservations
                </div>
              </div>
              <!-- Product image-->
              <img
                class="card-img-top"
                src="upload/momstouch.png"
                alt="..."
              />
              <!-- Product details-->
              <div class="card-body p-4">
                <div class="text-center">
                  <!-- Product name-->
                  <h5 class="fw-bolder">HalfChickenCombo</h5>
                  <h6 class="fw-lighter">Mom's Touch</h6>
                  <!-- Product reviews-->
                  <div
                    class="d-flex justify-content-center small text-warning mb-2"
                  >
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                  </div>
                  <!-- Product price-->
                  
                  <span class="text-muted text-decoration-line-through"
                  >13800 ₩</span>
                6900 ₩
                </div>
              </div>
              <!-- Product actions-->
              <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                  <a class="btn btn-outline-dark mt-auto" href="CheckRegist.php">Eat Together</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col mb-5">
            <div class="card h-100">
              <!-- book badge-->
              <div class="position-relative"> 
                <div
                  class="badge bg-dark text-white position-absolute"
                  style="top: 0.5rem; right: 0.5rem"
                >
                2/4 reservations
                </div>
              </div>
              <!-- Product image-->
              <img
                class="card-img-top"
                src="upload/schoolmeal.jpg"
                alt="..."
              />
              <!-- Product details-->
              <div class="card-body p-4">
                <div class="text-center">
                  <!-- Product name-->
                  <h5 class="fw-bolder">School meal</h5>
                  <h6 class="fw-lighter">Building B</h6>
                  <!-- Product reviews-->
                  <div
                    class="d-flex justify-content-center small text-warning mb-2"
                  >
                    <div class="bi-star-fill"></div>
                    <div class="bi-star"></div>
                    <div class="bi-star"></div>
                    <div class="bi-star"></div>
                    <div class="bi-star"></div>
                  </div>
                  <!-- Product price-->
                  5500 ₩
                </div>
              </div>
              <!-- Product actions-->
              <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                  <a class="btn btn-outline-dark mt-auto" href="CheckRegist.php">Eat Together</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Footer-->
    <?php include('footer.php'); ?>
  </body>
</html>
