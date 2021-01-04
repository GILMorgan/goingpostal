<?php

namespace App\Controller;

use App\Repository\AddressBookRepository;
use App\Service\AddressBook\AddressEntry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Gestion du carnet d'addresses
 *
 * @Route("/address_book")
 */
class AddressBookController extends AbstractController
{
    /**
     * @var AddressEntry
     */
    private $addressEntry;

    /**
     * @var AddressBookRepository
     */
    private $addressBookRepository;

    /**
     * @param AddressEntry $addressEntry
     * @param AddressBookRepository $addressBookRepository
     */
    public function __construct(
        AddressEntry $addressEntry,
        AddressBookRepository $addressBookRepository
    ) {
        $this->addressEntry = $addressEntry;
        $this->addressBookRepository = $addressBookRepository;
    }

    /**
     * @Route("/", name="address_book")
     *
     * @return Response
     */
    public function index(): Response
    {
        $addresses = $this->addressBookRepository->findAll();

        return $this->render(
            'address_book/index.html.twig',
            [
                'addresses' => $addresses,
            ]
        );
    }

    /**
     * @Route("/add", name="address_book.add")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function add(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $this->addressEntry->addFromRequest($request);

            return $this->redirectToRoute('address_book');
        }

        return $this->render(
            'address_book/add.html.twig',
            [

            ]
        );
    }
}
