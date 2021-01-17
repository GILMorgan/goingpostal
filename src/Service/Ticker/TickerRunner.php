<?php

namespace App\Service\Ticker;

use App\Service\Ticker\Command\GetMails;
use App\Service\Ticker\Command\InterfaceTickerCommand;
use App\Service\Ticker\Command\SendMails;

class TickerRunner
{
    /**
     * @var InterfaceTickerCommand[]
     */
    private $runners;

    /**
     * @param GetMails $getMails
     * @param SendMails $sendMails
     */
    public function __construct(
        GetMails $getMails,
        SendMails $sendMails
    ) {
        $this->runners = [
            "GetMails" => $getMails,
            "SendMails" => $sendMails,
        ];
    }

    /**
     * @param string $commandName
     *
     * @return string
     *
     * @throws \Exception
     */
    public function runCommand(string $commandName): string
    {
        if (isset($this->runners[$commandName])) {
            $runner = $this->runners[$commandName];
            return $runner->run();
        }

        throw new \Exception(
            sprintf("La commande %s n'est pas encore implémentée", $commandName)
        );
    }
}