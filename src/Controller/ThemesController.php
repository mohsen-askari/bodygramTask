<?php

namespace App\Controller;

use App\Service\ThemesManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



final class ThemesController extends AbstractController
{

    public function themeDefault($id, ThemesManager $themesManager): Response
    {
        $themesManager->updateDefault($id);

        return $this->json(["theme" => "update"], 200);
    }
}
