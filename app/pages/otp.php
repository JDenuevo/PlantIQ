<?php
session_start();
include '../php/userconfig.php';

if (isset($_SESSION['otp'])) {
   $otp = $_SESSION['otp'];
}
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}


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
  <title>Plant.IQ | Change Username</title>
  <link rel="icon" href="../assets/img/icon.png">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Open+Sans:wght@300;400;500;600;700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">  <link rel="stylesheet" href="css\node_modules\bootstrap\dist\css\bootstrap.min.css">
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="../assets/css/swiper-bundle.min.css">

  <!-- Main Template -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">

</head>
<style>
    .message1 {
        display: none;
        color: red;
    }
    .message2 {
        display: none;
        color: green;
    }
</style>
<body>

<!-- CoverPhoto -->
<?php include '../pages/components/cover.php'; ?>

<br><br><br>
<div class="container">
    <div class="justify-content-center d-flex" style="margin-top: 50px; margin-bottom: 50px;">
        <h1>Forgot Password</h1>
    </div>

    <form method="post" action="../php/otp.php" class="requires-validation" novalidate>
        <div class="mx-auto text-center">
            <div  class="form-floating">
            <input type="hidden" name="correct_otp" value="<?php echo $otp; ?>">
                <input type="number" id="code" class="form-control form-control-lg" name="otp" id="validationServer01" placeholder="Enter OTP" style="border-radius: 10px;" fdprocessedid="s1ri14" required>
                <label for="validationServer01" class="form-label text-secondary">Enter OTP</label>
                <div class="message1" id="wrongMessage">Wrong code, please try again.</div>
                <div class="message2" id="correctMessage">Correct code! Access granted.</div>
            </div>
            <div class="mx-auto text-center">
                <nav aria-label="breadcrumb mt-2">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-secondary">Email</a></li>
                        <li class="breadcrumb-item"><a class="text-success fw-semibold" href="otp.php">Enter OTP</a></li>
                        <li class="breadcrumb-item"><a class="text-secondary">New Password</a></li>
                    </ol>
                </nav>
                <div class="justify-content-center d-flex">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold m-5 rounded-pill" onclick="checkCode()" style="box-shadow: -4px 4px #3FAA3D;">Submit</button>
                </div>
            </div>          
        </div>
    </form>

    <div class="text-center" style="margin-top: 100px;">
        <label style="color: grey">You remember your account?</label>  <a href="../index.php" style="color: green">Login</a>
    </div>
</div>
            
<script>
    if (window.performance) {
      if (performance.navigation.type == 1) {
        // Reloaded the page using the browser's reload button
        window.location.href = "otp.php";
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


<script>
    function checkCode() {
        var codeInput = document.getElementById('code').value;
        var wrongMessage = document.getElementById('wrongMessage');
        var correctMessage = document.getElementById('correctMessage');

        if (codeInput === '<?php echo $otp;?>') {
            wrongMessage.style.display = 'none';
            correctMessage.style.display = 'block';
            document.getElementById('code').setCustomValidity('');

        } else {
            wrongMessage.style.display = 'block';
            correctMessage.style.display = 'none';
            document.getElementById('code').setCustomValidity('Invalid code');
        }
    }
</script>



  <!-- JavaScript -->
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/all.min.js"></script>

</body>
</html>
