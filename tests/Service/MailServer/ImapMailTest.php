<?php

use App\DataObject\Mail;
use App\Service\MailServer\ImapMail;
use PhpImap\IncomingMail;
use PHPUnit\Framework\TestCase;


class ImapMailTest extends TestCase
{
    public function testFormatText()
    {
        $imapMail = new ImapMail();
        $incomingMail = Mockery::mock(IncomingMail::class);
        $incomingMail->date = '2020-06-24T19:34:30+02:00';
        $incomingMail->header = new \stdClass();
        $incomingMail->header->subject = "Une belle lettre";
        $incomingMail->header->fromaddress = "Un admirateur anonyme";
        $incomingMail->textPlain = "Tout mes compliments";

        $formatMail = $imapMail->format($incomingMail);

        $this->assertTrue(is_a($formatMail, Mail::class));
        $this->assertSame("24/06/2020", $formatMail->getDate()->format("d/m/Y"));
        $this->assertSame("Une belle lettre", $formatMail->getSubject());
        $this->assertSame("Un admirateur anonyme", $formatMail->getFrom());
        $this->assertSame("Tout mes compliments", $formatMail->getContent());
    }
}