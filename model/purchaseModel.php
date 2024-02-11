<?php

class Purchase
{
    private int $id;

    private DateTime $tgl_purchase;

    private string $supplier_code;

    private int $quantity;

    private int $total_price;

    /**
     * @param int $id
     * @param DateTime $tgl_purchase
     * @param string $supplier_code
     * @param int $quantity
     * @param int $total_price
     */
    public function __construct(int $id, DateTime $tgl_purchase, string $supplier_code, int $quantity, int $total_price)
    {
        $this->id = $id;
        $this->tgl_purchase = $tgl_purchase;
        $this->supplier_code = $supplier_code;
        $this->quantity = $quantity;
        $this->total_price = $total_price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTglPurchase(): string
    {
        return $this->tgl_purchase->format('Y-m-d');
    }

    public function setTglPurchase(DateTime $tgl_purchase): void
    {
        $this->tgl_purchase = $tgl_purchase;
    }

    public function getSupplierCode(): string
    {
        return $this->supplier_code;
    }

    public function setSupplierCode(string $supplier_code): void
    {
        $this->supplier_code = $supplier_code;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getTotalPrice(): int
    {
        return $this->total_price;
    }

    public function setTotalPrice(int $total_price): void
    {
        $this->total_price = $total_price;
    }
}