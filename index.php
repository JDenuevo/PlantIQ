<?php
// Connection details
$servername = "localhost";
$username = "xsmdaevu_userplantiq";
$password = "1{V{EYLmvO?r";
$dbname = "xsmdaevu_appplantiq";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate form data (you may add more validation logic as needed)

    // Insert the data into the plantiq_feedback table
    $insertQuery = "INSERT INTO plantiq_feedback (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($insertQuery) === TRUE) {
        // You may also redirect the user to a thank you page or do any other post-submission actions
    } else {
        echo "Error inserting record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>PLANT.IQ</title>

  <!-- Favicons -->
  <link href="../assets/img/icon.png" rel="icon">
  <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css"  rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Main Template CSS Files -->
  <link href="../assets/css/aos.css" rel="stylesheet">
  <link href="../assets/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/css/swiper-bundle.min.css" rel="stylesheet">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/slider.css" rel="stylesheet">
  <link href="../assets/css/website.css" rel="stylesheet">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<style>
  #preloader {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 9999;
  overflow: hidden;
  background: url(../assets/img/preloading.gif) no-repeat;
  background-color: white;
  background-position: center;
}

</style>

<!-- Navbar Start -->
<div class="container-fluid fixed-top" id="header">
  <div class="container">
    <nav class="navbar navbar-expand-lg p-0 justify-content-between" style="background-color: #FFFFFF;" id="navbar">
        <a href="index.php" class="navbar-brand">
          <img class="img-fluid" src="../assets/img/title.png" alt="Plant.IQ" width="200px">
        </a>
        <i class="fa-solid fa-circle fa-2xs ms-5 me-3 d-none d-sm-none d-md-none d-lg-block" style="color: #428339;"></i> 
        <!-- Mobile Toggle Button -->
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Mobile Menu -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav d-flex justify-content-around flex-fill">
            <a href="#home" class="fs-6 fw-semibold nav-link scrollto active">HOME</a>
            <a href="#guide" class="fs-6 fw-semibold nav-link scrollto">GUIDE</a>
            <a href="#about" class="fs-6 fw-semibold nav-link scrollto">ABOUT US</a>
            <a href="#team" class="fs-6 fw-semibold nav-link scrollto">TEAM</a>
            <a href="#contact" class="fs-6 fw-semibold nav-link scrollto">CONTACT</a>
          </div>
        </div>
    </nav>
  </div>
</div>
<!-- Navbar End -->

<br>

<!-- ======= Home Section ======= -->
<section id="home" class="d-flex align-items-center">
  <div class="container pt-5">
    <hr>
    <div class="row py-3">
      <div class="col-lg-7 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-lg-first" data-aos="fade-up" data-aos-delay="200">
        <h2 class="fw-bold text-dark mb-4">A beautiful plant is like having a friend around the house.</h2>
        <p class="mb-4">Indoor planting allows nature enthusiasts to cultivate lush greenery and vibrant blooms within the cozy confines of their homes, bringing a touch of the outdoors inside.</p>
        <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
          <a href="PlantIQ.apk" target="_blank" class="btn btn-primary rounded-pill text-light fw-bold me-4">Download APK</a>
          <a href="https://www.youtube.com/watch?v=kAVfXS10DN8" class="glightbox btn-watch-video text-decoration-none rounded-circle d-flex align-items-center">
            <i class="fa-regular fa-circle-play me-4" style="font-size: 3rem; color: #26DB23;" onmouseover="this.style.color='#2ebe2b'" onmouseout="this.style.color='#26DB23'"></i>
          </a>
          <p class="m-0">Watch, how to take care of plants using our system.</p>
        </div>
      </div>
      
      <div class="col-lg-5 order-2 d-none d-lg-block d-xl-block" data-aos="zoom-in" data-aos-delay="200">
        <img class="img-fluid float-end d-none d-sm-none d-md-none d-lg-block" src="../assets/img/dot.png" alt="" width="100px">
        <div class="z-0 position-absolute">
          <img src="../assets/img/intro.png" class="img-fluid animated" alt="" width="300px">
        </div>
        <div class="z-n1 position-absolute opacity-50">
          <img src="../assets/img/grid.png" class="img-fluid animated" alt="" width="300px">
        </div>
      </div>
    </div>
    
    <img src="../assets/img/dlcover.png" alt="Mobile App" class="img-fluid pt-5" data-aos="zoom-in-up" data-aos-delay="1000">
    
    <img class="img-fluid float-start d-none d-sm-none d-md-none d-lg-block" src="../assets/img/dot.png" alt="" width="100px" data-aos="fade-right" data-aos-delay="400">

      <div class="row py-4">
        <div class="col-lg-6 order-2 order-lg-1 text-center d-none d-sm-none d-md-none d-lg-block" data-aos="zoom-in" data-aos-delay="400">
          <div class="z-0 position-absolute">
            <img src="../assets/img/testimonial.png" class="img-fluid animated m-0" width="300px">
          </div>
          <div class="z-n1 position-absolute opacity-50">
            <img src="../assets/img/grid.png" class="img-fluid animated" alt="" width=phone"300px">
          </div>
        </div>
        <div class="col-lg-6 align-self-start pt-4 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="400">
          <h5 class="fw-bold" style="color: #35AC12;">#Why Us</h5>
          <h2 class="fw-bold text-dark">Best For Indoor Plants</h2>
          <p class="mb-4">Indoor planting allows nature enthusiasts to cultivate lush greenery and vibrant blooms within the cozy confines of their homes, bringing a touch of the outdoors inside.</p>
        </div>
      </div>

    <img class="img-fluid float-end d-none d-sm-none d-md-none d-lg-block" src="../assets/img/dot.png" alt="" width="100px" data-aos="fade-up" data-aos-delay="400">
  
  </div>
