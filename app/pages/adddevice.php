<?php 
include 'php-header.php';
date_default_timezone_set('Asia/Manila');
if ($_SESSION['macaddress']){
 $macaddress = $_SESSION['macaddress'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plant.IQ | Add Device </title>
  <link rel="icon" href="../assets/img/icon.png">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Open+Sans:wght@300;400;500;600;700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css\node_modules\bootstrap\dist\css\bootstrap.min.css">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <!-- Main Template -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    $(document).ready(function() {
        // Check if the URL contains "modal=1"
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('modal') && urlParams.get('modal') === '1') {
            // Show the modal when the page is loaded
            $("#modal1").modal("show");
        }
    });
</script>
</head>

<body>
<style>
    #plantbox{
        width: 150px;
        height: 100px;
        margin-bottom: 4px;
    }
</style>
  <!-- CoverPhoto -->
  <?php include '../pages/components/cover.php'; ?>

  <!-- TOP NAVBAR -->
  <?php include '../pages/components/navbar.php'; ?>


  <form action="adddevice_query.php" method="POST" >
    <div class="container text-center">
      <h2 class="fw-semibold">Add Device</h2>
      <label class="text-muted mb-4">Input the Mac Address or Scan the QR Code in your device</label>

      <div class="card shadow mx-auto rounded-5" style="max-width: 500px;">
        <div class="card-body">
          <h4 class="card-title mb-4">ENTER MAC ADDRESS</h2>
          
          <div class="text-end mb-4">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addModal">
             <i class="fa fa-qrcode mb-2 fa-2xl"></i>
            </button>
          </div>
          
          <div class="mb-4">
            <input type="hidden" name="email" value="<?php echo $email; ?>" >
            <input type="text" class="form-control form-control-lg rounded-4" placeholder="Mac Address" name="macaddress" id="macAddressInput" required>
            <div class="form-text">Please provide the Mac Address to proceed.</div>
          </div>

           <div class="d-flex justify-content-center align-items-center">
            <button type="submit" name="submitmac" class="btn btn-primary btn-lg m-3 rounded-pill fw-bold w-50" data-bs-toggle="modal" style="box-shadow: -4px 4px #3FAA3D;">Connect</button>
            <?php if (isset($_SESSION['macaddress']) && $_SESSION['macaddress'] !== ''): ?>
                <button type="button" class="btn btn-primary btn-lg m-3 rounded-pill fw-bold w-50" data-bs-toggle="modal" data-bs-target="#modal1" style="box-shadow: -4px 4px #3FAA3D;">View Plants</button>
            <?php endif; ?>
        </div>

            <!-- CREATE SWEET ALERT FOR RESPONSE IF CONNECTED SUCCESSFULLY OR NOT -->
        </div>
      </div>
    </div>
  </form>
  
  <br> <br>
  
        <!-- Add/Scan Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content p-3 rounded-5">
              <div class="text-center fw-bold">
                <h4>Scan the QR Code</h4>
                <br>
                <div class="my-1">
                    <video id="preview" width="100%"></video>
                </div>
                <div>
                    <button class="btn btn-sm btn-light" onclick="changeCamera('front')">Front Camera</button>
                    <button class="btn btn-sm btn-light" onclick="changeCamera('back')">Back Camera</button>
                </div>
              </div>
              <div class="d-flex justify-content-around mt-4">
                <button type="button" class="btn btn-lg btn-dark rounded-pill" data-bs-dismiss="modal">Close</button>
                <!-- Optional: Button to manually trigger the scanner -->
                <!-- <button class="btn btn-lg btn-primary rounded-pill" onclick="startScanner()">Scan</button> -->
              </div>
            </div>
          </div>
        </div>
    
    
    <!-- First Modal -->
    <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <?php 
              $sql = "SELECT * FROM plantiq_plants WHERE mac_address = '$macaddress' AND isHarvested = 0"; // removed email
              $results = mysqli_query($conn, $sql);
            
              if ($results) {
                $row = mysqli_fetch_assoc($results);
                $dateplanted = $row['date_planted'];
            }
            
            $date_plantedm = new DateTime($row['date_planted']);
            // Get the current date
            $current_datem = new DateTime();
            // Calculate the difference in days between the current date and the expected harvest date
            $planted_for_days = $current_datem->diff($date_plantedm)->days;
            ?>
        <form action="../php/add_plant.php" method="post">
          <div class="modal-body">
            <h4 class="text-center my-3">Setup plant</h4>
            <p class="text-center text-muted">Setup your plant device and plants you wanted to.</p>
            <div class="row mt-3">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <?php
                        $sql = "SELECT macaddress, device_name FROM plantiq_binding WHERE macaddress = '$macaddress'";
                        $results = mysqli_query($conn, $sql);
                        
                        if ($results) {
                            $row = mysqli_fetch_assoc($results);
                            $macaddress = $row['macaddress'];
                            $device_name = $row['device_name'];
                        }
                        
                        $sql1 = "SELECT * FROM plantiq_plants WHERE mac_address = '$macaddress' AND (isHarvested = 0 OR isHarvested IS NULL)";
                        $results1 = mysqli_query($conn, $sql1);
                        
                        if ($results1) {
                            $row1 = mysqli_fetch_assoc($results1);
                            $date_planted = isset($row1['date_planted']) ? $row1['date_planted'] : date('Y-m-d', strtotime('now'));
                        }
                        ?>
                        <input type="hidden" class="form-control" name="email" value="<?php echo $email; ?>">
                        <input type="hidden" class="form-control" name="mac_address" value="<?php echo $macaddress; ?>">
                        <input type="text" class="form-control" id="DeviceName" name="device_name" placeholder="Device Name" value="<?php echo $device_name; ?>" required>
                      <label for="DeviceName">Device Name</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        <?php
                        if ($planted_for_days >= 1) {
                            // If planted for more than 1 day, make the date field readonly
                            echo '<input type="text" class="form-control" id="datePlanted" name="date_planted" value="' . $date_planted . '" readonly>';
                        } else {
                            // If planted for 1 day or less, allow editing the date
                            echo '<input type="date" class="form-control" id="datePlanted" name="date_planted" value="' . $date_planted . '" required>';
                        }
                        ?>
                        <label for="datePlanted">Date Planted</label>
                    </div>
                </div>
            </div>
            
           <?php
