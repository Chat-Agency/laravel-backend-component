<?php

namespace Tests\Feature;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\MainBackendComponent;
use Tests\TestCase;

class SimpleComponentTest extends TestCase
{
    /** @test */
    public function a_component_can_be_created_using_main_class()
    {
        $component = new MainBackendComponent('div');

        $this->assertEquals('div', $component->getName());
    }
    /** @test */
    public function a_component_can_be_created_using_a_builder()
    {
        $component = ComponentBuilder::make('div');

        $this->assertEquals('div', $component->getName());
    }

    /** @test */
    public function a_component_can_be_created_using_a_builder_and_enum()
    {
        $component = ComponentBuilder::make(ComponentEnum::DIV);

        $this->assertEquals('div', $component->getName());
    }
}
