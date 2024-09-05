<?php

namespace Tests\Feature\Components\Headers;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class H4Test extends TestCase
{
    #[Test]
    public function empty_h4_header()
    {
        $header = ComponentBuilder::make(ComponentEnum::H4);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('<h4', false)
            ->assertSee('</h4>', false);
    }

    #[Test]
    public function h4_header_accepts_content()
    {
        $header = ComponentBuilder::make(ComponentEnum::H4)
            ->setContent('Nice h4 tag');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('Nice h4 tag');
    }

    #[Test]
    public function h4_header_accepts_attributes()
    {
        $header = ComponentBuilder::make(ComponentEnum::H4)
            ->setAttribute('id', 'nice_header');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('id="nice_header"', false);
    }

    #[Test]
    public function h4_header_accepts_sub_components()
    {
        $div = ComponentBuilder::make(ComponentEnum::H4)
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
    public function h4_header_accepts_theme()
    {
        $theme = [
            'color' => 'error',
        ];

        $header = ComponentBuilder::make(ComponentEnum::H4)
            ->setThemes($theme);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
