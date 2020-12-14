<?php

namespace App\DataObject\Collection;

use App\DataObject\Mail;

class Mails
{
    /**
     * @var \SplObjectStorage
     */
    private $internalStorage;

    /**
     * 
     */
    public function __construct()
    {
        $this->internalStorage = new \SplObjectStorage();
    }

    /**
     * @param Mail $mail
     * 
     * @return self
     */
    public function add(Mail $mail): self
    {
        $this->internalStorage->attach($mail);

        return $this;
    }
}