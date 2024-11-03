<tbody>
<?php
// Fetch courses from the database
$sql = "SELECT * FROM Course";
$stmt = $pdo->query($sql);

while ($course = $stmt->fetch()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($course['Id']) . "</td>";
    echo "<td>" . htmlspecialchars($course['Title']) . "</td>";
    echo "<td>" . "Teacher Name" . "</td>"; // Replace with teacher name if available
    echo "<td>" . "Category Name" . "</td>"; // Replace with actual category if available
    echo "<td>" . htmlspecialchars($course['Start_date']) . "</td>";
    echo "<td>
        <a href= class='btn btn-primary btn-sm'>Edit</a>
        <a href='delete-course.php?id=" . $course['Id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this course?\")'>Delete</a>
    </td>";
    echo "</tr>";
}
?>
</tbody>
