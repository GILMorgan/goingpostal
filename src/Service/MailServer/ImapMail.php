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
       $mail = new Mail();
       $mail->setDate(new \DateTime($incomingMail->date));
       $mail->setSubject($incomingMail->header->subject);
       $mail->setFrom($incomingMail->header->fromaddress);
       $mail->setContent($incomingMail->textPlain);

       return $mail;
   }
}