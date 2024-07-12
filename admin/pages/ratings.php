<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Plant.IQ | Accounts</title>

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
            <h5 class="card-title fw-semibold mb-4">Ratings</h5>
            <div class="flex-grow-1"></div>
          </div>
          <hr>
          <div class="table-responsive">
            <table class="table text-nowrap mb-0 text-center">
              <thead class="text-dark fs-4">
                <tr>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 text-center">ID</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 text-center">User Ratings</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr class="text-center">
                  <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">1</h6>
                  </td>
                  <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">5 Star</h6>
                  </td>
                </tr>     
              </tbody>
            </table>
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