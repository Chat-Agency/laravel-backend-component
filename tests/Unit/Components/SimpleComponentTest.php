<?php

namespace Tests\Unit\Components;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\MainBackendComponent;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\backendComponentNamespace;

class SimpleComponentTest extends TestCase
{
    #[Test]
    public function a_component_can_be_created_using_main_class()
    {
        $component = new MainBackendComponent('div');

        $this->assertEquals('div', $component->getName());
    }

    #[Test]
    public function a_component_can_be_created_using_a_builder()
    {
        $component = ComponentBuilder::make('div');

        $this->assertEquals('div', $component->getName());
    }

    #[Test]
    public function a_component_can_be_created_using_a_builder_and_enum()
    {
        $component = ComponentBuilder::make(ComponentEnum::DIV);

        $this->assertEquals('div', $component->getName());
    }

    #[Test]
    public function a_local_component_component_can_be_created()
    {
        $component = ComponentBuilder::make(ComponentEnum::DIV);

        $this->assertStringStartsWith(backendComponentNamespace(), $component->getComponentPath());

        $component->useLocal();

        $this->assertStringStartsNotWith(backendComponentNamespace(), $component->getComponentPath());
    }

    #[Test]
    public function the_namespace_can_be_set()
    {
        $component = ComponentBuilder::make(ComponentEnum::DIV);

        $this->assertEquals(backendComponentNamespace(), $component->getNamespace());

        $component->setNamespace('other-namespace::');

        $this->assertEquals('other-namespace::', $component->getNamespace());
    }

    #[Test]
    public function the_path_can_be_set()
    {
        $component = ComponentBuilder::make(ComponentEnum::DIV);

        $this->assertEquals(backendComponentNamespace(), $component->getPath());

        $component->setPath('other.path');

        $this->assertEquals(backendComponentNamespace().'other.path', $component->getPath());
    }

    #[Test]
    public function a_component_accepts_content_and_can_be_accessed_using_a_key()
    {
        $component = ComponentBuilder::make(ComponentEnum::DIV)
            ->setContent('Nice content', 1);

        $this->assertEquals('Nice content', $component->getContent(1));
    }

    #[Test]
    public function a_component_accepts_attributes()
    {
        $component = ComponentBuilder::make(ComponentEnum::DIV)
            ->setAttribute('id', 'div_id');

        $this->assertEquals('div_id', $component->getAttribute('id'));

        $component2 = ComponentBuilder::make(ComponentEnum::DIV)
            ->setAttributes([
                'id' => 'div_id',
            ]);

        $this->assertEquals('div_id', $component2->getAttributes()['id']);
    }

    #[Test]
    public function a_component_accepts_theme()
    {
        $component = ComponentBuilder::make(ComponentEnum::DIV)
            ->setTheme('display', 'inline');

        $this->assertEquals('inline', $component->getTheme('display'));

        $component2 = ComponentBuilder::make(ComponentEnum::DIV)
            ->setThemes([
                'display' => 'inline',
            ]);

        $this->assertEquals('inline', $component2->getTheme('display'));
    }

    #[Test]
    public function a_component_accepts_slots()
    {
        $component = ComponentBuilder::make(ComponentEnum::MODAL)
            ->setSlot('button', ComponentBuilder::make(ComponentEnum::BUTTON));

        $this->assertInstanceOf(MainBackendComponent::class, $component->getSlot('button'));

        $component2 = ComponentBuilder::make(ComponentEnum::MODAL)
            ->setSlots([
                'title' => ComponentBuilder::make(ComponentEnum::H2)
                    ->setContent('Nice Title', 1),
            ]);

        $this->assertInstanceOf(MainBackendComponent::class, $component2->getSlot('title'));
        $this->assertEquals('Nice Title', ($component2->getSlots()['title'])->getContent(1));

    }

    #[Test]
    public function a_component_accepts_extra()
    {
        $component = ComponentBuilder::make(ComponentEnum::MODAL)
            ->setExtra('container', []);

        $this->assertEquals([], $component->getExtra('container'));

        $component2 = ComponentBuilder::make(ComponentEnum::DIV)
            ->setExtras([
                'container' => [],
            ]);

        $this->assertEquals([], $component2->getExtras()['container']);
    }

    #[Test]
    public function a_component_string_representation_is_a_json_object()
    {
        $component = ComponentBuilder::make(ComponentEnum::DIV);

        $this->assertJson($component->__toString());
    }
}
