<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Ramsey\Uuid\Doctrine\UuidGenerator;

/**
 * @ORM\Entity()
 */
class Tick
{
    const INFO = 0;
    const WARN = 1;
    const ERROR = 2;

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
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $triggerHour;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $command;

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }
}