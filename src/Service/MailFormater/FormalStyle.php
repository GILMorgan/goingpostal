<?php

namespace App\Service\MailFormater;

use App\Entity\Draft;

use Twig\Environment;

/**
 * 
 */
class FormalStyle
{
    /**
     * @var Environement
     */
    private $engineInterface;

    /**
     * @param Environment $engineInterface
     */
    public function __construct(Environment $engineInterface)
    {
        $this->engineInterface = $engineInterface;
    }

    /**
     * @param Draft $draft
     * 
     * @return string
     */
    public function formatDraft(Draft $draft): string
    {
        return $this->engineInterface->render(
            'emails/formalStyle.html.twig',
            [
                'draft' => $draft,
            ]
        );
    }
}