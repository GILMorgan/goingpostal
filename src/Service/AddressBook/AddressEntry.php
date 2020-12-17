<?php

namespace App\Service\AddressBook;

use App\Entity\Address;
use App\Repository\AddressBookRepository;
use App\Service\AddressBook\Exception\AddressInvalidEmailException;
use App\Service\AddressBook\Exception\AddressMissingFieldException;
use Symfony\Component\HttpFoundation\Request;

class AddressEntry
{
    /**
     * @var AddressBookRepository
     */
    private $addressBookRepository;

    /**
     * @param AddressBookRepository $addressBookRepository
     */
    public function __construct(AddressBookRepository $addressBookRepository)
    {
        $this->addressBookRepository = $addressBookRepository;
    }

    /**
     * @param Request $request
     *
     * @return Address
     */
    public function addFromRequest(Request $request): Address
    {
        $address = new Address();
        $address->setNom($request->request->get('nom'));
        $address->setPrenom($request->request->get('prenom'));
        $address->setEmail($request->request->get('email'));
        $address->setSurnom($request->request->get('surnom'));

        $this->checkAllValidField($address);

        $address = $this->addressBookRepository->save($address);

        return $address;
    }

    /**
     * Verifie si tout les champs sont valide
     *
     * @param Address $address
     *
     * @return void
     *
     * @throws AddressMissingFieldException
     * @throws AddressInvalidEmailException
     */
    private function checkAllValidField(Address $address): void
    {
        if (!$address->getNom() && !$address->getPrenom() && !$address->getSurnom()) {
            throw new AddressMissingFieldException();
        }

        if (!filter_var($address->getEmail(), FILTER_VALIDATE_EMAIL)) {
            throw new AddressInvalidEmailException();
        }
    }
}