</section>
<!-- End Home -->

<!-- ======= Guide Us Section ======= -->
<section id="guide" class="guide">
  <div class="container py-3" data-aos="fade-up" data-aos-delay="200">
    <div class="section-title text-center">
      <h2 class="fw-bold" >INDOOR PLANT GUIDES</h2>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="false">
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
                        <img src="../app/assets/img/step1.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 1</label>
                        <p>It will redirect to the user dashboard click “i” icon to view manual software and hardware. Click “Chip” icon to connect mac address of device. Click “Logout” icon to logout.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step2.png" class="img-fluid mx-2 w-100 mt-5">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 2</label>
                        <p>When you press the info icon, the Plant IQ Manual both Software and Hardware will appear here.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step3.png" class="img-fluid mx-2 w-100 mt-3">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 3</label>
                        <p>When you press the chip icon the mac address will appear, here will appear your mac address and the other mac address entered in your account</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step4.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 4</label>
                        <p>If you scroll further down you will see it here you will see what device planted, and it has Date Planted the day you planted, Date of Harvest the day you can harvest what you planted and Today's Schedule.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step5.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 5</label>
                        <p>And when you press the three dots, the Calendar, Logs and History will appear.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step6.png" class="img-fluid mx-2 w-100 mt-4">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 6</label>
                        <p>Calendar here you can see how many more days your plants have been planted, there is also a button here that says Add Notes, here you can put notes, it has a title, description, start and ending date.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step7.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 7</label>
                        <p>Logs here you can see, who and what day or time the App was opened.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step8.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 8</label>
                        <p>History here you will see the Choose Device, here is suppose to be two devices that are connected to your app, you can choose what mac address it planted, Choose Date Range, what date you want to see. List of Plants inside the net Number of Plants how many plants are planted, Plants Name kunware Tomatoes, Potato etc. and Date Harvested is when you harvested the plant.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step9.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 9</label>
                        <p>Click “On or off” button to control light in device.</p>
                    </div>
                </div>
                
                 <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step10.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 10</label>
                        <p>Click “Find Plants” button to search or view the plants information in suggestions.</p>
                    </div>
                </div>
                
                 <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step11.png" class="img-fluid mx-2 w-100 mt-5">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 11</label>
                        <p>Click “Add Device” button to connect mac address of PlantIQ then insert mac address. Click “Scan” button to scan the QR Code of PlantIQ device using the camera of a mobile app.</p>
                    </div>
                </div>
                
                 <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step12.png" class="img-fluid mx-2 w-100 mt-3">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 12</label>
                        <p>Once you click the view plant, you will see all the plants that you planted.</p>
                    </div>
                </div>
                
                 <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step13.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 13</label>
                        <p>Click “Profile” button to choose device or upload profile picture of the user.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step14.png" class="img-fluid mx-2 w-100">
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
                        <img src="../app/assets/img/step1_hardware.png" class="img-fluid w-100">
                    </div>
                </div>
                <div class="text-center">
                    <label class="fw-bold">Front View</label>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step2_hardware.png" class="img-fluid w-100">
                    </div>
                </div>
                <div class="text-center">
                    <label class="fw-bold">Top View</label>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step3_hardware.png" class="img-fluid w-100">
                    </div>
                </div>
                <div class="text-center">
                    <label class="fw-bold">Back View</label>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step4_hardware.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 1</label>
                        <p>Plug the two connectors to turn on the power of the device.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step5_hardware.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 2</label>
                        <p>Put the pH level in the container then fill up it with water to sense the acidity and water level.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step6_hardware.png" class="img-fluid mx-2 w-100 mt-4">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 3</label>
                        <p>Put the soil moisture sensor in the middle part of the soil to sense the soil's health better.</p>
                    </div>
                </div>
                
                <div class="row mt-3 mx-4">
                    <div class="col">
                        <img src="../app/assets/img/figure.png" class="img-fluid mx-2 w-100">
                    </div>
                    <label class="fw-bold text-center">Step 4</label>
                    <p>(Figure.1) After opening the Plant IQ hardware, you need to connect ESP NodeMCU 8266 to wifi manager that shows in (Figure.2) After you connect NodeMCU 8266 to wifi manager, insert SSID name and wifi password to connect, that shows in (Figure.3) Next, wait patiently until you connect the hardware to wifi. (Figure.4) A message will Appear and Lastly, in (Figure.5) you will see that you are already connected.</p>
                </div>
                
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/ste7_hardware.png" class="img-fluid mx-2 w-100">
                    </div>
                    
                     <div class="col">
                        <label class="fw-bold">Step 5</label>
                        <p>By using the camera of a mobile app,  scan the QR code located at the back of the PlantIQ device to access it to the PlantIQ app.</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col">
                        <img src="../app/assets/img/step8_hardware.png" class="img-fluid mx-2 w-100">
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
    
    <div class="text-center" data-aos="fade-up" data-aos-delay="400">
      <img src="../assets/img/banner.png" class="img-fluid m-0" width="40%">
    </div>
    
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal"> 
    <i class="fa-solid fa-circle-info"></i>    
    </button>
    
    <div data-aos="fade-up" data-aos-delay="600">
      <h5 class="fw-bold" style="color: #35AC12;">#How to Plant?</h5>
      <p class="">In this guide, we'll explore the essential techniques for effective plant watering and monitoring systems. This will help you to properly use our user-friendly system hardware. Moreover, our advanced monitoring technology offers real-time insights into soil moisture levels, enabling you to be more informed and watering frequencies of your plant as needed.</p>
    </div>

    <img src="../assets/img/guide.png" alt="Mobile App" class="img-fluid" data-aos="zoom-in-up" data-aos-delay="1000">
  
  </div>
