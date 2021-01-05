<?php

namespace App\Command;

use App\Repository\DraftRepository;
use App\Service\MailServer\SendMail;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Commande d'envois des mails
 */
class SendMailCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'goingPostal:sendMails';

    /**
     * @var DraftRepository
     */
    private $draftRepository;

    /**
     * @var SendMail
     */
    private $sendMail;

    /**
     * @param DraftRepository $draftRepository
     * @param SendMail $sendMail
     */
    public function __construct(DraftRepository $draftRepository, SendMail $sendMail)
    {
        $this->draftRepository = $draftRepository;
        $this->sendMail = $sendMail;

        parent::__construct();
    }

    /**
     * Configuration de la commande
     */
    protected function configure()
    {
        $this->setDescription('Envois des emails');
    }

    /**
     * Envoi des brouillons posté
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $drafts = $this->draftRepository->findAllPosted();

        $io->info(
            sprintf("%s draft to send", count($drafts))
        );

        foreach ($drafts as $draft) {
            $this->sendMail->sendDraft($draft);

            $this->draftRepository->delete($draft);
        }

        return Command::SUCCESS;
    }
}