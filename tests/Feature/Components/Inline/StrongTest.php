<?php

namespace Tests\Feature\Components\Inline;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class StrongTest extends TestCase
{
    #[Test]
    public function simple_strong()
    {
        $strong = ComponentBuilder::make(ComponentEnum::STRONG);

        $this->blade('{{ $strong }}', [
            'strong' => $strong,
        ])
            ->assertSee('<strong', false)
            ->assertSee('</strong>', false);
    }

    #[Test]
    public function strong_accepts_content()
    {
        $strong = ComponentBuilder::make(ComponentEnum::STRONG)
            ->setContent('Nice strong tag');

        $this->blade('{{ $strong }}', [
            'strong' => $strong,
        ])
            ->assertSee('Nice strong tag');
    }

    #[Test]
    public function strong_accepts_attributes()
    {
        $strong = ComponentBuilder::make(ComponentEnum::STRONG)
            ->setAttribute('id', 'nice_strong');

        $this->blade('{{ $strong }}', [
            'strong' => $strong,
        ])
            ->assertSee('id="nice_strong"', false);
    }

    #[Test]
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

    #[Test]
    public function strong_accepts_theme()
    {
        $theme = [
            'display' => 'inline-block',
        ];

        $strong = ComponentBuilder::make(ComponentEnum::STRONG)
            ->setThemes($theme);

        $this->blade('{{ $strong }}', [
            'strong' => $strong,
        ])
            ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
