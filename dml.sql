
# Dashboard
-- Total Sale
SELECT COUNT(*) AS total_sales FROM sale;

-- Total Purchase
SELECT COUNT(*) AS total_purchase FROM purchase;

-- Total Customer
SELECT COUNT(*) AS total_customer FROM customer;

-- Total Supplier
SELECT COUNT(*) AS total_supplier FROM supplier;

-- Recent Sale
SELECT * FROM sale ORDER BY id DESC LIMIT 4;

-- Recent Sale
SELECT * FROM purchase ORDER BY id DESC LIMIT 4;

#  Address
-- insert
INSERT INTO address (`id`, `city`, `state`, `country`) VALUES
('ADC01', 'Tulungagung', 'Jawa Timur', 'Indonesia'),
('ADC02', 'Malang', 'Jawa Timur', 'Indonesia'),
('ADC03', 'Bandung', 'Jawa Barat', 'Indonesia'),
('ADC04', 'Surabaya', 'Jawa Timur', 'Indonesia'),
('ADC05', 'Sidoarjo', 'Jawa Timur', 'Indonesia'),
('ADS01', 'Blitar', 'Jawa Timur', 'Indonesia'),
('ADS02', 'Jombang', 'Jawa Timur', 'Indonesia'),
('ADS03', 'Solo', 'Jawa Timur', 'Indonesia'),
('ADS04', 'Banyuwangi', 'Jawa Timur', 'Indonesia'),
('ADS05', 'Kediri', 'Jawa Timur', 'Indonesia');

-- read
SELECT * FROM address;

-- update
UPDATE address SET city = 'Jomabang', state = 'Jawa Timur', country = 'Indonesia' WHERE id = 'ADC01';

-- delete
DELETE FROM address WHERE id = 'ADC01';

# Contact
-- insert
INSERT INTO contact (`id`, `number`) VALUES
('CTC01', 876575435424),
('CTC02', 876575435423),
('CTC03', 876575435456),
('CTC04', 856775433908),
('CTC05', 843575430909),
('CTS02', 890575435567),
('CTS03', 898575435876),
('CTS04', 878587435675),
('CTS05', 858543435076);

-- read
SELECT * FROM contact;

-- update
UPDATE contact SET number = '896543232122' WHERE id = 'CTC01';

-- delete
DELETE FROM contact WHERE id =  'CTC01';

# Customer
-- insert
INSERT INTO customer (`code`, `name`, `contact_id`, `address_id`) VALUES
('CS01', 'Adam', 'CTC01', 'ADC01'),
('CS02', 'Sikki', 'CTC02', 'ADC02'),
('CS03', 'Jelita', 'CTC03', 'ADC03'),
('CS04', 'Ita', 'CTC04', 'ADC04'),
('CS05', 'Juna', 'CTC05', 'ADC05');

-- read
SELECT * from customer;

-- update
UPDATE customer SET  name = 'Dito', contact_id = 'CTC05', address_id = 'ADC05' WHERE code = 'CS01';

-- delete
DELETE FROM customer WHERE code = 'CS01';

# Supplier
-- insert
INSERT INTO `supplier` (`code`, `name`, `email`, `contact_id`, `address_id`) VALUES
('SP01', 'Didit', 'didit@gmail.com', 'CTS01', 'ADS01'),
('SP02', 'Juma', 'juma@gmail.com', 'CTS02', 'ADS02'),
('SP03', 'Dilanda', 'dilan@gmail.com', 'CTS03', 'ADS03'),
('SP04', 'Buma', 'buma@Gmail.com', 'CTS04', 'ADS04'),
('SP05', 'Dito Ganteng', 'ditogaming@gmail.com', 'CTS05', 'ADS05');

-- read
SELECT * FROM supplier;

-- update
UPDATE customer SET  name = 'Dito', contact_id = 'CTC05', address_id = 'ADS05' WHERE code = 'SP01';

-- delete
DELETE FROM customer WHERE code = 'SP01';

# Item
-- insert
INSERT INTO item (`code`, `name`, `price`, `stock`, `category`) VALUES
('CA15', 'Cardigan', 120000, 49, 'Outer'),
('CO24', 'Coat', 200000, 41, 'Outer'),
('DR24', 'Dress', 125000, 60, 'Bottoms'),
('GT08', 'Graphic Tees', 60000, 101, 'Tops'),
('JA11', 'Jacket', 150000, 23, 'Outer'),
('PS02', 'Polo Shirt', 80000, 79, 'Tops'),
('SW05', 'Sweatshirt', 50000, 80, 'Tops'),
('SW08', 'Sweater', 100000, 62, 'Tops'),
('TA04', 'Tanks', 20000, 100, 'Tops'),
('TS12', 'T Shirt', 30000, 59, 'Tops');

-- read
SELECT * FROM item;

-- update
UPDATE item SET name = 'Boxer', price = '100000', stock = 20, category = 'Pants' WHERE code = 'SW05';

-- delete
DELETE FROM item WHERE code = 'SW05';

# SALE
-- insert
INSERT INTO sale (`id`, `tgl_sale`, `customer_code`) VALUES
(11, '2024-01-01', 'CS03'),
(12, '2024-01-01', 'CS01'),
(13, '2024-01-01', 'CS01'),
(14, '2024-01-01', 'CS05'),
(15, '2024-01-01', 'CS03');

-- read
SELECT
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
    p.id, p.tgl_purchase, p.supplier_code;

-- delete
DELETE FROM sale WHERE id = 15;

# Detail Sale
-- read
SELECT
    customer.name AS customer_name,
    detail_sale.item_code,
    item.name AS item_name,
    detail_sale.price,
    detail_sale.quantity,
    detail_sale.total_price
FROM
    detail_sale
        INNER JOIN
    sale ON detail_sale.sale_id = sale.id
        INNER JOIN
    customer ON sale.customer_code = customer.code
        INNER JOIN
    item ON detail_sale.item_code = item.code
WHERE
    sale.id = 15;

# PURCHASE
-- insert
INSERT INTO purchase (`id`, `tgl_purchase`, `supplier_code`) VALUES
(6, '2024-01-01', 'SP02'),
(7, '2024-01-01', 'SP01'),
(8, '2024-01-01', 'SP05'),
(9, '2024-01-01', 'SP03');

-- read
SELECT
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
    s.id, s.tgl_sale, s.customer_code;

-- delete
DELETE FROM purchase WHERE id = 6;

# Detail Purchase
-- Read
SELECT
    supplier.name AS supplier_name,
    detail_purchase.item_code,
    item.name AS item_name,
    detail_purchase.price,
    detail_purchase.quantity,
    detail_purchase.total_price
FROM
    detail_purchase
        INNER JOIN
    purchase ON detail_purchase.purchase_id = purchase.id
        INNER JOIN
    supplier ON purchase.supplier_code = supplier.code
        INNER JOIN
    item ON detail_purchase.item_code = item.code
WHERE
    purchase.id = 6;