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

            $query = "UPDATE contact SET number = ? WHERE id = ?";
            $statement = $connection->prepare($query);
            $statement->execute([$number, $id]);
            $connection = null;

            // Redirect if success
            header("location: ../../view/viewContact.php");
            exit();
        } catch (PDOException $e) {
            // Handle Error Update
            $errorMessage = "Error updating contact: " . $e->getMessage();
            echo "<script>
                alert('$errorMessage');
                window.history.go(-1);
            </script>";
            exit();
        }
    } else {
        // Handle error not complete
        $errorMessage = "Complete your input";
        echo "<script>
                alert('$errorMessage');
                window.history.go(-1); 
            </script>";
        exit();
    }
}