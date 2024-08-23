<?php

namespace Tests\Components\Inline;
use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class StrongTest extends TestCase
{
    /** @test */
    public function simple_strong()
    {
        $strong = ComponentBuilder::make(ComponentEnum::STRONG);

        $this->blade('{{ $strong }}', [
            'strong' => $strong,
        ])
        ->assertSee('<strong', false)
        ->assertSee('</strong>', false);
    }

    /** @test */
    public function strong_accepts_content()
    {
        $strong = ComponentBuilder::make(ComponentEnum::STRONG)
            ->setContent('Nice strong tag');

        $this->blade('{{ $strong }}', [
            'strong' => $strong,
        ])
        ->assertSee('Nice strong tag');
    }

    /** @test */
    public function strong_accepts_attributes()
    {
        $strong = ComponentBuilder::make(ComponentEnum::STRONG)
            ->setAttribute('id', 'nice_strong');

        $this->blade('{{ $strong }}', [
            'strong' => $strong,
        ])
        ->assertSee('id="nice_strong"', false);
    }

    /** @test */
    public function strong_does_not_accept_sub_components()
    {
        $strong = ComponentBuilder::make(ComponentEnum::STRONG)
            ->setSubComponent(
                ComponentBuilder::make(ComponentEnum::SPAN)
            );

        $this->blade('{{ $strong }}', [
            'strong' => $strong,
        ])
        ->assertDontSee('<span', false);
    }

    /** @test */
    public function strong_accepts_theme()
    {
        $theme = [
            'display' =>  'inline-block',
        ];

        $strong = ComponentBuilder::make(ComponentEnum::STRONG)
            ->setThemes($theme);

        $this->blade('{{ $strong }}', [
            'strong' => $strong,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);
    }
}
