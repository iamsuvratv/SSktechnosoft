<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the email and password are provided
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        // Replace with your database connection code
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'ssk technosoft';

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        // Validate user credentials (you should improve this with prepared statements)
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['username'];
                header("Location: index.html"); // Redirect to a welcome page upon successful login
                exit();
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "User not found!";
        }

        mysqli_close($conn);
    } else {
        echo "Please provide both email and password.";
    }
}
?>
