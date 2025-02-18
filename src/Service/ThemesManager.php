<?php

namespace App\Service;

use App\Repository\ThemeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ThemesManager {

    private $em;
    private $themeRepository;

    public function __construct(
        EntityManagerInterface $em,
        ThemeRepository $themeRepository
    ){
        $this->em = $em;
        $this->themeRepository = $themeRepository;
    }

    function updateDefault($id) {
        
        $themes = $this->themeRepository->findAll();

        foreach ($themes as $theme) {
            $theme->setIsDefault(false);            
        }
        $this->em->persist($theme);

        $setDefault = $this->themeRepository->find($id)->setIsDefault(true);
        $this->em->persist($setDefault);

        $this->em->flush();

    }
}