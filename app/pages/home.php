<?php
include 'php-header.php';
include 'control_light_esp_access.php';
// include 'selector.php';
$sql2 = "SELECT DISTINCT macaddress FROM plantiq_binding WHERE email= '$email' LIMIT 1";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $_SESSION['macaddress'] = isset($_SESSION['macaddress']) ? $_SESSION['macaddress'] : $row2['macaddress'];
}

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plant.IQ | Home</title>
  <link rel="icon" href="../assets/img/icon.png">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Open+Sans:wght@300;400;500;600;700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <!-- Main Template -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">

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

  <div class="container pb-5">
     
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> 
    <i class="fa-solid fa-circle-info"></i>    
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Plant IQ Manual</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item col-6" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Software</button>
                </li>
                <li class="nav-item col-6" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Hardware</button>
                </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
              <!-- Software -->
              <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                  
                 <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step1.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 1</label>
                        <p>It will redirect to the user dashboard click “i” icon to view manual software and hardware. Click “Chip” icon to connect mac address of device. Click “Logout” icon to logout.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step2.png" class="img-fluid mx-2 w-100 mt-5">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 2</label>
                        <p>When you press the info icon, the Plant IQ Manual both Software and Hardware will appear here.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step3.png" class="img-fluid mx-2 w-100 mt-3">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 3</label>
                        <p>When you press the chip icon the mac address will appear, here will appear your mac address and the other mac address entered in your account</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step4.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 4</label>
                        <p>If you scroll further down you will see it here you will see what device planted, and it has Date Planted the day you planted, Date of Harvest the day you can harvest what you planted and Today's Schedule.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step5.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 5</label>
                        <p>And when you press the three dots, the Calendar, Logs and History will appear.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step6.png" class="img-fluid mx-2 w-100 mt-4">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 6</label>
                        <p>Calendar here you can see how many more days your plants have been planted, there is also a button here that says Add Notes, here you can put notes, it has a title, description, start and ending date.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step7.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 7</label>
                        <p>Logs here you can see, who and what day or time the App was opened.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step8.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 8</label>
                        <p>History here you will see the Choose Device, here is suppose to be two devices that are connected to your app, you can choose what mac address it planted, Choose Date Range, what date you want to see. List of Plants inside the net Number of Plants how many plants are planted, Plants Name kunware Tomatoes, Potato etc. and Date Harvested is when you harvested the plant.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step9.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 9</label>
                        <p>Click “On or off” button to control light in device.</p>
                    </div>
                </div>
                
                 <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step10.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 10</label>
                        <p>Click “Find Plants” button to search or view the plants information in suggestions.</p>
                    </div>
                </div>
                
                 <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step11.png" class="img-fluid mx-2 w-100 mt-5">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 11</label>
                        <p>Click “Add Device” button to connect mac address of PlantIQ then insert mac address. Click “Scan” button to scan the QR Code of PlantIQ device using the camera of a mobile app.</p>
                    </div>
                </div>
                
                 <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step12.png" class="img-fluid mx-2 w-100 mt-3">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 12</label>
                        <p>Once you click the view plant, you will see all the plants that you planted.</p>
                    </div>
                </div>
                
                 <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step13.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 13</label>
                        <p>Click “Profile” button to choose device or upload profile picture of the user.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step14.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 14</label>
                        <p>Click “Settings” button to change the full name, username, or password.</p>
                    </div>
                </div>
                
              </div>
              <!-- Hardware -->
              <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                  <div class="row mt-5">
                    <div class="col">
                        <img src="../assets/img/step1_hardware.png" class="img-fluid w-100">
                    </div>
                </div>
                <div class="text-center">
                    <label class="fw-bold">Front View</label>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step2_hardware.png" class="img-fluid w-100">
                    </div>
                </div>
                <div class="text-center">
                    <label class="fw-bold">Top View</label>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step3_hardware.png" class="img-fluid w-100">
                    </div>
                </div>
                <div class="text-center">
                    <label class="fw-bold">Back View</label>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step4_hardware.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 1</label>
                        <p>Plug the two connectors to turn on the power of the device.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step5_hardware.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 2</label>
                        <p>Put the pH level in the container then fill up it with water to sense the acidity and water level.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step6_hardware.png" class="img-fluid mx-2 w-100 mt-4">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 3</label>
                        <p>Put the soil moisture sensor in the middle part of the soil to sense the soil's health better.</p>
                    </div>
                </div>
                
                <div class="row mt-3 mx-4">
                    <div class="col">
                        <img src="../assets/img/figure.png" class="img-fluid mx-2 w-100">
                    </div>
                    <label class="fw-bold text-center">Step 4</label>
                    <p>(Figure.1) After opening the Plant IQ hardware, you need to connect ESP NodeMCU 8266 to wifi manager that shows in (Figure.2) After you connect NodeMCU 8266 to wifi manager, insert SSID name and wifi password to connect, that shows in (Figure.3) Next, wait patiently until you connect the hardware to wifi. (Figure.4) A message will Appear and Lastly, in (Figure.5) you will see that you are already connected.</p>
                </div>
                
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/ste7_hardware.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 5</label>
                        <p>By using the camera of a mobile app,  scan the QR code located at the back of the PlantIQ device to access it to the PlantIQ app.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../assets/img/step8_hardware.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 6</label>
                        <p>To control the PlantIQ device grow light, press the on or off button using the PlantIQ app.</p>
                    </div>
                </div>
                  
              </div>
            </div> <!-- Closing of Tab -->
            
          </div>
        </div>
      </div>
    </div>


    <div class="text-center my-4">
      <h3 class="fw-semibold text-dark">Welcome to <span class="text-primary">PLANTIQ</span> 
        <?php
          $sql = "SELECT fullname FROM plantiq_login WHERE email = '$email'";
          $results = mysqli_query($conn, $sql);
        
          if ($results) {
            $row = mysqli_fetch_assoc($results);
            echo $row['fullname'];
          }
          ?> !</h3>
    </div>
    
