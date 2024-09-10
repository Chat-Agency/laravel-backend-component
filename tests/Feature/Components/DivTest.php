<?php

namespace Tests\Feature\Components;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\bladeThemes;

class DivTest extends TestCase
{
    #[Test]
    public function empty_div()
    {
        $div = ComponentBuilder::make(ComponentEnum::DIV);

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
            ->assertSee('<div', false)
            ->assertSee('</div>', false);
    }

    #[Test]
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

    #[Test]
    public function div_accepts_attributes()
    {
        $div = ComponentBuilder::make(ComponentEnum::DIV)
            ->setAttribute('id', 'div_id');

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
            ->assertSee('id="div_id"', false);
    }

    #[Test]
    public function div_accepts_sub_components()
    {
        $div = ComponentBuilder::make(ComponentEnum::DIV)
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

    #[Test]
    public function div_accepts_theme()
    {
        $theme = [
            'color' => 'success',
        ];

        $div = ComponentBuilder::make(ComponentEnum::DIV)
            ->setThemes($theme);

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
            ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
