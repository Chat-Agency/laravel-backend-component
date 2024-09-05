<?php

namespace Tests\Feature\Components\Inline;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SmallTest extends TestCase
{
    #[Test]
    public function simple_empty_small()
    {
        $small = ComponentBuilder::make(ComponentEnum::SMALL);

        $this->blade('{{ $small }}', [
            'small' => $small,
        ])
            ->assertSee('<small', false)
            ->assertSee('</small>', false);
    }

    #[Test]
    public function small_accepts_content()
    {
        $small = ComponentBuilder::make(ComponentEnum::SMALL)
            ->setContent('Nice b tag');

        $this->blade('{{ $small }}', [
            'small' => $small,
        ])
            ->assertSee('Nice b tag');
    }

    #[Test]
    public function small_accepts_attributes()
    {
        $small = ComponentBuilder::make(ComponentEnum::SMALL)
            ->setAttribute('id', 'nice_small');

        $this->blade('{{ $small }}', [
            'small' => $small,
        ])
            ->assertSee('id="nice_small"', false);
    }

    #[Test]
    public function small_does_not_accept_sub_components()
    {
        $small = ComponentBuilder::make(ComponentEnum::SMALL)
            ->setSubComponent(
                ComponentBuilder::make(ComponentEnum::SPAN)
            );

        $this->blade('{{ $small }}', [
            'small' => $small,
        ])
            ->assertDontSee('<span', false)
            ->assertDontSee('</span>', false);
    }

    #[Test]
    public function small_accepts_theme()
    {
        $theme = [
            'display' => 'inline-block',
        ];

        $small = ComponentBuilder::make(ComponentEnum::SMALL)
            ->setThemes($theme);

        $this->blade('{{ $small }}', [
            'small' => $small,
        ])
            ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