<?php
$macaddress = $_SESSION['macaddress'];
$sql = "SELECT status FROM plantiq_espconnection WHERE macaddress='$macaddress'";
$run = $conn->query($sql);

if ($run->num_rows > 0) {
    $row = $run->fetch_assoc();
    $currentStatus = $row['status'];
?>

<div class="d-flex justify-content-between">
    <div>
        <h6 id="status" class="mt-2 ms-2 position-relative">
            Status: <?php echo $currentStatus; ?> 
            <?php if ($currentStatus == 'Connected'){ ?>
                <i class="fa-solid fa-circle text-success"></i>
            <?php }else { ?>
                <i class="fa-solid fa-circle text-secondary"></i>
            <?php } }?>
        </h6>
    </div>
    
    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#macaddress_modal">
        <i <i class="fa-solid fa-microchip fa-solid fa-2xl"></i>
    </button>
    <!-- Modal -->
    
    <div class="modal fade" id="macaddress_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Select Mac Address</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              
            <?php
            // Check if the form is submitted
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Check if the selected MAC address is set in the POST data
                if (isset($_POST['macaddressDropdown'])) {
                    // Store the selected MAC address in the session
                    $_SESSION['macaddress'] = $_POST['macaddressDropdown'];
                }
            }
            
            // Fetch $macaddress values associated with the given $email
            $sql = "SELECT DISTINCT macaddress, device_name FROM plantiq_binding WHERE email = '$email'";
            $result = $conn->query($sql);
            
            // Check if there are rows returned
            if ($result->num_rows > 0) {
                // Start the form with a POST method
                echo '<form method="post" action="">';
                // Start the dropdown
                echo '<select id="macaddressDropdown" class="form-select border border-dark w-100" name="macaddressDropdown">';
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    $macaddress1 = $row['macaddress'];
                    // Check if this option is the currently selected one
                    $selected = ($_SESSION['macaddress'] == $macaddress1) ? 'selected' : '';
                    // Output an option for each $macaddress
                    echo "<option value='$macaddress1' $selected>$macaddress1</option>";
                }
                echo '</select><center><input type="submit" class="btn btn-primary mt-4 mb-3" value="Submit"></center>';
                // End the form
                echo '</form>';
            
            ?>
            <script>
                // Add an event listener to the dropdown to update the session value on change
            document.getElementById('macaddressDropdown').addEventListener('change', function() {
                var selectedValue = this.value;
                // Send an AJAX request to update the session value without refreshing the page
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_session.php'); // Specify the PHP file to handle the update
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    // Handle the response if needed
                    console.log(xhr.responseText);
                };
                xhr.send('macaddressDropdown=' + selectedValue);
            });
            </script>
          </div>
        </div>
      </div>
    </div>
    
