<?php

require_once "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form
    $code = $_POST["code"] ?? "";
    $name = $_POST["name"] ?? "";
    $contact_id = $_POST["contact_id"] ?? "";
    $address_id = $_POST["address_id"] ?? "";

    if (!empty($code) && !empty($name) && !empty($contact_id) && !empty($address_id)) {
        try {

            $connection = getConnection();

            // query contact
            $query_contact = "SELECT * FROM customer WHERE contact_id = ?";
            $statement_contact = $connection->prepare($query_contact);
            $statement_contact->execute([$contact_id]);

            // query address
            $query_address = "SELECT * FROM customer WHERE address_id = ?";
            $statement_address = $connection->prepare($query_address);
            $statement_address->execute([$address_id]);

            // Error handle contact
            if($statement_contact->fetch()) {
                $errorMessage = "ID Contact Already Use";
                echo "<script>
                alert('$errorMessage');
                window.history.go(-1); 
            </script>";
                $connection = null;
                exit();
            }

            // Error handle customer
            if($statement_address->fetch()) {
                $errorMessage = "ID Address Already Use";
                echo "<script>
                alert('$errorMessage');
                window.history.go(-1); 
            </script>";
                $connection = null;
                exit();
            }

            // If success
            $query_success = "INSERT INTO customer VALUES (?,?,?,?)";
            $statement = $connection->prepare($query_success);
            $statement->execute([$code, $name, $contact_id, $address_id]);

            $connection = null;
            header("location: ../../view/viewCustomer.php");
            exit();

        } catch (PDOException $e) {
        // Handle if primary key same
        $errorMessage = "ID already exists. Use another ID.";
        echo "<script>
                alert('$errorMessage');
                window.history.go(-1);
            </script>";
        $connection = null;
        exit();
        }

    } else {
        // Handle error not complete
        $errorMessage = "Complete your input";
        echo "<script>
                alert('$errorMessage');
                window.history.go(-1); 
            </script>";
        $connection = null;
        exit();
    }
}