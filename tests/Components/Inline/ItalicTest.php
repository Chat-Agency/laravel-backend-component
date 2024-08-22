<?php

namespace Tests\Components\Inline;

use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class ItalicTest extends TestCase
{
    /** @test */
    public function simple_italic()
    {
        $italic = ComponentBuilder::make(ComponentEnum::ITALIC);

        $this->blade('{{ $italic }}', [
            'italic' => $italic,
        ])
        ->assertSee('<i', false)
        ->assertSee('</i>', false);
    }

    /** @test */
    public function italic_with_content()
    {
        $italic = ComponentBuilder::make(ComponentEnum::ITALIC)
         ->setContent('Nice i tag');

        $this->blade('{{ $italic }}', [
            'italic' => $italic,
        ])
        ->assertSee('Nice i tag');
    }

    /** @test */
    public function italic_with_attributes()
    {
        $italic = ComponentBuilder::make(ComponentEnum::ITALIC)
            ->setAttribute('id', 'nice_italic');

        $this->blade('{{ $italic }}', [
            'italic' => $italic,
        ])
        ->assertSee('id="nice_italic"', false);
    }

    /** @test */
    public function italic_has_no_sub_components()
    {
        $italic = ComponentBuilder::make(ComponentEnum::ITALIC)
            ->setSubComponent(
                ComponentBuilder::make(ComponentEnum::SPAN)
            );

        $this->blade('{{ $italic }}', [
            'italic' => $italic,
        ])
        ->assertDontSee('<span', false);
    }

    /** @test */
    public function italic_with_theme()
    {
        $theme = [
            'display' =>  'inline-block',
        ];

        $italic = ComponentBuilder::make(ComponentEnum::ITALIC)
            ->setThemes($theme);

        $this->blade('{{ $italic }}', [
            'italic' => $italic,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);
    }
}
