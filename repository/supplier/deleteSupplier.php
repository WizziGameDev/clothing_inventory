<?php
require_once "../connection.php";

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $connection = getConnection();

    $delete_supplier = "DELETE FROM supplier WHERE code = ?";
    $statement = $connection->prepare($delete_supplier);
    $statement->execute([$code]);

    $connection = null;
    header("location: ../../view/viewSupplier.php");
    exit();

} else {
    echo "No Supplier Code specified.";
}
