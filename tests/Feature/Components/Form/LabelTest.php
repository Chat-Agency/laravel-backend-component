<?php

namespace Tests\Feature\Components\Form;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use Tests\TestCase;

class LabelTest extends TestCase
{
    /** @test */
    public function simple_label()
    {
        $label = ComponentBuilder::make(ComponentEnum::LABEL);

        $this->blade('{{ $label }}', [
            'label' => $label,
        ])
            ->assertSee('<label', false);
    }

    /** @test */
    public function label_accepts_content()
    {
        $label = ComponentBuilder::make(ComponentEnum::LABEL)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::PARAGRAPH)
                    ->setContent('Span content')
            );

        $this->blade('{{ $label }}', [
            'label' => $label,
        ])
            ->assertSee('<label', false)
            ->assertSee('Span content')
            ->assertSee('</label>', false);
    }

    /** @test */
    public function label_accepts_attributes()
    {
        $label = ComponentBuilder::make(ComponentEnum::LABEL)
            ->setAttribute('for', 'label_for');

        $this->blade('{{ $label }}', [
            'label' => $label,
        ])
            ->assertSee('for="label_for"', false);
    }

    /** @test */
    public function label_accepts_sub_components()
    {
        $label = ComponentBuilder::make(ComponentEnum::LABEL)
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('First span'),
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Second span'),
            ]);

        $this->blade('{{ $label }}', [
            'label' => $label,
        ])
            ->assertSee('<span', false)
            ->assertSee('First span')
            ->assertSee('</span>', false)
            ->assertSee('Second span');

    }

    /** @test */
    public function label_accepts_theme()
    {
        $theme = [
            'color' => 'default',
        ];

        $label = ComponentBuilder::make(ComponentEnum::LABEL)
            ->setThemes($theme);

        $this->blade('{{ $label }}', [
            'label' => $label,
        ])
            ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
