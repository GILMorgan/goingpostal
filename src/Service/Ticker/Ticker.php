<?php

namespace App\Service\Ticker;

use App\Entity\Tick;
use App\Repository\TickRepository;
use App\Service\Logger\TickerLogger;

/**
 * 
 */
class Ticker
{
    /**
     * @var TickerRepository
     */
    private $tickRepository;

    /**
     * @var TickerLogger
     */
    private $tickerLogger;

    /**
     * @var TickerRunner
     */
    private $tickerRunner;

    /**
     * @param TickerRepository $tickRepository
     * @param TickerLogger $tickerLogger
     * @param TickerRunner $tickerRunner
     */
    public function __construct(
        TickRepository $tickRepository,
        TickerLogger $tickerLogger,
        TickerRunner $tickerRunner
    ) {
        $this->tickRepository = $tickRepository;
        $this->tickerLogger = $tickerLogger;
        $this->tickerRunner = $tickerRunner;
    }

    /**
     * @param int|null $hour
     */
    public function tick(int $hour = null)
    {
        if ($hour === null) {
            $hour = (int) (new \DateTime())->format("H");
        }

        $tick = $this->tickRepository->findByHour($hour);


        if (!$tick) {
            $this->tickerLogger->log(Tick::INFO, "Rien a faire");
            return;
        }

        try {
            $result = $this->tickerRunner->runCommand($tick->getCommand());
            $this->tickerLogger->log(Tick::INFO, $result);
        } catch(\Exception $e) {
            $this->tickerLogger->log(Tick::ERROR, $e->getMessage());
        }
    }
}