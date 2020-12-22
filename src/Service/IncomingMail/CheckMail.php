<?php

namespace App\Service\IncomingMail;

use App\DataObject\Collection\Mails;
use App\DataObject\Mail;
use App\Repository\AddressBookRepository;
use App\Repository\EmailRepository;

/**
 * Verification des mails
 * - Si un mail n'est pas dans le carnet d'addresse, on le vire
 * - Pareil s'il est déjà en base, on le vire aussi
 */
class CheckMail
{
    /**
     * @var AddressBookRepository
     */
    private $addressBookRepository;

    /**
     * @var EmailRepository
     */
    private $emailRepository;

    /**
     * @param AddressBookRepository $addressBookRepository
     * @param EmailRepository $emailRepository
     */
    public function __construct(
        AddressBookRepository $addressBookRepository,
        EmailRepository $emailRepository
    ) {
        $this->addressBookRepository = $addressBookRepository;
        $this->emailRepository = $emailRepository;
    }

    /**
     * @param Mails $mails
     *
     * @return Mails
     */
    public function filterMails(Mails $mails): Mails
    {
        foreach ($mails as $mail) {
            if (
                !$this->checkIfInAddressBook($mail)
                || $this->checkIfAllreadyRead($mail)
            ) {
                $mails->remove($mail);
            }
        }

        return $mails;
    }

    /**
     * @param Mail $mail
     *
     * @return bool
     */
    private function checkIfInAddressBook(Mail $mail): bool
    {
        return (bool) $this->addressBookRepository->findByEmail($mail->getFrom());
    }

    /**
     * @param Mail $mail
     *
     * @return bool
     */
    private function checkIfAllreadyRead(Mail $mail): bool
    {
        return (bool) $this->emailRepository->findByEmailAndDate($mail->getFrom(), $mail->getDate());
    }
}