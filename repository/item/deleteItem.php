<?php
require_once "../connection.php";

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $connection = getConnection();

    $delete_item = "DELETE FROM item WHERE code = ?";
    $statement = $connection->prepare($delete_item);
    $statement->execute([$code]);

    $connection = null;
    header("location: ../../view/viewItem.php");
    exit();

} else {
    echo "No Customer Code specified.";
}

