<?php

namespace App\Service\IncomingMail;

use App\DataObject\Collection\Mails;
use App\DataObject\Mail;
use App\Entity\Email;
use App\Repository\EmailRepository;

class SaveMail
{
    /**
     * @var EmailRepository
     */
    private $emailRepository;

    /**
     * @param EmailRepository $emailRepository
     */
    public function __construct(EmailRepository $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }

    /**
     * @param Mails $mails
     */
    public function persistMails(Mails $mails)
    {
        foreach($mails as $mail) {
            $email = $this->createNewEmailFromMail($mail);
            $this->emailRepository->save($email);
        }
    }

    /**
     * @param Mail $mail
     *
     * @return Email
     */
    private function createNewEmailFromMail(Mail $mail): Email
    {
        $email = new Email();
        $email
            ->setDate($mail->getDate())
            ->setSubject($mail->getSubject())
            ->setFrom($mail->getFrom())
            ->setContent($mail->getContent())
        ;

        return $email;
    }
}