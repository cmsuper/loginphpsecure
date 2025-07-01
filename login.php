<?php
session_start();
require_once 'google-config.php'; // Tambahkan ini

$conn = new mysqli("localhost", "root", "root", "loginphpsecure");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $raw_password = $_POST['password'];
    $password = hash("sha256", $raw_password);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        echo "Login gagal. Username atau password salah.";
    }

    $stmt->close();
}

// Buat URL login Google
$google_login_url = $client->createAuthUrl();
?>

<body>
    <h2>Form Login</h2>
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>

    <hr>
    <p>Atau login dengan akun Google:</p>
    <a href="<?= htmlspecialchars($google_login_url) ?>">
        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png"
            alt="Login with Google">
    </a>
</body>