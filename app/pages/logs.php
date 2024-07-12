<?php
include 'php-header.php';

// Fetch $macaddress values associated with the given $email
$sql = "SELECT DISTINCT macaddress FROM plantiq_binding WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $macaddress = $row['macaddress'];

        // Fetch device_name from plant_iq_plants based on email and mac_address
        $device_name_sql = "SELECT device_name FROM plantiq_binding WHERE email = ? AND macaddress = ?";
        $stmt_device = $conn->prepare($device_name_sql);
        $stmt_device->bind_param("ss", $email, $macaddress);
        $stmt_device->execute();
        $device_name_result = $stmt_device->get_result();

        // Check if there is a result
        if ($device_name_result->num_rows > 0) {
            $device_name_row = $device_name_result->fetch_assoc();
            $device_name = $device_name_row['device_name'];
        } else {
            // Handle the case where device_name is not found
            $device_name = 'Unknown Device';
        }

        // Fetch esp_data_log entries based on mac_address and order by timestamp
        $log_sql = "SELECT * FROM esp_data_log WHERE mac_address = ? ORDER BY timestamp DESC";
        $stmt_log = $conn->prepare($log_sql);
        $stmt_log->bind_param("s", $macaddress);
        $stmt_log->execute();
        $log_result = $stmt_log->get_result();

        // Check if there are rows returned
        if ($log_result->num_rows > 0) {
            // Output data of each row
            $grouped_rows = [];

            while ($row = $log_result->fetch_assoc()) {
                // Format timestamp to October 23, 2023
                $formatted_date = date('F j, Y', strtotime($row['timestamp']));
                // Format time to 8:32pm
                $formatted_time = date('g:i A', strtotime($row['timestamp']));

                // Group rows by date
                $grouped_rows[$formatted_date][] = [
                    'device_name' => $device_name, // Use the fetched device_name
                    'ph_level' => $row['ph_level'],
                    'water_level' => $row['water_level'],
                    'soil_moisture' => $row['soil_moisture'],
                    'formatted_time' => $formatted_time,
                ];
            }

            // Pagination variables
            $itemsPerPage = 15;
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($currentPage - 1) * $itemsPerPage;

            // Slice the grouped_rows array to fetch only the data for the current page
            $groupedRowsSlice = array_slice($grouped_rows, $offset, $itemsPerPage, true);

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
            
              <!-- Font Awesome Icons -->
              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
            
              <!-- Main Template -->
              <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
              <link rel="stylesheet" href="../assets/css/style.css">
            
            </head>
            
            <body>
            
              <!-- CoverPhoto -->
              <?php include '../pages/components/cover.php'; ?>
            
              <!-- TOP NAVBAR -->
              <?php include '../pages/components/navbar.php'; ?>
            
              <!-- HOME NAVBAR -->
              <?php include '../pages/components/navbar-home.php'; ?>
            
              <div class="card-body" style='overflow-x:auto; margin-top:30px'>
                  <?php foreach ($groupedRowsSlice as $date => $rows) : ?>
                      <div>
                          <h5 class="ms-2"><?php echo $date; ?></h5>
                          <table class="table table-striped table-bordered" style="width:100%">
                              <thead>
                                  <tr>
                                      <th width="20%">Device Name</th>
                                      <th width="17%">PH Level</th>
                                      <th width="20%">Water Level</th>
                                      <th width="20%">Soil Moisture</th>
                                      <th width="35%">Time</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($rows as $row) : ?>
                                      <tr>
                                          <td><?php echo $row['device_name']; ?></td>
                                          <td><?php echo $row['ph_level']; ?></td>
                                          <td><?php echo $row['water_level']; ?></td>
                                          <td><?php echo $row['soil_moisture']; ?></td>
                                          <td><?php echo $row['formatted_time']; ?></td>
                                      </tr>
                                  <?php endforeach; ?>
                              </tbody>
                          </table>
                      </div>
                  <?php endforeach; ?>
              </div>
              <?php
            
              // Pagination links
              $totalItems = count($grouped_rows);
              $totalPages = ceil($totalItems / $itemsPerPage);
            
              echo "<ul class='pagination justify-content-center'>";
              for ($i = 1; $i <= $totalPages; $i++) {
                  echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
              }
              echo "</ul>";
              ?>
            
              <!-- BOTTOM NAVBAR -->
              <?php include '../pages/components/navbar-bottom.php'; ?>
            
              <script src="../assets/js/bootstrap.bundle.js"></script>
              <script src="../assets/js/jquery-3.7.1.min.js"></script>
              <script src="../assets/js/navbarmenu.js"></script>
            
            </body>
            
            </html>
            
            <?php
        } else {
            // No logs found for this mac address
            echo "<div>";
            echo "<img class='img-fluid mx-auto mt-5 d-block' src='../assets/img/notfound.png' style='width: 200px; height: 200px;'>";
            echo "<br>";
            echo "<h1 class='text-center'>No Logs Found</h1>";
            echo "</div>";
        }
    }
} else {
    // No mac address found for this email
    echo "<div>";
    echo "<img class='img-fluid mx-auto mt-5 d-block' src='../assets/img/notfound.png' style='width: 200px; height: 200px;'>";
    echo "<br>";
    echo "<h1 class='text-center'>No Logs Found</h1>";
    echo "</div>";
}

// Close prepared statements and database connection
$stmt->close();
$stmt_device->close();
$stmt_log->close();
$conn->close();
?>
