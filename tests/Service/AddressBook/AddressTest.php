<?php

use App\Service\AddressBook\AddressEntry;
use App\Repository\AddressBookRepository;
use App\Service\AddressBook\Exception\AddressInvalidEmailException;
use App\Service\AddressBook\Exception\AddressMissingFieldException;

use Symfony\Component\HttpFoundation\Request;

use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    public function testComplete()
    {
        $request = \Mockery::Mock(Request::class);
        $subRequest = \Mockery::Mock(stdClass::class);
        $addressBookRepository = \Mockery::Mock(AddressBookRepository::class);

        $subRequest->shouldReceive("get")->with("nom")->andReturn("Sponge");
        $subRequest->shouldReceive("get")->with("prenom")->andReturn("Bob");
        $subRequest->shouldReceive("get")->with("email")->andReturn("bob.sponge@bob.com");
        $subRequest->shouldReceive("get")->with("surnom")->andReturn("Bob Ze Sponge");

        $addressBookRepository->shouldReceive("save")->andReturnUsing(function($address) { return $address; });

        $request->request = $subRequest;

        $addressEntry = new AddressEntry($addressBookRepository);
        $address = $addressEntry->addFromRequest($request);

        $this->assertSame("Sponge", $address->getNom());
        $this->assertSame("Bob", $address->getPrenom());
        $this->assertSame("bob.sponge@bob.com", $address->getEmail());
        $this->assertSame("Bob Ze Sponge", $address->getSurnom());
    }

    public function testInComplete()
    {
        $request = \Mockery::Mock(Request::class);
        $subRequest = \Mockery::Mock(stdClass::class);
        $addressBookRepository = \Mockery::Mock(AddressBookRepository::class);

        $subRequest->shouldReceive("get")->with("nom")->andReturn("");
        $subRequest->shouldReceive("get")->with("prenom")->andReturn("");
        $subRequest->shouldReceive("get")->with("email")->andReturn("bob.sponge@bob.com");
        $subRequest->shouldReceive("get")->with("surnom")->andReturn("");

        $request->request = $subRequest;

        $addressEntry = new AddressEntry($addressBookRepository);

        $this->expectException(AddressMissingFieldException::class);
        $address = $addressEntry->addFromRequest($request);
    }

    public function testInvalidMail()
    {
        $request = \Mockery::Mock(Request::class);
        $subRequest = \Mockery::Mock(stdClass::class);
        $addressBookRepository = \Mockery::Mock(AddressBookRepository::class);

        $subRequest->shouldReceive("get")->with("nom")->andReturn("Sponge");
        $subRequest->shouldReceive("get")->with("prenom")->andReturn("Bob");
        $subRequest->shouldReceive("get")->with("email")->andReturn("bob.sponge-bob.com");
        $subRequest->shouldReceive("get")->with("surnom")->andReturn("Bob Ze Sponge");

        $request->request = $subRequest;

        $addressEntry = new AddressEntry($addressBookRepository);

        $this->expectException(AddressInvalidEmailException::class);
        $address = $addressEntry->addFromRequest($request);
    }
}