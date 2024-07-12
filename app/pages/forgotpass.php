<?php
session_start();
include '../php/userconfig.php';

// if (isset($_SESSION['status'])) {
//     if($_SESSION['status'] == "Logged In"){
//         header("Location:home.php");
//         exit();
//     }
// }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plant.IQ | Change Password</title>
  <link rel="icon" href="../assets/img/icon.png">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Open+Sans:wght@300;400;500;600;700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">  <link rel="stylesheet" href="css\node_modules\bootstrap\dist\css\bootstrap.min.css">
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Main Template -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<!-- CoverPhoto -->
<?php include '../pages/components/cover.php'; ?>


<br><br><br>
<div class="container">
    <div class="justify-content-center d-flex" style="margin-top: 50px; margin-bottom: 50px;">
        <h2>Forgot Password</h2>
    </div>
    
    <form action="../php/email_check.php" method="post" class="requires-validation" novalidate>
        <div class="form-floating">
            <input type="email" name="email" class="form-control form-control-lg" id="validationServer01" placeholder="juandelacruz@gmail.com" style="border-radius: 10px;" fdprocessedid="s1ri14" required>
            <label for="validationServer01" class="form-label" style="color: gray;">Email</label>
            <div class="invalid-feedback">
                Please enter valid email.
            </div>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        
        <div class="mx-auto text-center  mt-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
              <li class="breadcrumb-item"><a class="text-success fw-semibold" href="forgotpass.php">Email</a></li>
              <li class="breadcrumb-item"><a class="text-secondary">Enter OTP</a></li>
              <li class="breadcrumb-item"><a class="text-secondary">New Password</a></li>
            </ol>
          </nav>
          <button type="submit" class="btn btn-primary btn-lg m-5 rounded-pill fw-bold" style="box-shadow: -4px 4px #3FAA3D;">Send OTP</button>
        </div>
    </form>
      <?php
          // Display error messages if they were passed in the URL
          if (isset($_GET['errors'])) {
              $errors = explode(',', $_GET['errors']);
              foreach ($errors as $error) {
                  echo "<script>Swal.fire({
                          icon: 'error',
                          title: 'ERROR',
                          text: '$error'
                      });</script>";

          }
          unset($_GET['errors']);
          }
      ?>
        <div class="text-center ">
                <label style="color: grey">You remember your account?</label>  <a href="../index.php" style="color: green">Login</a>
            </div>
        </div>  
</div>

<script>
    if (window.performance) {
      if (performance.navigation.type == 1) {
        // Reloaded the page using the browser's reload button
        window.location.href = "forgotpass.php";
      }
    }
</script>

<script>
(function () {
  'use strict';
  const forms = document.querySelectorAll('.requires-validation');
  Array.from(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }

      form.classList.add('was-validated');
    }, false);
  });
})();

</script>

  <!-- JavaScript -->
  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/all.min.js"></script>

</body>
</html>
