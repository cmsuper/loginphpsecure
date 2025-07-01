<?php
$conn = new mysqli("localhost", "root", "root", "loginphpsecure");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $raw_password = $_POST['password'];

    // Hash password dengan SHA-256
    $password = hash("sha256", $raw_password);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Registrasi berhasil!";
    } else {
        echo "Gagal registrasi: " . $stmt->error;
    }

    $stmt->close();
}
?>

<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br>
    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Register">
</form>