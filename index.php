<!-- Sumber : https://chatgpt.com/c/686149b9-691c-8013-823f-09be2efd3ca4 -->
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
    <a href="logout.php">Logout</a>
</body>

</html>