<?php

namespace Tests\Feature\Components\Inline;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use function ChatAgency\BackendComponents\bladeThemes;

class EmTest extends TestCase
{
    #[Test]
    public function simple_em()
    {
        $em = ComponentBuilder::make(ComponentEnum::EM);

        $this->blade('{{ $em }}', [
            'em' => $em,
        ])
            ->assertSee('<em', false)
            ->assertSee('</em>', false);
    }

    #[Test]
    public function em_accepts_content()
    {
        $em = ComponentBuilder::make(ComponentEnum::EM)
            ->setContent('Nice em tag');

        $this->blade('{{ $em }}', [
            'em' => $em,
        ])
            ->assertSee('Nice em tag');
    }

    #[Test]
    public function em_accepts_attributes()
    {
        $em = ComponentBuilder::make(ComponentEnum::EM)
            ->setAttribute('id', 'nice_em');

        $this->blade('{{ $em }}', [
            'em' => $em,
        ])
            ->assertSee('id="nice_em"', false);
    }

    #[Test]
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

    #[Test]
    public function em_accepts_theme()
    {
        $theme = [
            'display' => 'inline-block',
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
