<?php

namespace Tests\Feature\Components\Inline;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use function ChatAgency\BackendComponents\bladeThemes;

class BoldTest extends TestCase
{
    #[Test]
    public function simple_empty_bold()
    {
        $bold = ComponentBuilder::make(ComponentEnum::BOLD);

        $this->blade('{{ $bold }}', [
            'bold' => $bold,
        ])
            ->assertSee('<b', false)
            ->assertSee('</b>', false);
    }

    #[Test]
    public function bold_accepts_content()
    {
        $bold = ComponentBuilder::make(ComponentEnum::BOLD)
            ->setContent('Nice b tag');

        $this->blade('{{ $bold }}', [
            'bold' => $bold,
        ])
            ->assertSee('Nice b tag');
    }

    #[Test]
    public function bold_accepts_attributes()
    {
        $bold = ComponentBuilder::make(ComponentEnum::BOLD)
            ->setAttribute('id', 'nice_bold');

        $this->blade('{{ $bold }}', [
            'bold' => $bold,
        ])
            ->assertSee('id="nice_bold"', false);
    }

    #[Test]
    public function bold_does_not_accept_sub_components()
    {
        $bold = ComponentBuilder::make(ComponentEnum::BOLD)
            ->setSubComponent(
                ComponentBuilder::make(ComponentEnum::SPAN)
            );

        $this->blade('{{ $bold }}', [
            'bold' => $bold,
        ])
            ->assertDontSee('<span', false)
            ->assertDontSee('</span>', false);
    }

    #[Test]
    public function bold_accepts_theme()
    {
        $theme = [
            'display' => 'inline-block',
        ];

        $bold = ComponentBuilder::make(ComponentEnum::BOLD)
            ->setThemes($theme);

        $this->blade('{{ $bold }}', [
            'bold' => $bold,
        ])
            ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
