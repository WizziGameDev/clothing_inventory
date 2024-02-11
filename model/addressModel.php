<?php

class Address
{
    private string $id;

    private string $city;

    private string $state;

    private string $country;

    /**
     * @param string $id
     * @param string $city
     * @param string $state
     * @param string $country
     */
    public function __construct(string $id, string $city, string $state, string $country)
    {
        $this->id = $id;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }


}