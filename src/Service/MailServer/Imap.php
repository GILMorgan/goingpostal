<?php

namespace App\Service\MailServer;


class Imap
{
    /**
     * @param Mailbox
     */
    private $mailbox;

    
    public function __construct()
    {
        $this->mailbox = new \PhpImap\Mailbox(
            '{SSL0.OVH.NET/imap}INBOX', // IMAP server and mailbox folder
            'unofficial@gilmorgan.net', // Username for the before configured mailbox
            'mTDrFu44afFcEmtk40Ra', // Password for the before configured username
            __DIR__, // Directory, where attachments will be saved (optional)
            'UTF-8' // Server encoding (optional)
        );    

        try {
            // Get all emails (messages)
            // PHP.net imap_search criteria: http://php.net/manual/en/function.imap-search.php
            $mailsIds = $mailbox->searchMailbox('ALL');
        } catch(PhpImap\Exceptions\ConnectionException $ex) {
            echo "IMAP connection failed: ca a tout foiré" . $ex;
            die();
        }

        //$mail = $mailbox->getMail($mailsIds[0]);

        //PhpImap\IncomingMail
    }


}