$sql = "SELECT * FROM plantiq_plants WHERE mac_address = '$macaddress' AND (isHarvested = 0 OR isHarvested IS NULL)";
            
// Execute the query
$result = mysqli_query($conn, $sql);
            
// Count the number of plants retrieved
$num_plants = mysqli_num_rows($result);
            
// Determine the appropriate option based on the number of plants
$selected_option = "option1"; // Default to PLANT 2
if ($num_plants > 2 && $num_plants <= 4) {
    $selected_option = "option2"; // PLANT 4
} elseif ($num_plants > 4 && $num_plants <= 6) {
    $selected_option = "option3"; // PLANT 6
} elseif ($num_plants > 6) {
    $selected_option = "option4"; // PLANT 8
}

?>


<div class="dropdown-center text-end">
    <div class="row">
        <div class="col-6">
            <?php if ($planted_for_days >= 1): ?>
                <?php if ($selected_option == "option1"): ?>
                    <label>Only 2 Plants are available to be planted</label>
                <?php elseif ($selected_option == "option2"): ?>
                    <label>Only 4 Plants are available to be planted</label>
                <?php elseif ($selected_option == "option3"): ?>
                    <label>Only 2 Plants are available to be planted</label>
                <?php elseif ($selected_option == "option4"): ?>
                    <label>Only 8 Plants are available to be planted</label>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="col-6">
            <select id="size_select" class="btn border border-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <?php if ($planted_for_days >= 1): ?>
                    <?php if ($selected_option == "option1"): ?>
                        <option value="option1" selected>2 PLANTS</option>
                    <?php endif; ?>
                <?php else: ?>
                    <option value="option1" <?php if ($selected_option == "option1") echo "selected"; ?>>2 PLANTS</option>
                <?php endif; ?>
        
                <?php if ($planted_for_days >= 1): ?>
                    <?php if ($selected_option == "option2"): ?>
                        <option value="option2" selected>4 PLANTS</option>
                    <?php endif; ?>
                <?php else: ?>
                    <option value="option2" <?php if ($selected_option == "option2") echo "selected"; ?>>4 PLANTS</option>
                <?php endif; ?>
        
                <?php if ($planted_for_days >= 1): ?>
                    <?php if ($selected_option == "option3"): ?>
                        <option value="option3" selected>6 PLANTS</option>
                    <?php endif; ?>
                <?php else: ?>
                    <option value="option3" <?php if ($selected_option == "option3") echo "selected"; ?>>6 PLANTS</option>
                <?php endif; ?>
        
                <?php if ($planted_for_days >= 1): ?>
                    <?php if ($selected_option == "option4"): ?>
                        <option value="option4" selected>8 PLANTS</option>
                    <?php endif; ?>
                <?php else: ?>
                    <option value="option4" <?php if ($selected_option == "option4") echo "selected"; ?>>8 PLANTS</option>
                <?php endif; ?>
            </select>
        </div>
    </div>
