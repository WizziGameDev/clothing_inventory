<?php

require_once "../connection.php";

// Check from
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data (you may want to add more validation)
    $id = $_POST["id"] ?? "";
    $city = $_POST["city"] ?? "";
    $state = $_POST["state"] ?? "";
    $country = $_POST["country"] ?? "";

    // Check if null
    if (!empty($id) && !empty($city) && !empty($state) && !empty($country)) {
        try {
            $connection = getConnection();

            $query = "UPDATE address SET city = ?, state = ?, country = ? WHERE id = ?";
            $statement = $connection->prepare($query);
            $statement->execute([$city, $state, $country, $id]);
            $connection = null;

            // Redirect after successful update
            header("location: ../../view/viewAddress.php");
            exit();
        } catch (PDOException $e) {
            // Error Update
            $errorMessage = "Error updating address: " . $e->getMessage();
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