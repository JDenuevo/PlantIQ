<?php 
include 'php-header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plant.IQ | Settings </title>

  <link rel="icon" href="../assets/img/icon.png">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Open+Sans:wght@300;400;500;600;700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">  <link rel="stylesheet" href="css\node_modules\bootstrap\dist\css\bootstrap.min.css">
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  
  <!-- Main Template -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">

</head>
<style scoped>
    #passwordMatch {
      font-weight: bold;
    }

    .match {
      color: green;
    }

    .no-match {
      color: red;
    }
</style>
<body>

  <!-- CoverPhoto -->
  <?php include '../pages/components/cover.php'; ?>

  <!-- TOP NAVBAR -->
  <?php include '../pages/components/navbar.php'; ?>

    <div class="container d-flex flex-column">
        <h3 class="fw-bold mt-3">Settings</h3>
        
        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal3" class="btn btn-light text-decoration-none text-dark mb-3">
          <div class="d-flex flex-row px-3 align-items-center my-2">
            <i class="fa-solid fa-user-pen fa-xl"></i> 
            <label class="fs-6 mx-2 fw-semibold">Change Fullname</label>
            <div class="flex-grow-1"></div>
            <i class="fa-solid fa-chevron-right fa-xl"></i>
          </div>
          
        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1" class="btn btn-light text-decoration-none text-dark mb-3">
          <div class="d-flex flex-row px-3 align-items-center my-2">
            <i class="fa-solid fa-user-pen fa-xl"></i> 
            <label class="fs-6 mx-2 fw-semibold">Change Username</label>
            <div class="flex-grow-1"></div>
            <i class="fa-solid fa-chevron-right fa-xl"></i>
          </div>
        </a>
        
        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-light text-decoration-none text-dark mb-3">
          <div class="d-flex flex-row px-3 align-items-center my-2">
            <i class="fa-solid fa-user-shield fa-xl"></i> 
            <label class="fs-6 mx-2 fw-semibold">Change Password</label>
            <div class="flex-grow-1"></div>
            <i class="fa-solid fa-chevron-right fa-xl"></i>
          </div>
        </a
        
    </div>
    
    
  </div>
</div>

  <!-- BOTTOM NAVBAR -->

  <?php include '../pages/components/navbar-bottom.php'; ?>
  
  
<!-- Modal for Change Username -->
<?php
  $sql = "SELECT username FROM plantiq_login WHERE email = '$email'";
  $results = mysqli_query($conn, $sql);

  if ($results) {
    $row = mysqli_fetch_assoc($results);
  }
  ?>
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Username</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="../php/profile_change.php" method="post" class="requires-validation" novalidate>
            <div class="form-floating my-4 text-start" style="position: relative;">
              <input type="hidden" name="email" value="<?php echo $email; ?>">
              <input type="text" class="form-control form-control-lg rounded-4" id="newUser" name="newUser" value="<?php echo $row['username']; ?>" required>
              <label for="newUser">Username<label>
              <div class="valid-feedback">
                Looks good!
              </div>
              <span class="text-danger" id="validationMessage"></span>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="changeUsername" class="btn btn-primary">Change Username</button>
      </div>
      </form>
    </div>
  </div>
</div>


<?php
  $sql = "SELECT fullname FROM plantiq_login WHERE email = '$email'";
  $results = mysqli_query($conn, $sql);

  if ($results) {
    $row = mysqli_fetch_assoc($results);
  }
  ?>
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Fullname</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="../php/profile_change.php" method="post" class="requires-validation" novalidate>
            <div class="form-floating my-4 text-start" style="position: relative;">
              <input type="hidden" name="email" value="<?php echo $email; ?>">
              <input type="text" class="form-control form-control-lg rounded-4" id="newName" name="newName" value="<?php echo $row['fullname']; ?>" required>
              <label for="newName">Fullname<label>
              <div class="valid-feedback">
                Looks good!
              </div>
              <span class="text-danger" id="validationMessage"></span>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="changeFullname" class="btn btn-primary">Change Fullname</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    if (window.performance) {
      if (performance.navigation.type == 1) {
        // Reloaded the page using the browser's reload button
        window.location.href = "settings.php";
      }
    }
</script>

<!-- Script for Change User -->
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

const newUser = document.getElementById("newUser");
const validationMessage = document.getElementById("validationMessage");

function validateInput() {
    const inputValue = newUser.value;

    // Regular expression to allow only alphanumeric characters and spaces
    const regex = /^[a-zA-Z0-9\s]+$/;

    if (!regex.test(inputValue)) {
        validationMessage.textContent = "Special characters are not allowed.";
    } else {
        validationMessage.textContent = "";
    }
}

newUser.addEventListener("input", validateInput);
</script>

<!-- Modal for Change Password -->

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../php/profile_change.php" method="post" onsubmit="return validateForm()" class="requires-validation" novalidate>
         <div class="form-floating my-4" style="position: relative;">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="password" class="form-control form-control-lg rounded-4" name="newPassword" id="newPassword" placeholder="New Password" fdprocessedid="s1ri14" minlength="6" required>
            <label for="newPassword">Enter Password</label>
        <div class="invalid-feedback">
            Please provide at least 6 characters.
        </div>
            <span class="toggle-password mt-1" id="newPassword"></span>
        </div>
        <div class="form-floating mb-2 text-start" style="position: relative;">
            <input type="password" class="form-control form-control-lg rounded-4" id="confirmPassword" placeholder="Confirm Password" fdprocessedid="s1ri14" minlength="6" required>
            <label for="confirmPassword">Confirm Password</label>
        <div>
          <span id="passwordMatch"></span>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="changePassword" class="btn btn-primary">Change Password</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Script for Change Password -->
<script>
const newPasswordInput = document.getElementById("newPassword");
const confirmPasswordInput = document.getElementById("confirmPassword");
const passwordMatchLabel = document.getElementById("passwordMatch");
const submitButton = document.getElementById("submitPasswordButton");

function validatePassword() {
  const newPassword = newPasswordInput.value;
  const confirmPassword = confirmPasswordInput.value;

  // Check if the password has at least 6 characters
  const isValidLength = newPassword.length >= 6;

  if (isValidLength) {
    if (newPassword !== confirmPassword) {
      passwordMatchLabel.classList.remove("match");
      passwordMatchLabel.classList.add("no-match");
      passwordMatchLabel.textContent = "Passwords do not match";
    } else {
      passwordMatchLabel.classList.remove("no-match");
      passwordMatchLabel.classList.add("match");
      passwordMatchLabel.textContent = "Passwords match";
    }
  } else {
    passwordMatchLabel.textContent = "Password must be at least 6 characters.";
  }

  // Disable or enable the submit button based on the validation
  submitButton.disabled = !isValidLength || (newPassword !== confirmPassword);
}

newPasswordInput.addEventListener("input", validatePassword);
confirmPasswordInput.addEventListener("input", validatePassword);
</script>

<script>
function validateForm() {
  const newPassword = document.getElementById('newPassword').value;
  const confirmPassword = document.getElementById('confirmPassword').value;

  if (newPassword !== confirmPassword) {
    const passwordMatchElement = document.getElementById('passwordMatch');
    passwordMatchElement.textContent = 'Passwords do not match';
    return false;
  } else {
    return newPassword.length >= 6; // Only allow submission if the password has at least 6 characters
  }
}
</script>

  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/jquery-3.7.1.min.js"></script>
  <script src="../assets/js/navbarmenu.js"></script>
  
</body>
</html>