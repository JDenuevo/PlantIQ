  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <aside class="left-sidebar">
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./home.php" class="text-nowrap logo-img">
            <?php include 'logo_display.php'; ?>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="fa-solid fa-xmark fa-xl"></i>
          </div>
        </div>

        <nav class="sidebar-nav flex-column" data-simplebar="">
          <ul id="sidebarnav" class="nav nav-pills flex-column mb-auto">
            <li class="nav-item nav-small-cap">
              <span class="fw-bold">General</span>
            </li>
            <li class="nav-item sidebar-item mx-3">
              <a class="nav-link sidebar-link" href="./home.php" aria-expanded="false">
                  <i class="fa-solid fa-house"></i>
                <span class="fw-bold">Home</span>
              </a>
            </li>
            <li class="nav-item sidebar-item mx-3">
              <a class="nav-link sidebar-link" href="./mac.php" aria-expanded="false">
                  <i class="fa-solid fa-qrcode"></i>
                <span class="fw-bold">Mac Addresses</span>
              </a>
            </li>
            <li class="nav-item sidebar-item mx-3">
              <a class="nav-link sidebar-link" href="./plants.php" aria-expanded="false">
                <i class="fa-solid fa-seedling"></i>
                <span class="fw-bold">Plant Recommendations</span>
              </a>
            </li>
            <li class="nav-item nav-small-cap">
              <span class="fw-bold">Manage</span>
            </li>
            <!--<li class="nav-item sidebar-item mx-3">-->
            <!--  <a class="nav-link sidebar-link" href="./admin.php" aria-expanded="false">-->
            <!--    <i class="fa-solid fa-user-tie"></i>-->
            <!--    <span class="fw-bold">Admin</span>-->
            <!--  </a>-->
            <!--</li>-->
            <li class="nav-item sidebar-item mx-3">
              <a class="nav-link sidebar-link" href="./accounts.php" aria-expanded="false">
                <i class="fa-solid fa-user"></i>
                <span class="fw-bold">Accounts Registered</span>
              </a>
            </li>
            <li class="nav-item sidebar-item mx-3">
              <a class="nav-link sidebar-link" href="./feedbacks.php" aria-expanded="false">
                <i class="fa-solid fa-comment"></i>
                <span class="fw-bold">Feedbacks</span>
              </a>
            </li>
            <!--<li class="nav-item sidebar-item mx-3">-->
            <!--  <a class="nav-link sidebar-link" href="./ratings.php" aria-expanded="false">-->
            <!--    <i class="fa-solid fa-ranking-star"></i>-->
            <!--    <span class="fw-bold">Ratings</span>-->
            <!--  </a>-->
            <!--</li>-->
          </ul>
        </nav>
      </div>
    </aside>