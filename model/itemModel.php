<?php

class Item
{
    private string $code;

    private string $name;

    private int $price;

    private int $stock;

    private string $category;

    /**
     * @param string $code
     * @param string $name
     * @param int $price
     * @param int $stock
     * @param string $category
     */
    public function __construct(string $code, string $name, int $price, int $stock, string $category)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
        $this->category = $category;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }


}