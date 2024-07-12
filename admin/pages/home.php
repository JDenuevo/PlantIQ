<?php
session_start();

if(!$_SESSION['email']=="plantiq.it.ucc@gmail.com"){
     header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Plant.IQ | Home</title>

  <?php include 'components/icon.php'; ?>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Main Template -->
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">

</head>

<body>

  <?php include '../pages/components/navigation.php'; ?>

  <!--  Main wrapper -->
  <div class="body-wrapper">

    <?php include '../pages/components/header.php'; ?>

    <div class="container-fluid">          
        <hr>
          
          <div class="row">
              <div class="col-sm-4">
                <div class="card border-primary text-center">
                  <div class="card-body text-center">
                    <h5 class="card-title fw-semibold">Number of Mac Adresses Registered</h5>
                    <p class="card-text fw-bold fs-1"><?php $numberofmac = "SELECT COUNT(macaddress) AS total FROM plantiq_availablemacaddresses";
                                                             $result = $conn->query($numberofmac);
                                                             $data = $result->fetch_assoc();
                                                             echo $total_records = isset($data['total']) ? $data['total'] : 0;?></p>
                    <a href="mac.php" class="btn btn-primary">Click to Shortcut</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card border-primary text-center">
                  <div class="card-body text-center">
                    <h5 class="card-title">Number of Accounts Registered</h5>
                    <p class="card-text fw-bold fs-1"><?php $numberofaccounts = "SELECT COUNT(email) AS total FROM plantiq_login";
                                                             $result = $conn->query($numberofaccounts);
                                                             $data = $result->fetch_assoc();
                                                             echo $total_records = isset($data['total']) ? $data['total'] : 0;?></p>
                    <a href="accounts.php" class="btn btn-primary">Click to Shortcut</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card border-primary text-center">
                  <div class="card-body text-center">
                    <h5 class="card-title">Number of Recent Feedbacks</h5>
                    <p class="card-text fw-bold fs-1"><?php $numberoffbacks = "SELECT COUNT(id) AS total FROM plantiq_feedback";
                                                             $result = $conn->query($numberoffbacks);
                                                             $data = $result->fetch_assoc();
                                                             echo $total_records = isset($data['total']) ? $data['total'] : 0;?></p>
                    <a href="feedbacks.php" class="btn btn-primary">Click to Shortcut</a>
                  </div>
                </div>
              </div>
          </div>
        
    </div>



  </div>
</div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.js"></script>
  <script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../../assets/js/dashboard.js"></script>
  <script src="../../assets/js/sidebarmenu.js"></script>
  <script src="../../assets/js/app.min.js"></script>

</body>

</html>