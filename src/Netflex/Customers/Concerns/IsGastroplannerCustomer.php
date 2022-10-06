<?php

namespace Netflex\Customers\Concerns;

use Netflex\Customers\Customer;
use Gastroplanner\Contracts\GastroplannerCustomer;

trait IsGastroplannerCustomer
{
    public static function bootIsGastroplannerCustomer()
    {
        assert_trait_class_compatiblity(IsGastroplannerCustomer::class, static::class, Customer::class);
        assert_trait_interface_compatiblity(IsGastroplannerCustomer::class, static::class, GastroplannerCustomer::class);
    }

    public function getCompanyName(): ?string
    {
        /** @var Customer $this */
        return $this->company;
    }

    public function getFirstName(): ?string
    {
        /** @var Customer $this */
        return $this->firstname;
    }

    public function getLastName(): ?string
    {
        /** @var Customer $this */
        return $this->surname;
    }

    public function getEmail(): ?string
    {
        /** @var Customer $this */
        return $this->mail;
    }

    public function getPhone(): ?string
    {
        /** @var Customer $this */
        return $this->phone;
    }

    public function getPhoneCountryCode(): ?string
    {
        /** @var Customer $this */
        return $this->phone_countrycode;
    }
}
