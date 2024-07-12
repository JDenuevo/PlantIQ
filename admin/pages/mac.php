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

  <title>Plant.IQ | Mac Address</title>

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
            <h5 class="card-title fw-semibold mb-4">Mac Address</h5>
            <div class="flex-grow-1"></div>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-mac">
              <i class="fa-solid fa-plus fs"></i>
              Add Mac Address/es
            </button>
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
                    <h6 class="fw-semibold mb-0 text-center">Mac Address</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 text-center">Action</h6>
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
            $sql = "SELECT * FROM plantiq_availablemacaddresses LIMIT $limit OFFSET $offset";
            if ($rs = $conn->query($sql)) {
                $i = $offset + 1;
                while ($row = $rs->fetch_assoc()) {
                    ?>
                    <tr class="text-center">
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-0"><?php echo $i++; ?></h6>
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-0"><?php echo $row['macaddress']; ?></h6>
                        </td>
                        <td class="border-bottom-0">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#update-modal<?php echo $row['id']; ?>">Edit</button>
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
    $sql = "SELECT COUNT(*) AS total FROM plantiq_availablemacaddresses";
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
<?php
  $sql = "SELECT * FROM plantiq_availablemacaddresses";
  if($rs=$conn->query($sql)){
      while ($row=$rs->fetch_assoc()) {
  ?>
<!-- Modal -->
<div class="modal fade" id="update-modal<?php echo $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update-modal-label">Update MAC Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../php/update_mac.php" method="post">
        <div class="form-floating mb-3">
          <input type="hidden" class="form-control" id="floatingInput" name="id" value="<?php echo $row['id']; ?>">
          <input type="text" class="form-control" id="floatingInput" name="mac_address" value="<?php echo $row['macaddress']; ?>">
          <label for="floatingInput">MAC Address</label>
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
<?php
    }
    }
  ?>
  
<!-- Modal -->
<div class="modal fade" id="add-mac" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update-modal-label">Add MAC Address/es</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../php/add_mac.php" method="post">
        <div class="form-floating mb-3">
          <input type="textarea" class="form-control" id="floatingInput" name="mac_addresses" placeholder="Enter 1 or more MAC, separate using space" required>
          <label for="floatingInput">MAC Address</label>
          <p class="small text-muted">Use space to separate for multiple MAC Addresses</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
  function validateForm() {
    var macAddressesInput = document.forms[0]["mac_addresses"].value.trim();

    // Check if there is at least one MAC address and they are separated by space
    if (macAddressesInput === "" || macAddressesInput.indexOf(" ") === -1) {
      alert("Please enter at least one MAC address and separate multiple addresses using space.");
      return false;
    }

    return true;
  }
</script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.js"></s cript>
  <script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../../assets/js/dashboard.js"></script>
  <script src="../../assets/js/sidebarmenu.js"></script>
  <script src="../../assets/js/app.min.js"></script>

</body>

</html>