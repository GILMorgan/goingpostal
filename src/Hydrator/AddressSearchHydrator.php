<?php

/**
 * 
 */
class AddressSearchHydrator
{
    /**
     * @var array|Address[]
     */
    private $addresses;

    /**
     * @param array|Address[] $addresses
     */
    public function __construct(array $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $arrAddresses = [];

        foreach ($this->addresses as $address) {
            $arrAddresses[$address->getId()] = $address->getNom() . " " . $address->getPrenom();
        }

        return $arrAddresses;
    }
}