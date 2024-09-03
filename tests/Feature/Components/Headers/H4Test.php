<?php

namespace Tests\Feature\Components\Headers;

use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class H4Test extends TestCase
{
    /** @test */
    public function empty_empty_header()
    {
        $header = ComponentBuilder::make(ComponentEnum::H4);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
        ->assertSee('<h4', false)
        ->assertSee('</h4>', false);
    }

    /** @test */
    public function header_accepts_content()
    {
        $header = ComponentBuilder::make(ComponentEnum::H4)
            ->setContent('Nice h4 tag');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
        ->assertSee('Nice h4 tag');
    }

    /** @test */
    public function header_accepts_attributes()
    {
        $header = ComponentBuilder::make(ComponentEnum::H4)
            ->setAttribute('id', 'nice_header');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
        ->assertSee('id="nice_header"', false);;
    }

    /** @test */
    public function header_accepts_sub_components()
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

    /** @test */
    public function header_accepts_theme()
    {
        $theme = [
            'color' =>  'error',
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
