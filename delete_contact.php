<?php

include "db.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = "DELETE FROM contacts WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        echo "<script>
                alert('Contact deleted successfully!');
                window.location.href = 'view_contacts.php';
              </script>";

    } else {

        echo "Error deleting contact: " . $stmt->error;
    }

    $stmt->close();

} else {

    echo "Invalid contact ID.";
}

$conn->close();

?>