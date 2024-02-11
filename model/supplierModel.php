<?php

class Supplier
{
    private string $code;

    private string $name;

    private string $email;

    private string $contact_id;

    private string $address_id;

    /**
     * @param string $code
     * @param string $name
     * @param string $email
     * @param string $contact_id
     * @param string $address_id
     */
    public function __construct(string $code, string $name, string $email, string $contact_id, string $address_id)
    {
        $this->code = $code;
        $this->name = $name;
        $this->email = $email;
        $this->contact_id = $contact_id;
        $this->address_id = $address_id;
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getContactId(): string
    {
        return $this->contact_id;
    }

    public function setContactId(string $contact_id): void
    {
        $this->contact_id = $contact_id;
    }

    public function getAddressId(): string
    {
        return $this->address_id;
    }

    public function setAddressId(string $address_id): void
    {
        $this->address_id = $address_id;
    }
}