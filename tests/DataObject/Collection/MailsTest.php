<?php

use App\DataObject\Collection\Mails;
use App\DataObject\Mail;
use PHPUnit\Framework\TestCase;

class MailTest extends TestCase
{
    public function testForeach()
    {
        $mails = new Mails();

        $mails->add(new Mail(new \DateTime(), "", "", ""));
        $mails->add(new Mail(new \DateTime(), "", "", ""));
        $mails->add(new Mail(new \DateTime(), "", "", ""));
        $mails->add(new Mail(new \DateTime(), "", "", ""));

        $loop = 0;
        foreach($mails as $mail) {
            $loop++;
        }

        $this->assertSame(4, count($mails));
        $this->assertSame(4, $loop);

    }
}