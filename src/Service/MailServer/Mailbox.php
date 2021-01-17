<?php

namespace App\Service\MailServer;

use App\DataObject\Collection\Mails;
use App\Service\MailServer\Contract\GetMailBoxAdapter;

/**
 * Récupération des mails
 * Prends en constructeur un adaptateur et renvoie une collection de mails
 */
class Mailbox
{
    /**
     * @var GetMailBoxAdapter
     */
    private $getMailBoxAdapter;

    /**
     * @param GetMailBoxAdapter $getMailBoxAdapter
     */
    public function __construct(GetMailBoxAdapter $getMailBoxAdapter)
    {
        $this->getMailBoxAdapter = $getMailBoxAdapter;
    }

    /**
     * Retourne une collection de mails
     *
     * @return Mails
     */
    public function getAllMails(): Mails
    {
        return $this->getMailBoxAdapter->getAllMails();
    }
}