<?php 
include 'php-header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plant.IQ | Profile </title>

  <link rel="icon" href="../assets/img/icon.png">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Open+Sans:wght@300;400;500;600;700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">  <link rel="stylesheet" href="css\node_modules\bootstrap\dist\css\bootstrap.min.css">
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="../assets/css/swiper-bundle.min.css">

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
  
  <?php
// Assuming the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file is uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Process the uploaded file
        $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
        $imageData = mysqli_real_escape_string($conn, $imageData);

        // Update the database with the new image data
        $updateSql = "UPDATE plantiq_login SET img = '$imageData' WHERE email = '$email'";
        $updateResult = mysqli_query($conn, $updateSql);

        if (!$updateResult) {
            die("Image update failed: " . mysqli_error($conn));
        }
    }
}

// Fetch user data
$sql = "SELECT img, fullname FROM plantiq_login WHERE email = '$email'";
$results = mysqli_query($conn, $sql);

if ($results) {
    $row = mysqli_fetch_assoc($results);

    // Check if the image is null or empty
    if ($row['img'] == null || empty($row['img'])) {
        // Set default image path if img is null or empty
        $imgPath = "../assets/img/default.jpg";
    } else {
        // Use the image from the database
        $imgPath = 'data:image/jpeg;base64,' . base64_encode($row['img']);
    }

    echo '<div class="container mt-5">
            <form method="post" enctype="multipart/form-data">
                <div class="upload mx-auto" id="upload">
                    <div class="position-relative d-inline-block">
                        <div class="rounded-circle-container shadow position-relative">
                            <img id="uploadedImage" src="' . $imgPath . '" class="img-fluid" alt="Uploaded Image">
                        </div>
                        <label for="image" class="btn rounded position-absolute bottom-0 end-0 mb-2 me-2">
                            <i class="fa-solid fa-plus d-flex justify-content-center p-2 mt-2 px-4" style="color: green;font-size: 2.4em; background-color: white; border-radius: 50%; width: 50px; height: 50px;"></i>
                            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" onchange="uploadImage()" required style="display: none;">
                        </label>
                    </div>
                    <div>
                        <h1 class="fw-bold">' . $row['fullname'] . '</h1>
                        <span class="text-secondary">Owner</span>
                    </div>
                </div>
            </form>
        </div>
        
        <script>
            function uploadImage() {
                // Automatically submit the form when a file is selected
                document.querySelector("form").submit();
            }
        </script>';
}
?>
<br><br>

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">My Plants</h1>
        <div class="form-floating">
           <select class="form-select w-100 bg-none border border-dark rounded-4" id="device" name="device">
                <option value="" disabled>Choose Device</option>
                <?php
                $sql = "SELECT device_name, macaddress FROM plantiq_binding WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $device_name = $row['device_name'];
                    $macaddress = $row['macaddress'];
                    if ($device_name === null) {
                        $device_name = "Unknown Device";
                    }
                    $selected = ''; // Initialize selected attribute
                    if (isset($_SESSION['selectedDevice']) && $_SESSION['selectedDevice'] == $macaddress) {
                        $selected = 'selected'; // Set selected attribute if the device is selected
                    }
                    echo "<option value=\"$macaddress\" $selected>$device_name</option>";
                }
                ?>
            </select>

            <label for="device">Device Name</label>
        </div>
    </div>
    <input type="hidden" id="email" value="<?php echo $email;?>">
    <div class="slide-container swiper" data-swiper-autoplay="2000" data-aos="fade-up" data-aos-delay="800">
      <div class="slide-content mx-5 my-2 overflow-hidden">
        <div class="card-wrapper swiper-wrapper">
            
        </div>
      </div>

      <div class="swiper-pagination"></div>
    </div>

<script>
$(document).ready(function () {
    // Function to fetch plant list and display
    function fetchPlantListAndDisplay() {
        // Retrieve selected values from sessionStorage
        var selectedDevice = sessionStorage.getItem('selectedDevice');
        var email = sessionStorage.getItem('email');

        // Set selected value in the device dropdown
        $('#device').val(selectedDevice);

        // Ajax call to fetch updated plant list
        $.ajax({
            type: 'POST',
            url: 'get_mac.php',
            data: {
                device: selectedDevice,
                email: email
            },
            dataType: 'json',
            success: function (response) {
                // Update the plant list with the fetched data
                updatePlantList(response);
            },
            error: function (error) {
                console.log(error.responseText);
                // Handle the error and display a message
                updatePlantList([]);
            }
        });
    }

    // Call the function to fetch and display the plant list when the page loads
    fetchPlantListAndDisplay();

    // Event listener for select elements change
    $('#device').change(function () {
        // Get selected values
        var selectedDevice = $(this).val();
        var email = $('#email').val(); // Assuming you have an element with id 'email'

        // Store selected values in sessionStorage
        sessionStorage.setItem('selectedDevice', selectedDevice);
        sessionStorage.setItem('email', email);

        // Reload the page
        window.location.reload();
    });

    // Function to update the plant list in the UI
    function updatePlantList(plants) {
        var plantContainer = $('.card-wrapper');
        plantContainer.empty(); // Clear existing plant cards

        if (plants && plants.length > 0) {
            // Iterate over the plants and create card elements
            $.each(plants, function (index, plant) {
                var card = $('<div class="card swiper-slide small-card rounded">');
                var imageContainer = $('<div class="image-container">');
                var img = $('<img src="' + plant.plant_img + '" class="card-img-top rounded" alt="">');
                var mask = $('<div class="mask">');
                var cardBody = $('<div class="card-body text-center text-white position-absolute w-100" style="bottom: 0;">');
                var label = $('<label class="fw-bold fs-6">' + plant.plant_name + '</label>');
                var p = $('<p class="fw-semibold" style="font-size: 13px;">Count: <span>' + plant.plant_count + '</span></p>');

                // Append elements to the card
                imageContainer.append(img, mask, cardBody.append(label, p));
                card.append(imageContainer);
                plantContainer.append(card);
            });
        } else {
            // Display a message when no plants are found
            plantContainer.append(   
                '<div class="text-center">' +
                '<img class="img-fluid d-block" src="../assets/img/notfound.png" style="width: 200px; height: 200px; margin-left: 15px;">' +
                '<br>' +
                '<h1 style= "margin-left: 5px;" >No Plants Found</h1>' +
                '</div>'
            );
        }
    }
});

</script>



<script>
    function displayImage(event) {
        var image = document.getElementById('uploadedImage');
        image.src = URL.createObjectURL(event.target.files[0]);
    }
</script>

  <!-- BOTTOM NAVBAR -->
  <?php include '../pages/components/navbar-bottom.php'; ?>

  <!-- Swiper JS -->
  <script src="../assets/js/swiper-bundle.min.js"></script>
  <!-- JavaScript -->
  <script src="../assets/js/script-swipers.js"></script>
  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/jquery-3.7.1.min.js"></script>
  <script src="../assets/js/navbarmenu.js"></script>
<br><br><br><br><br><br>
</body>
</html>