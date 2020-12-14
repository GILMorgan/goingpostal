<?php

namespace App\Service\MailServer;

use App\DataObject\Collection\Mails;
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
     *  Retourne une collection d'email et renvoir une exception si un probleme c'est produit
     *
     * @return Mails
     *
     * @throws \PhpImap\Exceptions\ConnectionException
     */
    public function getAllMails(): Mails
    {
        $mails = new Mails();
        $imapMail = new ImapMail();
        $mailsIds = $this->mailbox->searchMailbox('ALL');

        foreach($mailsIds as $mailId) {
            $mail = $imapMail->format($this->mailbox->getMail($mailId));
            $mails->add($mail);
        }

        return $mails;
    }

}