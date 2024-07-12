<?php
include 'php-header.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plant.IQ | Find Plants</title>

  <link rel="icon" href="../assets/img/icon.png">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Open+Sans:wght@300;400;500;600;700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">  <link rel="stylesheet" href="css\node_modules\bootstrap\dist\css\bootstrap.min.css">
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  
  <!-- Main Template -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">

</head>

<style scoped>

  .card img {
    max-width: 100%;
    height: auto;
    object-fit: cover;
    height: 100%; /* Adjust this value to your preference */
  }

  /* Media query for tablet and mobile screens */
  @media (max-width: 768px) {
    .card-body {
      font-size: 12px; /* Adjust the font size as needed */
    }
  }

</style>

<body>

  <!-- CoverPhoto -->
  <?php include '../pages/components/cover.php'; ?>

  <!-- TOP NAVBAR -->
  <?php include '../pages/components/navbar.php'; ?>
  
    <div class="position-relative my-3">
      <input type="text" class="form-control rounded-pill border border-success" id="searchPlant" placeholder="Search for a plant">
      <a href="#" id="search" class="search-button" onclick="searchPlants()">
        <span class="fa fa-search text-dark me-1"></span>
      </a>
    </div>
    
    <div class="container mt-3">
      <h2 class="position-relative">Suggestions:</h2>
    
      <div id="plantSuggestions"></div>
    
      <?php
        $sql = "SELECT * FROM plantiq_recommended ORDER BY plant_name";
        $result = $conn->query($sql);
    
        $plants = array();
    
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $plants[] = array(
              'plantName' => $row['plant_name'],
              'plantImage' => $row['plant_img'],
              'plantDescription' => $row['plant_description']
            );
          }
        }
      ?>
    
      <script>
        const searchPlantInput = document.getElementById('searchPlant');
        const plantSuggestionsContainer = document.getElementById('plantSuggestions');
        const plants = <?php echo json_encode($plants); ?>;
    
        const displayPlants = (plantList) => {
          const plantHTML = plantList.map(plant => `
            <div class="card my-3 rounded-4 border border-success">
              <div class="row g-0">
                <div class="col-5">
                  <img class="img-fluid rounded-4" src="${plant.plantImage}" alt="">
                </div>
                <div class="col-7">
                  <div class="card-body">
                    <h4>${plant.plantName}</h4>
                    <p>${plant.plantDescription}</p>
                  </div>
                </div>
              </div>
            </div>
          `).join('');
    
          plantSuggestionsContainer.innerHTML = plantHTML;
        };
    
        const searchPlants = () => {
          const searchQuery = searchPlantInput.value.toLowerCase();
    
          if (searchQuery.trim() === '') {
            // If search input is empty, display all plants
            displayPlants(plants);
            return;
          }
    
          const filteredPlants = plants.filter(plant => {
            const plantName = plant.plantName.toLowerCase();
            const plantDescription = plant.plantDescription.toLowerCase();
            return plantName.includes(searchQuery) || plantDescription.includes(searchQuery);
          });
    
          displayPlants(filteredPlants);
        };
    
        // Initial display of all plants
        displayPlants(plants);
      </script>
    </div>



  <br> <br> <br> <br>
<!-- BOTTOM NAVBAR -->
<?php include '../pages/components/navbar-bottom.php'; ?>

  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/jquery-3.7.1.min.js"></script>
  <script src="../assets/js/navbarmenu.js"></script>

</body>
</html>