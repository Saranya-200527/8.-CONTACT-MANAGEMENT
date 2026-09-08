<?php

include "db.php";

$sql = "SELECT * FROM contacts ORDER BY id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Contacts</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1>CONTACT MANAGEMENT SYSTEM</h1>
        <p>View all contacts</p>
    </header>

    <nav>
        <a href="index.html">Home</a>
        <a href="add_contact.html">Add Contact</a>
        <a href="view_contacts.php">View Contacts</a>
    </nav>

    <main>

        <div class="contacts-container">

            <h2>Contact List</h2>

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {

                    ?>

                    <tr>

                        <td><?php echo $row["id"]; ?></td>

                        <td><?php echo htmlspecialchars($row["name"]); ?></td>

                        <td><?php echo htmlspecialchars($row["email"]); ?></td>

                        <td><?php echo htmlspecialchars($row["phone"]); ?></td>

                        <td><?php echo htmlspecialchars($row["address"]); ?></td>

                        <td>

                            <a href="edit_contact.php?id=<?php echo $row["id"]; ?>">
                                Edit
                            </a>

                            <a href="delete_contact.php?id=<?php echo $row["id"]; ?>"
                               onclick="return confirm('Are you sure you want to delete this contact?');">
                                Delete
                            </a>

                        </td>

                    </tr>

                    <?php

                        }

                    } else {

                        echo "<tr>
                                <td colspan='6'>No contacts found.</td>
                              </tr>";

                    }

                    ?>

                </tbody>

            </table>

        </div>

    </main>

    <footer>
        <p>&copy; 2026 Contact Management System</p>
    </footer>

    <script src="script.js"></script>

</body>

</html>

<?php

$conn->close();

?>