<?php

namespace Tests\Feature\Components\Headers;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use Tests\TestCase;

class H3Test extends TestCase
{
    /** @test */
    public function empty_h3_header()
    {
        $header = ComponentBuilder::make(ComponentEnum::H3);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('<h3', false)
            ->assertSee('</h3>', false);
    }

    /** @test */
    public function h3_header_accepts_content()
    {
        $header = ComponentBuilder::make(ComponentEnum::H3)
            ->setContent('Nice h3 tag');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('Nice h3 tag');
    }

    /** @test */
    public function h3_header_accepts_attributes()
    {
        $header = ComponentBuilder::make(ComponentEnum::H3)
            ->setAttribute('id', 'nice_header');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('id="nice_header"', false);
    }

    /** @test */
    public function h3_header_accepts_sub_components()
    {
        $div = ComponentBuilder::make(ComponentEnum::H3)
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

    /** @test */
    public function h3_header_accepts_theme()
    {
        $theme = [
            'color' => 'error',
        ];

        $header = ComponentBuilder::make(ComponentEnum::H3)
            ->setThemes($theme);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
