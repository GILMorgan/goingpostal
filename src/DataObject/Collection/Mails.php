<?php

namespace App\DataObject\Collection;

use App\DataObject\Mail;


class Mails implements \Countable, \Iterator
{
    /**
     * @var \SplObjectStorage
     */
    private $internalStorage;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->internalStorage = new \SplObjectStorage();
    }

    /**
     * Ajoute un mail a la collection
     *
     * @param Mail $mail
     *
     * @return self
     */
    public function add(Mail $mail): self
    {
        $this->internalStorage->attach($mail);

        return $this;
    }

    /**
     * Supprime un mail de la collection
     *
     * @param Mail $mail
     *
     * @return self
     */
    public function remove(Mail $mail): self
    {
        $this->internalStorage->detach($mail);

        return $this;
    }

    /**
     * Implementation du count
     *
     * @return int
     */
    public function count()
    {
        return $this->internalStorage->count();
    }

    public function current(): Mail
    {
        return $this->internalStorage->current();
    }

    public function key(): scalar
    {
        return $this->internalStorage->key();
    }

    public function next(): void
    {
        $this->internalStorage->next();
    }

    public function rewind(): void
    {
        $this->internalStorage->rewind();
    }

    public function valid(): bool
    {
        return $this->internalStorage->valid();
    }

}