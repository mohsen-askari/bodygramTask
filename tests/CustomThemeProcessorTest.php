<?php

namespace App\Tests\Unit\Processor;

use App\Entity\Theme;
use App\Processor\CustomThemeProcessor;
use App\Repository\ThemeRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;

class CustomThemeProcessorTest extends TestCase
{
    private  $em;
    private  $themeRepository;
    private  $processor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->em = $this->createMock(EntityManagerInterface::class);
        $this->themeRepository = $this->createMock(ThemeRepository::class);
        $this->processor = new CustomThemeProcessor($this->em, $this->themeRepository);
    }

    public function testProcessPostOperationIsDefaultTrue()
    {
        $theme = new Theme();
        $theme->setIsDefault(true);

        $operation = new \stdClass();

        $this->themeRepository->expects($this->once())
            ->method('updateDefualt');

        $result = $this->processor->process($theme, $operation);

        $this->assertInstanceOf(Theme::class, $result);
        $this->assertTrue($result->isDefault());
    }    

}