</div>

        <?php
          date_default_timezone_set('Asia/Manila');
          $sql = "SELECT * FROM plantiq_plants WHERE mac_address = '$macaddress' AND isHarvested = 0"; // removed email
          $results = mysqli_query($conn, $sql);
        
          if ($results) {
            $row = mysqli_fetch_assoc($results);
            $dateplanted = $row['date_planted'];
          }
          ?>
<?php
// Assuming $row['date_planted'] contains a date string from the database
$date_planted = new DateTime($row['date_planted']);
$formatted_date = $date_planted->format('F j, Y');

$expected_harvest = new DateTime($row['expected_harvest']);
$expected_harvest_formatted = $expected_harvest->format('F j, Y');

// Get the current date
$current_date = new DateTime();

// Clone the $expected_harvest object to avoid modification
$expected_harvest_clone = clone $expected_harvest;
// Check if the current date is greater than expected harvest by 1 day
$is_ready_to_harvest = $current_date > $expected_harvest_clone->modify('+1 day');

// Calculate the difference in days between the current date and the expected harvest date
$planted_for_days = $current_date->diff($date_planted)->days;

$days_lapses_for_harvest = $expected_harvest->diff($current_date)->days;
// Define the target day for 100% progress
$target_day = 21;

// Calculate the progress percentage
$progress_percentage = min(($planted_for_days / $target_day) * 100, 100);
$progress_percentage2 = min(ceil(($planted_for_days / $target_day) * 100), 100);
?>

<!-- COLUMN 1 CONTENT -->
<div class="container pt-3">
    <div class="card border-0 rounded-4">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                   <?php if ($is_ready_to_harvest): ?>
                        <h5 class="text-center">Ready to Harvest</h5>
                        <h2 class="text-center text-danger">
                            <?php
                            echo ($days_lapses_for_harvest === 1 || $days_lapses_for_harvest === 0)
                                ? $days_lapses_for_harvest . ' day ago'
                                : $days_lapses_for_harvest . ' days ago';
                            ?>
                        </h2>
                    <?php else: ?>
                        <h5 class="text-center">Planted For </h5>
                        <h2 class="text-center text-primary">
                            <?php
                            echo ($planted_for_days === 1 || $planted_for_days === 0)
                                ? $planted_for_days . ' day'
                                : $planted_for_days . ' days';
                            ?>
                        </h2>
                    <?php endif; ?>

                    <p class="text-center text-secondary"></p>
                </div>
                <div class="col-6 d-flex justify-content-center">
                    <div role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo $progress_percentage2?>"></div>
                </div>
            </div>
        </div>
    </div>
