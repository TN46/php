<?php
include 'db.php'; // Connect to employee_db

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $age = $_POST['age'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $phoneNo = $_POST['phoneNo'] ?? '';
    $role = $_POST['role'] ?? '';

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, age, gender, phoneNo, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $username, $age, $gender, $phoneNo, $role);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>✅ User added successfully!</p>";
        echo "<p><a href='dashboard.php'>Go to Dashboard</a></p>";
    } else {
        echo "<p style='color:red;'>❌ Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New User</title>
</head>
<body>
    <h2>Add New User</h2>
    <form method="POST" action="">
        Name: <input type="text" name="username" required><br><br>
        Age: <input type="number" name="age" required><br><br>
        Gender: 
        <select name="gender" required>
            <option value="">--Select--</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Others">Others</option>
        </select><br><br>
        Phone No: <input type="text" name="phoneNo" required><br><br>
        Role: <input type="text" name="role" required><br><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>