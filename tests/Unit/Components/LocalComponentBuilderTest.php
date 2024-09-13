<?php

namespace Tests\Unit\Components;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use ChatAgency\BackendComponents\Builders\LocalComponentBuilder;

use function ChatAgency\BackendComponents\backendComponentNamespace;

class LocalComponentBuilderTest extends TestCase
{
    #[Test]
    public function a_local_component_can_be_created_using_a_builder()
    {
        $component = LocalComponentBuilder::make('div');

        $this->assertStringStartsNotWith(backendComponentNamespace(), $component->getComponentPath());

        $themeManager = $component->getThemeManager();

        $this->assertStringStartsNotWith(backendComponentNamespace(), $themeManager->getThemePath());
    }

}
