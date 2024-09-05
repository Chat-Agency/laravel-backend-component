<?php

namespace Tests\Feature\Components\Headers;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class H5Test extends TestCase
{
    #[Test]
    public function empty_h5_header()
    {
        $header = ComponentBuilder::make(ComponentEnum::H5);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('<h5', false)
            ->assertSee('</h5>', false);
    }

    #[Test]
    public function h5_header_accepts_content()
    {
        $header = ComponentBuilder::make(ComponentEnum::H5)
            ->setContent('Nice h5 tag');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('Nice h5 tag');
    }

    #[Test]
    public function h5_header_accepts_attributes()
    {
        $header = ComponentBuilder::make(ComponentEnum::H5)
            ->setAttribute('id', 'nice_header');

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('id="nice_header"', false);
    }

    #[Test]
    public function h5_header_accepts_sub_components()
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

    #[Test]
    public function h5_header_accepts_theme()
    {
        $theme = [
            'color' => 'error',
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
