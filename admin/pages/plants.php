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

  <title>Plant.IQ | Plant Recommendations</title>

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

<style>
    .custom-textarea {
        min-height: 50px; /* Set a minimum height */
        overflow: hidden; /* Hide the scrollbar */
    }
</style>

<body>

  <?php include '../pages/components/navigation.php'; ?>

  <!--  Main wrapper -->
  <div class="body-wrapper">

    <?php include '../pages/components/header.php'; ?>

    <div class="container-fluid">
      <div class="card w-100">
        <div class="card-body p-4">
          <div class="d-flex">
            <h5 class="card-title fw-semibold mb-4">Plant Recommendations</h5>
            <div class="flex-grow-1"></div>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-plants">
            <i class="fa-solid fa-plus"></i>
              Add Plants
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
                    <h6 class="fw-semibold mb-0 text-center">Plant Image</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 text-center">Plant Name</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 text-center">Plant Description</h6>
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
                    $sql = "SELECT * FROM plantiq_recommended LIMIT $limit OFFSET $offset";
                    if ($rs = $conn->query($sql)) {
                        $i = $offset + 1;
                        while ($row = $rs->fetch_assoc()) {
                            ?>
                            <tr class="text-center">
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0"><?php echo $i++; ?></h6>
                               <td class="border-bottom-0">
                                 <img class="img-fluid rounded-4" src="https://app.plantiq.info/<?php echo $row['plant_img']; ?>" style="width: 100px; height: 80px;" alt="<?php echo $row['plant_name']; ?>">
                              </td>
                              <td class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0"><?php echo $row['plant_name']; ?></h6>
                              </td>
                              <td class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0" style="white-space: pre-line;"><?php echo $row['plant_description']; ?></h6>
                              </td>
                             <td class="border-bottom-0">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#update-modal<?php echo $row['plant_id']; ?>">Edit</button>
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
            $sql = "SELECT COUNT(*) AS total FROM plantiq_recommended";
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
$sql = "SELECT * FROM plantiq_recommended";
if ($rs = $conn->query($sql)) {
    while ($row = $rs->fetch_assoc()) {
?>
        <!-- Modal -->
        <div class="modal fade" id="update-modal<?php echo $row['plant_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered">
                <form action="../php/edit_plant.php" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="d-flex justify-content-evenly p-2">
                                <div class="w-50 text-center">
                                    <p class="text-muted">Update plant's picture</p>
                                    <img class="img-fluid rounded-4" id="selectedImage<?php echo $row['plant_id']; ?>" src="https://app.plantiq.info/<?php echo $row['plant_img']; ?>" style="width: 60%; height: 100px;" alt="<?php echo $row['plant_name']; ?>">
                                    <input class="my-3" type="file" name="plant_img" accept=".jpg, .jpeg, .png" onchange="uploadImage('<?php echo $row['plant_id']; ?>')">
                                </div>

                                <div class="w-50 text-center my-auto">
                                    <label>Plant Name</label>
                                    <input type="text" class="form-control rounded" name="plant_name" value="<?php echo $row['plant_name']; ?>" required>
                                    <input type="hidden" class="form-control rounded" name="plant_id" value="<?php echo $row['plant_id']; ?>" required>
                                    <br>
                                    <label>Plant Description</label>
                                    <textarea class="form-control rounded custom-textarea auto-adjust" name="plant_description" required><?php echo $row['plant_description']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Edit Plant</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<?php
    }
}
?>

<script>
    function uploadImage(plantId) {
        // Get the file input element using the plantId
        var input = document.querySelector('#update-modal' + plantId + ' input[type="file"]');

        // Ensure that a file is selected
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            // Set up the reader to load the selected image
            reader.onload = function (e) {
                // Update the src attribute of the image using the plantId
                document.getElementById('selectedImage' + plantId).src = e.target.result;
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.js"></script>
  <script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../../assets/js/dashboard.js"></script>
  <script src="../../assets/js/sidebarmenu.js"></script>
  <script src="../../assets/js/app.min.js"></script>

</body>

</html>

<!-- Modal -->
<div class="modal fade" id="add-plants" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-centered">
   <form action="../php/add_plant.php" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-evenly p-2">
            <div class="w-50 text-center">
                <p class="text-muted">Choose a plant picture</p>
                <img class="img-fluid rounded-4" id="selectedImage" src="../assets/img/questionmark.svg" style="width: 60%; height: 120px;" alt="sample">
                <input class="my-3" type="file" name="plant_img" id="imageInput" accept=".jpg, .jpeg, .png" onchange="uploadPhoto()" required>
            </div>
            <div class="w-50 text-center my-auto">
                <label>Plant Name</label>
                <input type="text" class="form-control rounded" name="plant_name" required>
                <br>
                <label>Plant Description</label>
                <textarea class="form-control rounded custom-textarea auto-adjust" name="plant_description" required></textarea>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Plant</button>
      </div>
    </div>
    </form>
  </div>
</div>

<script>
function uploadPhoto() {
    // Get the file input element
    var input1 = document.getElementById('imageInput');

    // Ensure that a file is selected
    if (input1.files && input1.files[0]) {
        var reader1 = new FileReader();

        // Set up the reader to load the selected image
        reader1.onload = function (e) {
            // Update the src attribute of the image
            document.getElementById('selectedImage').src = e.target.result;
        };

        // Read the selected file as a data URL
        reader1.readAsDataURL(input1.files[0]);
    }
}
</script>