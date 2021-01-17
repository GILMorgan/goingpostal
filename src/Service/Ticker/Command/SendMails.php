<?php

namespace App\Service\Ticker\Command;

use App\Service\MailServer\SendMail;
use App\Repository\DraftRepository;

class SendMails
{
    /**
     * @var DraftRepository
     */
    private $draftRepository;

    /**
     * @var SendMail
     */
    private $sendMail;

    /**
     * @param DraftRepository
     * @param SendMail
     */
    public function __construct(
        DraftRepository $draftRepository,
        SendMail $sendMail
    ) {
        $this->draftRepository = $draftRepository;
        $this->sendMail = $sendMail;
    }

    /**
     * @return string
     */
    public function run(): string
    {
        $currendDate = new \DateTime();
        $currendDate->modify("-2 days");

        $mailsToSend = $this->draftRepository->findAllPostable($currendDate);

        foreach ($mailsToSend as $mailToSend) {
            if ($this->sendMail->sendDraft($mailToSend)) {
                $mailToSend
                    ->setPosted(true)
                    ->setPostedAt(new \DateTime());

                $this->draftRepository->save($mailToSend);
            }
        }

        return sprintf(
            "%s mails envoyés",
            count($mailsToSend)
        );
    }
}