</div>


            
    <br><br>

    <!-- COLUMN 2 CONTENT -->
    <div class="container mb-5">
      <div class="card border-success rounded-4">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-4">
              <?php 
               $sql = "SELECT macaddress, device_name FROM plantiq_binding WHERE macaddress = '$macaddress'";
               $results = mysqli_query($conn, $sql);
                
                if ($results) {
                    $row = mysqli_fetch_assoc($results);
                    $device_name = $row['device_name'];
                }
              ?>
            <h5 class="card-title fw-bolder"><?php echo $device_name ?? 'Unknown Device'; ?></h5>
            <a href="../pages/calendar.php" class="">
              <i class="fa-solid fa-ellipsis fa-xl text-dark"></i>
            </a>
          </div>
             <?php
            $sql = "SELECT * FROM plantiq_plants WHERE mac_address = '$macaddress' AND (isHarvested = 0 OR isHarvested IS NULL)"; // removed email
            $results = mysqli_query($conn, $sql);
            
            if ($results && mysqli_num_rows($results) > 0) {
                $row = mysqli_fetch_assoc($results);
            
                // Assuming $row['date_planted'] contains a date string from the database
                $date_planted = new DateTime($row['date_planted']);
                $formatted_date = $date_planted->format('F j, Y');
            
                $expected_harvest = new DateTime($row['expected_harvest']);
                $expected_harvest_formatted = $expected_harvest->format('F j, Y');
            
                // Get the current date
                $current_date = new DateTime();
            
                // Check if the current date is equal to or past the expected harvest date
                $show_harvest_button = ($current_date >= $expected_harvest);
                $expected = $row['expected_harvest'];
            } else {
                // No results, handle accordingly
                $expected = $row['expected_harvest'];
                $formatted_date = 'Not Yet Modified';
                $expected_harvest_formatted = 'Not Yet Modified';
                $show_harvest_button = false;
            }
            ?>
            
            <div class="row">
                <div class="col-6">
                    <label class="fw-bold mb-2">Date Planted:</label>
                    <p class=""><?php echo $formatted_date; ?></p>
                </div>
                <div class="col-6">
                    <label class="fw-bold mb-2">Date of Harvest:</label>
                    <p class=""><?php echo $expected_harvest_formatted; ?></p>
                </div>
            </div>

            <div>
                <label class="fw-bold mb-2">Today's Schedule:</label>
                <p id="current-time" class=""></p>
            </div>
            
            <!--<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal-harvest">-->
            <!--  Harvest-->
            <!--</button>-->
            
            <script>
                function updateCurrentTime() {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("current-time").innerHTML = this.responseText;
                        }
                    };
                    xhttp.open("GET", "update_current_time.php", true);
                    xhttp.send();
                }
            
                updateCurrentTime();
            
                setInterval(updateCurrentTime, 5000);
            </script>
            
              <?php
                if ($show_harvest_button) {
                    echo '<a href="../php/harvest.php?email=' . urlencode($email) . '&macaddress=' . urlencode($macaddress) . '&expected_harvest=' . urlencode($expected) . '" type="button" class="btn btn-warning" id="harvestButton">Harvest</a>';
                    echo '<script>
                            document.addEventListener("DOMContentLoaded", () => {
                                Notification.requestPermission().then((perm) => {
                                    if (perm === "granted") {
                                        const notification = new Notification("PLANT IQ", {
                                            body: "Your plant needs you! It is now ready for harvesting!",
                                            icon: "../assets/img/icon.png",
                                            badge: "../assets/img/icon.png",
                                        });
                                    }
                                });
                            });
                          </script>';
                }
                ?>




            
