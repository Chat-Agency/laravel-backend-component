<?php

namespace Tests\Feature\Components\Form;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class SelectTest extends TestCase
{
    #[Test]
    public function empty_select()
    {
        $select = ComponentBuilder::make(ComponentEnum::SELECT);

        $this->blade('{{ $select }}', [
            'select' => $select,
        ])
            ->assertSee('<select', false)
            ->assertSee('</select>', false);
    }

    #[Test]
    public function select_accepts_content()
    {
        $select = ComponentBuilder::make(ComponentEnum::SELECT)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::OPTION)
                    ->setContent('Option content')
            );

        $this->blade('{{ $select }}', [
            'select' => $select,
        ])
            ->assertSee('<option', false)
            ->assertSee('Option content')
            ->assertSee('</option>', false);
    }

    #[Test]
    public function select_accepts_attributes()
    {
        $select = ComponentBuilder::make(ComponentEnum::SELECT)
            ->setAttribute('id', 'select_id');

        $this->blade('{{ $select }}', [
            'select' => $select,
        ])
            ->assertSee('id="select_id"', false);
    }

    #[Test]
    public function select_accepts_sub_components()
    {
        $select = ComponentBuilder::make(ComponentEnum::SELECT)
            ->setSubComponent(
                ComponentBuilder::make(ComponentEnum::OPTGROUP)
                    ->setSubComponents([
                        ComponentBuilder::make(ComponentEnum::OPTION)
                            ->setContent('First option'),
                        ComponentBuilder::make(ComponentEnum::OPTION)
                            ->setContent('Second option'),
                    ])
            );

        $this->blade('{{ $select }}', [
            'select' => $select,
        ])
            ->assertSee('<optgrou', false)
            ->assertSee('<option', false)
            ->assertSee('First option')
            ->assertSee('</option>', false)
            ->assertSee('</optgroup>', false)
            ->assertSee('Second option');

    }

    #[Test]
    public function select_accepts_theme()
    {
        $theme = [
            'display' => 'inline-block',
        ];

        $select = ComponentBuilder::make(ComponentEnum::SELECT)
            ->setThemes($theme);

        $this->blade('{{ $select }}', [
            'select' => $select,
        ])
            ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
