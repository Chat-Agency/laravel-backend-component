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
        $div = ComponentBuilder::make(ComponentEnum::DIV)
            ->setContent('Nice div');

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
        ->assertSee('<div', false)
        ->assertSee('Nice div')
        ->assertSee('</div>', false);
    }

    /** @test */
    public function div_with_component_content()
    {
        $div = ComponentBuilder::make(ComponentEnum::DIV)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::PARAGRAPH)
                    ->setContent('Span content')
            );

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
        ->assertSee('<div ', false)
        ->assertSee('<p', false)
        ->assertSee('Span content')
        ->assertSee('</p>', false)
        ->assertSee('</div>', false);
    }

    /** @test */
    public function div_with_arguments()
    {
        $div = ComponentBuilder::make(ComponentEnum::DIV)
            ->setContent('Nice div')
            ->setAttribute('id', 'div_id');

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
        ->assertSee('<div', false)
        ->assertSee('id="div_id"', false)
        ->assertSee('</div>', false);
    }

    /** @test */
    public function div_with_sub_components()
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
        ->assertSee('<div', false)
        ->assertSee('<p', false)
        ->assertSee('First paragraph')
        ->assertSee('</p>', false)
        ->assertSee('Second paragraph')
        ->assertSee('</div>', false);
        
    }

    /** @test */
    public function div_with_theme()
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
        ->assertSee('<div', false)
        ->assertSee('class="'.bladeThemes($theme), false)
        ->assertSee('</div>', false);
    }
}
