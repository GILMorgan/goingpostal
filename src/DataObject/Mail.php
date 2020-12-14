<?php

namespace App\DataObject;

/**
 * Structure d'un mail (recu ou envoyé) 
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
     * Setter de la date de reception/redaction
     * 
     * @param \DateTime $dateTime
     * 
     * @return self
     */
    public function setDate(\DateTime $dateTime): self        
    {
        $this->date = $dateTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param string $subject
     * 
     * @return self
     */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $from
     *
     * @return self
     */
    public function setFrom(string $from): self
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->subject;
    }

    /**
     * @param string $content
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}