<?php

namespace Tests\Components\Headers;

use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class H5Test extends TestCase
{
    /** @test */
    public function simple_empty_header()
    {
        $header = ComponentBuilder::make(ComponentEnum::H5);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
        ->assertSee('<h5', false)
        ->assertSee('</h5>', false);
    }

    /** @test */
    public function header_accepts_content()
    {
        $header = ComponentBuilder::make(ComponentEnum::H5)
            ->setContent('Nice h5 tag');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
        ->assertSee('Nice h5 tag');
    }

    /** @test */
    public function header_accepts_attributes()
    {
        $header = ComponentBuilder::make(ComponentEnum::H5)
            ->setAttribute('id', 'nice_header');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
        ->assertSee('id="nice_header"', false);;
    }

    /** @test */
    public function header_accepts_sub_components()
    {
        $div = ComponentBuilder::make(ComponentEnum::H5)
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

        $header = ComponentBuilder::make(ComponentEnum::H5)
            ->setThemes($theme);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }

}
