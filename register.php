<?php
session_start(); // Start the session

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'nb1';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Check if the data was submitted
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    exit('Please complete the registration form!');
}

// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    exit('Please complete the registration form');
}

// Check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id FROM accounts WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'Username exists, please choose another!';
    } else {
        // Insert new account
        if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
            $stmt->execute();
    
            // Get the ID of the newly created account
            $newUserId = $stmt->insert_id;
    
            // Assign labdarugo records to the new user
            if ($stmt = $con->prepare('UPDATE labdarugo SET felhasznalo_id = ? WHERE felhasznalo_id IS NULL LIMIT 5')) {
                $stmt->bind_param('i', $newUserId);
                $stmt->execute();
            }
    
            // Automatically log the user in by setting session variables
            $_SESSION['loggedin'] = true; // Match 'loggedin' from home.php
            $_SESSION['name'] = $_POST['username']; // Match 'name' from home.php
            $_SESSION['id'] = $newUserId; // Store the user ID in the session

            // Redirect to the home page
            header('Location: home.php');
            exit();
        } else {
            echo 'Could not prepare statement!';
        }
    }
    $stmt->close();
} else {
    echo 'Could not prepare statement!';
}

$con->close();
?>
