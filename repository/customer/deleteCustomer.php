<?php
require_once "../connection.php";

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $connection = getConnection();

    $delete_customer = "DELETE FROM customer WHERE code = ?";
    $statement = $connection->prepare($delete_customer);
    $statement->execute([$code]);

    $connection = null;
    header("location: ../../view/viewCustomer.php");
    exit();

} else {
    echo "No Customer Code specified.";
}

