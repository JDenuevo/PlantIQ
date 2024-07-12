<?php
session_start();
include 'userconfig.php';


// Check if the authorization code is received
if (isset($_GET['code'])) {
  // Received authorization code from Google, exchange it for access token
  $code = $_GET['code'];

  $clientId = "844690144383-ffudsfqmt0cusgd54fl737h358r9aeno.apps.googleusercontent.com";
  $clientSecret = "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"; // Replace with your actual client secret
  $redirectUri = "https://app.plantiq.info/php/checker.php";

  $tokenEndpoint = "https://oauth2.googleapis.com/token";
  $params = array(
    "code" => $code,
    "client_id" => $clientId,
    "client_secret" => $clientSecret,
    "redirect_uri" => $redirectUri,
    "grant_type" => "authorization_code"
  );

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $tokenEndpoint);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);

  $data = json_decode($response, true);

  if (isset($data['access_token'])) {
    // Access token obtained, now get user information using the access token
    $accessToken = $data['access_token'];

    $userInfoEndpoint = "https://www.googleapis.com/oauth2/v1/userinfo?access_token=" . $accessToken;
    $userResponse = file_get_contents($userInfoEndpoint);
    $userData = json_decode($userResponse, true);
    if (isset($userData['email'])) {
      // Email obtained, now proceed with your logic
      $email = $userData['email'];

      // Check if the email already exists in your database
      $query = "SELECT * FROM plantiq_login WHERE email = '$email'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        // Email exists, redirect to dashboard
        $_SESSION['fullName'] = $userData['name'];
        $_SESSION['email'] = $userData['email'];
        $_SESSION['status'] = "Logged In";
        header('Location: ../pages/home.php');
        exit();
      } else {
        // Email does not exist, insert the user into the database
        $fullName = isset($userData['name']) ? $userData['name'] : '';
        $query1 = "INSERT INTO plantiq_login SET
          `fullname`='$fullName',
          `username`='$email',
          `email`='$email',
          `password`=''
          ";
        $query_run1 = mysqli_query($conn, $query1);

        if ($query_run1) {
          $_SESSION['fullName'] = $userData['name'];
          $_SESSION['email'] = $userData['email'];
          $_SESSION["status"] = "Logged In";
          header('Location: ../pages/home.php');
            exit();
        } else {
          echo "Error: " . mysqli_error($conn);
        }
        
      }
    } 
}
}
?>