</div>


            <!-- 2 PLANTS -->
          <div class="container rounded mt-3" style="background-color: #EEEEEE;">
            <div id="option1" class="size_chart">
              <div class="mapouter">
                <div class="row g-2 p-2 hidden-div" id="div2">
                    <?php
                $sql = "SELECT * FROM plantiq_plants WHERE mac_address = '$macaddress' AND (isHarvested = 0 OR isHarvested IS NULL) LIMIT 2";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 1) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-6">
                            <div class="image-container" >
                                <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal3_<?php echo $row['id']?>">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <img src="<?php echo $row['plant_img']?>" id="plantbox" class="img-fluid rounded-4">
                            </div>
                        </div>
                        <?php
                    }
                } elseif ($result->num_rows == 1) {
                    $row = $result->fetch_assoc(); // Fetch the row data
                    ?>
                    <div class="col-6">
                        <div class="image-container" >
                            <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal3_<?php echo $row['id']?>">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                            <img src="<?php echo $row['plant_img']?>" id="plantbox" class="img-fluid rounded-4">
                        </div>
                    </div>
                    <?php
                        if ($planted_for_days < 1) {
                            // If planted for more than 1 day, make the date field readonly
                            echo '<div class="col-6" >
                            <div class="image-container">
                                <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal2">
                                    <i class="fa-regular fa-square-plus fa-xl"></i>
                                </button>
                                <img src="../assets/img/none.png" id="plantbox" class="img-fluid rounded-4">
                            </div>
                          </div>';
                        }
                          ?>
                    <?php
                } else {
                    echo '<div class="col-6" >
                            <div class="image-container">
                                <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal2">
                                    <i class="fa-regular fa-square-plus fa-xl"></i>
                                </button>
                                <img src="../assets/img/none.png" id="plantbox" class="img-fluid rounded-4">
                            </div>
                          </div>';
                }
                ?>
                </div>
              </div>
            </div>
          </div>

          <!-- 4 PLANTS -->
            <div class="container rounded" style="background-color: #EEEEEE; overflow: auto; max-height: 200px;">
                <div id="option2" class="size_chart">
                    <div class="mapouter">
                        <div class="row g-2 p-2 hidden-div" id="div4">
                            <?php
                            $sql = "SELECT * FROM plantiq_plants WHERE mac_address = '$macaddress' AND (isHarvested = 0 OR isHarvested IS NULL) LIMIT 4";
                            $result = $conn->query($sql);
            
                            if ($result->num_rows > 3) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="col-6">
                                        <div class="image-container">
                                            <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal3_<?php echo $row['id']?>">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <img src="<?php echo $row['plant_img']?>" id="plantbox" class="img-fluid rounded-4">
                                        </div>
                                    </div>
                                    <?php
                                }
                            } elseif ($result->num_rows <= 3 && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="col-6">
                                        <div class="image-container">
                                            <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal3_<?php echo $row['id']?>">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <img src="<?php echo $row['plant_img']?>" id="plantbox" class="img-fluid rounded-4">
                                        </div>
                                    </div>
                                    <?php
                                }
                                if ($planted_for_days < 1) {
                                    // If planted for more than 1 day, make the date field readonly
                                    echo '<div class="col-6">
                                            <div class="image-container">
                                                <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal2">
                                                    <i class="fa-regular fa-square-plus fa-xl"></i>
                                                </button>
                                                <img src="../assets/img/none.png" id="plantbox" class="img-fluid rounded-4">
                                            </div>
                                          </div>';
                                }
                            } else {
                                if ($planted_for_days < 1) {
                                    echo '<div class="col-6">
                                            <div class="image-container">
                                                <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal2">
                                                    <i class="fa-regular fa-square-plus fa-xl"></i>
                                                </button>
                                                <img src="../assets/img/none.png" id="plantbox" class="img-fluid rounded-4">
                                            </div>
                                          </div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>



         <!-- 6 PLANTS -->
        <div class="container rounded" style="background-color: #EEEEEE; overflow: auto; max-height: 200px;">
            <div id="option3" class="size_chart">
                <div class="mapouter">
                    <div class="row g-2 p-2 hidden-div" id="div6">
                        <?php
                        $sql = "SELECT * FROM plantiq_plants WHERE mac_address = '$macaddress' AND (isHarvested = 0 OR isHarvested IS NULL) LIMIT 6";
                        $result = $conn->query($sql);
        
                        if ($result->num_rows > 5) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="col-4">
                                    <div class="image-container">
                                        <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal3_<?php echo $row['id']?>">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                        <img src="<?php echo $row['plant_img']?>" id="plantbox" class="img-fluid rounded-4">
                                    </div>
                                </div>
                                <?php
                            }
                        } elseif ($result->num_rows <= 5 && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="col-4">
                                    <div class="image-container">
                                        <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal3_<?php echo $row['id']?>">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                        <img src="<?php echo $row['plant_img']?>" id="plantbox" class="img-fluid rounded-4">
                                    </div>
                                </div>
                                <?php
                            }
                            if ($planted_for_days < 1) {
                                // If planted for more than 1 day, make the date field readonly
                                echo '<div class="col-4">
                                        <div class="image-container">
                                            <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal2">
                                                <i class="fa-regular fa-square-plus fa-xl"></i>
                                            </button>
                                            <img src="../assets/img/none.png" id="plantbox" class="img-fluid rounded-4">
                                        </div>
                                      </div>';
                            }
                        } else {
                            if ($planted_for_days < 1) {
                                echo '<div class="col-4">
                                        <div class="image-container">
                                            <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal2">
                                                <i class="fa-regular fa-square-plus fa-xl"></i>
                                            </button>
                                            <img src="../assets/img/none.png" id="plantbox" class="img-fluid rounded-4">
                                        </div>
                                      </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 8 PLANTS -->
        <div class="container rounded" style="background-color: #EEEEEE; overflow: auto; max-height: 200px;">
            <div id="option4" class="size_chart">
                <div class="mapouter">
                    <div class="row g-3 p-2 hidden-div" id="div8">
                        <?php
                        $sql = "SELECT * FROM plantiq_plants WHERE mac_address = '$macaddress' AND (isHarvested = 0 OR isHarvested IS NULL) LIMIT 8";
                        $result = $conn->query($sql);
        
                        if ($result->num_rows > 7) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="col-3">
                                    <div class="image-container">
                                        <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal3_<?php echo $row['id']?>">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                        <img src="<?php echo $row['plant_img']?>" id="plantbox" class="img-fluid rounded-4">
                                    </div>
                                </div>
                                <?php
                            }
                        } elseif ($result->num_rows <= 7 && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="col-3">
                                    <div class="image-container">
                                        <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal3_<?php echo $row['id']?>">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                        <img src="<?php echo $row['plant_img']?>" id="plantbox" class="img-fluid rounded-4">
                                    </div>
                                </div>
                                <?php
                            }
                            if ($planted_for_days < 1) {
                                // If planted for more than 1 day, make the date field readonly
                                echo '<div class="col-3">
                                        <div class="image-container">
                                            <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal2">
                                                <i class="fa-regular fa-square-plus fa-xl"></i>
                                            </button>
                                            <img src="../assets/img/none.png" id="plantbox" class="img-fluid rounded-4">
                                        </div>
                                      </div>';
                            }
                        } else {
                            if ($planted_for_days < 1) {
                                echo '<div class="col-3">
                                        <div class="image-container">
                                            <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal2">
                                                <i class="fa-regular fa-square-plus fa-xl"></i>
                                            </button>
                                            <img src="../assets/img/none.png" id="plantbox" class="img-fluid rounded-4">
                                        </div>
                                      </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            <?php
            $sql5 = "SELECT * FROM plantiq_plants WHERE mac_address = '$macaddress' AND (isHarvested = 0 OR isHarvested IS NULL)";
            $result5 = $conn->query($sql5);
            
            // Check the number of rows in the result set
            $numPlantsForOption = $result5->num_rows;
            
            // Display the "Save changes" button only if there is at least one plant
            if ($numPlantsForOption > 0) {
                echo '<button type="submit" class="btn btn-primary">Save changes</button>';
            }
            ?>
          </div>
          
          </form>
        </div>
      </div>
    </div>
    

   
    <script>
    $(document).ready(function() {
        <?php
            // Check if the "addPlant" form was submitted
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addPlant'])) {
                echo '$("#modal1").modal("show");';
            }
        ?>
    });
</script>

<?php
$sql = "SELECT * FROM plantiq_plants WHERE mac_address = '$macaddress' AND (isHarvested = 0 OR isHarvested IS NULL)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="modal fade" id="modal3_<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="dismissModal('<?php echo $row['id']?>')"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card rounded-4 border border-light">
                            <div class="row g-0">
                                <div class="col-5 border-0">
                                    <img class="img-fluid rounded-4 edit-pic" src="<?php echo $row['plant_img']?>" style="width: 295px; height: 150px;">
                                </div>
                                <div class="col-7">
                                    <div class="card-body">
                                        <h5><?php echo $row['plant_name']?></h5>
                                        <div class="status-container">
                                            <!-- This container will be updated dynamically -->
                                            <p class="text-muted mt-2">Status:
                                                <select name="plant_status" class="form-select" onchange="updateStatus('<?php echo $row['id']?>', this.value)">
                                                    <option value="Alive" <?php echo ($row['plant_status'] == 'Alive') ? 'selected' : ''; ?>>Alive</option>
                                                    <option value="Dead" <?php echo ($row['plant_status'] == 'Dead') ? 'selected' : ''; ?>>Dead</option>
                                                </select>
                                            </p>
                                            <a href="../php/delete_plant.php?plant_id=<?php echo $row['id']?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this plant?')">Remove Plant</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>

<script>
    function dismissModal(id) {
        // Refresh the page
        location.reload();
        // Redirect to the specified URL
        window.location.href = "https://app.plantiq.info/pages/adddevice.php?modal=1";
    }
</script>


   <!-- Second Modal -->
    <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-body">
          <h4>Choose your plant</h4>
            <hr>
          <div class="position-relative my-3">
           <input type="text" class="form-control rounded-pill border border-success" id="searchPlant" placeholder="Search for a plant">
            <a href="#" id="search" class="search-button">
             <span class="fa fa-search text-dark me-1"></span>
            </a>
          </div>
                    <?php
            $sql = "SELECT * FROM plantiq_recommended ORDER BY plant_name";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <form method="post" action="../php/process_form.php" id="addPlantForm">
                        <div class="card card-custom my-3 rounded-4 border border-success">
                            <div class="row g-0">
                                <div class="col-5">
                                    <img class="img-fluid rounded-4" src="<?php echo $row['plant_img']; ?>" alt="">
                                </div>
                                <div class="col-7">
                                    <div class="card-body card-body-custom">
                                        <div class="d-flex justify-content-between mb-2">
                                            <h5 class="text"><?php echo $row['plant_name']; ?></h5>
                                            <!-- Hidden inputs for plant data -->
                                            <input type="hidden" name="plant_id" value="<?php echo $row['plant_id']; ?>">
                                            <input type="hidden" class="form-control" name="email" value="<?php echo $email; ?>">
                                            <input type="hidden" class="form-control" name="mac_address" value="<?php echo $macaddress; ?>">
                                            <input type="hidden" class="form-control form-control-lg rounded-4" name="plant_img" value="<?php echo $row['plant_img']; ?>" required>
                                            <input type="hidden" class="form-control form-control-lg rounded-4" name="plant_name" value="<?php echo $row['plant_name']; ?>" required>
                                            <button type="submit" name="addPlant" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                        <p><?php echo $row['plant_description']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                }
            } else {
                echo "No records found";
            }
            ?>
      </div>
      <div class="modal-footer">
        <button class="btn btn-dark" data-bs-target="#modal1" data-bs-toggle="modal">Back to Add Device</button>
      </div>
    </div>
  </div>
