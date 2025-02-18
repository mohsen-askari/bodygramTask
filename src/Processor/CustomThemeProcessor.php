<?php

namespace App\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Theme;
use App\Repository\ThemeRepository;
use Doctrine\ORM\EntityManagerInterface;

final class CustomThemeProcessor implements ProcessorInterface
{

    private $em;
    private $themeRepository;

    public function __construct(EntityManagerInterface $em, ThemeRepository $themeRepository)
    {
        $this->em = $em;
        $this->themeRepository = $themeRepository;
    }


    function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): Theme
    {

        if (!$data instanceof Theme) {
            throw new \InvalidArgumentException('The data must be an instance of App\Entity\Theme');
        }

        $theme = $data;

        if ($theme->isDefault()) {

            // $themes = $this->em->getRepository(Theme::class)->findAll();
            // foreach ($themes as $t) {
            //     if ($t !== $theme) {
            //         $t->setIsDefault(false);
            //         $this->em->persist($t);
            //     }
            // }

            $this->themeRepository->updateDefualt();
        }

        $this->em->persist($theme);
        $this->em->flush();


        return $theme;
    }
}
