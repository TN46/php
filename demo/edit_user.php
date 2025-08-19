<?php
include 'db.php';

// Step 1: Check if we have the user ID in the URL
if (!isset($_GET['id'])) {
    die("❌ User ID missing.");
}

$userID = intval($_GET['id']);

// Step 2: If form is submitted, update the user
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phoneNo = $_POST['phoneNo'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET username=?, age=?, gender=?, phoneNo=?, role=? WHERE userID=?");
    $stmt->bind_param("sisssi", $username, $age, $gender, $phoneNo, $role, $userID);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>✅ User updated successfully!</p>";
        echo "<p><a href='dashboard.php'>Go back to Dashboard</a></p>";
        exit;
    } else {
        echo "<p style='color:red;'>❌ Error: " . $stmt->error . "</p>";
    }
}

// Step 3: Fetch existing user data to fill in the form
$result = $conn->query("SELECT * FROM users WHERE userID = $userID");

if ($result->num_rows !== 1) {
    die("❌ User not found.");
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User - ID <?php echo $userID; ?></h2>
    <form method="POST">
        Name: <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br><br>
        Age: <input type="number" name="age" value="<?php echo $user['age']; ?>" required><br><br>
        Gender:
        <select name="gender" required>
            <option value="Male" <?php if ($user['gender']=="Male") echo "selected"; ?>>Male</option>
            <option value="Female" <?php if ($user['gender']=="Female") echo "selected"; ?>>Female</option>
            <option value="Others" <?php if ($user['gender']=="Others") echo "selected"; ?>>Others</option>
        </select><br><br>
        Phone No: <input type="text" name="phoneNo" value="<?php echo $user['phoneNo']; ?>" required><br><br>
        Role: <input type="text" name="role" value="<?php echo $user['role']; ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>