<?php

namespace App\Controller;

use App\Entity\Draft;
use App\Repository\DraftRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/draft")
 */
class DraftController extends AbstractController
{
    /**
     * @var DraftRepository
     */
    private $draftRepository;

    /**
     * @param DraftRepository $draftRepository
     */
    public function __construct(DraftRepository $draftRepository)
    {
        $this->draftRepository = $draftRepository;
    }

    /**
     * @Route("/", name="draft.list_all")
     *
     * @return Response
     */
    public function listAllDraft(): Response
    {
        $drafts = $this->draftRepository->findAllNotPosted();

        return $this->render(
            "draft/list.html.twig",
            [
                "drafts" => $drafts,
            ]
        );
    }

    /**
     * @Route("/new", name="draft.new")
     *
     * @return Response
     */
    public function newDraft(): Response
    {
        return $this->render(
            "draft/new.html.twig", []
        );
    }

    /**
     * @Route("/edit/{draftId}", name="draft.edit")
     *
     * @param string $draftId
     *
     * @return Response
     */
    public function editDraft(string $draftId): Response
    {
        $draft = $this->draftRepository->find($draftId);

        return $this->render(
            "draft/edit.html.twig",
            [
                "draft" => $draft,
            ]
        );
    }

    /**
     * @Route("/save", name="draft.save")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function saveDraft(Request $request): JsonResponse
    {
        $jsonContent = $request->getContent();
        $content = json_decode($jsonContent);

        $draft = new Draft();
        $draft
            ->setDate(new \DateTime())
            ->setTo($content->to)
            ->setSubject($content->subject)
            ->setContent($content->content)
            ->setPosted(false);

        $this->draftRepository->save($draft);

        return new JsonResponse(
            [
                'draftId' => $draft->getId(),
            ]
        );
    }

    /**
     * @Route("/update/{draftId}", name="draft.update")
     *
     * @param string $draftId
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function updateDraft(string $draftId, Request $request): JsonResponse
    {
        $jsonContent = $request->getContent();
        $content = json_decode($jsonContent);

        $draft = $this->draftRepository->find($draftId);
        $draft
            ->setTo($content->to)
            ->setSubject($content->subject)
            ->setContent($content->content);

        $this->draftRepository->save($draft);

        return new JsonResponse(
            [
                'draftId' => $draft->getId(),
            ]
        );
    }
}