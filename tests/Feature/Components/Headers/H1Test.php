<?php

namespace Tests\Feature\Components\Headers;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\getThemes;

class H1Test extends TestCase
{
    #[Test]
    public function empty_h1_header()
    {
        $header = ComponentBuilder::make(ComponentEnum::H1);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('<h1', false)
            ->assertSee('</h1>', false);
    }

    #[Test]
    public function h1_header_accepts_content()
    {
        $header = ComponentBuilder::make(ComponentEnum::H1)
            ->setContent('Nice h1 tag');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('Nice h1 tag');
    }

    #[Test]
    public function h1_header_accepts_attributes()
    {
        $header = ComponentBuilder::make(ComponentEnum::H1)
            ->setAttribute('id', 'nice_header');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('id="nice_header"', false);
    }

    #[Test]
    public function h1_header_accepts_sub_components()
    {
        $div = ComponentBuilder::make(ComponentEnum::H1)
            ->setChildren([
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('First span'),
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Second span'),
            ]);

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
            ->assertSee('<span >', false)
            ->assertSee('First span')
            ->assertSee('</span>', false)
            ->assertSee('Second span');
    }

    #[Test]
    public function h1_header_accepts_theme()
    {
        $theme = [
            'color' => 'error',
        ];

        $header = ComponentBuilder::make(ComponentEnum::H1)
            ->setThemes($theme);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('class="'.getThemes($theme), false);

        $this->assertNotEmpty(getThemes($theme));
    }
}
