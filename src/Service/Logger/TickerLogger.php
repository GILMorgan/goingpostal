<?php

namespace App\Service\Logger;

use App\Entity\TickerLog;
use App\Repository\TickerLogRepository;

/**
 * Service de log des ticks
 */
class TickerLogger
{
    /**
     * @var TickerLogRepository
     */
    private $tickerLogRepository;

    /**
     * @param TickerLogRepository $tickerLogRepository
     */
    public function __construct(TickerLogRepository $tickerLogRepository)
    {
        $this->tickerLogRepository = $tickerLogRepository;
    }

    /**
     * @param string $channel
     * @param string $content
     */
    public function log(string $channel, string $content)
    {
        $tickerLog = new TickerLog($channel, $content);

        $this->tickerLogRepository->save($tickerLog);
    }
}