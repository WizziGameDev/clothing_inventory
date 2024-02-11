<?php
require_once "../repository/getAllData.php";
session_start();

// Check session
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}

$data = getAllAddress();
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Address</title>

        <link rel="stylesheet" href="../assets/style/styleAddress.css">
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
                    <h1>ADDRESS MANAGEMENT</h1>
                </div>

                <!-- Controller -->
                <div class="controller">
                    <a href="#" class="button-add">ADD ADDRESS</a>
                </div>

                <!-- START POP UP ADD -->
                <div class="popup-add">
                    <div class="popup-content">
                        <h1> ADD DATA ADDRESS </h1>
                        <form method="POST" action="../repository/address/addAddress.php" class="form-popup">
                            <div class="input-form">
                                <label>ID</label>
                                <input type="text" id="add-id-input" class="input" name="id">
                            </div>
                            <div class="input-form">
                                <label>City</label>
                                <input type="text" id="add-city-input" class="input" name="city">
                            </div>
                            <div class="input-form">
                                <label>State</label>
                                <input type="text" id="add-state-input" class="input" name="state">
                            </div>
                            <div class="input-form">
                                <label>Country</label>
                                <input type="text" id="add-country-input" class="input" name="country">
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
                        <h1> EDIT DATA ADDRESS </h1>
                        <form method="POST" action="../repository/address/editAddress.php" class="form-popup">
                            <div class="input-form">
                                <label>ID</label>
                                <input type="text" id="edit-id-input" class="input" name="id" readonly>
                            </div>
                            <div class="input-form">
                                <label>City</label>
                                <input type="text" id="edit-city-input" class="input" name="city">
                            </div>
                            <div class="input-form">
                                <label>State</label>
                                <input type="text" id="edit-state-input" class="input" name="state">
                            </div>
                            <div class="input-form">
                                <label>Country</label>
                                <input type="text" id="edit-country-input" class="input" name="country">
                            </div>
                            <div class="button-form">
                                <a href="#" class="btn-close"> CLOSE </a>
                                <button type="submit" class="btn-submit"> SUBMIT </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END POP UP EDIT -->

                <!-- START TABLE -->
                <div class="outer-wrapper">
                    <div class="table-wrapper">
                        <table>
                            <!-- Header -->
                            <tr>
                                <th>NO</th>
                                <th>ID</th>
                                <th>CITY</th>
                                <th>STATE</th>
                                <th>COUNTRY</th>
                                <th class="change">ACTIONS</th>
                            </tr>

                            <!-- Value -->
                            <?php
                            $counter = 1;
                            foreach ($data as $address) { ?>
                                <tr>
                                    <td><?= $counter ?></td>
                                    <td><?= $address->getId() ?></td>
                                    <td><?= $address->getCity()?></td>
                                    <td><?= $address->getState()?></td>
                                    <td><?= $address->getCountry()?></td>
                                    <td>
                                        <div class="button-control">
                                            <a href="#" class="button-edit" data-id="<?=$address->getId()?>" data-city="<?= $address->getCity()?>" data-state="<?= $address->getState()?>" data-country="<?= $address->getCountry()?>">EDIT</a>
                                            <a href="../repository/address/deleteAddress.php?id=<?= $address->getId() ?>" class="button-delete">DELETE</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $counter++;
                            } ?>
                        </table>
                    </div>
                </div>
                <!-- END TABLE-->
            </div>
            <!-- END CONTENT-->
        </div>

        <!-- JS -->
        <script src="../assets/js/script.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                addressPopUp();
            });
        </script>
    </body>
</html>