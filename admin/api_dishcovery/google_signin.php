<?php
session_start();
include 'dbconfig.php';

// Check if the authorization code is received
if (isset($_GET['code'])) {
    // Received authorization code from Google, exchange it for access token
    $code = $_GET['code'];

    $clientId = "1028273265947-karpptahvldi2499tn663is3e4ulq4gl.apps.googleusercontent.com";
    $clientSecret = "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"; // Replace with your actual client secret
    $redirectUri = "http://localhost/dishcovery/api/google_signin.php";

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
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP response code
    curl_close($ch);

    // Check for HTTP response code and handle accordingly
    if ($httpCode === 200) {
        // HTTP 200 OK, process response
        $data = json_decode($response, true);

        if (isset($data['access_token'])) {
            // Access token obtained, now get user information using the access token
            $accessToken = $data['access_token'];

            $userInfoEndpoint = "https://www.googleapis.com/oauth2/v1/userinfo?access_token=" . $accessToken;
            $userResponse = file_get_contents($userInfoEndpoint);

            if ($userResponse !== false) {
                // User information obtained successfully
                $userData = json_decode($userResponse, true);

                if (isset($userData['email'])) {
                    // Email obtained, now proceed with your logic
                    $email = $userData['email'];
                    $fullName = isset($userData['name']) ? $userData['name'] : '';
                    $profilePicture = isset($userData['picture']) ? file_get_contents($userData['picture']) : ''; // Fetching image data

                    // Check if the email already exists in your database
                    $query = "SELECT * FROM tbl_users WHERE email = '$email'";
                    $result = mysqli_query($conn, $query);

                    if ($result !== false && mysqli_num_rows($result) > 0) {
                        // Email exists, redirect to dashboard
                        $_SESSION['name'] = $userData['name'];
                        $_SESSION['email'] = $userData['email'];
                        header('Location: ../pages/dashboard.php');
                        exit();
                    } else {
                        // Email does not exist, insert the user into the database
                        $query1 = "INSERT INTO tbl_users (`name`, `username`, `email`, `password`, `prof_pic`) 
                                   VALUES ('$fullName', '$email', '$email', '', ?)";
                        $stmt = mysqli_prepare($conn, $query1);

                        if ($stmt !== false) {
                            mysqli_stmt_bind_param($stmt, 'b', $profilePicture); // Bind the image data
                            mysqli_stmt_send_long_data($stmt, 0, $profilePicture); // Send the image data
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);

                            $_SESSION['name'] = $fullName;
                            $_SESSION['email'] = $email;
                            header('Location: ../pages/dashboard.php');
                            exit();
                        } else {
                            // Database insertion failed
                            echo "Error: Unable to prepare statement for user insertion.";
                        }
                    }
                } else {
                    // Email not found in user data
                    echo "Error: Email not found in user data.";
                }
            } else {
                // Failed to fetch user information
                echo "Error: Unable to fetch user information.";
            }
        } else {
            // Access token not found in response
            echo "Error: Access token not found in response.";
        }
    } else {
        // HTTP request failed
        echo "Error: HTTP request to token endpoint failed with HTTP code $httpCode.";
    }
} else {
    // Authorization code not received
    echo "Error: Authorization code not received.";
}
?>
