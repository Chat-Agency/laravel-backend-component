<?php

namespace Tests\Components;

use Tests\TestCase;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;

class DivTest extends TestCase
{
    /** @test */
    public function simple_div()
    {
        $div = ComponentBuilder::make(ComponentEnum::DIV);

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
        ->assertSee('<div', false)
        ->assertSee('</div>', false);
    }

    /** @test */
    public function div_accepts_content()
    {
        $div = ComponentBuilder::make(ComponentEnum::DIV)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::PARAGRAPH)
                    ->setContent('Span content')
            );

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
        ->assertSee('<p', false)
        ->assertSee('Span content')
        ->assertSee('</p>', false);
    }

    /** @test */
    public function div_accepts_attributes()
    {
        $div = ComponentBuilder::make(ComponentEnum::DIV)
            ->setContent('Nice div')
            ->setAttribute('id', 'div_id');

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
        ->assertSee('id="div_id"', false);
    }

    /** @test */
    public function div_accepts_sub_components()
    {
        $div = ComponentBuilder::make(ComponentEnum::DIV)
            ->setContent('Nice div')
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::PARAGRAPH)
                    ->setContent('First paragraph'),
                ComponentBuilder::make(ComponentEnum::PARAGRAPH)
                    ->setContent('Second paragraph'),
            ]);

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
        ->assertSee('<p', false)
        ->assertSee('First paragraph')
        ->assertSee('</p>', false)
        ->assertSee('Second paragraph');
        
    }

    /** @test */
    public function div_accepts_theme()
    {
        $theme = [
            'color' =>  'success',
        ];
        
        $div = ComponentBuilder::make(ComponentEnum::DIV)
            ->setContent('Nice div')
            ->setThemes($theme);
        
        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
