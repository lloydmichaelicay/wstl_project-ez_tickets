<?php
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $age = $_POST['age'] ?? 0;
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
 
    $conn = new mysqli ('localhost','root','','ez_tickets');

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    if ($conn->connect_error) {
        die('Connection Failed : '. $conn->connect_error);
    }
    else {
        $stmt = $conn->prepare("insert into user_account (first_name, last_name, gender, age, email, password) values (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $first_name, $last_name, $gender, $age, $email, $hashed_password);
        
        // Validate password match
        if ($password !== $confirm_password) {
            echo "Passwords do not match.";
            exit;
        }

        $stmt->execute();
        echo "Account registration successful";
        header("Location: login.html");
        $stmt->close();
        $conn->close();    
    }




?>