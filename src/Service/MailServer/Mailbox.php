<?php

namespace App\Service\MailServer;

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
     */
    public function getAllMails()
    {
        return $this->getMailBoxAdapter->getAllMails();
    }
}