</div>
<script>
    function updateStatus(plantId, status) {
        $.ajax({
            type: "POST",
            url: "../php/update_status.php",
            data: { plant_id: plantId, plant_status: status },
            success: function (response) {
                // Update the selected option based on the server response
                $(".status-container select").val(status);
            },
            error: function (error) {
                console.error("Error updating status:", error);
            }
        });
    }
</script>
<script>
    // Function to filter plants based on search input
    function filterPlants() {
        var searchQuery = $('#searchPlant').val().toLowerCase();

        // Loop through each plant card
        $('.card-custom').each(function () {
            var plantName = $(this).find('.text').text().toLowerCase();
            
            // Check if the plant name contains the search query
            if (plantName.includes(searchQuery)) {
                $(this).show(); // Show the plant card
            } else {
                $(this).hide(); // Hide the plant card if it doesn't match the search query
            }
        });
    }

    // Attach the filterPlants function to the keyup event of the search input
    $('#searchPlant').on('keyup', function () {
        filterPlants();
    });
</script>
  <!-- BOTTOM NAVBAR -->
  <?php include '../pages/components/navbar-bottom.php'; ?>

  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/jquery-3.7.1.min.js"></script>
  <script src="../assets/js/navbarmenu.js"></script>
  <script src="../assets/js/all.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtcadapter/3.3.3/adapter.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
