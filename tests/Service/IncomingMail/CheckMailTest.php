<?php

use App\DataObject\Collection\Mails;
use App\DataObject\Mail;
use App\Entity\Address;
use App\Entity\Email;
use App\Repository\AddressBookRepository;
use App\Repository\EmailRepository;
use App\Service\IncomingMail\CheckMail;
use PHPUnit\Framework\TestCase;

class CheckMailTest extends TestCase
{
    public function testEmptyMailbox()
    {
        $mails = new Mails();
        $addressBookRepository = Mockery::mock(AddressBookRepository::class);
        $mailRepository = Mockery::mock(EmailRepository::class);

        $checkMail = new CheckMail($addressBookRepository, $mailRepository);

        $filteredMails = $checkMail->filterMails($mails);

        $this->assertSame(0, count($filteredMails));
    }

    public function testGoodMailbox()
    {
        $mails = new Mails();
        $mail = new Mail(new \DateTime(), "test", "spongeBob", "coucou en passant");
        $mails->add($mail);

        $addressBookRepository = Mockery::mock(AddressBookRepository::class);
        $addressBookRepository->shouldReceive('findByEmail')->andReturn(new Address());
        $mailRepository = Mockery::mock(EmailRepository::class);
        $mailRepository->shouldReceive('findByEmailAndDate')->andReturn(null);

        $checkMail = new CheckMail($addressBookRepository, $mailRepository);

        $filteredMails = $checkMail->filterMails($mails);

        $this->assertSame(1, count($filteredMails));
    }

    public function testWrongMailbox()
    {
        $mails = new Mails();
        $mail = new Mail(new \DateTime(), "test", "falsespongeBob", "coucou en passant");
        $mails->add($mail);

        $addressBookRepository = Mockery::mock(AddressBookRepository::class);
        $addressBookRepository->shouldReceive('findByEmail')->andReturn(null);
        $mailRepository = Mockery::mock(EmailRepository::class);

        $checkMail = new CheckMail($addressBookRepository, $mailRepository);

        $filteredMails = $checkMail->filterMails($mails);

        $this->assertSame(0, count($filteredMails));
    }
}