</section>
<!-- End Guide Us Section -->


<!-- ======= About Us Section ======= -->
<section id="about" class="about">

  <img class="img-fluid float-start d-none d-sm-none d-md-none d-lg-block" src="../assets/img/dot.png" alt="" width="100px" data-aos="fade-right" data-aos-delay="400">
  
  <div class="container" data-aos="fade-up" data-aos-delay="200">
    <div class="row">
      <div class="col-12 col-lg-7">
        <div class="section-title text-center">
          <h2 class="fw-bold">ABOUT US</h2>
        </div>
        <div class="text-center" data-aos="fade-up" data-aos-delay="400">
          <img src="../assets/img/banner.png" class="img-fluid" width="80%">
        </div>
        <div data-aos="fade-up" data-aos-delay="600">
          <h5 class="fw-bold" style="color: #35AC12;">#Know us more</h5>
          <p class="mb-4">Welcome to our community of indoor edible plant enthusiasts! We are passionate about bringing the joys of gardening and fresh, homegrown produce right into your living space. Our mission is to grow your plant from seed to young plant, regardless of their gardening experience, to cultivate a thriving edible garden indoors.
            <br> <br>
            At Indoor Edible Greens, we believe that everyone should have access to fresh, flavorful, and nutritious, right from the comfort of their homes. We're on a mission to transform indoor spaces into bountiful gardens, providing a sustainable and delicious source of nourishment.
          </p>
        </div>
      </div>
      <div class="col-lg-5 text-center d-none d-sm-none d-md-none d-lg-block">
        <img src="../assets/img/frame.png" alt="Frame" class="img-fluid" data-aos="fade-left" data-aos-delay="200">
      </div>
    </div>

  </div>
