<?php

require_once "../connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $connection = getConnection();

    // Check if the address ID used in customer or supplier
    $check_sql = <<<SQL
        SELECT COUNT(*) as total FROM (
            SELECT 1 FROM customer WHERE address_id = ? 
            UNION 
            SELECT 1 FROM supplier WHERE address_id = ?
        ) AS combined
    SQL;

    $check_statement = $connection->prepare($check_sql);
    $check_statement->execute([$id, $id]);

    // Check statement
    if ($check_statement->fetchColumn()) {
        // If ID is used in customer or supplier
        $errorMessage = "ID already used in customer or supplier.";
        echo "<script>
                alert('$errorMessage');
                window.history.go(-1);
            </script>";
        $connection = null;
    } else {
        // Address is not used
        $delete_address = "DELETE FROM address WHERE id = ?";
        $delete_statement = $connection->prepare($delete_address);
        $delete_statement->execute([$id]);
        $connection = null;

        header("location: ../../view/viewAddress.php");
    }
    exit();

} else {
    echo "No Address ID specified.";
}