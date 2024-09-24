<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'user_accounts');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Password encryption

    // Check if user already exists
    $checkUser = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($checkUser);
    
    if ($result->num_rows > 0) {
        echo "<script>
            alert('User already exists. Please login.');
             window.location.href = 'login.html';
        </script>";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            // Display a JavaScript alert for successful signup
            echo "<script>
                alert('Signup successful! You can now login.');
                window.location.href = 'login.html'; // Redirect to login page after alert
            </script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
    }
}

$conn->close();
?>
