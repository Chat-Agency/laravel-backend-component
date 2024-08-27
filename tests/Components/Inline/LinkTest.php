<?php

namespace Tests\Components\Inline;

use Tests\TestCase;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;


class LinkTest extends TestCase
{
    /** @test */
    public function simple_link()
    {
        $link = ComponentBuilder::make(ComponentEnum::LINK);

        $this->blade('{{ $link }}', [
            'link' => $link,
        ])
        ->assertSee('<a ', false)
        ->assertSee('</a>', false);
    }

    /** @test */
    public function link_accepts_content()
    {
        $link = ComponentBuilder::make(ComponentEnum::LINK)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Span content')
            );

        $this->blade('{{ $link }}', [
            'link' => $link,
        ])
        ->assertSee('<a ', false)
        ->assertSee('<span', false)
        ->assertSee('Span content')
        ->assertSee('</span>', false)
        ->assertSee('</a>', false);
    }

    /** @test */
    public function link_accepts_attributes()
    {
        $link = ComponentBuilder::make(ComponentEnum::LINK)
            ->setContent('Nice link')
            ->setAttribute('target', '_blank');

        $this->blade('{{ $link }}', [
            'link' => $link,
        ])
        ->assertSee('<a', false)
        ->assertSee('target="_blank"', false)
        ->assertSee('</a>', false);
    }

    /** @test */
    public function link_accepts_sub_components()
    {
        $link = ComponentBuilder::make(ComponentEnum::LINK)
            ->setContent('Nice link')
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Inside span')
            ]);

        $this->blade('{{ $link }}', [
            'link' => $link,
        ])
        ->assertSee('<a', false)
        ->assertSee('<span', false)
        ->assertSee('Inside span')
        ->assertSee('</span>', false)
        ->assertSee('</a>', false);
        
    }
    
    /** @test */
    public function link_accepts_theme()
    {
        $theme = [
            'action' =>  'default',
        ];
        
        $link = ComponentBuilder::make(ComponentEnum::LINK)
            ->setContent('Nice link')
            ->setThemes($theme);
        
        $this->blade('{{ $link }}', [
            'link' => $link,
        ])
        ->assertSee('<a', false)
        ->assertSee('class="'.bladeThemes($theme), false)
        ->assertSee('</a>', false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}