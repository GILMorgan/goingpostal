<?php

namespace App\Controller;

use App\Repository\EmailRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/message")
 */
class MessageController extends AbstractController
{
    /**
     * @var EmailRepository
     */
    private $emailRepository;

    /**
     * @param EmailRepository $emailRepository
     */
    public function __construct(EmailRepository $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }

    /**
     * @Route("/show/{emailId}", name="message.show")
     *
     * @param string $emailId
     *
     * @return Response
     */
    public function displayMessage(string $emailId): Response
    {
        $email = $this->emailRepository->find($emailId);

        return $this->render(
            'message/show.html.twig',
            [
                'email' => $email,
            ]
        );
    }
}