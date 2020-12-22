<?php

namespace App\Service\MailServer;

use App\DataObject\Mail;

use PhpImap\IncomingMail;

class ImapMail
{
   /**
    * @param IncomingMail $incomingMail
    *
    * @return Mail
    */
   public function format(IncomingMail $incomingMail): Mail
   {
        return new Mail(
            new \DateTime($incomingMail->date),
            $incomingMail->subject,
            $incomingMail->fromAddress,
            $incomingMail->textPlain
        );
   }
}