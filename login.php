<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'user_accounts');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // Password should ideally be hashed and verified

    // Check if user exists
    $checkUser = "SELECT * FROM users WHERE username = '?'";
    $result = $conn->query($checkUser);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password (this should be using hashed passwords in production)
        if ($user['password'] === $password) {
            // Password matches, redirect to another page
            header("Location: index.html"); // Change this to your target page
            exit();
        } else {
            // Incorrect password
            echo "<script>
                alert('Incorrect password. Please try again.');
                window.location.href = 'login.html'; // Redirect back to login page
            </script>";
        }
    } else {
        // User not found
        echo "<script>
            alert('User not found. Please signup.');
            window.location.href = 'signup.html'; // Redirect to signup page
        </script>";
    }
}

$conn->close();
?>
