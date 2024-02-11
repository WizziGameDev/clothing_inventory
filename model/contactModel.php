<?php

class Contact
{
    private string $id;

    private int $number;

    /**
     * @param string $id
     * @param int $number
     */
    public function __construct(string $id, int $number)
    {
        $this->id = $id;
        $this->number = $number;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

}