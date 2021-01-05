<?php

namespace App\Service\MailServer;

use App\Entity\Draft;

/**
 * Formatage et envoi du message
 */
class SendMail
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @param Swift_Mailer $swift_Mailer
     */
    public function __construct(\Swift_Mailer $swift_Mailer)
    {
        $this->mailer = $swift_Mailer;
    }

    /**
     * @param Draft $draft
     *
     * @return int
     */
    public function sendDraft(Draft $draft): int
    {
        $message = (new \Swift_Message($draft->getSubject()))
            ->setFrom('unofficial@gilmorgan.net')
            ->setTo($draft->getTo())
            ->setBody(
                $draft->getContent(),
                'text/html'
            );

        return $this->mailer->send($message);
    }
}