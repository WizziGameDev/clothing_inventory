<?php

require_once "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data (you may want to add more validation)
    $code = $_POST["code"] ?? "";
    $name = $_POST["name"] ?? "";
    $contact_id = $_POST["contact_id"] ?? "";
    $address_id = $_POST["address_id"] ?? "";

    if (!empty($code) && !empty($name) && !empty($contact_id) && !empty($address_id)) {
        $connection = getConnection();

        // Check Duplicate
        $query_duplicate_check = "SELECT COUNT(*) FROM customer WHERE (contact_id = ? OR address_id = ?) AND code != ?";
        $result_duplicate_check = $connection->prepare($query_duplicate_check);
        $result_duplicate_check->execute([$contact_id, $address_id, $code]);

        $duplicate_count = $result_duplicate_check->fetchColumn();

        if ($duplicate_count == 0) {
            // If Not Duplicate
            $query_update = "UPDATE customer SET name = ?, contact_id = ?, address_id = ? WHERE code = ?";
            $statement = $connection->prepare($query_update);
            $statement->execute([$name, $contact_id, $address_id, $code]);

            header("location: ../../view/viewCustomer.php");

        } else {
            // ERROR
            $errorMessage = "Contact or Address ID Already Use";
            echo "<script>
                alert('$errorMessage');
                window.history.go(-1); 
            </script>";
        }
        $connection = null;

    } else {
        // Handle error not complete
        $errorMessage = "Complete your input";
        header("location: ../../view/viewCustomer.php?error=$errorMessage");
    }
    exit();
}
