<?php session_start();

require_once "../connection.php";
$connection = getConnection();

// Add Item
$action_type = $_GET['action_type'];
if($action_type=='add_item') {

    $code = $_GET['code'];
    $product_name = $_GET['product_name'];
    $quantity = $_GET['quantity'];
    $price = $_GET['price'];

    $product_arr = array(
        'code'=>$code,
        'product_name'=>$product_name,
        'quantity'=>$quantity,
        'price'=>$price,
    );

    if(!empty($_SESSION['cart'])) {

        $product_ids = array_column($_SESSION['cart'], 'code');
        if(in_array($code, $product_ids)) {

            foreach($_SESSION['cart'] as $key => $val) {

                if($_SESSION['cart'][$key]['code'] == $code) {

                    $_SESSION['cart'][$key]['quantity'] = $_SESSION['cart'][$key]['quantity'] + $quantity;

                }
            }
        }
        else {
            $_SESSION['cart'][] = $product_arr;
        }
    }
    else {
        $_SESSION['cart'][] = $product_arr;
    }
    header("location: ../../view/viewAddPurchase.php");
}

// Delete Item
if ($action_type == 'remove_item') {
    $code = $_GET['code'];
    $quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;

    if (!empty($_SESSION['cart'])) {
        $product_ids = array_column($_SESSION['cart'], 'code');

        if (in_array($code, $product_ids)) {
            foreach ($_SESSION['cart'] as $key => $val) {
                if ($_SESSION['cart'][$key]['code'] == $code) {
                    $_SESSION['cart'][$key]['quantity'] -= $quantity;

                    if ($_SESSION['cart'][$key]['quantity'] <= 0) {
                        unset($_SESSION['cart'][$key]);
                    }

                    break;
                }
            }
        }
    }
    header("location: ../../view/viewAddPurchase.php");
    exit();
}

// Clear Session
if (isset($_GET['action_type'])) {
    $action_type = $_GET['action_type'];

    if ($action_type === 'clear_session') {
        unset($_SESSION['cart']);
        header("location: ../../view/viewPurchase.php");
        exit();
    }
}

// Submit to Database
if ($action_type == 'submit') {
    $supplier_code = $_POST['supplier_code'];

    // check cart not null
    if (!empty($_SESSION['cart'])) {

        // check supplier code
        if (!empty($supplier_code)) {

            $query_supplier = "SELECT * FROM supplier WHERE code = ?";
            $statement = $connection->prepare($query_supplier);
            $statement->execute([$supplier_code]);
            $check_code = $statement->rowCount();

            // run if result not null
            if ($check_code != 0) {
                $query_purchase = "INSERT INTO purchase (tgl_purchase, supplier_code) VALUES (NOW(), ?)";
                $statement_purchase = $connection->prepare($query_purchase);
                $statement_purchase->execute([$supplier_code]);
                $id = $connection->lastInsertId();

                /* SQL */
                foreach ($_SESSION['cart'] as $cart_item) {
                    $item_code = $cart_item['code'];
                    $quantity = $cart_item['quantity'];
                    $price = $cart_item['price'];
                    $total_price = $quantity * $price;

                    /* Detail Purchase */
                    $query_detail = "INSERT INTO detail_purchase (purchase_id, item_code, quantity, price, total_price) VALUES (?,?,?,?,?)";
                    $statement_detail = $connection->prepare($query_detail);
                    $statement_detail->execute([$id, $item_code, $quantity, $price, $total_price]);

                    /* Add Stock in Table Item*/
                    $query_item = "UPDATE item SET stock = stock + ? WHERE code = ?";
                    $statement_item = $connection->prepare($query_item);
                    $statement_item->execute([$quantity, $item_code]);

                }

                $connection = null;
                $_SESSION['cart'] = array();
                $_SESSION['success_message'] = "Input Successfully";
                header("location: ../../view/viewAddPurchase.php");
                exit();

            } else {
                /* ELSE supplier code not in database */
                $_SESSION['error_message'] = "Supplier code doesn't exist";
                header("location: ../../view/viewAddPurchase.php");
                exit();
            }
        } else {
            /* ELSE empty supplier code */
            $_SESSION['error_message'] = "Complete your input supplier code";
            header("location: ../../view/viewAddPurchase.php");
            exit();
        }
    } else {
        /* ELSE cart null */
        $_SESSION['error_message'] = "Complete Your Input Cart";
        session_write_close();
        header("location: ../../view/viewAddPurchase.php");
        exit();
    }
}
