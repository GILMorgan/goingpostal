<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Ramsey\Uuid\Doctrine\UuidGenerator;

/**
 * @ORM\Entity()
 */
class TickerLog
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
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $logDate;

    /**
     * @ORM\Column(type="string")
     */
    private $channel;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @param string $channel
     * @param string $content;
     */
    public function __construct(string $channel, string $content)
    {
        $this->logDate = new \DateTime();
        $this->channel = $channel;
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getLogDate(): \DateTime
    {
        return $this->logDate;
    }

    /**
     * @return string
     */
    public function getChannel(): string
    {
        return $this->channel;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}