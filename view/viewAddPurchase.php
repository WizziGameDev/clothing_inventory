<?php
session_start();
require_once "../repository/getAllData.php";

// Check session
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}

$data = getAllItem();
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Purchase</title>

        <link rel="stylesheet" href="../assets/style/styleAddPurchase.css">
    </head>
    <body>

        <div class="container">
            <div>
                <!-- HEAD -->
                <h1> ADD PURCHASE SUPPLIER </h1>
            </div>
            <div class="container-purchase">
                <!--TABLE AND PURCHASE -->
                <div class="item">
                    <!-- TABLE ITEM -->
                    <div class="outer-wrapper">
                        <h2> ITEM </h2>
                        <div class="table-wrapper">
                            <table>

                                <tr>
                                    <th>NO</th>
                                    <th>CODE</th>
                                    <th>NAME</th>
                                    <th>PRICE /ITEM</th>
                                    <th width="20%">ACTIONS</th>
                                </tr>

                                <!-- LIST ITEM -->
                                <?php
                                $counter = 1;
                                foreach ($data as $item) {
                                    ?>
                                    <tr>
                                        <td><?= $counter ?></td>
                                        <td><?= $item->getCode() ?></td>
                                        <td><?= $item->getName() ?></td>
                                        <td><?= $item->getPrice() ?></td>
                                        <td>
                                            <div class="td-quantity">
                                                <a href="../repository/purchase_supplier/actionAddPurchase.php?action_type=remove_item&code=<?=$item->getCode()?>&product_name=<?=$item->getName()?>&quantity=1&price=<?=$item->getPrice()?>" class="min">
                                                    MIN
                                                </a>
                                                <a href="../repository/purchase_supplier/actionAddPurchase.php?action_type=add_item&code=<?=$item->getCode()?>&product_name=<?=$item->getName()?>&quantity=1&price=<?=$item->getPrice()?>" class="plus">
                                                    PLUS
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $counter++;
                                } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="item-purchase">
                    <h2> PURCHASE </h2>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th width="20%">Qty</th>
                                    <th width="30%">Total</th>
                                </tr>
                            </thead>

                            <!-- CART -->
                            <tbody>
                                <?php
                                $Total = 0;
                                if (isset($_SESSION['cart'])) {
                                    foreach ($_SESSION['cart'] as $key => $cartItem) {
                                        $totalItem = $cartItem['price'] * $cartItem['quantity'];
                                        $Total += $totalItem;
                                        ?>
                                        <tr>
                                            <td style="padding: 5px"><?= $cartItem['product_name'] ?></td>
                                            <td><?= $cartItem['quantity'] ?></td>
                                            <td><?= $totalItem ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="footer">
                <div class="close">
                    <a href="../repository/purchase_supplier/actionAddPurchase.php?action_type=clear_session" class="button-close">Close</a>
                </div>
                <div class="submit">
                    <label> Total = <?= $Total?></label>
                    <form method="POST" action="../repository/purchase_supplier/actionAddPurchase.php?action_type=submit" class="input-form">
                        <label> Code Supplier <input name="supplier_code"> </label>
                        <br>
                        <button class="button-submit" type="submit">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
        /* ERROR HANDLE*/
        if (isset($_SESSION['error_message'])) {
            $error_message = $_SESSION['error_message'];
            echo "<script>
                    alert('$error_message');
                </script>";
            unset($_SESSION['error_message']);

        } elseif (isset($_SESSION['success_message'])) {
            $success_message = $_SESSION['success_message'];
            echo "<script>
                    alert('$success_message');
                </script>";
            unset($_SESSION['success_message']);
        }
        ?>
    </body>
</html>