$(document).ready(function() {
// Function to toggle visibility based on selected option
function toggleVisibility(selectedOptionId) {
    $(".size_chart").hide(); // Hide all divs initially
    $("#"+selectedOptionId).show(); // Show the selected div
}

// Function to initialize visibility based on preselected option
function initializeVisibility() {
    var selected_option = $("#size_select").val();
    toggleVisibility(selected_option);
}

// Event listener for dropdown change
$("#size_select").change(function() {
    var selected_option = $(this).val();
    toggleVisibility(selected_option);
});

// Initialize visibility
initializeVisibility();
});
</script>
<script>
$(document).ready(function() {
    $('#addModal').on('shown.bs.modal', function () {
        startScanner();
    });
});

let scanner;

function startScanner(cameraIndex = 0) {
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
            scanner.addListener('scan', function(content) {
                console.log('Scanned:', content);
                // Set the scanned content to the input field
                $('#macAddressInput').val(content);
                // Close the modal after scanning
                $('#addModal').modal('hide'); // Close the modal
                $('.modal-backdrop').remove(); // Remove the modal backdrop
                $('button[name="submitmac"]').click();
            
            });
            setTimeout(function() {
                scanner.start(cameras[cameraIndex]);
            }, 1000);
        } else {
            alert('No cameras found');
        }
    }).catch(function(e) {
        console.error(e);
    });
}

function changeCamera(position) {
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 1) {
            if (scanner) {
                scanner.stop();
            }
            let selectedCameraIndex;
            if (position === 'front') {
                selectedCameraIndex = 0;
            } else {
                selectedCameraIndex = 1;
            }
            startScanner(selectedCameraIndex);
        } else {
            alert('No multiple cameras found');
        }
    }).catch(function(e) {
        console.error(e);
    });
}
</script>

<script>
$(document).ready(function() {
    // Check if the URL contains the parameter 'modal1'
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('modal1')) {
        // Open the modal
        $('#modal1').modal('show');
    }
});
</script>

<script>
    if (window.performance && performance.navigation.type === 1) {
  window.location.href = "adddevice.php";
  }
</script>
</body>
</html>