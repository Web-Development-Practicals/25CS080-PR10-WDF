<?php
require_once "db.php";

// Generate exact local bcrypt hash for 'password123'
$password = "password123";
$hash = password_hash($password, PASSWORD_DEFAULT);

// Reset both accounts
$conn->query("DELETE FROM users WHERE email IN ('admin@charusat.edu.in', '25cs080@charusat.edu.in')");

$stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");

// Insert Admin
$u1 = "admin_user";
$e1 = "admin@charusat.edu.in";
$r1 = "admin";
$stmt->bind_param("ssss", $u1, $e1, $hash, $r1);
$stmt->execute();

// Insert Student
$u2 = "25cs080";
$e2 = "25cs080@charusat.edu.in";
$r2 = "student";
$stmt->bind_param("ssss", $u2, $e2, $hash, $r2);
$stmt->execute();

echo "<h2>Users reset successfully!</h2>";
echo "<p>Password for both accounts is set to: <strong>password123</strong></p>";
echo "<a href='login.php'>Go to Login Page</a>";

$stmt->close();
$conn->close();
?>