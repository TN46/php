<?php
include 'db.php';

// Step 1: Check if ID is given
if (!isset($_GET['id'])) {
    die("❌ User ID missing.");
}

$userID = intval($_GET['id']);

// Step 2: Delete the user
$stmt = $conn->prepare("DELETE FROM users WHERE userID = ?");
$stmt->bind_param("i", $userID);

if ($stmt->execute()) {
    // Redirect back to dashboard after deletion
    header("Location: dashboard.php?msg=User+deleted+successfully");
    exit;
} else {
    echo "<p style='color:red;'>❌ Error: " . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();
?>