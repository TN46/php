<?php

include 'db.php';



$result = $conn->query("SELECT * FROM users");



echo "<h2>User Dashboard</h2>";

echo "<table border='1'>

<tr>

<th>User ID</th>

<th>Name</th>

<th>Age</th>

<th>Gender</th>

<th>Phone</th>

<th>Role</th>

<th>Actions</th>

</tr>";



// Counter for row numbering

$counter = 1;



while ($row = $result->fetch_assoc()) {

    echo "<tr>";

    echo "<td>" . $counter++ . "</td>"; // Increment counter for each row

    echo "<td>" . $row['username'] . "</td>";

    echo "<td>" . $row['age'] . "</td>";

    echo "<td>" . $row['gender'] . "</td>";

    echo "<td>" . $row['phoneNo'] . "</td>";

    echo "<td>" . $row['role'] . "</td>";

    echo "<td>

        <a href='edit_user.php?id=" . $row['userID'] . "'>Edit</a>

        <a href='delete_user.php?id=" . $row['userID'] . "' onclick=\"return confirm('Are you sure?');\">Delete</a>

    </td>";

    echo "</tr>";

}



echo "</table>";

?>