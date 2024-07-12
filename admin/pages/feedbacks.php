<?php
session_start();

include("../php/userconfig.php");

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

  <title>Plant.IQ | Feedbacks</title>

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
      <div class="card w-100">
        <div class="card-body p-4">
          <div class="d-flex">
            <h5 class="card-title fw-semibold mb-4">Feedbacks</h5>
            <div class="flex-grow-1"></div>
          </div>
          <hr>
          <div class="table-responsive">
            <table class="table text-nowrap mb-0 text-center">
              <thead class="text-dark fs-4">
                <tr>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 text-center"></h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 text-center">Name</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 text-center">Email</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 text-center">Subject</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 text-center">Message</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                   <?php
                    // Pagination variables
                    $limit = 10;
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;
                    
                    // Query to fetch data with pagination
                    $sql = "SELECT * FROM plantiq_feedback LIMIT $limit OFFSET $offset";
                    if ($rs = $conn->query($sql)) {
                        $i = $offset + 1;
                        while ($row = $rs->fetch_assoc()) {
                            ?>
                            <tr class="text-center">
                              <td class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0"><?php echo $i++; ?></h6>
                              </td>
                              <td class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0"><?php echo $row['name']; ?></h6>
                              </td>
                              <td class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0"><?php echo $row['email']; ?></h6>
                              </td>
                              <td class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0"><?php echo $row['subject']; ?></h6>
                              </td>
                              <td class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0" style="white-space: pre-line;"><?php echo $row['message']; ?></h6>
                              </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
              </tbody>
            </table>
            <?php
            // Pagination links
            $sql = "SELECT COUNT(*) AS total FROM plantiq_feedback";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            $total_records = $data['total'];
            $total_pages = ceil($total_records / $limit);
        
            echo "<ul class='pagination justify-content-center'>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
            }
            echo "</ul>";
            ?>
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