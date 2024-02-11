<?php
require_once "../repository/getAllData.php";
session_start();

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
        <title>Item</title>

        <link rel="stylesheet" href="../assets/style/styleItem.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body>
        <div class="container">
            <!-- START NAV -->
            <div class="navigation">
                <nav class="sidebar">
                    <ul>
                        <li class="logo_app">
                            <img class="text_logo" src="../assets/image/logo.png" alt="text_logo">
                        </li>
                        <li>
                            <a href="viewDashboard.php">
                                <span class="material-icons">dashboard</span>
                                <span class="nav-name">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="viewCustomer.php">
                                <span class="material-icons">people</span>
                                <span class="nav-name">Customer</span>
                            </a>
                        </li>
                        <li>
                            <a href="viewSupplier.php">
                                <span class="material-icons">local_shipping</span>
                                <span class="nav-name">Supplier</span>
                            </a>
                        </li>
                        <li>
                            <a href="viewContact.php">
                                <span class="material-icons">contacts</span>
                                <span class="nav-name">Contact</span>
                            </a>
                        </li>
                        <li>
                            <a href="viewAddress.php">
                                <span class="material-icons">pin_drop</span>
                                <span class="nav-name">Address</span>
                            </a>
                        </li>
                        <li>
                            <a href="viewItem.php">
                                <span class="material-icons">category</span>
                                <span class="nav-name">Item</span>
                            </a>
                        </li>
                        <li>
                            <a href="viewSale.php">
                                <span class="material-icons">point_of_sale</span>
                                <span class="nav-name">Sale</span>
                            </a>
                        </li>
                        <li>
                            <a href="viewPurchase.php">
                                <span class="material-icons">shopping_cart</span>
                                <span class="nav-name">Purchase</span>
                            </a>
                        </li>
                        <li>
                            <a href="../repository/logOut.php" class="btn-logout">
                                <span class="material-icons">logout</span>
                                <span class="nav-name">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- END NAV -->

            <!-- START CONTENT -->
            <div class="content-container">
                <!-- Head -->
                <div class="header">
                    <h1>ITEM MANAGEMENT</h1>
                </div>

                <!-- Controller -->
                <div class="controller">
                    <a href="#" class="button-add">ADD ITEM</a>
                </div>

                <!-- START POP UP ADD -->
                <div class="popup-add">
                    <div class="popup-content">
                        <h1> ADD DATA FOR ITEM </h1>
                        <form method="POST" action="../repository/item/addItem.php" class="form-popup">
                            <div class="input-form">
                                <label>CODE</label>
                                <input type="text" id="add-code-input" class="input" name="code">
                            </div>
                            <div class="input-form">
                                <label>Name</label>
                                <input type="text" id="add-name-input" class="input" name="name">
                            </div>
                            <div class="input-form">
                                <label>PRICE</label>
                                <input type="text" id="add-price-input" class="input" name="price">
                            </div>
                            <div class="input-form">
                                <label>STOCK</label>
                                <input type="text" id="add-stock-input" class="input" name="stock">
                            </div>
                            <div class="input-form">
                                <label>CATEGORY</label>
                                <input type="text" id="add-category-input" class="input" name="category">
                            </div>
                            <div class="button-form">
                                <a href="#" class="btn-close"> CLOSE </a>
                                <button type="submit" class="btn-submit"> SUBMIT </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END POP UP ADD -->

                <!-- START POP UP EDIT -->
                <div class="popup-edit">
                    <div class="popup-content">
                        <h1> EDIT DATA FOR ITEM </h1>
                        <form method="POST" action="../repository/item/editItem.php" class="form-popup">
                            <div class="input-form">
                                <label>CODE</label>
                                <input type="text" id="edit-code-input" class="input" name="code" readonly>
                            </div>
                            <div class="input-form">
                                <label>Name</label>
                                <input type="text" id="edit-name-input" class="input" name="name">
                            </div>
                            <div class="input-form">
                                <label>PRICE</label>
                                <input type="text" id="edit-price-input" class="input" name="price">
                            </div>
                            <div class="input-form">
                                <label>STOCK</label>
                                <input type="text" id="edit-stock-input" class="input" name="stock">
                            </div>
                            <div class="input-form">
                                <label>CATEGORY</label>
                                <input type="text" id="edit-category-input" class="input" name="category">
                            </div>
                            <div class="button-form">
                                <a href="#" class="btn-close"> CLOSE </a>
                                <button type="submit" class="btn-submit"> SUBMIT </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- START POP UP EDIT -->

                <!-- START TABLE -->
                <div class="outer-wrapper">
                    <div class="table-wrapper">
                        <table>
                            <!-- Header -->
                            <tr>
                                <th>NO</th>
                                <th>CODE</th>
                                <th>NAME</th>
                                <th>PRICE /ITEM</th>
                                <th>STOCK</th>
                                <th>CATEGORY</th>
                                <th class="change">ACTIONS</th>
                            </tr>

                            <!-- Value -->
                            <?php
                            $counter = 1;
                            foreach ($data as $item) { ?>
                                <tr>
                                    <td><?= $counter ?></td>
                                    <td><?= $item->getCode() ?></td>
                                    <td><?= $item->getName()?></td>
                                    <td><?= $item->getPrice()?></td>
                                    <td><?= $item->getStock()?></td>
                                    <td><?= $item->getCategory()?></td>
                                    <td>
                                        <div class="button-control">
                                            <a href="#" class="button-edit" data-code="<?=$item->getCode()?>" data-name="<?= $item->getName()?>" data-price="<?= $item->getPrice()?>" data-stock="<?= $item->getStock()?>" data-category="<?= $item->getCategory()?>">EDIT</a>
                                            <a href="../repository/item/deleteItem.php?code=<?= $item->getCode() ?>" class="button-delete">DELETE</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $counter++;
                            } ?>
                        </table>
                    </div>
                </div>
                <!-- END TABLE -->
            </div>
            <!-- END CONTENT-->
        </div>


        <!-- JS -->
        <script src="../assets/js/script.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                itemPopUp();
            });
        </script>
    </body>
</html>