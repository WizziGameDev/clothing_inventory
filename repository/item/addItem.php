<?php

require_once "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $code = $_POST["code"] ?? "";
    $name = $_POST["name"] ?? "";
    $price = $_POST["price"] ?? "";
    $stock = $_POST["stock"] ?? "";
    $category = $_POST["category"] ?? "";

    // Check if null
    if (!empty($code) && !empty($name) && !empty($price) && !empty($stock) && !empty($category)) {
        try {
            $connection = getConnection();

            $query = "INSERT INTO item (code, name, price, stock, category) VALUES (?,?,?,?,?)";
            $statement = $connection->prepare($query);
            $statement->execute([$code, $name, $price, $stock, $category]);
            $connection = null;

            // Redirect after successful insertion
            header("location: ../../view/viewItem.php");
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
