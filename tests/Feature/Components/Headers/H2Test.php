<?php

namespace Tests\Feature\Components\Headers;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\bladeThemes;

class H2Test extends TestCase
{
    #[Test]
    public function empty_h2_header()
    {
        $header = ComponentBuilder::make(ComponentEnum::H2);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('<h2', false)
            ->assertSee('</h2>', false);
    }

    #[Test]
    public function h2_header_accepts_content()
    {
        $header = ComponentBuilder::make(ComponentEnum::H2)
            ->setContent('Nice h2 tag');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('Nice h2 tag');
    }

    #[Test]
    public function h2_header_accepts_attributes()
    {
        $header = ComponentBuilder::make(ComponentEnum::H2)
            ->setAttribute('id', 'nice_header');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('id="nice_header"', false);
    }

    #[Test]
    public function h2_header_accepts_sub_components()
    {
        $div = ComponentBuilder::make(ComponentEnum::H2)
            ->setSubComponents([
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
    public function h2_header_accepts_theme()
    {
        $theme = [
            'color' => 'error',
        ];

        $header = ComponentBuilder::make(ComponentEnum::H2)
            ->setThemes($theme);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
