<?php

namespace App\Controller;

use App\Repository\EmailRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller de la page d'accueil
 */
class IndexController extends AbstractController
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
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function index(): Response
    {
        $mails = $this->emailRepository->findAll();

        return $this->render(
            'index/index.html.twig',
            [
                "mails" => $mails
            ]
        );
    }
}
