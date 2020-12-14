<?php

namespace App\Service\MailServer\Contract;

use App\DataObject\Collection\Mails;

/**
 * Interface générique pour les connecteurs permettant de récupérer 
 * les emails dans la boite aux lettres (Imap, POP, File, etc ...)
 */
interface GetMailBoxAdapter
{
    public function getAllMails(): Mails;
}