<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "rangasala";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $match = $_POST['match'];
    $ticket_type = $_POST['ticket-type'];
    $quantity = $_POST['quantity'];
    $name = $_POST['name'];
    $email = $_POST['email'];

     
    $stmt = $conn->prepare("INSERT INTO booking (match_name, ticket_type, quantity, name, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiis", $match, $ticket_type, $quantity, $name, $email);

    
    if ($stmt->execute()) {
        
        echo "<p>Booking successful! Your tickets have been reserved.</p>";
    } else {
        
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    
    $stmt->close();
}


$conn->close();
?>