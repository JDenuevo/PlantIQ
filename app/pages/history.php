<?php
include 'php-header.php';
 ?>
  <?php
// Fetch $macaddress values associated with the given $email
$sql = "SELECT DISTINCT macaddress FROM plantiq_binding WHERE email = '$email'";
$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $macaddress = $row['macaddress'];
    }
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
  <link rel="stylesheet" href="css\node_modules\bootstrap\dist\css\bootstrap.min.css">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <!-- Main Template -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  
</head>

<body>

  <!-- CoverPhoto -->
  <?php include '../pages/components/cover.php'; ?>

  <!-- TOP NAVBAR -->
  <?php include '../pages/components/navbar.php'; ?>
    
  <!-- HOME NAVBAR -->
  <?php include '../pages/components/navbar-home.php'; ?>
  
<div class="container">
    <div class="row g-2 mt-2">
        <div class="col-6">
            <div class="form-floating">
                <select class="form-select w-100 bg-none border border-dark rounded-4" id="device" name="device">
                    <option value="" disabled selected>Choose Device</option>
                    <?php
                    $sql = "SELECT device_name, macaddress FROM plantiq_binding WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $device_name = $row['device_name'];
                        $macaddress = $row['macaddress'];
                        if ($device_name === null) {
                            $device_name = "Unknown Device";
                        }
                        echo "<option value=\"$macaddress\">$device_name</option>";
                    }
                    ?>
                </select>
                <label for="device">Device Name</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-floating">
                <select class="form-select w-100 bg-none border border-dark rounded-4" id="date">
                    <option value="" selected>Choose Date Range</option> <!-- Added empty option -->
                </select>
                <label for="date">Date Range</label>
            </div>
        </div>
    </div>
    <input type="hidden" id="email" value="<?php echo $email;?>">

    <div class="table-responsive" style="height: 400px; overflow-y: auto;">
        <table id="tbl" class="table table-striped table-bordered mt-4">
            <thead class="text-center">
                <tr>
                    <th colspan="3">List of Plants</th>
                </tr>
                <tr>
                    <th class="text-center">Number of Plants</th>
                    <th class="text-center">Plant's Name</th>
                    <th class="text-center">Date Harvested</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <!-- No Found UI -->
</div>


<script>
$(document).ready(function () {
    // Event listener for device select element change
    $('#device').change(function () {
        var selectedDevice = $(this).val();
        var email = $('#email').val();

        // Ajax call to fetch dates associated with the selected device
        $.ajax({
            type: 'POST',
            url: 'get_dates.php',
            data: {
                device: selectedDevice,
                email: email
            },
            success: function (response) {
                // Update the date range select element with the retrieved dates
                $('#date').html(response);
            },
            error: function (error) {
                console.log(error.responseText);
            }
        });
    });

    // Event listener for select elements change
    $(document).on('change', '#device, #date, #email', function () {
        // Get selected values
        var selectedDevice = $('#device').val();
        var selectedDate = $('#date').val();
        var email = $('#email').val();

        // Ajax call to fetch updated plant list
        $.ajax({
            type: 'POST',
            url: 'get_plants.php',
            data: {
                device: selectedDevice,
                date: selectedDate,
                email: email
            },
            dataType: 'json',
            success: function (response) {
                // Update the plant list table with the fetched data
                updatePlantList(response);
            },
            error: function (error) {
                console.log(error.responseText);
            }
        });
    });

    function updatePlantList(plantList) {
        var tbody = $('#tbl tbody');
        tbody.empty(); // Clear existing rows
    
        if (plantList.length > 0) {
            for (var i = 0; i < plantList.length; i++) {
                var plant = plantList[i];
                tbody.append('<tr><td class="text-center">' + plant.plant_count + '</td><td class="text-center">' + plant.plant_name + '</td><td class="text-center">' + plant.date_harvested + '</td></tr>');
            }
        } else {
            // Display a message if no plants are found
            tbody.append('<tr><td colspan="3" class="text-center">No plants found.</td></tr>');
        }
    }
});


</script>
  <!-- BOTTOM NAVBAR -->
  <?php include '../pages/components/navbar-bottom.php'; ?>

  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/jquery-3.7.1.min.js"></script>
  <script src="../assets/js/navbarmenu.js"></script>

</body>
</html>