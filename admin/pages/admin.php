<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Plant.IQ | Admin Accounts</title>

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
            <h5 class="card-title fw-semibold mb-4">List of Admin/s</h5>
            <div class="flex-grow-1"></div>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-admin">
            <i class="fa-solid fa-plus"></i>
              Add Admin Account
            </button>
          </div>
          <hr>
          <div class="table-responsive">
            <table class="table text-nowrap mb-0 text-center">
              <thead class="text-dark fs-4">
                <tr class="text-center">
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">ID</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Admin Name</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Action</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr class="text-center">
                  <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">1</h6>
                  </td>
                  <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Eshophagus Esophagus</h6>
                  </td>
                  <td class="border-bottom-0">
                    <button type="button" class="btn btn-secondary">Update</button>
                    <button type="button" class="btn btn-danger">Delete</button>
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

<!-- Modal -->
<div class="modal fade" id="add-admin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row p-2">
          <div class="col-6">
            <label>Admin Name</label>
            <input type="text" class="form-control rounded" placeholder="Set a Admin Name" name="" required>
          </div>
          <div class="col-6">
            <label>Plant Name</label>
            <input type="text" class="form-control rounded" placeholder="Set a Password Name" name="" required>
          </div>
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Add new Admin</button>
      </div>
    </div>
  </div>
</div>