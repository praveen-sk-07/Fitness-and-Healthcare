<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitness";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the encrypted password from the database
$sql = "SELECT encrypted_password FROM users WHERE id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the encrypted password
    $row = $result->fetch_assoc();
    $encryptedPassword = $row['encrypted_password'];
    
    // Decryption details
    $encryptionKey = 'your-encryption-key'; // The key used for encryption
    $iv = 'your-initialization-vector'; // The initialization vector used during encryption

    // Decrypt the password
    $decryptedPassword = openssl_decrypt($encryptedPassword, 'AES-256-CBC', $encryptionKey, 0, $iv);

    echo 'Decrypted Password: ' . $decryptedPassword;
} else {
    echo "No results found";
}

$conn->close();
?>