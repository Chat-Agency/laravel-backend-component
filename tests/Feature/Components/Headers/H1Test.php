<?php

namespace Tests\Feature\Components\Headers;

use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class H1Test extends TestCase
{
    /** @test */
    public function empty_empty_header()
    {
        $header = ComponentBuilder::make(ComponentEnum::H1);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
        ->assertSee('<h1', false)
        ->assertSee('</h1>', false);
    }

    /** @test */
    public function header_accepts_content()
    {
        $header = ComponentBuilder::make(ComponentEnum::H1)
            ->setContent('Nice h1 tag');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
        ->assertSee('Nice h1 tag');
    }

    /** @test */
    public function header_accepts_attributes()
    {
        $header = ComponentBuilder::make(ComponentEnum::H1)
            ->setAttribute('id', 'nice_header');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
        ->assertSee('id="nice_header"', false);;
    }

    /** @test */
    public function header_accepts_sub_components()
    {
        $div = ComponentBuilder::make(ComponentEnum::H1)
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
    public function header_accepts_theme()
    {
        $theme = [
            'color' =>  'error',
        ];

        $header = ComponentBuilder::make(ComponentEnum::H1)
            ->setThemes($theme);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }

}
