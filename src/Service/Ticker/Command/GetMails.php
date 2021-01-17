<?php

namespace App\Service\Ticker\Command;

use App\Service\IncomingMail\CheckMail;
use App\Service\IncomingMail\SaveMail;
use App\Service\MailServer\Mailbox;

class GetMails implements InterfaceTickerCommand
{
    /**
     * @var MailBox
     */
    private $mailbox;

    /**
     * @var CheckMail
     */
    private $checkMail;

    /**
     * @var SaveMail
     */
    private $saveMail;

    /**
     * @param Mailbox $mailbox
     * @param CheckMail $checkMail
     * @param SaveMail $saveMail
     */
    public function __construct(
        Mailbox $mailbox,
        CheckMail $checkMail,
        SaveMail $saveMail
    ) {
        $this->mailbox = $mailbox;
        $this->checkMail = $checkMail;
        $this->saveMail = $saveMail;
    }

    /**
     * @return string
     */
    public function run(): string
    {
        $mails = $this->mailbox->getAllMails();

        $totalInbox = count($mails);

        $mails = $this->checkMail->filterMails($mails);

        $filteredMails = count($mails);

        $this->saveMail->persistMails($mails);

        return sprintf(
            "%s mails dans la box distante, %s mails ajouté à la boite de reception",
            $totalInbox,
            $filteredMails
        );
    }
}