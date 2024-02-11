<?php
require_once "../connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate form
        $id = $_POST["id"] ?? "";
        $city = $_POST["city"] ?? "";
        $state = $_POST["state"] ?? "";
        $country = $_POST["country"] ?? "";

    // Check if null
    if (!empty($id) && !empty($city) && !empty($state) && !empty($country)) {
        try {
            $connection = getConnection();

            $query = "INSERT INTO address (id, city, state, country) VALUES (?,?,?,?)";
            $statement = $connection->prepare($query);
            $statement->execute([$id, $city, $state, $country]);
            $connection = null;

            // Redirect after successful insertion
            header("location: ../../view/viewAddress.php");
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