<!-- 2 PLANTS -->
<div class="container rounded mt-3" style="background-color: #EEEEEE;">
    <div class="row g-2 p-2 hidden-div" id="">
        <?php
        $sql = "SELECT * FROM plantiq_plants WHERE mac_address = '$macaddress' AND (isHarvested = 0 OR isHarvested IS NULL)"; // removed email
        $result = $conn->query($sql);

        $plantCount = 0; // Variable to count the displayed plants

        while ($row = $result->fetch_assoc()) {
        ?>
            <div class="col-6 mb-2">
                <div class="image-container">
                    <button type="button" class="btn plus-button position-absolute" data-bs-toggle="modal" data-bs-target="#modal3_<?php echo $row['id']?>">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                    <img src="<?php echo $row['plant_img']; ?>" id="plantbox" class="img-fluid rounded-4">
                </div>
            </div>
        <?php
            $plantCount++;

            // If 8 plants are displayed, break the loop
            if ($plantCount >= 8) {
                break;
            }
        }

        // Check if no plants were displayed or less than 8 plants
        if ($plantCount == 0 || $plantCount < 8) {
        ?>
            <div class="col-6 mb-2">
                <div class="image-container">
                    <a href="adddevice.php?modal=1" class="btn plus-button position-absolute">
                        <i class="fa-regular fa-square-plus fa-xl"></i>
                    </a>
                    <?php
                    if ($planted_for_days >= 1) {
                        // Do nothing if planted for 1 day or more
                    } else {
                        // If planted for 1 day or less, allow editing the date
                        echo '<img src="../assets/img/none.png" id="plantbox" class="img-fluid rounded-4">';
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>



          <!-- Modal -->
          <?php
    $sql = "SELECT * FROM plantiq_plants WHERE mac_address = '$macaddress'"; // removed email
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
                <div class="modal fade" id="modal3_<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <p class="text-muted mt-2">Status: <span class="<?php echo ($row['plant_status'] == 'Dead') ? 'text-danger' : 'text-success'; ?>">
                                    <?php echo ($row['plant_status']) ? $row['plant_status'] : 'Alive'; ?>
                                </span></p>
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
            <div class="row g-2 mt-2">
              <div class="col-12 col-sm-6 col-md-6">
               <div class="card">
                <div class="card-body">
                  <label class="card-title fs-5 fw-semibold">Device Light</label>
                  <?php
                  $sql = "SELECT state FROM plantiq_lights WHERE macaddress = '$macaddress'";
                  $results = mysqli_query($conn, $sql);
                
                  if ($results) {
                    $row = mysqli_fetch_assoc($results);
                    $plantiq_lights_state = $row['state'];
                  }
                  ?>
                  <form action="control_light_update.php" method="POST">
                    <button class="btn btn-lg <?php echo ($plantiq_lights_state == 'on') ? 'btn-success' : 'btn-dark'; ?>" type="submit" name="buttonState" value="on">ON</button>
                    <button class="btn btn-lg <?php echo ($plantiq_lights_state == 'off') ? 'btn-success' : 'btn-dark'; ?>" type="submit" name="buttonState" value="off">OFF</button>
                </form>
                </div>
               </div>
              </div>
              
           <!-- WAG NYO NA ITONG GAGALAWIN NAKAKABALIW YUNG QUERY NITO -->   
           
              <div class="col-12 col-sm-6 col-md-6">
               <div class="card">
                <div class="card-body row">
                 <div class="col-6" id="ph-level-container" style="font-size: 13px;">
                    <?php include('fetch_data.php?type=ph'); ?>
                 </div>
                 <div class="col-6" style="font-size: 13px;">
                    <label class="card-title fw-bold">Legend:</label>
                    <br>
                    <label><i class="fa-solid fa-circle text-dark"></i> No Data </label>
                    <br>
                    <label><i class="fa-solid fa-circle text-danger"></i> < 5 or > 8.5</label>
                    <br>
                    <label><i class="fa-solid fa-circle text-warning"></i> 5 </label>
                    <br>
                    <label><i class="fa-solid fa-circle text-primary"></i> > 6 or < 8.5</label>
                 </div>
                </div>
               </div>
              </div>
              
              <div class="col-12 col-sm-6 col-md-6">
               <div class="card">
                <div class="card-body row">
                 <div class="col-6" id="water-level-container" style="font-size: 13px;">
                    <?php include('fetch_data.php?type=water'); ?>
                 </div>
                 <div class="col-6" style="font-size: 13px;">
                    <label class="card-title fw-bold">Legend:</label>
                    <br>
                    <label><i class="fa-solid fa-circle text-dark"></i> >= 14 </label>
                    <br>
                    <label><i class="fa-solid fa-circle text-danger"></i> >= 11 and <= 13 </label>
                    <br>
                    <label><i class="fa-solid fa-circle text-warning"></i> >= 5 and <= 10 </label>
                    <br>
                    <label><i class="fa-solid fa-circle text-primary"></i> 0 and <= 4 </label>
                 </div>
                </div>
               </div>
              </div>
              
              <div class="col-12 col-sm-6 col-md-6">
               <div class="card">
                <div class="card-body row">
                 <div class="col-6" id="soil-moisture-container" style="font-size: 13px;">
                    <?php include('fetch_data.php?type=soil'); ?>
                 </div>
                 <div class="col-6" style="font-size: 13px;">
                    <label class="card-title fw-bold">Legend:</label>
                    <br>
                    <label><i class="fa-solid fa-circle text-danger"></i> > 65 </label>
                    <br>
                    <label><i class="fa-solid fa-circle text-warning"></i> < 45 </label>
                    <br>
                    <label><i class="fa-solid fa-circle text-primary"></i> <= 65 & >= 45 </label>
                 </div>
                </div>
               </div>
              </div>
<!-- HANGGANG DITO YAN -->
            </div>
        </div>
      </div>
    </div>

    <br>

  </div>
  
<!-- No Found UI -->
 <?php
 }else {
    echo ' 
    
        <img class="img-fluid mx-auto mt-5 d-block" src="../assets/img/notfound.png" style="width: 200px; height: 200px;">
        <br>
        <h1 class="text-center">  No Devices Found  </h1>

    ' ;
}

// Close the database connection
$conn->close();

?>

<!-- BOTTOM NAVBAR -->
<?php include '../pages/components/navbar-bottom.php'; ?>

<script>
    $(document).ready(function () {
        // Function to refresh data
        function refreshData(containerId, type) {
            $.ajax({
                url: 'fetch_data.php?type=' + type,
                success: function (data) {
                    $('#' + containerId).html(data);
                }
            });
        }

        // Refresh pH level data every second
        setInterval(function () {
            refreshData('ph-level-container', 'ph');
        }, 3000);

        // Refresh water level data every second
        setInterval(function () {
            refreshData('water-level-container', 'water');
        }, 3000);

        // Refresh soil moisture data every second
        setInterval(function () {
            refreshData('soil-moisture-container', 'soil');
        }, 3000);
    });
</script>

<script>
        // Function to refresh status
        function refreshStatus() {
            $.ajax({
                url: 'esp_status.php',
                success: function (data) {
                    $('#status').html(data);
                }
            });
        }

        // Refresh status every second
        setInterval(refreshStatus, 5000);
    </script>
<!-- HANGGANG DITO-->
  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/jquery-3.7.1.min.js"></script>
  <script src="../assets/js/navbarmenu.js"></script>
  <script src="../assets/js/all.min.js"></script>

</body>
</html>

<!-- Modal -->
<div class="modal fade" id="modal-harvest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-5">
      <div class="modal-body container p-5 border border-5 border-primary rounded-5">
        <div class="text-center">
          <img src="../assets/img/haha.gif" class="img-fluid py-2">
          <h1 class="text-primary">Congratulations!</h1>
          <label class="text-dark my-2">In just 21 days, you were able to effectively raise a seed into a young, healthy plant!</label>
          <br>
          <p class="text-muted my-2">Your love of gardening is clear, and this achievement is a credit to your ability and caring nature.</p>
        </div>
        <br>
        <div class="d-flex justify-content-around mt-3">
          <button type="button" class="btn btn-dark rounded-pill mx-1" data-bs-dismiss="modal">No, Thanks!</button>
          <button type="button" class="btn btn-primary rounded-pill mx-1">I want to plant again!</button>
        </div>
      </div>
    </div>
  </div>
</div>

