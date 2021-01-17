<?php

namespace App\Command;

use App\Service\IncomingMail\CheckMail;
use App\Service\IncomingMail\SaveMail;
use App\Service\MailServer\Mailbox;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Commande de récupération des mails
 */
class GetMailCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'goingPostal:getMails';

    /**
     * @var Mailbox
     */
    private $mailbox;

    /**
     * @var ChecklMail
     */
    private $checkMail;

    /**
     * @var SaveMail
     */
    private $saveMail;

    /**
     * @param Mailbox $mailbox
     * @param CheckMail $checkMail
     * @param SaveMail $saveMail
     */
    public function __construct(
        Mailbox $mailbox,
        CheckMail $checkMail,
        SaveMail $saveMail
    ) {
        $this->mailbox = $mailbox;
        $this->checkMail = $checkMail;
        $this->saveMail = $saveMail;

        parent::__construct();
    }

    /**
     * Configuration de la commande
     */
    protected function configure()
    {
        $this->setDescription('Récupération des emails');
    }

    /**
     * Recupération des emails
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $mails = $this->mailbox->getAllMails();

        $io->success(sprintf('%s mails ont été relevé', count($mails)));

        $mails = $this->checkMail->filterMails($mails);

        $this->saveMail->persistMails($mails);

        $io->success(sprintf('%s mails ont été ajouté a la boite de reception', count($mails)));

        return Command::SUCCESS;
    }
}