</section>
<!-- End About Us Section -->


<!-- ======= Team Section -->
<section id="team">

  <img class="img-fluid float-end d-none d-sm-none d-md-none d-lg-block" src="../assets/img/dot.png" alt="" width="100px" data-aos="fade-up" data-aos-delay="200">

  <div class="container text-center" data-aos="fade-up" data-aos-delay="200">
    <div class="section-title text-center">
      <h2 class="fw-bold text-center">MEET OUR TEAM</h2>
      <div class="text-center" data-aos="fade-up" data-aos-delay="400">
        <img src="../assets/img/banner.png" class="img-fluid" width="40%">
      </div>
      <div data-aos="fade-up" data-aos-delay="600">
        <p>Step into the world of precision plant care with our dedicated team behind the PLANT IQ. Together, we're redefining sustainable gardening practices, ensuring every plant receives the perfect amount of hydration. Join us as we cultivate healthier, greener spaces with intelligent plant care solutions.</p>
      </div>
    </div>

    <div class="slide-container swiper" data-swiper-autoplay="2000" data-aos="fade-up" data-aos-delay="800">
      <div class="slide-content mx-5 my-5 overflow-hidden">
        <div class="card-wrapper swiper-wrapper">

          <div class="card swiper-slide small-card rounded">
            <div class="image-container">
              <img src="../assets/img/dejesus.png" class="card-img-top rounded" alt="">
              <div class="mask"></div>
              <div class="card-body text-center text-white position-absolute w-100" style="bottom: 0;">
                  <label class="fw-bold fs-6">Darwin Eulin De Jesus</label>
                  <p class="" style="font-size: 13px;">Backend/Hardware - Lead</p>
              </div>
            </div>
          </div>

          <div class="card swiper-slide small-card rounded">
            <div class="image-container">
              <img src="../assets/img/nolasco.png" class="card-img-top rounded" alt="">
              <div class="mask"></div>
              <div class="card-body text-center text-white position-absolute w-100" style="bottom: 0;">
                  <label class="fw-bold fs-6">John Michael Nolasco</label>
                  <p class="" style="font-size: 13px;">Backend - Lead</p>
              </div>
            </div>
          </div>

          <div class="card swiper-slide small-card rounded">
            <div class="image-container">
              <img src="../assets/img/denuevo.png" class="card-img-top rounded" alt="">
              <div class="mask"></div>
              <div class="card-body text-center text-white position-absolute w-100" style="bottom: 0;">
                  <label class="fw-bold fs-6">Jhemar Denuevo</label>
                  <p class="" style="font-size: 13px;">UI/UX - Front-end Lead</p>
              </div>
            </div>
          </div>

          <div class="card swiper-slide small-card rounded">
            <div class="image-container">
              <img src="../assets/img/molina.png" class="card-img-top rounded" alt="">
              <div class="mask"></div>
              <div class="card-body text-center text-white position-absolute w-100" style="bottom: 0;">
                  <label class="fw-bold fs-6">Patrice Molina</label>
                  <p class="" style="font-size: 13px;">UI/UX - Assistant</p>
              </div>
            </div>
          </div>

          <div class="card swiper-slide small-card rounded">
            <div class="image-container">
              <img src="../assets/img/ubana.png" class="card-img-top rounded" alt="">
              <div class="mask"></div>
              <div class="card-body text-center text-white position-absolute w-100" style="bottom: 0;">
                  <label class="fw-bold fs-6">Kian Charles Ubana</label>
                  <p class="" style="font-size: 13px;">Front-end - Assistant</p>
              </div>
            </div>
          </div>

          <div class="card swiper-slide small-card rounded">
            <div class="image-container">
              <img src="../assets/img/lanuza.png" class="card-img-top rounded" alt="">
              <div class="mask"></div>
              <div class="card-body text-center text-white position-absolute w-100" style="bottom: 0;">
                  <label class="fw-bold fs-6">Alexis Lanuza</label>
                  <p class="" style="font-size: 13px;">Front-end - Assistant</p>
              </div>
            </div>
          </div>

          <div class="card swiper-slide small-card rounded">
            <div class="image-container">
              <img src="../assets/img/morente.png" class="card-img-top rounded" alt="">
              <div class="mask"></div>
              <div class="card-body text-center text-white position-absolute w-100" style="bottom: 0;">
                  <label class="fw-bold fs-6">Jayniel Morente</label>
                  <p class="" style="font-size: 13px;">Hardware - Assistant</p>
              </div>
            </div>
          </div>

          <div class="card swiper-slide small-card rounded">
            <div class="image-container">
              <img src="../assets/img/roldanj.png" class="card-img-top rounded" alt="">
              <div class="mask"></div>
              <div class="card-body text-center text-white position-absolute w-100" style="bottom: 0;">
                  <label class="fw-bold fs-6">Jericho Roldan</label>
                  <p class="" style="font-size: 13px;">Graphic Artist - Lead</p>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="swiper-button-next swiper-navBtn"></div>
      <div class="swiper-button-prev swiper-navBtn"></div>
      <div class="swiper-pagination"></div>
    </div>
    <br><br><br><br>

    <div class="container pt-5 rounded-5" style="background-color: #EAF6E7;" data-aos="fade-up" data-aos-delay="200">
      <div class="position-relative" style="top: -100px;">
        <img src="../assets/img/indoor.png" alt="" class="img-fluid w-75">
      </div>

      <div class="section-title text-center mb-3" data-aos="fade-up" data-aos-delay="400">
        <h2 class="fw-bold">Our Client Says</h2>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="600">
        <div id="testimonial-carousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="border border-dark rounded-5">
                <div class="row p-5">
                  <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <img src="../assets/img/gmar.jpg" class="img-fluid rounded-5 profile-pic" >
                  </div>
                  <div class="col-12 col-sm-12 col-md-8 col-lg-8 mt-3">
                    <i class="fa-solid fa-quote-left fa-2xl float-start text-dark"></i>
                    <p class="py-4">Setting it up was a breeze, and the accompanying app is incredibly user-friendly. With its real-time soil moisture monitoring and integration with local weather forecasts, I can ensure my plants receive just the right amount of water, even when I'm away. Its versatility caters to the needs of different plant types, and the convenience of controlling watering schedules from anywhere is unbeatable. Thanks to Plant IQ, gardening has become easier, more efficient, and immensely enjoyable. If you're serious about your garden, this system is a must-have.</p>
                    <i class="fa-solid fa-quote-right fa-2xl float-end text-dark"></i>
                    <div class="d-flex justify-content-between pt-5">
                      <div class="text-start">
                        <label class="fw-bold fs-5">Jhemar Denuevo</label>
                        <p class=""> - Working Student</p>
                      </div>
                      <div class="d-inline-flex my-auto ps-2">
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="border border-dark rounded-5">
                <div class="row p-5">
                  <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <img src="../assets/img/ubana.png" class="img-fluid rounded-5 profile-pic" >
                  </div>
                  <div class="col-12 col-sm-12 col-md-8 col-lg-8 mt-3">
                    <i class="fa-solid fa-quote-left fa-2xl float-start text-dark"></i>
                    <p class="py-4">The Plant IQ has completely transformed the way I care for my plants. From the seamless setup process to the intuitive app interface, every aspect of using this system has been a delight. </p>
                    <i class="fa-solid fa-quote-right fa-2xl float-end text-dark"></i>
                    <div class="d-flex justify-content-between pt-5">
                      <div class="text-start">
                        <label class="fw-bold fs-5">Kian Charles Ubana</label>
                        <p class=""> - Working Student</p>
                      </div>
                      <div class="d-inline-flex my-auto ps-2">
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="border border-dark rounded-5">
                <div class="row p-5">
                  <div class="col-12 col-sm-12 col-md-4 col-lg-4 mt-3">
                    <img src="../assets/img/morente.png" class="img-fluid rounded-5 profile-pic" >
                  </div>
                  <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                    <i class="fa-solid fa-quote-left fa-2xl float-start text-dark"></i>
                    <p class="py-4"> Its versatility in catering to various plant types and the convenience via the app have made tending to my garden more efficient and enjoyable. If you're seeking a smarter, more sustainable way to nurture your plants.</p>
                    <i class="fa-solid fa-quote-right fa-2xl float-end text-dark"></i>
                    <div class="d-flex justify-content-between pt-5 p-0">
                      <div class="text-start">
                        <label class="fw-bold fs-5">Jayniel Morente</label>
                        <p class=""> - Working Student</p>
                      </div>
                      <div class="d-inline-flex my-auto ps-2">
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                        <i class="fa-solid fa-star" style="color: #ffd700;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br>
    </div>
  </div>
