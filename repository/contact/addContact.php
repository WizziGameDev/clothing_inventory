<?php

require_once "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form
    $id = $_POST["id"] ?? "";
    $number = $_POST["number"] ?? "";

    // Check if null
    if (!empty($id) && !empty($number)) {
        try {
            $connection = getConnection();

            $query = "INSERT INTO contact (id, number) VALUES (?, ?)";
            $statement = $connection->prepare($query);
            $statement->execute([$id, $number]);
            $connection = null;

            // Redirect if success
            header("location: ../../view/viewContact.php");
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
