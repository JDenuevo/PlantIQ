<!--  Header Start -->

<header class="app-header">
  <nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
          <i class="fa-solid fa-bars"></i>
        </a>
      </li>
    </ul>
    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
        <div class="dropdown me-3">
          <!--<a class="btn position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">-->
          <!--  <i class="fa-regular fa-bell navbtn"></i>-->
          <!--  <span class="position-absolute top-0 start-100 translate-middle badge bg-primary rounded-circle">5</span>-->
          <!--</a>-->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up">
            <div class="container" style="width: 25rem;">
              <div class="card-body d-flex justify-content-between">
                <div class="">
                  <img src="../../assets/img/notificon.png" class="img-fluid" style="max-width: 50px;" alt="">
                  <label class="fw-bold">Plants Need Water!</label>
                </div>
                <div class="">
                  <label class="fw-light">Now!</label>
                </div>
              </div>
              <div class="mt-2">
                <label class="fw-bold">Plants Need Watering Immediately check your plants</label>
              </div>
            </div>
          </ul>
        </div>
        <div class="btn-group">
          <a class="nav-link nav-icon-hover cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../../assets/img/admin.png" alt="" width="35" height="35" class="rounded-circle">
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up">
            <li>
              <button class="d-flex align-items-center gap-2 dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#update-modal">
               <i class="fa-regular fa-envelope"></i>
                <p class="mb-0">My Account</p>
              </button>
            </li>
            <!--<li>-->
            <!--  <button class="d-flex align-items-center gap-2 dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#update-system">-->
            <!--    <i class="fa-solid fa-gear"></i>-->
            <!--    <p class="mb-0">System Modification</p>-->
            <!--  </button>-->
            <!--</li>-->
            <li>
              <a href="logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block"><i class="ti ti-logout"></i> Logout</a>
            </li>
          </ul>
        </div>
      </ul>
    </div>
  </nav>
</header>
<!--  Header End -->
<div class="modal fade" id="update-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update-modal-label">Update My Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../../php/update_profile.php" method="post">
        <div class="form-floating mb-3">
            <?php
            include("../php/userconfig.php");
            $sql = "SELECT id, username from plantiq_login WHERE email = 'plantiq.it.ucc2023@gmail.com'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
          <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Username" value="<?php echo $row['username']; ?>">
          <input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" value="">
          <label for="floatingPassword">Password</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="update-system" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update-modal-label">Update System</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <div class="d-flex justify-content-center align-items-center">
            <div class="">
              <img src="../../assets/img/title.png" alt="" class="img-fluid w-50">
            </div>
          </div>
          <label class="form-label mt-2">Choose a file to change system logo.</label>
          <div class="d-flex justify-content-center align-items-center">
            <div class="file">
              <input class="form-control form-control-sm" id="" type="file">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Close</button>
        <button type="button" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Update</button>
      </div>
    </div>
  </div>
</div>