</section>

<!-- ======= Contact Section ======= -->
<section id="contact">
<img class="img-fluid float-start d-none d-sm-none d-md-none d-lg-block" src="../assets/img/dot.png" alt="" width="100px" data-aos="fade-right" data-aos-delay="200">
  <div class="container mt-5" data-aos="fade-up">
    <div class="section-title text-center">
      <h2 class="fw-bold text-center">CONTACT</h2>
      <div class="text-center" data-aos="fade-up" data-aos-delay="200">
        <img src="../assets/img/banner.png" class="img-fluid" width="40%">
      </div>
    </div>
    <div class="container" data-aos="fade-up">
      <div class="row rounded-5 border border-light p-4">
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 border border-start-0 border-end-0 border-3 border-success py-3">
          <div class="d-flex align-items-stretch">
            <div class="location my-auto me-3">
              <i class="fa-solid fa-location-dot fa-xl" style="color: #26DB23;"></i>
            </div>
            <div class="div">
              <h4>Location:</h4>
              <p>Biglang Awa St Cor 11th Ave Catleya, Grace Park East, Caloocan, Metro Manila. 1400</p>
            </div>
          </div>
          <div class="d-flex align-items-stretch">
            <div class="email my-auto me-3">
              <i class="fa-solid fa-envelope fa-xl" style="color: #26DB23;"></i>
            </div>
            <div class="div">
              <h4>Email:</h4>
              <p>plantiq.it.ucc2023@gmail.com</p>
            </div>
          </div>
          <div class="d-flex align-items-stretch">
            <div class="phone my-auto me-3">
              <i class="fa-solid fa-phone fa-xl" style="color: #26DB23;"></i>
            </div>
            <div class="div">
              <h4>Call:</h4>
              <p>0966 146 0661</p>
            </div>
          </div>
          <iframe class="rounded-5" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15440.174965675702!2d120.9945888!3d14.653458500000005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b686dd24e859%3A0xe442b57504cbf05f!2sUniversity%20of%20Caloocan%20City%20-%20South%20Campus!5e0!3m2!1sen!2sph!4v1698291916703!5m2!1sen!2sph" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 border border-start-0 border-end-0 border-3 border-success py-3">
        <form method="post">
          <div class="form-floating mb-3">
            <input class="form-control" id="floatingLabel1" name="name">
            <label for="floatingLabel1">Name (Optional) </label>
          </div>

          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" name="email" required>
            <label for="floatingInput">Email address</label>
          </div>

          <div class="form-floating mb-3">
             <input class="form-control" id="floatingLabel" name="subject" required>
            <label for="floatingLabel">Subject</label>
          </div>

          <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="message" required></textarea>
            <label for="floatingTextarea2">Message</label>
          </div>
          
          <div class="text-center mt-3">
            <button class="btn btn-primary rounded-pill fw-semibold w-75" type="submit">Send Message</button>
          </div>
          </form>
        </div>      
      </div>
    </div>
  </div>
