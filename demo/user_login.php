<?php
// database connection
$conn = new mysqli("localhost", "username", "password", "database_name");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    $userID = $_POST['userID'];
    $username = $_POST['username'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phoneNO = $_POST['phoneNO'];
    $role = $_POST['role'];

    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO users (userID, username, age, gender, phoneNO, role) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $userID, $username, $age, $gender, $phoneNO, $role);

    if ($stmt->execute()) {
        echo "User details saved successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<form method="post" action="">
    UserID: <input type="text" name="userID" required><br>
    Username: <input type="text" name="username" required><br>
    Age: <input type="number" name="age" required><br>
    Gender: 
    <select name="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select><br>
    Phone No: <input type="text" name="phoneNO" required><br>
    Role: <input type="text" name="role" required><br>
    <button type="submit" name="save">Save</button>
</form>
