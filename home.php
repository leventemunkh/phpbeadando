<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpbeadando/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link href="/phpbeadando/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body class="loggedin">
    <nav class="navtop">
        <div>
            <h1>Website Title</h1>
            <a href="/phpbeadando/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="/phpbeadando/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            <a href="/phpbeadando/pdf_generator.php">PDF generator</a>
        </div>
    </nav>
    <div class="content">
        <h2>Home Page</h2>
        <div>
            <p>Welcome back, <?=htmlspecialchars($_SESSION['name'], ENT_QUOTES)?>!</p>
        </div>
    </div>
</body>
</html>