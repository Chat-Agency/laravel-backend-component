<?php

namespace Tests\Feature\Components\Inline;

use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class EmTest extends TestCase
{
    /** @test */
    public function simple_em()
    {
        $em = ComponentBuilder::make(ComponentEnum::EM);

        $this->blade('{{ $em }}', [
            'em' => $em,
        ])
        ->assertSee('<em', false)
        ->assertSee('</em>', false);
    }

    /** @test */
    public function em_accepts_content()
    {
        $em = ComponentBuilder::make(ComponentEnum::EM)
            ->setContent('Nice em tag');

        $this->blade('{{ $em }}', [
            'em' => $em,
        ])
        ->assertSee('Nice em tag');
    }

    /** @test */
    public function em_accepts_attributes()
    {
        $em = ComponentBuilder::make(ComponentEnum::EM)
            ->setAttribute('id', 'nice_em');

        $this->blade('{{ $em }}', [
            'em' => $em,
        ])
        ->assertSee('id="nice_em"', false);
    }

    /** @test */
    public function em_does_not_accept_sub_components()
    {
        $em = ComponentBuilder::make(ComponentEnum::EM)
            ->setSubComponent(
                ComponentBuilder::make(ComponentEnum::SPAN)
            );

        $this->blade('{{ $em }}', [
            'em' => $em,
        ])
        ->assertDontSee('<span', false)
        ->assertDontSee('</span>', false);
    }

    /** @test */
    public function em_accepts_theme()
    {
        $theme = [
            'display' =>  'inline-block',
        ];

        $em = ComponentBuilder::make(ComponentEnum::EM)
            ->setThemes($theme);

        $this->blade('{{ $em }}', [
            'em' => $em,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