</section>
<!-- End Contact Section -->

<img class="img-fluid float-end d-none d-sm-none d-md-none d-lg-block" src="../assets/img/dot.png" alt="" width="100px" data-aos="fade-up" data-aos-delay="200">
<!-- ======= Footer ======= -->
<footer id="footer">
  <div class="container" data-aos="fade-up" data-aos-delay="400">
    <div class="row">
      <div class="col-6 col-sm-6 col-md-3 col-lg-3">
        <a href="index.php" class="navbar-brand">
          <img class="img-fluid" src="../assets/img/title.png" alt="Plant.IQ" width="200px">
        </a>
        <p>
          Biglang Awa St Cor 11th Ave Catleya, 
          Grace Park East, Caloocan, Metro Manila. 1400 <br>
          <br>
          <strong>Phone:</strong> 0966 146 0661<br>
          <strong>Email:</strong> plantiq.it.ucc2023@gmail.com<br><br>
        </p>
      </div>
      <div class="col-6 col-sm-6 col-md-3 col-lg-3">
        <h4>Quick Links</h4>
        <ul class="list-unstyled">
          <li><i class="fa-solid fa-chevron-right"></i> <a href="#home" class="fw-semibold text-decoration-none text-dark scrollto">Home</a>
          <li><i class="fa-solid fa-chevron-right"></i> <a href="#guide" class="fw-semibold text-decoration-none text-dark scrollto">Guide</a>
          <li><i class="fa-solid fa-chevron-right"></i> <a href="#about" class="fw-semibold text-decoration-none text-dark scrollto">About us</a>
          <li><i class="fa-solid fa-chevron-right"></i> <a href="#team" class="fw-semibold text-decoration-none text-dark scrollto">Team</a>
          <li><i class="fa-solid fa-chevron-right"></i> <a href="#contact" class="fw-semibold text-decoration-none text-dark scrollto">Contact</a>
        </ul>
      </div>
      <!--<div class="col-6 col-sm-6 col-md-3 col-lg-3">-->
      <!--  <h4>Useful Links</h4>-->
      <!--  <ul class="list-unstyled">-->
      <!--    <li><i class="fa-solid fa-chevron-right"></i> <a href="#" class="fw-semibold text-decoration-none text-dark">Download</a>-->
      <!--    <li><i class="fa-solid fa-chevron-right"></i> <a href="#" class="fw-semibold text-decoration-none text-dark">Services</a>-->
      <!--    <li><i class="fa-solid fa-chevron-right"></i> <a href="#" class="fw-semibold text-decoration-none text-dark">Terms of service</a>-->
      <!--    <li><i class="fa-solid fa-chevron-right"></i> <a href="#" class="fw-semibold text-decoration-none text-dark">Privacy policy</a>-->
      <!--  </ul>-->
      <!--</div>-->
      <div class="col-6 col-sm-6 col-md-3 col-lg-3">
        <h4>Our Social Networks</h4>
        <p>We invite you to get connected in our social media platforms!</p>
        <div class="social-links mt-3">
          <a href="#" class="twitter"><i class="fa-brands fa-x-twitter fa-xl mx-1" style="color: #26DB23;"></i></a>
          <a href="#" class="facebook"><i class="fa-brands fa-facebook fa-xl mx-1" style="color: #26DB23;"></i></a>
          <a href="#" class="instagram"><i class="fa-brands fa-instagram fa-xl mx-1" style="color: #26DB23;"></i></a>
          <a href="#" class="google"><i class="fa-brands fa-google fa-xl mx-1" style="color: #26DB23;"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>
<br>
<div class="py-4 text-center text-light" style="background-color: #428339">
  &copy; Copyright 2024 <strong><span>Plant.IQ</span></strong>. All rights reserved.
</div>
  <!-- End Footer -->

  <div id="preloader"></div>
  
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center text-decoration-none"><i class="fa-solid fa-arrow-up"></i></a>

  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

  <!-- Vendor JS Files -->
  <script src="../assets/js/aos.js"></script>
  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/glightbox.min.js"></script>
  <script src="../assets/js/swiper-bundle.min.js"></script>
  <script src="../assets/js/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/main.js"></script>

</body>
</html>