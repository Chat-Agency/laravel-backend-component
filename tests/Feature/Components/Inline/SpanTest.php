<?php

namespace Tests\Feature\Components\Inline;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\getThemes;

class SpanTest extends TestCase
{
    #[Test]
    public function simple_span()
    {
        $span = ComponentBuilder::make(ComponentEnum::SPAN);

        $this->blade('{{ $span }}', [
            'span' => $span,
        ])
            ->assertSee('<span', false)
            ->assertSee('</span>', false);
    }

    #[Test]
    public function span_accepts_content()
    {
        $span = ComponentBuilder::make(ComponentEnum::SPAN)
            ->setContent('Nice span');

        $this->blade('{{ $span }}', [
            'span' => $span,
        ])
            ->assertSee('Nice span');
    }

    #[Test]
    public function span_accepts_contents_array()
    {
        $span = ComponentBuilder::make(ComponentEnum::SPAN)
            ->setContents([
                'content 1 ',
                'content 2',
            ]);

        $this->blade('{{ $span }}', [
            'span' => $span,
        ])
            ->assertSee('<span', false)
            ->assertSee('content 1 ')
            ->assertSee('content 2')
            ->assertSee('</span>', false);
    }

    #[Test]
    public function span_accepts_attributes()
    {
        $span = ComponentBuilder::make(ComponentEnum::SPAN)
            ->setAttribute('id', 'nice_span');

        $this->blade('{{ $span }}', [
            'span' => $span,
        ])
            ->assertSee('id="nice_span"', false);
    }

    #[Test]
    public function button_accepts_theme()
    {
        $theme = [
            'font' => 'bold',
        ];

        $span = ComponentBuilder::make(ComponentEnum::SPAN)
            ->setThemes($theme);

        $this->blade('{{ $span }}', [
            'span' => $span,
        ])
            ->assertSee('class="'.getThemes($theme), false);

        $this->assertNotEmpty(getThemes($theme));
    }
}
