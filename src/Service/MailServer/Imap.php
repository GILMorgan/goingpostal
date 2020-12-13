<?php

namespace App\Service\MailServer;

use App\Service\MailServer\Contract\GetMailBoxAdapter;

/**
 * Récupération des emails via IMAP
 */
class Imap implements GetMailBoxAdapter
{
    /**
     * @var Mailbox
     */
    private $mailbox;

    /**
     * Constructeur
     * 
     * @param string $imapFolder
     * @param string $userName
     * @param string $password
     */
    public function __construct(
        string $imapFolder,
        string $userName,
        string $password
    )
    {
        $this->mailbox = new \PhpImap\Mailbox(
            $imapFolder,
            $userName,
            $password,
            __DIR__, // Directory, where attachments will be saved (optional)
            'UTF-8' // Server encoding (optional)
        );
    }

    /**
     *  Retourne un tableau d'email et renvoir une exception si un probleme c'est produit
     * 
     * @return array
     * 
     * @throws \PhpImap\Exceptions\ConnectionException
     */    
    public function getAllMails(): array    
    {
        $mails = [];
        $mailsIds = $this->mailbox->searchMailbox('ALL');
        
        foreach($mailsIds as $mailId) {
            $mails[] = $this->mailbox->getMail($mailId);
        }

        return $mails;
    }

}