<?php

namespace Tests\Feature\Components\Inline;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\getThemes;

class ItalicTest extends TestCase
{
    #[Test]
    public function simple_italic()
    {
        $italic = ComponentBuilder::make(ComponentEnum::ITALIC);

        $this->blade('{{ $italic }}', [
            'italic' => $italic,
        ])
            ->assertSee('<i', false)
            ->assertSee('</i>', false);
    }

    #[Test]
    public function italic_accepts_content()
    {
        $italic = ComponentBuilder::make(ComponentEnum::ITALIC)
            ->setContent('Nice i tag');

        $this->blade('{{ $italic }}', [
            'italic' => $italic,
        ])
            ->assertSee('Nice i tag');
    }

    #[Test]
    public function italic_accepts_attributes()
    {
        $italic = ComponentBuilder::make(ComponentEnum::ITALIC)
            ->setAttribute('id', 'nice_italic');

        $this->blade('{{ $italic }}', [
            'italic' => $italic,
        ])
            ->assertSee('id="nice_italic"', false);
    }

    #[Test]
    public function italic_does_not_accept_sub_components()
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

    #[Test]
    public function italic_accepts_theme()
    {
        $theme = [
            'display' => 'inline-block',
        ];

        $italic = ComponentBuilder::make(ComponentEnum::ITALIC)
            ->setThemes($theme);

        $this->blade('{{ $italic }}', [
            'italic' => $italic,
        ])
            ->assertSee('class="'.getThemes($theme), false);

        $this->assertNotEmpty(getThemes($theme));
    }
}
