<?php

include "db.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM contacts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $contact = $result->fetch_assoc();

    $stmt->close();

    if (!$contact) {
        die("Contact not found.");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    $sql = "UPDATE contacts
            SET name = ?, email = ?, phone = ?, address = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssi",
        $name,
        $email,
        $phone,
        $address,
        $id
    );

    if ($stmt->execute()) {

        echo "<script>
                alert('Contact updated successfully!');
                window.location.href = 'view_contacts.php';
              </script>";

    } else {

        echo "Error updating contact: " . $stmt->error;
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Contact</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1>CONTACT MANAGEMENT SYSTEM</h1>
        <p>Edit contact details</p>
    </header>

    <nav>
        <a href="index.html">Home</a>
        <a href="add_contact.html">Add Contact</a>
        <a href="view_contacts.php">View Contacts</a>
    </nav>

    <main>

        <div class="form-container">

            <h2>Edit Contact</h2>

            <form method="POST" action="edit_contact.php">

                <input type="hidden" name="id"
                       value="<?php echo $contact['id']; ?>">

                <div class="form-group">
                    <label for="name">Full Name</label>

                    <input type="text"
                           id="name"
                           name="name"
                           value="<?php echo htmlspecialchars($contact['name']); ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>

                    <input type="email"
                           id="email"
                           name="email"
                           value="<?php echo htmlspecialchars($contact['email']); ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>

                    <input type="text"
                           id="phone"
                           name="phone"
                           value="<?php echo htmlspecialchars($contact['phone']); ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>

                    <textarea id="address"
                              name="address"
                              rows="4"><?php echo htmlspecialchars($contact['address']); ?></textarea>
                </div>

                <button type="submit">Update Contact</button>

            </form>

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