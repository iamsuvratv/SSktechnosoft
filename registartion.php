<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are provided
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
        // Retrieve form data
        $name = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Validate form data (you should add more validation as needed)
        if ($password != $confirm_password) {
            echo "Passwords do not match. Please try again.";
        } else {
            // Connect to your database (replace with your connection code)
            $db_host = 'localhost';
            $db_user = 'root';
            $db_pass = '';
            $db_name = 'ssk technosoft';

            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data into the database (you should use prepared statements for better security)
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

            if (mysqli_query($conn, $sql)) {
                echo "Registration successful!";
                // Optionally, you can redirect the user to the login page after successful registration
                // header("Location: login.html");
                // exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
    } else {
        echo "Please provide all required information.";
    }
}
?>
