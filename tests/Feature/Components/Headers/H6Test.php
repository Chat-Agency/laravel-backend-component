<?php

namespace Tests\Feature\Components\Headers;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\getThemes;

class H6Test extends TestCase
{
    #[Test]
    public function empty_h6_header()
    {
        $header = ComponentBuilder::make(ComponentEnum::H6);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('<h6', false)
            ->assertSee('</h6>', false);
    }

    #[Test]
    public function h6_header_accepts_content()
    {
        $header = ComponentBuilder::make(ComponentEnum::H6)
            ->setContent('Nice h6 tag');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('Nice h6 tag');
    }

    #[Test]
    public function h6_accepts_contents_array()
    {
        $header = ComponentBuilder::make(ComponentEnum::H6)
            ->setContents([
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Span'),
                ComponentBuilder::make(ComponentEnum::BOLD)
                    ->setContent('Bold'),
            ]);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('<h6', false)
            ->assertSee('<span', false)
            ->assertSee('Span')
            ->assertSee('</span>', false)
            ->assertSee('<b', false)
            ->assertSee('Bold')
            ->assertSee('</b>', false)
            ->assertSee('</h6>', false);
    }


    #[Test]
    public function h6_header_accepts_attributes()
    {
        $header = ComponentBuilder::make(ComponentEnum::H6)
            ->setAttribute('id', 'nice_header');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('id="nice_header"', false);
    }

    #[Test]
    public function h6_header_accepts_theme()
    {
        $theme = [
            'color' => 'error',
        ];

        $header = ComponentBuilder::make(ComponentEnum::H6)
            ->setThemes($theme);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('class="'.getThemes($theme), false);

        $this->assertNotEmpty(getThemes($theme));
    }
}
