<?php

namespace Tests\Unit\Components;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use ChatAgency\BackendComponents\Builders\LocalThemeComponentBuilder;

use function ChatAgency\BackendComponents\backendComponentNamespace;

class LocalThemeComponentBuilderTest extends TestCase
{
    #[Test]
    public function a_local_component_can_be_created_using_a_builder()
    {
        $component = LocalThemeComponentBuilder::make('div');

        $this->assertStringStartsWith(backendComponentNamespace(), $component->getComponentPath());

        $themeManager = $component->getThemeManager();

        $this->assertStringStartsNotWith(backendComponentNamespace(), $themeManager->getThemePath());
    }

}
