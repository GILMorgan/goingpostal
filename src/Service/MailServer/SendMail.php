<?php

namespace App\Service\MailServer;

use App\Entity\Draft;
use App\Service\MailFormater\FormalStyle;

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
     * @var FormalStyle
     */
    private $mailFormater;

    /**
     * @param Swift_Mailer $swift_Mailer
     * @param FormalStyle $formalStyle
     */
    public function __construct(
        \Swift_Mailer $swift_Mailer,
        FormalStyle $formalStyle
    )
    {
        $this->mailer = $swift_Mailer;
        $this->formalStyle = $formalStyle;
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
                $this->formalStyle->formatDraft($draft),
                'text/html'
            );

        return $this->mailer->send($message);
    }
}