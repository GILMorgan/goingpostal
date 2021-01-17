<?php

namespace App\DataObject;

/**
 * Structure d'un mail
 */
class Mail
{
    /**
     * @var \DateTime $date
     */
    private $date;

    /**
     * @var string $subject
     */
    private $subject;

    /**
     * @var string|null $from
     */
    private $from;

    /**
     * @var string $content
     */
    private $content;

    /**
     * @param \DateTime $date
     * @param string $subject
     * @param string $from
     * @param string $content
     */
    public function __construct(
        \DateTime $date,
        string $subject,
        string $from,
        string $content
    ) {
        $this->date = $date;
        $this->subject = $subject;
        $this->from = $from;
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }
    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}