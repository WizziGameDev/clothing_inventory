<?php

require_once "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form
    $code = $_POST["code"] ?? "";
    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $contact_id = $_POST["contact_id"] ?? "";
    $address_id = $_POST["address_id"] ?? "";

    if (!empty($code) && !empty($name) && !empty($email) && !empty($contact_id) && !empty($address_id)) {
        $connection = getConnection();

        // Check Duplicate
        $query_duplicate_check = "SELECT COUNT(*) FROM supplier WHERE (contact_id = ? OR address_id = ?) AND code != ?";
        $statement_duplicate_check = $connection->prepare($query_duplicate_check);
        $statement_duplicate_check->execute([$contact_id, $address_id, $code]);

        $result = $statement_duplicate_check->fetchColumn();

        if ($result == 0) {
            // If Not Duplicate
            $query_update = "UPDATE supplier SET name = ?, email = ?, contact_id = ?, address_id = ? WHERE code = ?";
            $statement = $connection->prepare($query_update);
            $statement->execute([$name, $email, $contact_id, $address_id, $code]);

            header("location: ../../view/viewSupplier.php");

        } else {
            // ERROR
            $errorMessage = "Contact or Address ID Already Use";
            echo "<script>
                alert('$errorMessage');
                window.history.go(-1); 
            </script>";
        }
        $connection = null;
        exit();

    } else {
        // Handle error not complete
        $errorMessage = "Complete your input";
        header("location: ../../view/viewSupplier.php?error=$errorMessage");
        exit();
    }
}
