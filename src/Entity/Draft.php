<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Ramsey\Uuid\Doctrine\UuidGenerator;

/**
 * @ORM\Entity()
 */

class Draft
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     *
     * @var string
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     *
     * @var \DateTime $date
     */
    private $date;

    /**
     * @ORM\Column(type="string")
     *
     * @var string $subject
     */
    private $subject;

    /**
     * @ORM\Column(type="string", name="draft_to")
     *
     * @var string $to
     */
    private $to;

    /**
     * @ORM\Column(type="string")
     *
     * @var string $content
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool $isPosted
     */
    private $isPosted;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime
     *
     * @return self
     */
    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
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
     * @return string|null
     */
    public function getTo(): ?string
    {
        return $this->to;
    }

    /**
     * @param string $to
     *
     * @return self
     */
    public function setTo(string $to): self
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
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
     * @param bool $isPosted
     *
     * @return self
     */
    public function setPosted(bool $isPosted): self
    {
        $this->isPosted = $isPosted;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPosted(): bool
    {
        return $this->isPosted;
    }
}