<?php

namespace App\Command;

use App\Service\Ticker\Ticker;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Cette commande est appellée a intervalle régulier pour déclancher des événements programmés
 */
class TickerCommand extends Command
{
    protected static $defaultName = 'goingPostal:ticker';

    /**
     * @var Ticker
     */
    private $ticker;

    /**
     * @param Ticker $ticker
     */
    public function __construct(Ticker $ticker)
    {
        $this->ticker = $ticker;

        parent::__construct();
    }

    /**
     * Configuration de la commande
     */
    protected function configure()
    {
        $this
            ->setDescription('Appel du ticker')
            ->addOption('hour', null, InputOption::VALUE_OPTIONAL, "L'heure pour le debug");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->ticker->tick($input->getOption('hour'));

        return Command::SUCCESS;
    }
}
