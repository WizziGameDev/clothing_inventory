<?php

use Cassandra\Date;

require_once "../model/contactModel.php";
require_once "../model/addressModel.php";
require_once "../model/customerModel.php";
require_once "../model/supplierModel.php";
require_once "../model/itemModel.php";
require_once "../model/purchaseModel.php";
require_once "../model/saleModel.php";
require_once "connection.php";

// Contact
function getAllContact(): array
{
    $connection = getConnection();
    $sql = "SELECT * FROM contact";
    $result = $connection ->query($sql);

    $array = [];

    while ($row = $result->fetch())
        $array[] = new Contact(
            id: $row["id"],
            number: $row["number"]
        );

    return $array;
}

// Address
function getAllAddress(): array
{
    $connection = getConnection();
    $sql = "SELECT * FROM address";
    $result = $connection->query($sql);

    $array = [];

    while ($row = $result->fetch())
        $array[] = new Address(
            id: $row["id"],
            city: $row["city"],
            state: $row["state"],
            country: $row["country"]
        );

    return $array;
}

// Customer
function getAllCustomer(): array
{
    $connection = getConnection();
    $sql = "SELECT * FROM customer";
    $result = $connection ->query($sql);

    $array = [];

    while ($row = $result->fetch())
        $array[] = new Customer(
            code: $row["code"],
            name: $row["name"],
            contact_id: $row["contact_id"],
            address_id: $row["address_id"]
        );

    return $array;
}

// Supplier
function getAllSupplier(): array
{
    $connection = getConnection();
    $sql = "SELECT * FROM supplier";
    $result = $connection ->query($sql);

    $array = [];

    while ($row = $result->fetch())
        $array[] = new Supplier(
            code: $row["code"],
            name: $row["name"],
            email: $row["email"],
            contact_id: $row["contact_id"],
            address_id: $row["address_id"]
        );

    return $array;
}

// Item
function getAllItem(): array
{
    $connection = getConnection();
    $sql = "SELECT * FROM item";
    $result = $connection ->query($sql);

    $array = [];

    while ($row = $result->fetch())
        $array[] = new Item(
            code: $row["code"],
            name: $row["name"],
            price: $row["price"],
            stock: $row["stock"],
            category: $row["category"]
        );

    return $array;
}

// Transaction Supplier
/**
 * @throws Exception
 */
function getAllPurchase(): array
{
    $connection = getConnection();
    $query = "SELECT 
        p.id AS purchase_id,
        p.tgl_purchase,
        p.supplier_code,
        SUM(dp.quantity) AS quantity,
        SUM(dp.total_price) AS total_price
    FROM 
        purchase p
    JOIN 
        detail_purchase dp ON p.id = dp.purchase_id
    GROUP BY 
        p.id, p.tgl_purchase, p.supplier_code";

    $result = $connection->query($query);

    $array = [];

    // Data to Array
    while ($row = $result->fetch()) {
        $tgl_purchase = new DateTime($row['tgl_purchase']);

        $array[] = new Purchase(
          id: $row['purchase_id'],
          tgl_purchase: $tgl_purchase,
          supplier_code: $row['supplier_code'],
          quantity: $row["quantity"],
          total_price: $row['total_price']
        );
    }
    return $array;
}

// Sale Customer
/**
 * @throws Exception
 */
function getAllSale(): array
{
    $connection = getConnection();
    $query = "SELECT 
        s.id AS sale_id,
        s.tgl_sale,
        s.customer_code,
        SUM(ds.quantity) AS quantity,
        SUM(ds.total_price) AS total_price
    FROM 
        sale s
    JOIN 
        detail_sale ds ON s.id = ds.sale_id
    GROUP BY 
        s.id, s.tgl_sale, s.customer_code";

    $result = $connection->query($query);

    $array = [];

    // Data to Array
    while ($row = $result->fetch()) {
        $tgl_sale = new DateTime($row['tgl_sale']);

        $array[] = new Sale(
            id: $row['sale_id'],
            tgl_sale: $tgl_sale,
            customer_code: $row['customer_code'],
            quantity: $row["quantity"],
            total_price: $row['total_price']
        );
    }
    return $array;
}

// DASHBOARD //
function getTotalSales()
{
    $connection = getConnection();
    $sql = "SELECT COUNT(*) AS total_sales FROM sale;";
    $result = $connection->query($sql);

    if ($result) {
        $row = $result->fetch();
        return $row ? $row['total_sales'] : 0;
    } else {
        return false;
    }
}

function getTotalPurchase()
{
    $connection = getConnection();
    $sql = "SELECT COUNT(*) AS total_purchase FROM purchase;";
    $result = $connection->query($sql);

    if ($result) {
        $row = $result->fetch();
        return $row ? $row['total_purchase'] : 0;
    } else {
        return false; // Return false on query error
    }
}

function getTotalCustomer()
{
    $connection = getConnection();
    $sql = "SELECT COUNT(*) AS total_customer FROM customer";
    $result = $connection->query($sql);

    if ($result) {
        $row = $result->fetch();
        return $row ? $row['total_customer'] : 0;
    } else {
        return false; // Return false on query error
    }
}

function getTotalSupplier()
{
    $connection = getConnection();
    $sql = "SELECT COUNT(*) AS total_supplier FROM supplier";
    $result = $connection->query($sql);

    if ($result) {
        $row = $result->fetch();
        return $row ? $row['total_supplier'] : 0;
    } else {
        return false; // Return false on query error
    }
}

// Recent Sale
function getRecentSale():array
{
    $connection = getConnection();
    $sql = "SELECT * FROM sale ORDER BY id DESC LIMIT 4;";
    $result = $connection->query($sql);

    $array = [];

    while ($row = $result->fetch()) {
        $saleData = [
            'id' => $row['id'],
            'tgl_sale' => $row['tgl_sale'],
            'customer_code' => $row['customer_code']
        ];

        // Menambah array asosiatif ke dalam array utama
        $array[] = $saleData;
    }

    return $array;
}

//Recent Purchase
function getRecentPurchase():array
{
    $connection = getConnection();
    $sql = "SELECT * FROM purchase ORDER BY id DESC LIMIT 4;";
    $result = $connection->query($sql);

    $array = [];

    while ($row = $result->fetch()) {
        $saleData = [
            'id' => $row['id'],
            'tgl_purchase' => $row['tgl_purchase'],
            'supplier_code' => $row['supplier_code']
        ];

        // Menambah array asosiatif ke dalam array utama
        $array[] = $saleData;
    }

    return $array;
}